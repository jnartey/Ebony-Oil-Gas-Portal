<?php
namespace App\Controller\Department;
use App\Controller\Department\AppController;
use Cake\ORM\TableRegistry;
use Cake\Mailer\Email;
use Cake\Routing\Router;

/**
 * DepartmentForums Controller
 *
 * @property \App\Model\Table\DepartmentForumsTable $DepartmentForums
 *
 * @method \App\Model\Entity\DepartmentForum[] paginate($object = null, array $settings = [])
 */
class DepartmentForumsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
		$user = $this->Auth->user();
		$user_table = TableRegistry::get('Users');		
		$get_user = $user_table->find('all')->where(['Users.id' => $user['id']])->first();

		$department_members = TableRegistry::get('DepartmentsMembers');
		$department_member = $department_members->find('all')->where(['DepartmentsMembers.user_id'=>$user['id']])->first();
		
        $departmentsForums = $this->DepartmentForums->find('all', [
			'conditions' => ['DepartmentForums.department_id' => $get_user->department_access],
			'contain' => ['Departments', 'Users']
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
        $departmentsForum = $this->DepartmentForums->get($id, [
            'contain' => ['Departments', 'Users']
        ]);
			
		$users = TableRegistry::get('Users');
		$comments = TableRegistry::get('DepartmentComments');
		//$comment = $comments->newEntity();
		
		$userA = $this->Auth->user();
		
		$user_table = TableRegistry::get('Users');
		$get_user = $user_table->find('all')->where(['Users.id' => $userA['id']])->first();
	
		$post = null;
	
		if($comment_id){
	        $comment = $comments->get($comment_id, [
	            'contain' => []
	        ]);
			
	        if ($this->request->is(['patch', 'post', 'put'])) {
	            $comment_post = $comments->patchEntity($comment, $this->request->getData());
				$comment_post->department_id = $get_user->department_access;
	            if ($comments->save($comment_post)) {
					$this->Log->write('info', 'Forum', $userA['first_name'].' '.$userA['last_name'].' commented '.$this->request->getData('comment'), [], ['request' => true], $this->request->getData('forum_id'), $get_user->department_access);
	                $this->Flash->success(__('The comment has been Updated.'));

	                return $this->redirect(['action' => 'view', $this->request->getData('forum_id')]);
	            }
	            $this->Flash->error(__('The comment could not be saved. Please, try again.'));
	        }
		}else{
			$comment = $comments->newEntity();
		
	        if ($this->request->is('post')) {
	            $comment_post = $comments->patchEntity($comment, $this->request->getData());
				$comment_post->department_id = $get_user->department_access;
	            if ($comments->save($comment_post)) {
					$this->Log->write('info', 'Forum', $userA['first_name'].' '.$userA['last_name'].' commented '.$this->request->getData('comment'), [], ['request' => true], $this->request->getData('forum_id'), $get_user->department_access);
	                $this->Flash->success(__('The comment has been saved.'));

	                return $this->redirect(['action' => 'view', $this->request->getData('forum_id')]);
	            }
	            $this->Flash->error(__('The comment could not be saved. Please, try again.'));
	        }
		}
		
        $this->paginate = [
			'conditions'=>['DepartmentComments.source_id'=>$departmentsForum->id, 'DepartmentComments.forum_id'=>$departmentsForum->id],
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
        $departmentsForum = $this->DepartmentForums->newEntity();
		$user = $this->Auth->user();
		$user_table = TableRegistry::get('Users');		
		$get_user = $user_table->find('all')->where(['Users.id' => $user['id']])->first();
		
        if ($this->request->is('post')) {
            $departmentsForum = $this->DepartmentForums->patchEntity($departmentsForum, $this->request->getData());
			$departmentsForum->department_id = $get_user->department_access;
            if ($result = $this->DepartmentForums->save($departmentsForum)) {
				$this->Log->write('info', 'Forum', $user['first_name'].' '.$user['last_name'].' added '.$this->request->getData('title'), [], ['request' => true], $result->id, $get_user->department_access);
                $this->Flash->success(__('The departments forum has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The departments forum could not be saved. Please, try again.'));
        }
        $departments = $this->DepartmentForums->Departments->find('list', ['limit' => 200]);
        $users = $this->DepartmentForums->Users->find('list', ['limit' => 200]);
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
		$userA = $this->Auth->user();
        $departmentsForum = $this->DepartmentForums->get($id, [
            'contain' => []
        ]);
        $forum = $this->DepartmentForums->get($id, [
            'contain' => []
        ]);
		
		$user_table = TableRegistry::get('Users');
		$get_user = $user_table->find('all')->where(['Users.id' => $userA['id']])->first();
			
        if ($this->request->is(['patch', 'post', 'put'])) {
            $departmentsForum = $this->DepartmentForums->patchEntity($departmentsForum, $this->request->getData());
            if ($this->DepartmentForums->save($departmentsForum)) {
				$this->Log->write('info', 'Forum', $userA['first_name'].' '.$userA['last_name'].' edited '.$forum->title, [], ['request' => true], $forum->id, $get_user->department_access);
                $this->Flash->success(__('The departments forum has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The departments forum could not be saved. Please, try again.'));
        }
        $departments = $this->DepartmentForums->Departments->find('list', ['limit' => 200]);
        $users = $this->DepartmentForums->Users->find('list', ['limit' => 200]);
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
        $departmentsForum = $this->DepartmentForums->get($id);
		
		$user_table = TableRegistry::get('Users');
		$get_user = $user_table->find('all')->where(['Users.id' => $userA['id']])->first();
		
        if ($this->DepartmentForums->delete($departmentsForum)) {
			$this->Log->write('info', 'Forum', $userA['first_name'].' '.$userA['last_name'].' deleted '.$departmentsForum->title, [], ['request' => true], $departmentsForum->id, $get_user->department_access);
            $this->Flash->success(__('The departments forum has been deleted.'));
        } else {
            $this->Flash->error(__('The departments forum could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
