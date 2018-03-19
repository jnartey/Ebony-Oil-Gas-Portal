<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Mailer\Email;

/**
 * Forums Controller
 *
 * @property \App\Model\Table\ForumsTable $Forums
 *
 * @method \App\Model\Entity\DepartmentsForum[] paginate($object = null, array $settings = [])
 */
class ForumsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
		$user = $this->Auth->user();
		$department_members = TableRegistry::get('DepartmentsMembers');
		$department_member = $department_members->find('all')->where(['DepartmentsMembers.user_id'=>$user['id']])->first();
		
        $departmentsForums = $this->Forums->find('all', [
			'conditions' => [],
			'contain' => ['Users']
		]);

        $this->set(compact('departmentsForums'));
        $this->set('_serialize', ['departmentsForums']);
    }

    /**
     * View method
     *
     * @param string|null $id Departments Forum id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null, $comment_id = null)
    {
        $departmentsForum = $this->Forums->get($id, [
            'contain' => ['Users']
        ]);
			
		$users = TableRegistry::get('Users');
		$comments = TableRegistry::get('Comments');
		//$comment = $comments->newEntity();
	
		$post = null;
		
		$userA = $this->Auth->user();
	
		if($comment_id){
	        $comment = $comments->get($comment_id, [
	            'contain' => []
	        ]);
			
	        if ($this->request->is(['patch', 'post', 'put'])) {
	            $comment_post = $comments->patchEntity($comment, $this->request->getData());
	            if ($comments->save($comment_post)) {
	                $this->Flash->success(__('The comment has been Updated.'));
					
					$this->Log->write('info', 'Forum', $userA['first_name'].' '.$userA['last_name'].' commented '.$this->request->getData('comment'), [], ['request' => true], $this->request->getData('forum_id'));

	                return $this->redirect(['action' => 'view', $this->request->getData('forum_id')]);
	            }
	            $this->Flash->error(__('The comment could not be saved. Please, try again.'));
	        }
		}else{
			$comment = $comments->newEntity();
		
	        if ($this->request->is('post')) {
	            $comment_post = $comments->patchEntity($comment, $this->request->getData());
	            if ($comments->save($comment_post)) {
					$this->Log->write('info', 'Forum', $userA['first_name'].' '.$userA['last_name'].' commented '.$this->request->getData('comment'), [], ['request' => true], $this->request->getData('forum_id'));
	                $this->Flash->success(__('The comment has been saved.'));

	                return $this->redirect(['action' => 'view', $this->request->getData('forum_id')]);
	            }
	            $this->Flash->error(__('The comment could not be saved. Please, try again.'));
	        }
		}
		
        $this->paginate = [
			'conditions'=>['Comments.source_id'=>$departmentsForum->id, 'Comments.forum_id'=>$departmentsForum->id],
            'contain' => ['Users']
        ];
		
        $posts = $this->paginate($comments);
				
        $this->set(compact('departmentsForum', 'users', 'comment', 'posts', 'comment_id'));

        $this->set('_serialize', ['departmentsForum']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
		$user = $this->Auth->user();
        $departmentsForum = $this->Forums->newEntity();
        if ($this->request->is('post')) {
            $departmentsForum = $this->Forums->patchEntity($departmentsForum, $this->request->getData());
			//$departmentsForum->department_id = $this->request->getData('department_id');
            if ($result = $this->Forums->save($departmentsForum)) {
				$this->Log->write('info', 'Forum', $user['first_name'].' '.$user['last_name'].' added '.$this->request->getData('title'), [], ['request' => true], $result->id);
                $this->Flash->success(__('The forum has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The forum could not be saved. Please, try again.'));
        }
        $departments = $this->Forums->find('list', ['limit' => 200]);
        $users = $this->Forums->Users->find('list', ['limit' => 200]);
        $this->set(compact('departmentsForum', 'departments', 'users'));
        $this->set('_serialize', ['departmentsForum']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Departments Forum id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
		$user = $this->Auth->user();
        $departmentsForum = $this->Forums->get($id, [
            'contain' => []
        ]);
        $forum = $this->Forums->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $departmentsForum = $this->Forums->patchEntity($departmentsForum, $this->request->getData());
            if ($this->Forums->save($departmentsForum)) {
				$this->Log->write('info', 'Forum', $user['first_name'].' '.$user['last_name'].' edited '.$forum->title, [], ['request' => true], $forum->id);
                $this->Flash->success(__('The forum has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The forum could not be saved. Please, try again.'));
        }
        $departments = $this->Forums->find('list', ['limit' => 200]);
        $users = $this->Forums->Users->find('list', ['limit' => 200]);
        $this->set(compact('departmentsForum', 'departments', 'users'));
        $this->set('_serialize', ['departmentsForum']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Departments Forum id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
		$userA = $this->Auth->user();
        $this->request->allowMethod(['post', 'delete']);
        $departmentsForum = $this->Forums->get($id);
        if ($this->Forums->delete($departmentsForum)) {
            $this->Flash->success(__('The departments forum has been deleted.'));
			$this->Log->write('info', 'Forum', $userA['first_name'].' '.$userA['last_name'].' deleted '.$departmentsForum->title, [], ['request' => true], $departmentsForum->id);
        } else {
            $this->Flash->error(__('The departments forum could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
