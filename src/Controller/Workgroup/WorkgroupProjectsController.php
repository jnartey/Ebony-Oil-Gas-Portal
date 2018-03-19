<?php
namespace App\Controller\Workgroup;
use App\Controller\Workgroup\AppController;
use Cake\ORM\TableRegistry;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;
use Cake\Mailer\Email;
use Cake\Routing\Router;

/**
 * WorkgroupProjects Controller
 *
 * @property \App\Model\Table\WorkgroupProjectsTable $WorkgroupProjects
 *
 * @method \App\Model\Entity\WorkgroupProject[] paginate($object = null, array $settings = [])
 */
class WorkgroupProjectsController extends AppController
{

    public function index()
    {
		$user = $this->Auth->user();
		$user_table = TableRegistry::get('Users');	
		$workgroup = TableRegistry::get('Workgroups');	
		$get_user = $user_table->find('all')->where(['Users.id' => $user['id']])->first();
		
        $this->paginate = [
			'conditions' => ['WorkgroupProjects.workgroup_id' => $get_user->workgroup_access],
            'contain' => ['WorkgroupTasks'],
			'limit' => 24
        ];
		
        $projects = $this->paginate($this->WorkgroupProjects);
		
		$workgroup_details = $workgroup->find('all', [
		    'conditions' => ['Workgroups.id' => $get_user->workgroup_access],
		]);
		
		$workgroup_details = $workgroup_details->first();

        $this->set(compact('projects', 'workgroup_details'));
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
		
		$projects_members = TableRegistry::get('WorkgroupProjectMembers');
		$workgroup_members = TableRegistry::get('WorkgroupsMembers');
		$workgroup = TableRegistry::get('Workgroups');
		$users = TableRegistry::get('Users');
		$task = TableRegistry::get('WorkgroupTasks');
		$mediaTable = TableRegistry::get('WorkgroupMedia');
		
		$user = $this->Auth->user();
		
        $project = $this->WorkgroupProjects->get($id, [
            'contain' => ['WorkgroupProjectMembers']
        ]);
			
		$user_details = $workgroup_members->find('all', [
		    'conditions' => ['WorkgroupsMembers.user_id' => $user['id']],
			'contain' => ['Workgroups']
		]);
			
		$project_members = $projects_members->find('all', [
		    'conditions' => ['WorkgroupProjectMembers.project_id' => $id],
			'contain' => ['WorkgroupProjects', 'Users']
		]);
			
		$tasks = $task->find('all', [
		    'conditions' => ['WorkgroupTasks.project_id' => $id],
			'contain' => ['WorkgroupProjects']
		]);
			
		$get_user = $users->find('all')->where(['Users.id' => $user['id']])->first();
	
		$workgroup_details = $workgroup->find('all', [
		    'conditions' => ['Workgroups.id' => $get_user->workgroup_access],
		]);
	
		$workgroup_details = $workgroup_details->first();
		
		$wkg_members = $workgroup_members->find('all', [
			'conditions' => ['WorkgroupsMembers.workgroup_id'=>$get_user->workgroup_access],
		    'contain' => ['Users']
		]);
			
		$media_files = $mediaTable->find('all')->where(['WorkgroupMedia.project_id' => $project->id, 'WorkgroupMedia.file_name IS NOT'=>'', 'WorkgroupMedia.task_id IS'=>null]);
		$media_files_count = $mediaTable->find('all')->where(['WorkgroupMedia.project_id' => $project->id, 'WorkgroupMedia.file_name IS NOT'=>'', 'WorkgroupMedia.task_id IS'=>null])->count();
			
		$wkg_members_array = $wkg_members->toArray();
		
		//$data = $user_details->toArray();
				
		$workgroup_ids = null;
		
        if($this->request->is(['patch', 'post', 'put'])) {
            $project = $this->WorkgroupProjects->patchEntity($project, $this->request->getData());
			$project->workgroup_id = $get_user->workgroup_access;
			
            if ($result = $this->WorkgroupProjects->save($project)) {
				$this->Log->write('info', 'Project', $user['first_name'].' '.$user['last_name'].' updated '.$project->name. '\'s timeline', [], ['request' => true], $project->id, null, $get_user->workgroup_access);
                $this->Flash->success(__($project->name.' timeline has been updated.'));
				
				// if($wkg_members_array){
// 					$email = new Email('default');
// 					foreach($wkg_members as $w_member) {
// 					    $mail->addTo($w_member->user->email);
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
				$workgroup_ids[] = $collect->workgroup->id;
			endforeach;

			//$workgroup_ids = implode(',', array_values($workgroup_ids));

			$staff = $workgroup_members->find('all')->where(['WorkgroupsMembers.workgroup_id IN' => $workgroup_ids])->contain(['Users']);
		}

		$this->set(compact('staff', 'tasks', 'project_members', 'workgroup_details', 'media_files', 'media_files_count'));
        $this->set('project', $project);
        $this->set('_serialize', ['project']);
    }
	
    public function comments($id = null, $comment_id = null)
    {
		
		$projects_members = TableRegistry::get('WorkgroupProjectMembers');
		$workgroup_members = TableRegistry::get('WorkgroupsMembers');
		$workgroup = TableRegistry::get('Workgroups');
		$users = TableRegistry::get('Users');
		$task = TableRegistry::get('WorkgroupTasks');
		$comments = TableRegistry::get('WorkgroupComments');
		
		$post = null;
		
		$user = $this->Auth->user();
		
		$get_user = $users->find('all')->where(['Users.id' => $user['id']])->first();
		
		$w_members = $projects_members->find('all', [
			'conditions' => ['WorkgroupProjectMembers.workgroup_id'=>$get_user->workgroup_access],
		    'contain' => ['Users']
		]);
			
		$w_member_array = $w_members->toArray();
		
        $project = $this->WorkgroupProjects->get($id, [
            'contain' => ['WorkgroupProjectMembers']
        ]);
		
		if($comment_id){
	        $comment = $comments->get($comment_id, [
	            'contain' => []
	        ]);
				
	        if ($this->request->is(['patch', 'post', 'put'])) {
				$project = $this->WorkgroupProjects->get($this->request->getData('project_id'));
	            $comment_post = $comments->patchEntity($comment, $this->request->getData());
				
				$w_members = $projects_members->find('all', [
					'conditions' => ['WorkgroupProjectMembers.project_id'=>$project->id],
				    'contain' => ['Users']
				]);
			
				$w_member_array = $w_members->toArray();
				
	            if ($comments->save($comment_post)) {
					$this->Log->write('info', 'Project', $user['first_name'].' '.$user['last_name'].' edited commented on '.$project->name, [], ['request' => true], $project->id);
	                $this->Flash->success(__('The comment has been Updated.'));

	                return $this->redirect(['action' => 'comments', $this->request->getData('project_id')]);
	            }
	            $this->Flash->error(__('The comment could not be saved. Please, try again.'));
	        }
		}else{
			$comment = $comments->newEntity();
			
	        if ($this->request->is('post')) {
				$project = $this->WorkgroupProjects->get($this->request->getData('project_id'));
				$w_members = $projects_members->find('all', [
					'conditions' => ['WorkgroupProjectMembers.project_id'=>$project->id],
				    'contain' => ['Users']
				]);
			
				$w_member_array = $w_members->toArray();
				
	            $comment_post = $comments->patchEntity($comment, $this->request->getData());
	            if ($comments->save($comment_post)) {
					$this->Log->write('info', 'Project', $user['first_name'].' '.$user['last_name'].' commented on '.$project->name, [], ['request' => true], $project->id);
	                $this->Flash->success(__('The comment has been saved.'));
					
	                return $this->redirect(['action' => 'comments', $this->request->getData('project_id')]);
	            }
	            $this->Flash->error(__('The comment could not be saved. Please, try again.'));
	        }
		}
		
		$user_table = TableRegistry::get('Users');	
		$workgroup = TableRegistry::get('Workgroups');	
		$get_user = $user_table->find('all')->where(['Users.id' => $user['id']])->first();
		
		$workgroup_details = $workgroup->find('all', [
		    'conditions' => ['Workgroups.id' => $get_user->workgroup_access],
		]);
		
		$workgroup_details = $workgroup_details->first();
		
		$tasks = $task->find('all', [
		    'conditions' => ['WorkgroupTasks.project_id' => $id],
			'contain' => ['WorkgroupProjects']
		]);
		
		//$data = $user_details->toArray();
        $this->paginate = [
			'conditions'=>['WorkgroupComments.comment_src'=>1, 'WorkgroupComments.project_id'=>$project->id],
            'contain' => ['Users']
        ];
		
        $posts = $this->paginate($comments);
					
		$this->set(compact('staff', 'tasks', 'project_members', 'comment', 'posts', 'comment_id', 'workgroup_details'));
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
		$user = $this->Auth->user();
		$user_table = TableRegistry::get('Users');	
		$workgroup = TableRegistry::get('Workgroups');	
		$get_user = $user_table->find('all')->where(['Users.id' => $user['id']])->first();
		
		$workgroup_details = $workgroup->find('all', [
		    'conditions' => ['Workgroups.id' => $get_user->workgroup_access],
		]);
		
		$workgroup_details = $workgroup_details->first();
		
		$workgroup_members = TableRegistry::get('WorkgroupsMembers');
		$mediaTable = TableRegistry::get('WorkgroupMedia');
		
		$user = $this->Auth->user();
		
		$check_user = $workgroup_members->find('all')->where(['WorkgroupsMembers.user_id' => $user['id']])->contain(['Users', 'Workgroups'])->first();
		
		
        $project = $this->WorkgroupProjects->newEntity();
		$media = $mediaTable->newEntity();
        if ($this->request->is('post')) {
            $project = $this->WorkgroupProjects->patchEntity($project, $this->request->getData());
			$project->workgroup_id = $get_user->workgroup_access;
            if ($result = $this->WorkgroupProjects->save($project)) {
				
				$media->source_id = $result->id;
				$media->project_id = $result->id;
				$media->folder_name = $this->request->getData('name');
				$media->department_id = $get_user->workgroup_access;
				$media->parent_id = $current_media->id;
				$media->uploaded_by = $user['id'];
				$media->media_dir = 'files'.DS.'media'.DS.$department_details->name;
				
				if($mediaTable->save($media)){
					$dir = new Folder(WWW_ROOT . 'files'.DS.'media'.DS.$workgroup_details->name.DS.$this->request->getData('name'), true, 0755);
				}
				
				$this->Log->write('info', 'Project', $user['first_name'].' '.$user['last_name'].' added '.$this->request->getData('name'), [], ['request' => true], $result->id);	
                $this->Flash->success(__('The project has been saved.'));
				
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The project could not be saved. Please, try again.'));
        }
        $this->set(compact('project', 'workgroup_details'));
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
		$workgroup_members = TableRegistry::get('WorkgroupsMembers');
		$mediaTable = TableRegistry::get('WorkgroupMedia');
		
		$user = $this->Auth->user();
		$user_table = TableRegistry::get('Users');	
		$workgroup = TableRegistry::get('Workgroups');	
		$get_user = $user_table->find('all')->where(['Users.id' => $user['id']])->first();
		
		$workgroup_details = $workgroup->find('all', [
		    'conditions' => ['Workgroups.id' => $get_user->workgroup_access],
		]);
		
		$workgroup_details = $workgroup_details->first();
		
        $project = $this->WorkgroupProjects->get($id, [
            'contain' => []
        ]);
		
		$check_user = $workgroup_members->find('all')->where(['WorkgroupsMembers.user_id' => $user['id']])->contain(['Users', 'Workgroups'])->first();
		$check_folder = $mediaTable->find('all')->where(['WorkgroupMedia.project_id' => $project->id, 'WorkgroupMedia.department_id' => $department_details->id])->contain([])->first();
		
		$w_members = $projects_members->find('all', [
			'conditions' => ['WorkgroupProjectMembers.project_id'=>$project->id],
		    'contain' => ['Users']
		]);
	
		$w_member_array = $w_members->toArray();
		
		$current_media = $mediaTable->find('all')->where(['WorkgroupMedia.department_id' => $get_user->workgroup_access, 'WorkgroupMedia.parent_id IS' => null])->contain([])->first();
				
        if ($this->request->is(['patch', 'post', 'put'])) {
            $project = $this->WorkgroupProjects->patchEntity($project, $this->request->getData());
			
            if ($result = $this->WorkgroupProjects->save($project)) {
				$this->Log->write('info', 'Project', $user['first_name'].' '.$user['last_name'].' edited '.$project->name, [], ['request' => true], $project->id, null, $get_user->workgroup_access);
                $this->Flash->success(__($project->name.' has been updated.'));
				
				$media = $mediaTable->newEntity();
				//if($check_folder){
					$media->id = $check_folder->id;
					$media->folder_name = $this->request->getData('name');
					$mediaTable->save($media);
					
					$dir_path = new Folder(WWW_ROOT . 'files'.DS.'media'.DS.$workgroup_details->name);
					
					if($dir_path->cd($this->request->getData('name'))){
						rename(WWW_ROOT . 'files'.DS.'media'.DS.$workgroup_details->name.DS.$project->name, WWW_ROOT . 'files'.DS.'media'.DS.$workgroup_details->name.DS.$this->request->getData('name'));
					}else{
						$dir = new Folder(WWW_ROOT . 'files'.DS.'media'.DS.$workgroup_details->name.DS.$this->request->getData('name'), true, 0755);
					}
					
				// }else{
// 					$media->source_id = $result->id;
// 					$media->folder_name = $this->request->getData('name');
// 					$media->workgroup_id = $workgroup_details->id;
// 					$media->uploaded_by = $user['id'];
// 					$media->parent_id = $current_media->id;
//
// 					if($mediaTable->save($media)){
// 						$dir = new Folder(WWW_ROOT . 'files'.DS.'media'.DS.$workgroup_details->name.DS.$this->request->getData('name'), true, 0755);
// 					}
// 				}
				
				if($w_member_array){
					$recipients = array();
					$email = new Email('default');
					
					foreach($w_member as $added_member) {
					    $recipients[] = $added_member->user->email;
					}
					
					$link =  Router::url(['controller' => 'WorkgroupProjects', 'action' => 'view', $project->id, 'workgroup'=>$project->department_id], true);
					
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
        $this->set(compact('project', 'workgroup_details'));
        $this->set('_serialize', ['project']);
    }
	
    public function upload($id = null)
    {
 		$user = $this->Auth->user();

 		$parent_id = $id;
 		$current_media = null;
		
		$workgroups = TableRegistry::get('Workgroups');
		$mediaTable = TableRegistry::get('WorkgroupsMedia');
		$user_table = TableRegistry::get('Users');
		$get_user = $user_table->find('all')->where(['Users.id' => $user['id']])->first();
		
		$media = $mediaTable->newEntity();
		
		$current_workgroup = $workgroups->get($get_user->workgroup_access);
		
		$project = $this->WorkgroupsProjects->find('all')->where(['WorkgroupsProjects.id' => $id])->first();

        if ($this->request->is('post')) {
 			//pr($this->request->getData());
 			
 			$current_media = $mediaTable->find('all')->where(['WorkgroupsMedia.workgroup_id' => $current_workgroup->id, 'WorkgroupsMedia.project_id' => $project->id])->first();
			
			$media = $mediaTable->patchEntity($media, $this->request->getData());
			
 			//pr($this->request->getData());
			$media->source_id = $project->id;
			
			$media->parent_id = $current_media->id;
			
			$media->workgroup_id = $get_user->workgroup_access;
			$media->project_id = $project->id;

 			$media->uploaded_by = $user['id'];

 			if($id){
				if($current_media->media_dir){
					$media->media_dir = $current_media->media_dir.DS.$project->name;
				}else{
					$media->media_dir = $current_media->folder_name;
				}
 			}else{
 				$media->media_dir = 'files'.DS.'media'.DS.$current_workgroup->name.DS.$project->name;
 			}

            if ($result = $mediaTable->save($media)) {
				$this->Log->write('info', 'Project', $user['first_name'].' '.$user['last_name'].' uploaded '.$this->request->data['file_name']['name'], [], ['request' => true], $result->id, null, $get_user->workgroup_access);
                
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
		$project_members = TableRegistry::get('WorkgroupProjectMembers');
		$tasks = TableRegistry::get('WorkgroupTasks');
		$user_table = TableRegistry::get('Users');
		$comments = TableRegistry::get('WorkgroupComments');
		
        $this->request->allowMethod(['post', 'delete']);
        $project = $this->WorkgroupProjects->get($id);
		
		$w_members = $project_members->find('all', [
			'conditions' => ['DepartmentProjectMembers.project_id'=>$project->id],
		    'contain' => ['Users']
		]);
	
		$w_member_array = $w_members->toArray();
		
		$user_table = TableRegistry::get('Users');	
		$get_user = $user_table->find('all')->where(['Users.id' => $user['id']])->first();
		
        if ($this->WorkgroupProjects->delete($project)) {
			
			if($w_member_array){
				$recipients = array();
				$email = new Email('default');
				
				foreach($w_members as $added_member) {
				    $recipients[] = $added_member->user->email;
				}
								
				try{
				  	$email->from(['info@eogportal.com' => 'Ebony Oil & Gas Portal::Projects'])
					    ->to($recipients)
					    ->subject($project->name)
						->emailFormat('html')
						->send($user['first_name'].' '.$user['last_name'].' has edited a project<br />'
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
				
			$this->Log->write('info', 'Project', $user['first_name'].' '.$user['last_name'].' deleted '.$project->name, [], ['request' => true], $project->id, null, $get_user->workgroup_access);
				
            $this->Flash->success(__($project->name.' has been deleted.'));
        } else {
            $this->Flash->error(__($project->name.' could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
	
    public function deleteComment($id = null)
    {
		$userA = $this->Auth->user();
		$comments = TableRegistry::get('WorkgroupComments');
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
