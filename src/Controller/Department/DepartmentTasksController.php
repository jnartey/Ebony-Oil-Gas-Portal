<?php
namespace App\Controller\Department;
use App\Controller\Department\AppController;
use Cake\ORM\TableRegistry;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;
use Cake\Mailer\Email;
use Cake\Routing\Router;

/**
 * DepartmentTasks Controller
 *
 * @property \App\Model\Table\DepartmentTasksTable $DepartmentTasks
 *
 * @method \App\Model\Entity\DepartmentTask[] paginate($object = null, array $settings = [])
 */
class DepartmentTasksController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
		$user = $this->Auth->user();
		$tasks = $this->DepartmentTasks->find('all', [
		    'contain' => ['Users', 'Departments', 'DepartmentProjects']
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
		$project = TableRegistry::get('DepartmentProjects');
		$project_members = TableRegistry::get('DepartmentProjectMembers');
		$department_members = TableRegistry::get('DepartmentsMembers');
		$department = TableRegistry::get('Departments');
		$users = TableRegistry::get('Users');
		$comments = TableRegistry::get('DepartmentComments');
		$mediaTable = TableRegistry::get('DepartmentMedia');
		//$comment = $comments->newEntity();
		
		$post = null;
		$task_members = null;
		$user = $this->Auth->user();
		
        $task = $this->DepartmentTasks->get($id, [
            'contain' => ['Departments', 'DepartmentProjects']
        ]);
			
		$get_user = $users->find('all')->where(['Users.id' => $user['id']])->first();
		
		$media_files = $mediaTable->find('all')->where(['DepartmentMedia.task_id' => $task->id, 'DepartmentMedia.file_name IS NOT'=>'']);
		$media_files_count = $mediaTable->find('all')->where(['DepartmentMedia.task_id' => $task->id, 'DepartmentMedia.file_name IS NOT'=>''])->count();
		
		if($comment_id){
	        $comment = $comments->get($comment_id, [
	            'contain' => []
	        ]);
				
	        if ($this->request->is(['patch', 'post', 'put'])) {
	            $comment_post = $comments->patchEntity($comment, $this->request->getData());
	            if ($comments->save($comment_post)) {
					$this->Log->write('info', 'Task', $user['first_name'].' '.$user['last_name'].' edited commented on '.$task->name, [], ['request' => true], $task->id, $get_user->department_access);
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
					$this->Log->write('info', 'Task', $user['first_name'].' '.$user['last_name'].' commented on '.$task->name, [], ['request' => true], $task->id, $get_user->department_access);
	                $this->Flash->success(__('The comment has been saved.'));

	                return $this->redirect(['action' => 'view', $task->id]);
	            }
	            $this->Flash->error(__('The comment could not be saved. Please, try again.'));
	        }
		}
					
		$project = $project->get($task->project_id);
		
        if($this->request->is(['patch', 'post', 'put'])) {
            $task_rec = $this->DepartmentTasks->patchEntity($task, $this->request->getData());
			
            if ($result = $this->DepartmentTasks->save($task_rec)) {
                $this->Flash->success(__($task->name.' timeline has been updated.'));
				return $this->redirect(['controller'=>'DepartmentProjects', 'action' => 'view', $project->id]);
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
			'conditions'=>['DepartmentComments.comment_src'=>2, 'DepartmentComments.source_id'=>$task->id, 'DepartmentComments.project_id'=>$project->id],
            'contain' => ['Users']
        ];
		
        $posts = $this->paginate($comments);
				
        $this->set(compact('task', 'users', 'project', 'task_members', 'comment', 'posts', 'comment_id', 'media_files', 'media_files_count'));
        $this->set('_serialize', ['task']);
    }
	
    public function review($id = null, $comment_id = null)
    {
		$project = TableRegistry::get('DepartmentProjects');
		$project_members = TableRegistry::get('DepartmentProjectMembers');
		$department_members = TableRegistry::get('DepartmentsMembers');
		$department = TableRegistry::get('Departments');
		$users = TableRegistry::get('Users');
		$comments = TableRegistry::get('DepartmentComments');
		//$comment = $comments->newEntity();
		$user = $this->Auth->user();
		
		$get_user = $users->find('all')->where(['Users.id' => $user['id']])->first();
		
		$post = null;
		
		if($comment_id){
	        $comment = $comments->get($comment_id, [
	            'contain' => []
	        ]);
				
	        if ($this->request->is(['patch', 'post', 'put'])) {
	            $comment_post = $comments->patchEntity($comment, $this->request->getData());
	            if ($comments->save($comment_post)) {
					$this->Log->write('info', 'Task', $user['first_name'].' '.$user['last_name'].' edited '.$comment->comment, [], ['request' => true], $comment->id, $get_user->department_access);
	                $this->Flash->success(__('The comment has been Updated.'));

	                return $this->redirect(['action' => 'view', $this->request->getData('project_id')]);
	            }
	            $this->Flash->error(__('The comment could not be saved. Please, try again.'));
	        }
		}else{
			$comment = $comments->newEntity();
			
	        if ($this->request->is('post')) {
	            $comment_post = $comments->patchEntity($comment, $this->request->getData());
	            if ($result = $comments->save($comment_post)) {
					$this->Log->write('info', 'Task', $user['first_name'].' '.$user['last_name'].' added comment '.$comment->comment, [], ['request' => true], $comment->id, $get_user->department_access);
	                $this->Flash->success(__('The comment has been saved.'));

	                return $this->redirect(['action' => 'view', $this->request->getData('project_id')]);
	            }
	            $this->Flash->error(__('The comment could not be saved. Please, try again.'));
	        }
		}
		
		$review = $this->DepartmentTasks->get($id, [
            'contain' => ['Users', 'Departments', 'DepartmentProjects']
        ]);
		
        if($this->request->is(['patch', 'post', 'put'])) {
			$review = $this->DepartmentTasks->patchEntity($review, $this->request->getData());
            if ($this->DepartmentTasks->save($review)) {
				$this->Log->write('info', 'Task', $user['first_name'].' '.$user['last_name'].' reviewed '.$review->name, [], ['request' => true], $review->id, $get_user->department_access);
                $this->Flash->success(__($review->name.' has been updated.'));
				return $this->redirect(['action' => 'view', $review->id]);
            }
            $this->Flash->error(__('The task could not be saved. Please, try again.'));
        }        
		
        $task = $this->DepartmentTasks->get($id, [
            'contain' => ['Users', 'Departments', 'DepartmentProjects']
        ]);
		
		$project = $project->get($review->project_id);
		
		$expanded_ids = explode(',', $task->user_id);
        $task_members = $users->find('all', ['conditions'=>['Users.id IN'=>$expanded_ids]]);
		//pr($task_members->toArray());
		
        $this->paginate = [
			'conditions'=>['DepartmentComments.source_id'=>$task->id, 'DepartmentComments.project_id'=>$project->id],
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
		$project = TableRegistry::get('DepartmentProjects');
		$project_members = TableRegistry::get('DepartmentProjectMembers');
		$mediaTable = TableRegistry::get('DepartmentMedia');
		$department_members = TableRegistry::get('DepartmentsMembers');
		$user_table = TableRegistry::get('Users');
		$user = $this->Auth->user();
		
		$user_ids = null;
		$users = null;
		
        // $task_rec = $this->DepartmentTasks->get($id, [
//             'contain' => []
//         ]);
		$user = $this->Auth->user();
		$get_user = $user_table->find('all')->where(['Users.id' => $user['id']])->first();
		
		$project = $project->get($id);
		
		$check_user = $department_members->find('all')->where(['DepartmentsMembers.user_id' => $user['id']])->contain(['Users', 'Departments'])->first();
		
		$department = TableRegistry::get('Departments');	
	
		$department_details = $department->find('all', [
		    'conditions' => ['Departments.id' => $get_user->department_access],
		]);
		
		$department_details = $department_details->first();
		
        $task = $this->DepartmentTasks->newEntity();
        if ($this->request->is('post')) {
			
            $task = $this->DepartmentTasks->patchEntity($task, $this->request->getData());
			$media = $mediaTable->newEntity();
			$task->department_id = $get_user->department_access;
			
			if($this->request->getData(['user_id'])){
				$task->user_id = implode(',', $this->request->getData(['user_id']));
			}
			
			//pr($task);
			//debug($this->request->getData(['user_id']));
			
            if ($result = $this->DepartmentTasks->save($task)) {
				$this->Log->write('info', 'Task', $user['first_name'].' '.$user['last_name'].' added '.$this->request->getData('name'), [], ['request' => true], $result->id, $get_user->department_access);
				//$parent_m = $mediaTable->find('all')->where(['DepartmentMedia.source_id' => $project->id])->first();
				$parent_media = $mediaTable->find('all')->where(['DepartmentMedia.department_id' => $department_details->id, 'DepartmentMedia.parent_id IS' => null])->first();
				
				$current_media = $mediaTable->find('all')->where(['DepartmentMedia.project_id' => $project->id, 'DepartmentMedia.parent_id' => $parent_media->id])->first();
				
				$media->parent_id = $current_media->id;
				$media->source_id = $result->id;
				$media->task_id = $result->id;
				$media->project_id = $project->id;
				$media->folder_name = $this->request->getData('name');
				$media->department_id = $check_user->department_id;
				$media->uploaded_by = $user['id'];
				$media->media_dir = 'files'.DS.'media'.DS.$department_details->name.DS.$project->name;
				
				if($mediaTable->save($media)){
					$dir = new Folder(WWW_ROOT . 'files'.DS.'media'.DS.$department_details->name.DS.$project->name.DS.$this->request->getData('name'), true, 0755);
				}
					
                $this->Flash->success(__('The task has been saved.'));
				$this->Log->write('info', 'Task', $user['first_name'].' '.$user['last_name'].' added '.$this->request->getData('name'), [], ['request' => true], $result->id, $get_user->department_access);
				
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
				
					$this->Log->write('info', 'Task', $user['first_name'].' '.$user['last_name'].' assigned '.$assigned.' to task::'.$this->request->getData('name'), [], ['request' => true], $result->id, $get_user->department_access);
								
					if($d_member_array){
						$recipients = array();
						$email = new Email('default');
					
						foreach($added_members as $added_member) {
						    $recipients[] = $added_member->email;
						}
					
						$link =  Router::url(['controller' => 'DepartmentTasks', 'action' => 'view', $project->id, 'department'=>$project->department_id], true);
					
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

                return $this->redirect(['controller'=>'DepartmentProjects', 'action' => 'view', $this->request->getData(['project_id'])]);
            }
			
            $this->Flash->error(__('The task could not be saved. Please, try again.'));
        }
		
		$user_table = TableRegistry::get('Users');	
		$department = TableRegistry::get('Departments');	
		$get_user = $user_table->find('all')->where(['Users.id' => $user['id']])->first();
		
		$department_details = $department->find('all', [
		    'conditions' => ['Departments.id' => $get_user->department_access],
		]);
		
		$department_details = $department_details->first();
		
        //$users = $this->DepartmentTasks->Users->find('list', ['conditions'=>['']]);
		//$users_collect = $department_members->find('all')->where(['DepartmentsMembers.department_id' => $project->department_id]);
		$users_collect = $project_members->find('all', [
		    'conditions' => ['DepartmentProjectMembers.project_id' => $id]
		]);
		
		// $data = $users_collect->toArray();
//
// 		pr($data);
		
		foreach($users_collect as $collect):
			$user_ids[] = $collect->user_id;
		endforeach;
		
		if($user_ids){
			//$user_ids = implode(',', array_values($user_ids));
			$users = $this->DepartmentTasks->Users->find('list')->where(['Users.id IN' => $user_ids]);
		}
		
        $departments = $this->DepartmentTasks->Departments->find('list', []);
        $projects = $this->DepartmentTasks->DepartmentProjects->find('list', []);
        $this->set(compact('task', 'users', 'departments', 'projects', 'project', 'user_ids', 'department_details'));
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
		$department_members = TableRegistry::get('DepartmentsMembers');
		
		$user = $this->Auth->user();
		$project = TableRegistry::get('DepartmentProjects');
		$project_members = TableRegistry::get('DepartmentProjectMembers');
		$mediaTable = TableRegistry::get('DepartmentMedia');
		$user_table = TableRegistry::get('Users');
		$department = TableRegistry::get('Departments');
		
		$users = null;
		$user_ids = null;
		
        $task = $this->DepartmentTasks->get($id, [
            'contain' => []
        ]);
			
		$project = $project->get($task->project_id);
		
		$get_user = $user_table->find('all')->where(['Users.id' => $user['id']])->first();
			
		$check_user = $department_members->find('all')->where(['DepartmentsMembers.user_id' => $user['id']])->contain(['Users', 'Departments'])->first();
		$check_folder = $mediaTable->find('all')->where(['DepartmentMedia.project_id' => $project->id])->contain([])->first();
		
		$department_details = $department->find('all', [
		    'conditions' => ['Departments.id' => $get_user->department_access],
		]);
		
		$department_details = $department_details->first();
			
        if ($this->request->is(['patch', 'post', 'put'])) {
            $task = $this->DepartmentTasks->patchEntity($task, $this->request->getData());
			
			if($this->request->getData(['user_id'])){
				$task->user_id = implode(',', $this->request->getData(['user_id']));
			}
			
            if ($this->DepartmentTasks->save($task)) {
				$this->Log->write('info', 'Task', $user['first_name'].' '.$user['last_name'].' updated '.$task->name, [], ['request' => true], $task->id, $get_user->department_access);
                $this->Flash->success(__('The task has been saved.'));

				$media = $mediaTable->newEntity();
				//if($check_folder){
					//$parent_m = $mediaTable->find('all')->where(['DepartmentMedia.source_id' => $project->id])->first();
					//$media->parent_id = $parent_m->id;
					
					$current_media = $mediaTable->find('all')->where(['DepartmentMedia.project_id' => $project->id, 'DepartmentMedia.task_id' => $task->id])->contain([])->first();
					
					$media->id = $current_media->id;
					$media->folder_name = $this->request->getData('name');
					$media->media_dir = 'files'.DS.'media'.DS.$department_details->name.DS.$project->name;
					
					$mediaTable->save($media);
					
					$dir_path = new Folder(WWW_ROOT . 'files'.DS.'media'.DS.$department_details->name.DS.$project->name);
					
					if($dir_path->cd($this->request->getData('name'))){
						rename(WWW_ROOT . 'files'.DS.'media'.DS.$department_details->name.DS.$project->name.DS.$task->name, WWW_ROOT . 'files'.DS.'media'.DS.$department_details->name.DS.$project->name.DS.$this->request->getData('name'));
					}else{
						$dir = new Folder(WWW_ROOT . 'files'.DS.'media'.DS.$department_details->name.DS.$project->name.DS.$this->request->getData('name'), true, 0755);
					}
					
				// }else{
// 					//$parent_m = $mediaTable->find('all')->where(['DepartmentMedia.source_id' => $project->id])->first();
// 					//$media->parent_id = $parent_m->id;
// 					$media->source_id = $result->id;
// 					$media->folder_name = $this->request->getData('name');
// 					$media->department_id = $check_user->department_id;
// 					$media->uploaded_by = $user['id'];
// 					$media->media_dir = 'files'.DS.'media'.DS.$department_details->name.DS.$project->name;
//
// 					if($mediaTable->save($media)){
// 						$dir = new Folder(WWW_ROOT . 'files'.DS.'media'.DS.$department_details->name.DS.$this->request->getData('name'), true, 0755);
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
					
						$link =  Router::url(['controller' => 'DepartmentTasks', 'action' => 'view', $project->id, 'department'=>$project->department_id], true);
					
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
				
				return $this->redirect(['controller'=>'DepartmentProjects', 'action' => 'view', $task->project_id]);
            }else{
            	$this->Flash->error(__('The task could not be saved. Please, try again.'));
            }
        }
		
        //$users = $this->DepartmentTasks->Users->find('list', ['limit' => 200]);
        $departments = $this->DepartmentTasks->Departments->find('list', []);
        //$projects = $this->DepartmentTasks->Projects->find('list', []);
		
		$users_collect = $project_members->find('all', [
		    'conditions' => ['DepartmentProjectMembers.project_id' => $project->id]
		]);
		
		foreach($users_collect as $collect):
			$user_ids[] = $collect->user_id;
		endforeach;
		
		//$user_ids = implode(',', array_values($user_ids));
		if($user_ids){
			$users = $this->DepartmentTasks->Users->find('list')->where(['Users.id IN' => $user_ids]);
		}
		
		$default_ids = explode(',', $task->user_id);
		
		$default_ids = array_values($default_ids);
						
        $this->set(compact('task', 'users', 'departments', 'project', 'default_ids'));
        $this->set('_serialize', ['task']);
    }
	
    public function upload($id = null, $task_id = null)
    {
 		$user = $this->Auth->user();

 		$parent_id = $id;
 		$current_media = null;
		
		$departments = TableRegistry::get('Departments');
		$mediaTable = TableRegistry::get('DepartmentMedia');
		$projectsTable = TableRegistry::get('DepartmentProjects');
		$user_table = TableRegistry::get('Users');
		$get_user = $user_table->find('all')->where(['Users.id' => $user['id']])->first();
		
		$media = $mediaTable->newEntity();
		
		$current_department = $departments->get($get_user->department_access);
		
		$project = $projectsTable->find('all')->where(['DepartmentProjects.id' => $id])->first();
		
        $task = $this->DepartmentTasks->get($task_id, [
            'contain' => []
        ]);

        if ($this->request->is('post')) {
 			//pr($this->request->getData());
 			$current_media = $mediaTable->find('all')->where(['DepartmentMedia.department_id' => $current_department->id, 'DepartmentMedia.project_id' => $project->id])->first();
			
			$media = $mediaTable->patchEntity($media, $this->request->getData());
			
 			//pr($this->request->getData());

			$media->source_id = $task->id;
			
			$media->parent_id = $current_media->id;
			
			$media->department_id = $get_user->department_access;
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
 				$media->media_dir = 'files'.DS.'media'.DS.$current_department->name.DS.$task->name;
 			}

            if ($result = $mediaTable->save($media)) {
				$this->Log->write('info', 'Task', $user['first_name'].' '.$user['last_name'].' uploaded '.$this->request->data['file_name']['name'], [], ['request' => true], $result->id, $get_user->department_access);
                
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
		$comments = TableRegistry::get('DepartmentComments');
		$projects = TableRegistry::get('DepartmentProjects');
        $this->request->allowMethod(['post', 'delete']);
        $task = $this->DepartmentTasks->get($id);
		
		$user_table = TableRegistry::get('Users');
		$get_user = $user_table->find('all')->where(['Users.id' => $user['id']])->first();
		
		$project = $projects->get($task->project_id);
		
        if ($this->DepartmentTasks->delete($task)) {
			$comments->deleteAll([
			    'comment_src' => 2,
				'source_id' => $task->id
			]);
			$this->Log->write('info', 'Task', $user['first_name'].' '.$user['last_name'].' deleted '.$task->name, [], ['request' => true], $task->id, $get_user->department_access);
            $this->Flash->success(__($task->name.' has been deleted.'));
			
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
        } else {
            $this->Flash->error(__($task->name.' could not be deleted. Please, try again.'));
        }

        return $this->redirect(['controller'=>'DepartmentProjects', 'action' => 'view', $task->project_id]);
    }
	
    public function deleteComment($id = null)
    {
		$user = $this->Auth->user();
		$comments = TableRegistry::get('DepartmentComments');
        $this->request->allowMethod(['post', 'delete']);
        $comment = $comments->get($id);
		
		$user_table = TableRegistry::get('Users');
		$get_user = $user_table->find('all')->where(['Users.id' => $user['id']])->first();
		
        if ($comments->delete($comment)) {
			$this->Log->write('info', 'Task', $user['first_name'].' '.$user['last_name'].' deleted comment '.$comments->comment, [], ['request' => true], $comments->id, $get_user->department_access);
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
        $task = $this->DepartmentTasks->get($id);
		$task_e = $this->DepartmentTasks->newEntity();
		$task_e->id = $id;
		$task_e->status = $status;
		$task_e->attended_by = $user_id;
		
		$user_table = TableRegistry::get('Users');
		$get_user = $user_table->find('all')->where(['Users.id' => $user['id']])->first();
		
		$projects = TableRegistry::get('DepartmentProjects');
		$project = $projects->get($task->project_id, ['contain'=>['Users']]);
		
        if ($this->DepartmentTasks->save($task_e)) {
			if($status == 2){
				$this->Flash->success(__($task->name.' has been marked as done.'));
				
				$this->Log->write('info', 'Task', $user['first_name'].' '.$user['last_name'].' marked '.$project->name.' as done', [], ['request' => true], $task->id, $get_user->department_access);
		
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
			
			}
        } else {
            $this->Flash->error(__($task->name.' could not be marked as done. Please, try again.'));
        }

        return $this->redirect(['controller' => 'DepartmentProjects','action' => 'view', $task->project_id]);
    }
}
