<?php
namespace App\Controller\Department;
use App\Controller\Department\AppController;
use Cake\ORM\TableRegistry;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;
use Cake\Mailer\Email;
use Cake\Routing\Router;

/**
 * DepartmentProjects Controller
 *
 * @property \App\Model\Table\DepartmentProjectsTable $DepartmentProjects
 *
 * @method \App\Model\Entity\DepartmentProject[] paginate($object = null, array $settings = [])
 */
class DepartmentProjectsController extends AppController
{

    public function index()
    {
		$projects_members = TableRegistry::get('DepartmentProjectMembers');
		
		$user = $this->Auth->user();
		$user_table = TableRegistry::get('Users');		
		$get_user = $user_table->find('all')->where(['Users.id' => $user['id']])->first();
		
        $this->paginate = [
			'conditions' => ['DepartmentProjects.department_id' => $get_user->department_access],
            'contain' => ['DepartmentTasks', 'DepartmentProjectMembers'],
			'limit' => 24
        ];
		
        $projects = $this->paginate($this->DepartmentProjects);
		
        $this->set(compact('projects'));
        $this->set('_serialize', ['projects']);
    }

    /**
     * View method
     *
     * @param string|null $id Project id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
		
		$projects_members = TableRegistry::get('DepartmentProjectMembers');
		$department_members = TableRegistry::get('DepartmentsMembers');
		$department = TableRegistry::get('Departments');
		$users = TableRegistry::get('Users');
		$task = TableRegistry::get('DepartmentTasks');
		$mediaTable = TableRegistry::get('DepartmentMedia');
		
		$user = $this->Auth->user();
		
        $project = $this->DepartmentProjects->get($id, [
            'contain' => ['DepartmentProjectMembers']
        ]);
			
		$user_details = $department_members->find('all', [
		    'conditions' => ['DepartmentsMembers.user_id' => $user['id']],
			'contain' => ['Departments']
		]);
			
		$project_members = $projects_members->find('all', [
		    'conditions' => ['DepartmentProjectMembers.project_id' => $id],
			'contain' => ['DepartmentProjects', 'Users']
		]);
			
		$tasks = $task->find('all', [
		    'conditions' => ['DepartmentTasks.project_id' => $id],
			'contain' => ['DepartmentProjects']
		]);
			
		$media_files = $mediaTable->find('all')->where(['DepartmentMedia.project_id' => $project->id, 'DepartmentMedia.file_name IS NOT'=>'', 'DepartmentMedia.task_id IS'=>null]);
		$media_files_count = $mediaTable->find('all')->where(['DepartmentMedia.project_id' => $project->id, 'DepartmentMedia.file_name IS NOT'=>'', 'DepartmentMedia.task_id IS'=>null])->count();
			
		$get_user = $users->find('all')->where(['Users.id' => $user['id']])->first();
			
		
		$dpt_project_members_array = $project_members->toArray();
		
		//$data = $user_details->toArray();
				
		$department_ids = null;
		
        if($this->request->is(['patch', 'post', 'put'])) {
            $project = $this->DepartmentProjects->patchEntity($project, $this->request->getData());
			
            if ($result = $this->DepartmentProjects->save($project)) {
				$this->Log->write('info', 'Project', $user['first_name'].' '.$user['last_name'].' updated '.$project->name. '\'s timeline', [], ['request' => true], $project->id);
                $this->Flash->success(__($project->name.' timeline has been updated.'));
				
				// if($dpt_project_members_array){
// 					$email = new Email('default');
// 					foreach($project_members as $project_member) {
// 					    $mail->addTo($project_member->user->email);
// 					}
//
// 					$email->from(['info@eogportal.com' => 'Ebony Oil & Gas Portal::Projects'])
// 					    //->to('you@example.com')
// 					    ->subject($project->name)
// 					    ->send($user['first_name'].' '.$user['last_name'].' updated '.$project->name. '\'s timeline');
// 				}
				
				return $this->redirect(['action' => 'view', $project->id]);
			}else{
				$this->Flash->error(__($project->name.' timeline not be updated. Please, try again.'));
			}
        }
	
		if($user_details){
			foreach($user_details as $collect):
				$department_ids[] = $collect->department->id;
			endforeach;

			//$department_ids = implode(',', array_values($department_ids));

			$staff = $department_members->find('all')->where(['DepartmentsMembers.department_id IN' => $department_ids])->contain(['Users']);
		}

		$this->set(compact('staff', 'tasks', 'project_members', 'media_files', 'media_files_count'));
        $this->set('project', $project);
        $this->set('_serialize', ['project']);
    }
	
    public function comments($id = null, $comment_id = null)
    {
		
		$projects_members = TableRegistry::get('DepartmentProjectMembers');
		$department_members = TableRegistry::get('DepartmentsMembers');
		$department = TableRegistry::get('Departments');
		$users = TableRegistry::get('Users');
		$task = TableRegistry::get('DepartmentTasks');
		$comments = TableRegistry::get('DepartmentComments');
		
		$post = null;
		
		$user = $this->Auth->user();
		
		$get_user = $users->find('all')->where(['Users.id' => $user['id']])->first();
		
        $project = $this->DepartmentProjects->get($id, [
            'contain' => ['DepartmentProjectMembers']
        ]);
		
		if($comment_id){
	        $comment = $comments->get($comment_id, [
	            'contain' => []
	        ]);
				
	        if ($this->request->is(['patch', 'post', 'put'])) {
				$project = $this->DepartmentProjects->get($this->request->getData('project_id'));
				$d_members = $projects_members->find('all', [
					'conditions' => ['DepartmentProjectMembers.project_id'=>$project->id],
				    'contain' => ['Users']
				]);
			
				$d_member_array = $d_members->toArray();
				
	            $comment_post = $comments->patchEntity($comment, $this->request->getData());
	            if ($comments->save($comment_post)) {
					$this->Log->write('info', 'Project', $user['first_name'].' '.$user['last_name'].' edited commented on '.$project->name, [], ['request' => true], $project->id);
	                $this->Flash->success(__('The comment has been Updated.'));
					
					// if($d_member_array){
// 						$email = new Email('default');
// 						foreach($d_members as $d_member) {
// 						    $mail->addTo($d_member->user->email);
// 						}
//
// 						$email->from(['info@eogportal.com' => 'Ebony Oil & Gas Portal::Projects'])
// 						    //->to('you@example.com')
// 						    ->subject($project->name)
// 						    ->send($user['first_name'].' '.$user['last_name'].' edited commented on '.$project->name);
// 					}

	                return $this->redirect(['action' => 'comments', $this->request->getData('project_id')]);
	            }
	            $this->Flash->error(__('The comment could not be saved. Please, try again.'));
	        }
		}else{
			$comment = $comments->newEntity();
			
	        if ($this->request->is('post')) {
				$project = $this->DepartmentProjects->get($this->request->getData('project_id'));
	            $comment_post = $comments->patchEntity($comment, $this->request->getData());
	            if ($comments->save($comment_post)) {
					$this->Log->write('info', 'Project', $user['first_name'].' '.$user['last_name'].' commented on '.$project->name, [], ['request' => true], $project->id);
	                $this->Flash->success(__('The comment has been saved.'));
					
					// if($d_member_array){
// 						$email = new Email('default');
// 						foreach($d_members as $d_member) {
// 						    $mail->addTo($d_member->user->email);
// 						}
//
// 						$email->from(['info@eogportal.com' => 'Ebony Oil & Gas Portal::Projects'])
// 						    //->to('you@example.com')
// 						    ->subject($project->name)
// 						    ->send($user['first_name'].' '.$user['last_name'].' commented on '.$project->name);
// 					}

	                return $this->redirect(['action' => 'comments', $this->request->getData('project_id')]);
	            }
	            $this->Flash->error(__('The comment could not be saved. Please, try again.'));
	        }
		}
		
		$user = $this->Auth->user();
			
		$tasks = $task->find('all', [
		    'conditions' => ['DepartmentTasks.project_id' => $id],
			'contain' => ['DepartmentProjects']
		]);
		
		//$data = $user_details->toArray();
        $this->paginate = [
			'conditions'=>['DepartmentComments.comment_src'=>1, 'DepartmentComments.project_id'=>$project->id],
            'contain' => ['Users']
        ];
		
        $posts = $this->paginate($comments);
					
		$this->set(compact('staff', 'tasks', 'project_members', 'comment', 'posts', 'comment_id'));
        $this->set('project', $project);
        $this->set('_serialize', ['project']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
		$department_members = TableRegistry::get('DepartmentsMembers');
		$mediaTable = TableRegistry::get('DepartmentMedia');
		
		$user = $this->Auth->user();
		$user_table = TableRegistry::get('Users');	
		$department = TableRegistry::get('Departments');	
		$get_user = $user_table->find('all')->where(['Users.id' => $user['id']])->first();
		
		$department_details = $department->find('all', [
		    'conditions' => ['Departments.id' => $get_user->department_access],
		]);
		
		$department_details = $department_details->first();
		
		$check_user = $department_members->find('all')->where(['DepartmentsMembers.user_id' => $user['id']])->contain(['Users', 'Departments'])->first();
		
		$d_members = $department_members->find('all', [
			'conditions' => ['DepartmentsMembers.department_id'=>$get_user->department_access],
		    'contain' => ['Users']
		]);
			
		$current_media = $mediaTable->find('all')->where(['DepartmentMedia.department_id' => $get_user->department_access, 'DepartmentMedia.parent_id IS' => null])->contain([])->first();
	
		$d_member_array = $d_members->toArray();
				
        $project = $this->DepartmentProjects->newEntity();
		$media = $mediaTable->newEntity();
        if ($result = $this->request->is('post')) {
            $project = $this->DepartmentProjects->patchEntity($project, $this->request->getData());
			$project->department_id = $get_user->department_access;
			
            if ($result = $this->DepartmentProjects->save($project)) {
				
				$media->source_id = $result->id;
				$media->project_id = $result->id;
				$media->folder_name = $this->request->getData('name');
				$media->department_id = $get_user->department_access;
				$media->parent_id = $current_media->id;
				$media->uploaded_by = $user['id'];
				$media->media_dir = 'files'.DS.'media'.DS.$department_details->name;
				
				if($mediaTable->save($media)){
					$dir = new Folder(WWW_ROOT . 'files'.DS.'media'.DS.$check_user->department->name.DS.$this->request->getData('name'), true, 0755);
				}
					
				$this->Log->write('info', 'Project', $user['first_name'].' '.$user['last_name'].' added '.$this->request->getData('name'), [], ['request' => true], $result->id, $get_user->department_access);
				
                $this->Flash->success(__('The project has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The project could not be saved. Please, try again.'));
        }
        $this->set(compact('project', 'department_details', 'd_member_array'));
        $this->set('_serialize', ['project']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Project id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
		$department_members = TableRegistry::get('DepartmentsMembers');
		$mediaTable = TableRegistry::get('DepartmentMedia');
		$projects_members = TableRegistry::get('DepartmentProjectMembers');
		
		$user = $this->Auth->user();
		
        $project = $this->DepartmentProjects->get($id, [
            'contain' => []
        ]);
			
		$user = $this->Auth->user();
		$user_table = TableRegistry::get('Users');	
		$department = TableRegistry::get('Departments');	
		$get_user = $user_table->find('all')->where(['Users.id' => $user['id']])->first();
	
		$department_details = $department->find('all', [
		    'conditions' => ['Departments.id' => $get_user->department_access],
		]);
		
		$department_details = $department_details->first();
		
		$check_user = $department_members->find('all')->where(['DepartmentsMembers.user_id' => $user['id']])->contain(['Users', 'Departments'])->first();
		$check_folder = $mediaTable->find('all')->where(['DepartmentMedia.project_id' => $project->id, 'DepartmentMedia.department_id' => $department_details->id])->contain([])->first();
		
		$d_members = $projects_members->find('all', [
			'conditions' => ['DepartmentProjectMembers.project_id'=>$project->id],
		    'contain' => ['Users']
		]);
	
		$d_member_array = $d_members->toArray();
				
        if ($this->request->is(['patch', 'post', 'put'])) {
            $project = $this->DepartmentProjects->patchEntity($project, $this->request->getData());
			
            if ($result = $this->DepartmentProjects->save($project)) {
				$this->Log->write('info', 'Project', $user['first_name'].' '.$user['last_name'].' edited '.$project->name, [], ['request' => true], $project->id, $get_user->department_access);
                $this->Flash->success(__($project->name.' has been updated.'));
				
				$media = $mediaTable->newEntity();
				//if($check_folder){
					$media->id = $check_folder->id;
					$media->folder_name = $this->request->getData('name');
					$media->media_dir = 'files'.DS.'media'.DS.$department_details->name;
					$mediaTable->save($media);
					
					$dir_path = new Folder(WWW_ROOT . 'files'.DS.'media'.DS.$department_details->name);
					
					if($dir_path->cd($this->request->getData('name'))){
						rename(WWW_ROOT . 'files'.DS.'media'.DS.$department_details->name.DS.$project->name, WWW_ROOT . 'files'.DS.'media'.DS.$department_details->name.DS.$this->request->getData('name'));
					}else{
						$dir = new Folder(WWW_ROOT . 'files'.DS.'media'.DS.$department_details->name.DS.$this->request->getData('name'), true, 0755);
					}
					
				// }else{
// 					$media->source_id = $result->id;
// 					$media->folder_name = $this->request->getData('name');
// 					$media->department_id = $check_user->department_id;
// 					$media->uploaded_by = $user['id'];
//
// 					if($mediaTable->save($media)){
// 						$dir = new Folder(WWW_ROOT . 'files'.DS.'media'.DS.$department_details->name.DS.$this->request->getData('name'), true, 0755);
// 					}
// 				}
				
				if($d_member_array){
					$recipients = array();
					$email = new Email('default');
					
					foreach($d_members as $added_member) {
					    $recipients[] = $added_member->user->email;
					}
					
					$link =  Router::url(['controller' => 'DepartmentProjects', 'action' => 'view', $project->id, 'department'=>$project->department_id], true);
					
					try{
					  	$email->from(['info@eogportal.com' => 'Ebony Oil & Gas Portal::Projects'])
						    ->to($recipients)
						    ->subject($project->name)
							->emailFormat('html')
							->send($user['first_name'].' '.$user['last_name'].' has edited a project<br />'
								.'<strong>Project Title: </strong>'.$project->name.'<br />'
								.'<strong>Project Duration: </strong>'.$project->start_date.' - '.$project->end_date.'<br />'
								.'<strong>Project Description</strong><br />'.$project->description.'<br />'
								.'<a href="'.$link.'">Click here to view</a>'); 
					} catch (Exception $e) {
			            echo 'Exception : ',  $e->getMessage(), "\n";
			        }
				  	
				}
								
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__($project->name.' could not be saved. Please, try again.'));
        }
        $this->set(compact('project', 'department_details'));
        $this->set('_serialize', ['project']);
    }
	
    public function upload($id = null)
    {
 		$user = $this->Auth->user();

 		$parent_id = $id;
 		$current_media = null;
		
		$departments = TableRegistry::get('Departments');
		$mediaTable = TableRegistry::get('DepartmentMedia');
		$user_table = TableRegistry::get('Users');
		$get_user = $user_table->find('all')->where(['Users.id' => $user['id']])->first();
		
		$media = $mediaTable->newEntity();
		
		$current_department = $departments->get($get_user->department_access);
		
		$project = $this->DepartmentProjects->find('all')->where(['DepartmentProjects.id' => $id])->first();

        if ($this->request->is('post')) {
 			//pr($this->request->getData());
 			
 			$current_media = $mediaTable->find('all')->where(['DepartmentMedia.department_id' => $current_department->id, 'DepartmentMedia.project_id' => $project->id])->first();
			
			$media = $mediaTable->patchEntity($media, $this->request->getData());
			
 			//pr($this->request->getData());
			$media->source_id = $project->id;
			
			$media->parent_id = $current_media->id;
			
			$media->department_id = $get_user->department_access;
			$media->project_id = $project->id;

 			$media->uploaded_by = $user['id'];

 			if($id){
				if($current_media->media_dir){
					$media->media_dir = $current_media->media_dir.DS.$project->name;
				}else{
					$media->media_dir = $current_media->folder_name;
				}
 			}else{
 				$media->media_dir = 'files'.DS.'media'.DS.$current_department->name.DS.$project->name;
 			}

            if ($result = $mediaTable->save($media)) {
				$this->Log->write('info', 'Project', $user['first_name'].' '.$user['last_name'].' uploaded '.$this->request->data['file_name']['name'], [], ['request' => true], $result->id, $get_user->department_access);
				
				$resultJ = json_encode(array('result' => '<div class="callout success">'.$this->request->data['file_name']['name'].' uploaded successfully.</div>'));
				$this->response->type('json');
				$this->response->body($resultJ);
				return $this->response;
				
				if($id){
					return $this->redirect(['action' => 'view', $project->id]);
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
     * @param string|null $id Project id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
		$user = $this->Auth->user();
		$project_members = TableRegistry::get('DepartmentProjectMembers');
		$tasks = TableRegistry::get('DepartmentTasks');
		$user_table = TableRegistry::get('Users');
		$comments = TableRegistry::get('DepartmentComments');
		
        $this->request->allowMethod(['post', 'delete']);
        $project = $this->DepartmentProjects->get($id);
		
		$d_members = $project_members->find('all', [
			'conditions' => ['DepartmentProjectMembers.project_id'=>$project->id],
		    'contain' => ['Users']
		]);
	
		$d_member_array = $d_members->toArray();
		
		$get_user = $user_table->find('all')->where(['Users.id' => $user['id']])->first();
		
        if ($this->DepartmentProjects->delete($project)) {
			
			if($d_member_array){
				$recipients = array();
				$email = new Email('default');
				
				foreach($d_members as $added_member) {
				    $recipients[] = $added_member->email;
				}
								
				try{
				  	$email->from(['info@eogportal.com' => 'Ebony Oil & Gas Portal::Projects'])
					    ->to($recipients)
					    ->subject($project->name)
						->emailFormat('html')
						->send($user['first_name'].' '.$user['last_name'].' has deleted project<br />'
							.'<strong>Project Title: </strong>'.$project->name.'<br />'
							.'<strong>Project Duration: </strong>'.$project->start_date.' - '.$project->end_date.'<br />'
							.'<strong>Project Description</strong><br />'.$project->description.'<br />'); 
				} catch (Exception $e) {
		            echo 'Exception : ',  $e->getMessage(), "\n";
		        }
			  	
			}
			
			$project_members->deleteAll([
			    'project_id' => $project->id
			]);
				
			$tasks->deleteAll([
			    'project_id' => $project->id
			]);
				
			$comments->deleteAll([
			    'project_id' => $project->id
			]);
				
			$this->Log->write('info', 'Project', $user['first_name'].' '.$user['last_name'].' deleted '.$project->name, [], ['request' => true], $project->id, $get_user->department_access);
				
            $this->Flash->success(__($project->name.' has been deleted.'));
        } else {
            $this->Flash->error(__($project->name.' could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
	
    public function deleteComment($id = null)
    {
		$userA = $this->Auth->user();
		$comments = TableRegistry::get('DepartmentComments');
        $this->request->allowMethod(['post', 'delete']);
        $comment = $comments->get($id);
        if ($comments->delete($comment)) {
            $this->Flash->success(__($comment->comment.' has been deleted.'));
        } else {
            $this->Flash->error(__($comment->comment.' could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'view', $comment->source_id]);
    }
}
