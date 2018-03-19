<?php
namespace App\Controller\Workgroup;
use App\Controller\Workgroup\AppController;
use Cake\ORM\TableRegistry;
use Cake\Mailer\Email;
use Cake\Routing\Router;
/**
 * WorkgroupForums Controller
 *
 * @property \App\Model\Table\WorkgroupForumsTable $WorkgroupForums
 *
 * @method \App\Model\Entity\WorkgroupForum[] paginate($object = null, array $settings = [])
 */
class WorkgroupForumsController extends AppController
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

		$workgroup_members = TableRegistry::get('WorkgroupsMembers');
		$workgroup_member = $workgroup_members->find('all')->where(['WorkgroupsMembers.user_id'=>$user['id']])->first();
		
        $workgroupsForums = $this->WorkgroupForums->find('all', [
			'conditions' => ['WorkgroupForums.workgroup_id' => $get_user->workgroup_access],
			'contain' => ['Workgroups', 'Users']
		]);

        $this->set(compact('workgroupsForums'));
        $this->set('_serialize', ['workgroupsForums']);
    }

    /**
     * View method
     *
     * @param string|null $id Workgroups Forum id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null, $comment_id = null)
    {
        $workgroupsForum = $this->WorkgroupForums->get($id, [
            'contain' => ['Workgroups', 'Users']
        ]);
			
		$users = TableRegistry::get('Users');
		$comments = TableRegistry::get('Comments');
		//$comment = $comments->newEntity();
		
		$userA = $this->Auth->user();
	
		$post = null;
		
		$user_table = TableRegistry::get('Users');
		$get_user = $user_table->find('all')->where(['Users.id' => $user['id']])->first();
	
		if($comment_id){
	        $comment = $comments->get($comment_id, [
	            'contain' => []
	        ]);
			
	        if ($this->request->is(['patch', 'post', 'put'])) {
	            $comment_post = $comments->patchEntity($comment, $this->request->getData());
				$comment_post->workgroup_id = $get_user->workgroup_access;
	            if ($comments->save($comment_post)) {
					$this->Log->write('info', 'Forum', $userA['first_name'].' '.$userA['last_name'].' commented '.$this->request->getData('comment'), [], ['request' => true], $this->request->getData('forum_id'));
	                $this->Flash->success(__('The comment has been Updated.'));

	                return $this->redirect(['action' => 'view', $this->request->getData('forum_id')]);
	            }
	            $this->Flash->error(__('The comment could not be saved. Please, try again.'));
	        }
		}else{
			$comment = $comments->newEntity();
		
	        if ($this->request->is('post')) {
	            $comment_post = $comments->patchEntity($comment, $this->request->getData());
				$comment_post->workgroup_id = $get_user->workgroup_access;
	            if ($comments->save($comment_post)) {
					$this->Log->write('info', 'Forum', $userA['first_name'].' '.$userA['last_name'].' commented '.$this->request->getData('comment'), [], ['request' => true], $this->request->getData('forum_id'));
	                $this->Flash->success(__('The comment has been saved.'));

	                return $this->redirect(['action' => 'view', $this->request->getData('forum_id')]);
	            }
	            $this->Flash->error(__('The comment could not be saved. Please, try again.'));
	        }
		}
		
        $this->paginate = [
			'conditions'=>['Comments.source_id'=>$workgroupsForum->id, 'Comments.forum_id'=>$workgroupsForum->id],
            'contain' => ['Users']
        ];
		
        $posts = $this->paginate($comments);
				
        $this->set(compact('workgroupsForum', 'users', 'comment', 'posts', 'comment_id'));

        $this->set('_serialize', ['workgroupsForum']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
		$userA = $this->Auth->user();
        $workgroupsForum = $this->WorkgroupForums->newEntity();
		$user = $this->Auth->user();
		$user_table = TableRegistry::get('Users');		
		$get_user = $user_table->find('all')->where(['Users.id' => $userA['id']])->first();
		
        if ($this->request->is('post')) {
            $workgroupsForum = $this->WorkgroupForums->patchEntity($workgroupsForum, $this->request->getData());
			$workgroupsForum->workgroup_id = $get_user->workgroup_access;
            if ($result = $this->WorkgroupForums->save($workgroupsForum)) {
				$this->Log->write('info', 'Forum', $userA['first_name'].' '.$userA['last_name'].' added '.$this->request->getData('title'), [], ['request' => true], $result->id, null, $get_user->workgroup_access);
                $this->Flash->success(__('The workgroups forum has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The workgroups forum could not be saved. Please, try again.'));
        }
        $workgroups = $this->WorkgroupForums->Workgroups->find('list', ['limit' => 200]);
        $users = $this->WorkgroupForums->Users->find('list', ['limit' => 200]);
        $this->set(compact('workgroupsForum', 'workgroups', 'users'));
        $this->set('_serialize', ['workgroupsForum']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Workgroups Forum id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
		$userA = $this->Auth->user();
        $workgroupsForum = $this->WorkgroupForums->get($id, [
            'contain' => []
        ]);
        $forum = $this->WorkgroupForums->get($id, [
            'contain' => []
        ]);
		
		$user_table = TableRegistry::get('Users');
		$get_user = $user_table->find('all')->where(['Users.id' => $userA['id']])->first();	
		
        if ($this->request->is(['patch', 'post', 'put'])) {
            $workgroupsForum = $this->WorkgroupForums->patchEntity($workgroupsForum, $this->request->getData());
            if ($this->WorkgroupForums->save($workgroupsForum)) {
				$this->Log->write('info', 'Forum', $userA['first_name'].' '.$userA['last_name'].' edited '.$forum->title, [], ['request' => true], $forum->id, null, $get_user->workgroup_access);
                $this->Flash->success(__('The workgroups forum has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The workgroups forum could not be saved. Please, try again.'));
        }
        $workgroups = $this->WorkgroupForums->Workgroups->find('list', ['limit' => 200]);
        $users = $this->WorkgroupForums->Users->find('list', ['limit' => 200]);
        $this->set(compact('workgroupsForum', 'workgroups', 'users'));
        $this->set('_serialize', ['workgroupsForum']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Workgroups Forum id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
		$userA = $this->Auth->user();
        $this->request->allowMethod(['post', 'delete']);
        $workgroupsForum = $this->WorkgroupForums->get($id);
		
		$user_table = TableRegistry::get('Users');
		$get_user = $user_table->find('all')->where(['Users.id' => $userA['id']])->first();
		
        if ($this->WorkgroupForums->delete($workgroupsForum)) {
			$this->Log->write('info', 'Forum', $userA['first_name'].' '.$userA['last_name'].' deleted '.$workgroupsForum->title, [], ['request' => true], $workgroupsForum->id, null, $get_user->workgroup_access);
            $this->Flash->success(__('The workgroups forum has been deleted.'));
        } else {
            $this->Flash->error(__('The workgroups forum could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
