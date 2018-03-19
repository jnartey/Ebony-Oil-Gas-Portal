<?php
namespace App\Controller\Workgroup;
use App\Controller\Workgroup\AppController;
use Cake\ORM\TableRegistry;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;
use Cake\Mailer\Email;
use Cake\Routing\Router;

/**
 * WorkgroupTasks Controller
 *
 * @property \App\Model\Table\WorkgroupTasksTable $WorkgroupTasks
 *
 * @method \App\Model\Entity\WorkgroupTask[] paginate($object = null, array $settings = [])
 */
class WorkgroupTasksController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
		
		$tasks = $this->WorkgroupTasks->find('all', [
		    'contain' => ['Users', 'Workgroups', 'WorkgroupProjects']
		]);
		
        $this->set(compact('tasks'));
        $this->set('_serialize', ['tasks']);
    }

    /**
     * View method
     *
     * @param string|null $id Task id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null, $comment_id = null)
    {
		$project = TableRegistry::get('WorkgroupProjects');
		$project_members = TableRegistry::get('WorkgroupProjectMembers');
		$workgroup_members = TableRegistry::get('WorkgroupsMembers');
		$workgroup = TableRegistry::get('Workgroups');
		$users = TableRegistry::get('Users');
		$comments = TableRegistry::get('WorkgroupComments');
		//$comment = $comments->newEntity();
		
		$user = $this->Auth->user();
		
		$post = null;
		$task_members = null;
		
        $task = $this->WorkgroupTasks->get($id, [
            'contain' => ['Workgroups', 'WorkgroupProjects']
        ]);
		
		if($comment_id){
	        $comment = $comments->get($comment_id, [
	            'contain' => []
	        ]);
				
	        if ($this->request->is(['patch', 'post', 'put'])) {
	            $comment_post = $comments->patchEntity($comment, $this->request->getData());
	            if ($comments->save($comment_post)) {
					$this->Log->write('info', 'Task', $user['first_name'].' '.$user['last_name'].' edited commented on '.$task->name, [], ['request' => true], $task->id);
	                $this->Flash->success(__('The comment has been Updated.'));

	                return $this->redirect(['action' => 'view', $task->id]);
	            }
	            $this->Flash->error(__('The comment could not be saved. Please, try again.'));
	        }
		}else{
			$comment = $comments->newEntity();
			
	        if ($this->request->is('post')) {
	            $comment_post = $comments->patchEntity($comment, $this->request->getData());
	            if ($comments->save($comment_post)) {
					$this->Log->write('info', 'Task', $user['first_name'].' '.$user['last_name'].' commented on '.$task->name, [], ['request' => true], $task->id);
	                $this->Flash->success(__('The comment has been saved.'));

	                return $this->redirect(['action' => 'view', $task->id]);
	            }
	            $this->Flash->error(__('The comment could not be saved. Please, try again.'));
	        }
		}
					
		$project = $project->get($task->project_id);
		
        if($this->request->is(['patch', 'post', 'put'])) {
            $task_rec = $this->WorkgroupTasks->patchEntity($task, $this->request->getData());
			
            if ($result = $this->WorkgroupTasks->save($task_rec)) {
                $this->Flash->success(__($task->name.' timeline has been updated.'));
				return $this->redirect(['controller'=>'WorkgroupProjects', 'action' => 'view', $project->id]);
			}else{
				$this->Flash->error(__($task->name.' timeline not be updated. Please, try again.'));
			}
        }
		
		if($task->user_id){
			$expanded_ids = explode(',', $task->user_id);
	        $task_members = $users->find('all', ['conditions'=>['Users.id IN'=>$expanded_ids]]);
			//pr($task_members->toArray());
		}
		
        $this->paginate = [
			'conditions'=>['WorkgroupComments.source_id'=>$task->id, 'WorkgroupComments.project_id'=>$task->project_id, 'WorkgroupComments.comment_src'=>2],
            'contain' => ['Users']
        ];
		
        $posts = $this->paginate($comments);
				
        $this->set(compact('task', 'users', 'project', 'task_members', 'comment', 'posts', 'comment_id'));
        $this->set('_serialize', ['task']);
    }
	
    public function review($id = null, $comment_id = null)
    {
		$project = TableRegistry::get('WorkgroupProjects');
		$project_members = TableRegistry::get('WorkgroupProjectMembers');
		$workgroup_members = TableRegistry::get('WorkgroupsMembers');
		$workgroup = TableRegistry::get('Workgroups');
		$users = TableRegistry::get('Users');
		$comments = TableRegistry::get('WorkgroupComments');
		//$comment = $comments->newEntity();
		
		$post = null;
		
		if($comment_id){
	        $comment = $comments->get($comment_id, [
	            'contain' => []
	        ]);
				
	        if ($this->request->is(['patch', 'post', 'put'])) {
	            $comment_post = $comments->patchEntity($comment, $this->request->getData());
	            if ($comments->save($comment_post)) {
					$this->Log->write('info', 'Task', $user['first_name'].' '.$user['last_name'].' edited '.$comment->comment, [], ['request' => true], $comment->id);
	                $this->Flash->success(__('The comment has been Updated.'));

	                return $this->redirect(['action' => 'view', $this->request->getData('project_id')]);
	            }
	            $this->Flash->error(__('The comment could not be saved. Please, try again.'));
	        }
		}else{
			$comment = $comments->newEntity();
			
	        if ($this->request->is('post')) {
	            $comment_post = $comments->patchEntity($comment, $this->request->getData());
	            if ($comments->save($comment_post)) {
					$this->Log->write('info', 'Task', $user['first_name'].' '.$user['last_name'].' added comment '.$comment->comment, [], ['request' => true], $comment->id);
	                $this->Flash->success(__('The comment has been saved.'));

	                return $this->redirect(['action' => 'view', $this->request->getData('project_id')]);
	            }
	            $this->Flash->error(__('The comment could not be saved. Please, try again.'));
	        }
		}
		
		$review = $this->WorkgroupTasks->get($id, [
            'contain' => ['Users', 'Workgroups', 'WorkgroupProjects']
        ]);
		
        if($this->request->is(['patch', 'post', 'put'])) {
			$review = $this->WorkgroupTasks->patchEntity($review, $this->request->getData());
            if ($this->WorkgroupTasks->save($review)) {
				$this->Log->write('info', 'Task', $user['first_name'].' '.$user['last_name'].' reviewed '.$review->name, [], ['request' => true], $review->id);
                $this->Flash->success(__($review->name.' has been updated.'));
				return $this->redirect(['action' => 'view', $review->id]);
            }
            $this->Flash->error(__('The task could not be saved. Please, try again.'));
        }        
		
        $task = $this->WorkgroupTasks->get($id, [
            'contain' => ['Users', 'Workgroups', 'WorkgroupProjects']
        ]);
		
		$project = $project->get($id);
		
		$expanded_ids = explode(',', $task->user_id);
        $task_members = $users->find('all', ['conditions'=>['Users.id IN'=>$expanded_ids]]);
		//pr($task_members->toArray());
		
        $this->paginate = [
			'conditions'=>['WorkgroupComments.source_id'=>$task->id, 'WorkgroupComments.project_id'=>$project->id],
            'contain' => ['Users']
        ];
		
        $posts = $this->paginate($comments);
				
        $this->set(compact('task', 'users', 'project', 'task_members', 'comment', 'posts', 'comment_id', 'review'));
        $this->set('_serialize', ['task']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($id=null)
    {
		$project = TableRegistry::get('WorkgroupProjects');
		$project_members = TableRegistry::get('WorkgroupProjectMembers');
		$mediaTable = TableRegistry::get('WorkgroupMedia');
		$workgroup_members = TableRegistry::get('WorkgroupsMembers');
		
		$user_ids = null;
		$users = null;
        
		$project = $project->get($id);
		$user = $this->Auth->user();
		$check_user = $workgroup_members->find('all')->where(['WorkgroupsMembers.user_id' => $user['id']])->contain(['Users', 'Workgroups'])->first();
		
		$user_table = TableRegistry::get('Users');	
		$workgroup = TableRegistry::get('Workgroups');	
		$get_user = $user_table->find('all')->where(['Users.id' => $user['id']])->first();
		
		$workgroup_details = $workgroup->find('all', [
		    'conditions' => ['Workgroups.id' => $get_user->workgroup_access],
		]);
		
		$workgroup_details = $workgroup_details->first();
		
        $task = $this->WorkgroupTasks->newEntity();
        if ($this->request->is('post')) {
			
            $task = $this->WorkgroupTasks->patchEntity($task, $this->request->getData());
			$media = $mediaTable->newEntity();
			$media->workgroup_id = $get_user->workgroup_access;
			
			if($this->request->getData(['user_id'])){
				$task->user_id = implode(',', $this->request->getData(['user_id']));
			}
			
			//pr($task);
			//debug($this->request->getData(['user_id']));
			
            if ($result = $this->WorkgroupTasks->save($task)) {
				//$parent_m = $mediaTable->find('all')->where(['WorkgroupMedia.source_id' => $project->id])->first();
				//$media->parent_id = $parent_m->id;
				$media->source_id = $result->id;
				$media->folder_name = $this->request->getData('name');
				$media->workgroup_id = $get_user->workgroup_access;
				$media->uploaded_by = $user['id'];
				
				if($mediaTable->save($media)){
					$dir = new Folder(WWW_ROOT . 'files'.DS.'media'.DS.$workgroup_details->name.DS.$project->name.DS.$this->request->getData('name'), true, 0755);
				}
					
                $this->Flash->success(__('The task has been saved.'));
				$this->Log->write('info', 'Task', $user['first_name'].' '.$user['last_name'].' added '.$this->request->getData('name'), [], ['request' => true], $result->id, null, $get_user->workgroup_access);
				
				$userIDs = array();
				$userNames = array();
				$assigned = array();
				
				if(!empty($this->request->getData(['user_id']))){
					foreach($this->request->getData(['user_id']) as $u_ids):
						$userIDs[] = $u_ids;
					endforeach;
				
					$added_members = $user_table->find('all', [
					    'conditions' => ['Users.id IN' => $userIDs],
					]);
				
					$d_member_array = $added_members->toArray();
				
					foreach($added_members as $members):
						$userNames[] = $members->name;
					endforeach;
				
					$assigned = implode(',', $userNames);
				
					$this->Log->write('info', 'Task', $user['first_name'].' '.$user['last_name'].' assigned '.$assigned.' to task::'.$this->request->getData('name'), [], ['request' => true], $result->id, null, $get_user->workgroup_access);
								
					if($d_member_array){
						$recipients = array();
						$email = new Email('default');
					
						foreach($added_members as $added_member) {
						    $recipients[] = $added_member->email;
						}
					
						$link =  Router::url(['controller' => 'WorkgroupTasks', 'action' => 'view', $project->id, 'workgroup'=>$project->department_id], true);
					
						try{
						  	$email->from(['info@eogportal.com' => 'Ebony Oil & Gas Portal::Projects'])
							    ->to($recipients)
							    ->subject($project->name)
								->emailFormat('html')
								->send($user['first_name'].' '.$user['last_name'].' has assigned you to a project task<br />'
									.'<strong>Project Title: </strong>'.$project->name.'<br />'
									.'<strong>Project Task: </strong>'.$this->request->getData('name').'<br />'
									.'<strong>Project Duration: </strong>'.$project->start_date.' - '.$project->end_date.'<br />'
									.'<strong>Project Task Description</strong><br />'.$this->request->getData('description').'<br />'
									.'<a href="'.$link.'">Click here to view</a>'); 
						} catch (Exception $e) {
				            echo 'Exception : ',  $e->getMessage(), "\n";
				        }
				  	
					}
					
				}
				
                return $this->redirect(['controller'=>'WorkgroupProjects', 'action' => 'view', $this->request->getData(['project_id'])]);
            }
			
            $this->Flash->error(__('The task could not be saved. Please, try again.'));
        }
		
        //$users = $this->WorkgroupTasks->Users->find('list', ['conditions'=>['']]);
		//$users_collect = $workgroup_members->find('all')->where(['WorkgroupsMembers.workgroup_id' => $project->workgroup_id]);
		$users_collect = $project_members->find('all', [
		    'conditions' => ['WorkgroupProjectMembers.project_id' => $id]
		]);
		
		// $data = $users_collect->toArray();
//
// 		pr($data);
		
		foreach($users_collect as $collect):
			$user_ids[] = $collect->user_id;
		endforeach;
		
		if($user_ids){
			//$user_ids = implode(',', array_values($user_ids));
			$users = $this->WorkgroupTasks->Users->find('list')->where(['Users.id IN' => $user_ids]);
		}
		
        $workgroups = $this->WorkgroupTasks->Workgroups->find('list', []);
        $projects = $this->WorkgroupTasks->WorkgroupProjects->find('list', []);
        $this->set(compact('task', 'users', 'workgroups', 'projects', 'project', 'user_ids', 'workgroup_details'));
        $this->set('_serialize', ['task']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Task id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
		$workgroup_members = TableRegistry::get('WorkgroupsMembers');
		
		$user = $this->Auth->user();
		$project = TableRegistry::get('WorkgroupProjects');
		$project_members = TableRegistry::get('WorkgroupProjectMembers');
		$mediaTable = TableRegistry::get('WorkgroupMedia');
		
		$users = null;
		$user_ids = null;
		
        $task = $this->WorkgroupTasks->get($id, [
            'contain' => []
        ]);
			
		$project = $project->get($task->project_id);
				
		$user_table = TableRegistry::get('Users');	
		$workgroup = TableRegistry::get('Workgroups');	
		$get_user = $user_table->find('all')->where(['Users.id' => $user['id']])->first();
		
		$workgroup_details = $workgroup->find('all', [
		    'conditions' => ['Workgroups.id' => $get_user->workgroup_access],
		]);
		
		$workgroup_details = $workgroup_details->first();
			
		$check_user = $workgroup_members->find('all')->where(['WorkgroupsMembers.user_id' => $user['id']])->contain(['Users', 'Workgroups'])->first();
		$check_folder = $mediaTable->find('all')->where(['WorkgroupMedia.source_id' => $project->id])->contain([])->first();
			
        if ($this->request->is(['patch', 'post', 'put'])) {
            $task = $this->WorkgroupTasks->patchEntity($task, $this->request->getData());
			
			if($this->request->getData(['user_id'])){
				$task->user_id = implode(',', $this->request->getData(['user_id']));
			}
			
            if ($this->WorkgroupTasks->save($task)) {
				$this->Log->write('info', 'Task', $user['first_name'].' '.$user['last_name'].' edited '.$task->name, [], ['request' => true], $task->id);
                $this->Flash->success(__('The task has been saved.'));

				$media = $mediaTable->newEntity();
				//if($check_folder){
					//$parent_m = $mediaTable->find('all')->where(['WorkgroupMedia.source_id' => $project->id])->first();
					//$media->parent_id = $parent_m->id;
					
					$current_media = $mediaTable->find('all')->where(['WorkgroupMedia.project_id' => $project->id, 'WorkgroupMedia.task_id' => $task->id])->contain([])->first();
					
					$media->id = $current_media->id;
					$media->folder_name = $this->request->getData('name');
					$media->media_dir = 'files'.DS.'media'.DS.$workgroup_details->name.DS.$project->name;
					
					$mediaTable->save($media);
					
					$dir_path = new Folder(WWW_ROOT . 'files'.DS.'media'.DS.$check_user->workgroup->name);
					
					if($dir_path->cd($this->request->getData('name'))){
						rename(WWW_ROOT . 'files'.DS.'media'.DS.$workgroup_details->name.DS.$project->name.DS.$task->name, WWW_ROOT . 'files'.DS.'media'.DS.$check_user->workgroup->name.DS.$project->name.DS.$this->request->getData('name'));
					}else{
						$dir = new Folder(WWW_ROOT . 'files'.DS.'media'.DS.$workgroup_details->name.DS.$project->name.DS.$this->request->getData('name'), true, 0755);
					}
					
				// }else{
// 					//$parent_m = $mediaTable->find('all')->where(['WorkgroupMedia.source_id' => $project->id])->first();
// 					//$media->parent_id = $parent_m->id;
// 					$media->source_id = $result->id;
// 					$media->folder_name = $this->request->getData('name');
// 					$media->workgroup_id = $check_user->workgroup_id;
// 					$media->uploaded_by = $user['id'];
//
// 					if($mediaTable->save($media)){
// 						$dir = new Folder(WWW_ROOT . 'files'.DS.'media'.DS.$check_user->workgroup->name.DS.$this->request->getData('name'), true, 0755);
// 					}
// 				}
				
				$userIDs = array();
				$userNames = array();
				$assigned = array();
				
				if(!empty($this->request->getData(['user_id']))){
					foreach($this->request->getData(['user_id']) as $u_ids):
						$userIDs[] = $u_ids;
					endforeach;
				
					$added_members = $user_table->find('all', [
					    'conditions' => ['Users.id IN' => $userIDs],
					]);
				
					$d_member_array = $added_members->toArray();
				
					foreach($added_members as $members):
						$userNames[] = $members->name;
					endforeach;
				
					$assigned = implode(',', $userNames);
				
					$this->Log->write('info', 'Task', $user['first_name'].' '.$user['last_name'].' updated and assigned '.$assigned.' to task::'.$this->request->getData('name'), [], ['request' => true], $task->id, $get_user->department_access);
								
					if($d_member_array){
						$recipients = array();
						$email = new Email('default');
					
						foreach($added_members as $added_member) {
						    $recipients[] = $added_member->email;
						}
					
						$link =  Router::url(['controller' => 'WorkgroupTasks', 'action' => 'view', $project->id, 'workgroup'=>$project->department_id], true);
					
						try{
						  	$email->from(['info@eogportal.com' => 'Ebony Oil & Gas Portal::Projects'])
							    ->to($recipients)
							    ->subject($project->name)
								->emailFormat('html')
								->send($user['first_name'].' '.$user['last_name'].' has assigned you to a project task<br />'
									.'<strong>Project Title: </strong>'.$project->name.'<br />'
									.'<strong>Project Task: </strong>'.$this->request->getData('name').'<br />'
									.'<strong>Project Duration: </strong>'.$project->start_date.' - '.$project->end_date.'<br />'
									.'<strong>Project Task Description</strong><br />'.$this->request->getData('description').'<br />'
									.'<a href="'.$link.'">Click here to view</a>'); 
						} catch (Exception $e) {
				            echo 'Exception : ',  $e->getMessage(), "\n";
				        }
				  	
					}
				}
				
				return $this->redirect(['controller'=>'WorkgroupProjects', 'action' => 'view', $task->project_id]);
            }else{
            	$this->Flash->error(__('The task could not be saved. Please, try again.'));
            }
        }
		
        //$users = $this->WorkgroupTasks->Users->find('list', ['limit' => 200]);
        $workgroups = $this->WorkgroupTasks->Workgroups->find('list', []);
        //$projects = $this->WorkgroupTasks->Projects->find('list', []);
		
		$users_collect = $project_members->find('all', [
		    'conditions' => ['WorkgroupProjectMembers.project_id' => $project->id]
		]);
		
		foreach($users_collect as $collect):
			$user_ids[] = $collect->user_id;
		endforeach;
		
		//$user_ids = implode(',', array_values($user_ids));
		if($user_ids){
			$users = $this->WorkgroupTasks->Users->find('list')->where(['Users.id IN' => $user_ids]);
		}
		
		$default_ids = explode(',', $task->user_id);
		
		$default_ids = array_values($default_ids);
						
        $this->set(compact('task', 'users', 'workgroups', 'project', 'default_ids', 'workgroup_details'));
        $this->set('_serialize', ['task']);
    }
	
    public function upload($id = null, $task_id = null)
    {
 		$user = $this->Auth->user();

 		$parent_id = $id;
 		$current_media = null;
		
		$workgroups = TableRegistry::get('Workgroups');
		$mediaTable = TableRegistry::get('WorkgroupMedia');
		$projectsTable = TableRegistry::get('WorkgroupProjects');
		$user_table = TableRegistry::get('Users');
		$get_user = $user_table->find('all')->where(['Users.id' => $user['id']])->first();
		
		$media = $mediaTable->newEntity();
		
		$current_workgroup = $workgroups->get($get_user->workgroup_access);
		
		$project = $projectsTable->find('all')->where(['WorkgroupProjects.id' => $id])->first();
		
        $task = $this->WorkgroupTasks->get($task_id, [
            'contain' => []
        ]);

        if ($this->request->is('post')) {
 			//pr($this->request->getData());
 			$current_media = $mediaTable->find('all')->where(['WorkgroupMedia.department_id' => $current_workgroup->id, 'WorkgroupMedia.project_id' => $project->id])->first();
			
			$media = $mediaTable->patchEntity($media, $this->request->getData());
			
 			//pr($this->request->getData());

			$media->source_id = $task->id;
			
			$media->parent_id = $current_media->id;
			
			$media->workgroup_id = $get_user->workgroup_access;
			$media->project_id = $project->id;
			$media->task_id = $task->id;

 			$media->uploaded_by = $user['id'];

 			if($id){
				if($current_media->media_dir){
					$media->media_dir = $current_media->media_dir.DS.$task->name;
				}else{
					$media->media_dir = $current_media->folder_name.DS.$task->name;
				}
 			}else{
 				$media->media_dir = 'files'.DS.'media'.DS.$current_workgroup->name.DS.$task->name;
 			}

            if ($result = $mediaTable->save($media)) {
				$this->Log->write('info', 'Task', $user['first_name'].' '.$user['last_name'].' uploaded '.$this->request->data['file_name']['name'], [], ['request' => true], $result->id, null, $get_user->workgroup_access);
                
				$resultJ = json_encode(array('result' => '<div class="callout success">'.$this->request->data['file_name']['name'].' uploaded successfully.</div>'));
				$this->response->type('json');
				$this->response->body($resultJ);
				return $this->response;
				
				if($id){
					return $this->redirect(['action' => 'view', $task_id]);
				}else{
					return $this->redirect(['action' => 'index']);
				}
            }
			$resultJ = json_encode(array('result' => '<div class="callout error">'.$this->request->data['file_name']['name'].' could not be uploaded. Please, try again..</div>'));
			$this->response->type('json');
			$this->response->body($resultJ);
			return $this->response;
        }

        $this->set(compact('media', 'user', 'parent_id'));
        $this->set('_serialize', ['media']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Task id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
		$user = $this->Auth->user();
		$comments = TableRegistry::get('WorkgroupComments');
		$projects = TableRegistry::get('WorkgroupProjects');
        $this->request->allowMethod(['post', 'delete']);
        $task = $this->WorkgroupTasks->get($id);
		
		$user_table = TableRegistry::get('Users');
		$get_user = $user_table->find('all')->where(['Users.id' => $user['id']])->first();
		
		$project = $projects->get($task->project_id);
		
        if ($this->WorkgroupTasks->delete($task)) {
			$comments->deleteAll([
			    'comment_src' => 2,
				'source_id' => $task->id
			]);
			
			$this->Log->write('info', 'Task', $user['first_name'].' '.$user['last_name'].' deleted '.$task->name, [], ['request' => true], $task->id, null, $get_user->workgroup_access);
			
			$userIDs = explode(',', $task->user_id);
			$recipients = array();
			
			$added_members = $user_table->find('all', [
			    'conditions' => ['Users.id IN' => $userIDs],
			]);
			
			$d_member_array = $added_members->toArray();
			
			if($d_member_array){
				$recipients = array();
				$email = new Email('default');
				
				foreach($added_members as $added_member) {
				    $recipients[] = $added_member->email;
				}
								
				try{
				  	$email->from(['info@eogportal.com' => 'Ebony Oil & Gas Portal::Projects'])
					    ->to($recipients)
					    ->subject($task->name)
						->emailFormat('html')
						->send($user['first_name'].' '.$user['last_name'].' has deleted task<br />'
							.'<strong>Project Title: </strong>'.$project->name.'<br />'
							.'<strong>Task Title: </strong>'.$task->name.'<br />'
							.'<strong>Task Description</strong><br />'.$task->description.'<br />'); 
				} catch (Exception $e) {
		            echo 'Exception : ',  $e->getMessage(), "\n";
		        }
			  	
			}
			
            $this->Flash->success(__($task->name.' has been deleted.'));
        } else {
            $this->Flash->error(__($task->name.' could not be deleted. Please, try again.'));
        }

        return $this->redirect(['controller'=>'WorkgroupProjects', 'action' => 'view', $task->project_id]);
    }
	
    public function deleteComment($id = null)
    {
		$userA = $this->Auth->user();
		$comments = TableRegistry::get('WorkgroupComments');
        $this->request->allowMethod(['post', 'delete']);
        $comment = $comments->get($id);
        if ($comments->delete($comment)) {
			$this->Log->write('info', 'Task', $user['first_name'].' '.$user['last_name'].' deleted comment '.$comments->comment, [], ['request' => true], $comments->id);
            $this->Flash->success(__($comment->comment.' has been deleted.'));
        } else {
            $this->Flash->error(__($comment->comment.' could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'view', $comment->source_id]);
    }
	
    public function setStatus($id = null, $user_id = null, $status = null)
    {
		$user = $this->Auth->user();
        $this->request->allowMethod(['post']);
        $task = $this->WorkgroupTasks->get($id);
		$task_e = $this->WorkgroupTasks->newEntity();
		$task_e->id = $id;
		$task_e->status = $status;
		$task_e->attended_by = $user_id;
		
		$user_table = TableRegistry::get('Users');
		$get_user = $user_table->find('all')->where(['Users.id' => $user['id']])->first();
		
		$projects = TableRegistry::get('WorkgroupProjects');
		$project = $projects->get($task->project_id, ['contain'=>['Users']]);
				
        if ($this->WorkgroupTasks->save($task_e)) {
			if($status == 2){
				$this->Flash->success(__($task->name.' has been marked as done.'));
			}
			
			$this->Log->write('info', 'Task', $user['first_name'].' '.$user['last_name'].' marked '.$project->name.' as done', [], ['request' => true], $task->id, null, $get_user->workgroup_access);
	
			$email = new Email('default');
			
			try{
			  	$email->from(['info@eogportal.com' => 'Ebony Oil & Gas Portal::Projects'])
				    ->to($project->user->email)
				    ->subject($task->name)
					->emailFormat('html')
					->send($user['first_name'].' '.$user['last_name'].' has marked task as done<br />'
						.'<strong>Project Title: </strong>'.$project->name.'<br />'
						.'<strong>Task Title: </strong>'.$task->name.'<br />'
						.'<strong>Task Description</strong><br />'.$task->description.'<br />'); 
			} catch (Exception $e) {
	            echo 'Exception : ',  $e->getMessage(), "\n";
	        }
			
        } else {
            $this->Flash->error(__($task->name.' could not be marked as done. Please, try again.'));
        }

        return $this->redirect(['controller' => 'WorkgroupProjects','action' => 'view', $task->project_id]);
    }
}
