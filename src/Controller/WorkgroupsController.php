<?php
namespace App\Controller;
use Cake\ORM\TableRegistry;

use App\Controller\AppController;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;
use Cake\Mailer\Email;
use Cake\Routing\Router;

/**
 * Workgroups Controller
 *
 * @property \App\Model\Table\WorkgroupsTable $Workgroups
 */
class WorkgroupsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
		$this->paginate = [
            'conditions' => ['Workgroups.is_approved'=>2],
			'limit' => 20
        ];
		
        $workgroups = $this->paginate($this->Workgroups);
		$user = $this->Auth->user();
		$my_workgroups = null;
		$groups = null;
		
        $my_workgroups = $this->Workgroups->find('all', [
            'conditions' => ['Workgroups.user_id'=>$user['id']]
        ]);
			
		$my_workgroups_ch = $my_workgroups->toArray();
		$workgroups_ch = $workgroups->toArray();
		
		$workgroup_members = TableRegistry::get('WorkgroupsMembers');
		$users = TableRegistry::get('Users');
	
		$groups = $workgroup_members->find('all', [
		    'conditions' => ['WorkgroupsMembers.user_id' => $user['id']],
			'contain' => ['Workgroups']
		]);
			
		$groups_ch = $groups->toArray();
		
		//$data = $user_details->toArray();
				
		$department_ids = null;
	
        $this->set(compact('workgroups', 'my_workgroups', 'groups', 'my_workgroups_ch', 'groups_ch', 'workgroups_ch'));
        $this->set('_serialize', ['workgroups']);
    }

    /**
     * View method
     *
     * @param string|null $id Workgroup id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
		$workgroups_members = TableRegistry::get('WorkgroupsMembers');
		$users = TableRegistry::get('Users');
		
		$user = $this->Auth->user();
		
        $workgroup = $this->Workgroups->get($id, [
            'contain' => ['WorkgroupsMembers', 'Users']
        ]);
			
		$user_details = $workgroups_members->find('all', [
		    'conditions' => ['WorkgroupsMembers.user_id' => $user['id']],
			'contain' => ['Workgroups']
		]);
		
		$workgroup_members = $workgroups_members->find('all', [
		    'conditions' => ['WorkgroupsMembers.workgroup_id' => $id],
			'contain' => ['Workgroups', 'Users']
		]);
			
		$workgroupsMember = $workgroups_members->newEntity();
			
			//pr($workgroup_members->toArray());
			
		$workgroup_ids = null;

		if($user_details){
			foreach($user_details as $collect):
				$workgroup_ids[] = $collect->workgroup->id;
			endforeach;
			
			if($workgroup_ids){
				$workgroup_ids = implode(',', array_values($workgroup_ids));
			}
			
			$staff = $workgroups_members->find('all')->where(['WorkgroupsMembers.workgroup_id IN' => $workgroup_ids])->contain(['Users']);
		}
		
		$check_user = $workgroups_members->find('all')->where(['WorkgroupsMembers.user_id' => $user['id'], 'WorkgroupsMembers.workgroup_id' => $workgroup->id])->contain(['Users'])->first();
				
		$check_join = false;
		
		if(!empty($check_user)){
			if($check_user->user_id == $user['id']){
				$check_join = true;
			}
		}
		//pr($check_user->toArray());
        $this->set(compact('workgroup', 'staff', 'workgroup_members', 'workgroupsMember', 'check_join'));
        $this->set('_serialize', ['workgroup']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
		$workgroups_members = TableRegistry::get('WorkgroupsMembers');
		$mediaTable = TableRegistry::get('WorkgroupMedia');
		$users = TableRegistry::get('Users');
		
		$user = $this->Auth->user();
		
		$check_user = $workgroups_members->find('all')->where(['WorkgroupsMembers.user_id' => $user['id']])->contain(['Users', 'Workgroups'])->first();
		
		$administrators = $users->find('all')->where(['Users.role_id' => 1]);//->not(['Users.id' => 1]);
		$administrators_array = $administrators->toArray();
		
		$media = $mediaTable->newEntity();
		$workgroup_member = $workgroups_members->newEntity();
		
		$workgroup = $this->Workgroups->newEntity();
		
        if ($this->request->is('post')) {
            $workgroup = $this->Workgroups->patchEntity($workgroup, $this->request->getData());
            if($result = $this->Workgroups->save($workgroup)) {
				
				$dir = new Folder(WWW_ROOT . 'files'.DS.'media'.DS.$this->request->getData('name'), true, 0755);
				$media->source_id = $result->id;
				$media->folder_name = $this->request->getData('name');
				$media->workgroup_id = $result->id;
				$media->uploaded_by = $user['id'];
				$media->media_dir = 'files'.DS.'media';
				
				//$media = $mediaTable->patchEntity($media, $this->request->getData());
				$mediaTable->save($media);
                $this->Flash->success(__('The workgroup has been saved.'));
				$this->Log->write('info', 'Workgroup', $user['first_name'].' '.$user['last_name'].' added '.$this->request->getData('name'), [], ['request' => true], $result->id);
				
				$workgroup_member->user_id = $user['id'];
				$workgroup_member->workgroup_id = $result->id;
				
				$workgroups_members->save($workgroup_member);
				
				if($administrators_array){
					$recipients = array();
					$email = new Email('default');
					
					foreach($administrators as $added_member) {
					    $recipients[] = $added_member->email;
					}
					
					$link =  Router::url(['controller' => 'Workgroups', 'action' => 'view', $result->id], true);
					
					try{
					  	$email->from(['info@eogportal.com' => 'Ebony Oil & Gas Portal::Workgroups'])
						    ->to($recipients)
						    ->subject($this->request->getData('name'))
							->emailFormat('html')
							->send($user['first_name'].' '.$user['last_name'].' has added a workgroup<br />'
								.'<strong>Workgroup Name: </strong>'.$this->request->getData('name').'<br />'
								.'<strong>Workgroup Description: </strong>'.$this->request->getData('description').'<br />'
								.'<a href="'.$link.'">Click here to view</a>'); 
					} catch (Exception $e) {
			            echo 'Exception : ',  $e->getMessage(), "\n";
			        }
				  	
				}

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The workgroup could not be saved. Please, try again.'));
        }
        $this->set(compact('workgroup'));
        $this->set('_serialize', ['workgroup']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Workgroup id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
		$department_members = TableRegistry::get('DepartmentsMembers');
		$mediaTable = TableRegistry::get('WorkgroupMedia');
		
		$user = $this->Auth->user();
		
        $workgroup = $this->Workgroups->get($id, [
            'contain' => []
        ]);
			
		$check_user = $department_members->find('all')->where(['DepartmentsMembers.user_id' => $user['id']])->contain(['Users', 'Departments'])->first();
		$check_folder = $mediaTable->find('all')->where(['WorkgroupMedia.source_id' => $workgroup->id])->contain([])->first();
		
        if ($this->request->is(['patch', 'post', 'put'])) {
            $workgroup = $this->Workgroups->patchEntity($workgroup, $this->request->getData());
            if ($result = $this->Workgroups->save($workgroup)) {
                $this->Flash->success(__($workgroup->name.' has been saved.'));
				$this->Log->write('info', 'Workgroup', $user['first_name'].' '.$user['last_name'].' edited '.$workgroup->name, [], ['request' => true], $workgroup->id);
				
				$media = $mediaTable->newEntity();
				if($check_folder){
					$media->id = $check_folder->id;
					$media->folder_name = $this->request->getData('name');
					$mediaTable->save($media);
					
					$dir_path = new Folder(WWW_ROOT . 'files'.DS.'media'.DS.$check_user->department->name);
					
					if($dir_path->cd($this->request->getData('name'))){
						rename(WWW_ROOT . 'files'.DS.'media'.DS.$check_user->department->name.DS.$project->name, WWW_ROOT . 'files'.DS.'media'.DS.$check_user->department->name.DS.$this->request->getData('name'));
					}else{
						$dir = new Folder(WWW_ROOT . 'files'.DS.'media'.DS.$check_user->department->name.DS.$this->request->getData('name'), true, 0755);
					}
					
				}else{
					$media->source_id = $result->id;
					$media->folder_name = $this->request->getData('name');
					$media->department_id = $check_user->department_id;
					$media->uploaded_by = $user['id'];
					
					if($mediaTable->save($media)){
						$dir = new Folder(WWW_ROOT . 'files'.DS.'media'.DS.$check_user->department->name.DS.$this->request->getData('name'), true, 0755);
					}
				}
				
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The workgroup could not be saved. Please, try again.'));
        }
        $this->set(compact('workgroup'));
        $this->set('_serialize', ['workgroup']);
    }
	
    public function join()
    {
		$user = $this->Auth->user();
		$workgroups_members = TableRegistry::get('WorkgroupsMembers');
        $workgroupsMember = $workgroups_members->newEntity();
        if ($this->request->is('post')) {
            $workgroup = $workgroups_members->patchEntity($workgroupsMember, $this->request->getData());
			$workgroup->workgroup_id = $this->request->getData('workgroup_id');
			$workgroup->user_id = $this->request->getData('user_id');
	        $workgroup_details = $this->Workgroups->get($this->request->getData('workgroup_id'), [
	            'contain' => []
	        ]);
			//debug($workgroups_members->save($workgroup));
            if ($workgroups_members->save($workgroup)) {
				$this->Log->write('info', 'Workgroup', $user['first_name'].' '.$user['last_name'].' joined '.$workgroup_details->name, [], ['request' => true], $workgroup_details->id);
                $this->Flash->success(__('You have joined this workgroup.'));

                return $this->redirect(['action' => 'view', $this->request->getData('workgroup_id')]);
            }
            $this->Flash->error(__('Unable to join this workgroup. Please, try again.'));
			return $this->redirect(['action' => 'view', $this->request->getData('workgroup_id')]);
        }
        $this->set(compact('workgroup'));
        $this->set('_serialize', ['workgroup']);
    }
	
    public function comments($id = null, $comment_id = null)
    {
		$userA = $this->Auth->user();
		$workgroups_members = TableRegistry::get('WorkgroupsMembers');
		$users = TableRegistry::get('Users');
		$comments = TableRegistry::get('Comments');
		
		$post = null;
		
		if($comment_id){
	        $comment = $comments->get($comment_id, [
	            'contain' => []
	        ]);
				
	        if ($this->request->is(['patch', 'post', 'put'])) {
	            $comment_post = $comments->patchEntity($comment, $this->request->getData());
	            if ($comments->save($comment_post)) {
	                $this->Flash->success(__('The comment has been Updated.'));

	                return $this->redirect(['action' => 'comments', $this->request->getData('workgroup_id')]);
	            }
	            $this->Flash->error(__('The comment could not be saved. Please, try again.'));
	        }
		}else{
			$comment = $comments->newEntity();
			
	        if ($this->request->is('post')) {
	            $comment_post = $comments->patchEntity($comment, $this->request->getData());
	            if ($comments->save($comment_post)) {
	                $this->Flash->success(__('The comment has been saved.'));

	                return $this->redirect(['action' => 'comments', $this->request->getData('workgroup_id')]);
	            }
	            $this->Flash->error(__('The comment could not be saved. Please, try again.'));
	        }
		}
		
		$user = $this->Auth->user();
		
        $workgroup = $this->Workgroups->get($id, [
            'contain' => ['WorkgroupsMembers']
        ]);
			
		
		//$data = $user_details->toArray();
        $this->paginate = [
			'conditions'=>['Comments.comment_src'=>3, 'Comments.workgroup_id'=>$workgroup->id],
            'contain' => ['Users']
        ];
		
        $posts = $this->paginate($comments);
					
		$this->set(compact('staff', 'comment', 'posts', 'comment_id'));
        $this->set('workgroup', $workgroup);
        $this->set('_serialize', ['workgroup']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Workgroup id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
		$user = $this->Auth->user();
		$workgroup_members = TableRegistry::get('WorkgroupsMembers');
        $this->request->allowMethod(['post', 'delete']);
        $workgroup = $this->Workgroups->get($id);
        if ($this->Workgroups->delete($workgroup)) {
			$workgroup_members->deleteAll([
				'workgroup_id' => $workgroup->id
			]);
				
			$this->Log->write('info', 'Workgroup', $user['first_name'].' '.$user['last_name'].' deleted '.$workgroup->name, [], ['request' => true], $workgroup->id);
				
            $this->Flash->success(__($workgroup->name.' has been deleted.'));
        } else {
            $this->Flash->error(__($workgroup->name.' could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
	
    public function deleteComment($id = null)
    {
		$user = $this->Auth->user();
		$comments = TableRegistry::get('Comments');
        $this->request->allowMethod(['post', 'delete']);
        $comment = $comments->get($id);
        if ($comments->delete($comment)) {
            $this->Flash->success(__($comment->comment.' has been deleted.'));
			$this->Log->write('info', 'Workgroup', $user['first_name'].' '.$user['last_name'].' delete '.$comment->name, [], ['request' => true], $comments->id);
        } else {
            $this->Flash->error(__($comment->comment.' could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'view', $comment->source_id]);
    }
}
