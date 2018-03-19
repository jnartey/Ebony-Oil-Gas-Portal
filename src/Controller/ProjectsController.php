<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;
use Cake\Mailer\Email;

/**
 * Projects Controller
 *
 * @property \App\Model\Table\ProjectsTable $Projects
 */
class ProjectsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Tasks']
        ];
        $projects = $this->paginate($this->Projects);

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
		
		$projects_members = TableRegistry::get('ProjectsMembers');
		$department_members = TableRegistry::get('DepartmentsMembers');
		$department = TableRegistry::get('Departments');
		$users = TableRegistry::get('Users');
		$task = TableRegistry::get('Tasks');
		
		$user = $this->Auth->user();
		
        $project = $this->Projects->get($id, [
            'contain' => ['ProjectsMembers']
        ]);
			
		$user_details = $department_members->find('all', [
		    'conditions' => ['DepartmentsMembers.user_id' => $user['id']],
			'contain' => ['Departments']
		]);
			
		$project_members = $projects_members->find('all', [
		    'conditions' => ['ProjectsMembers.project_id' => $id],
			'contain' => ['Projects', 'Users']
		]);
			
		$tasks = $task->find('all', [
		    'conditions' => ['Tasks.project_id' => $id],
			'contain' => ['Projects']
		]);
		
		//$data = $user_details->toArray();
				
		$department_ids = null;
		
        if($this->request->is(['patch', 'post', 'put'])) {
            $project = $this->Projects->patchEntity($project, $this->request->getData());
			
            if ($result = $this->Projects->save($project)) {
				$this->Log->write('info', 'Project', $user['first_name'].' '.$user['last_name'].' updated '.$project->name. '\'s timeline', [], ['request' => true], $project->id);
                $this->Flash->success(__($project->name.' timeline has been updated.'));
				return $this->redirect(['action' => 'view', $project->id]);
			}else{
				$this->Flash->error(__($project->name.' timeline not be updated. Please, try again.'));
			}
        }
	
		if($user_details){
			foreach($user_details as $collect):
				$department_ids[] = $collect->department->id;
			endforeach;

			$department_ids = implode(',', array_values($department_ids));

			$staff = $department_members->find('all')->where(['DepartmentsMembers.department_id IN' => $department_ids])->contain(['Users']);
		}

		$this->set(compact('staff', 'tasks', 'project_members'));
        $this->set('project', $project);
        $this->set('_serialize', ['project']);
    }
	
    public function comments($id = null, $comment_id = null)
    {
		
		$projects_members = TableRegistry::get('ProjectsMembers');
		$department_members = TableRegistry::get('DepartmentsMembers');
		$department = TableRegistry::get('Departments');
		$users = TableRegistry::get('Users');
		$task = TableRegistry::get('Tasks');
		$comments = TableRegistry::get('Comments');
		
		$user = $this->Auth->user();
		
		$post = null;
		
		if($comment_id){
	        $comment = $comments->get($comment_id, [
	            'contain' => []
	        ]);
				
	        if ($this->request->is(['patch', 'post', 'put'])) {
		        $project = $this->Projects->get($this->request->getData('project_id'));
	            $comment_post = $comments->patchEntity($comment, $this->request->getData());
	            if ($comments->save($comment_post)) {
	                $this->Flash->success(__('The comment has been Updated.'));
					$this->Log->write('info', 'Project', $user['first_name'].' '.$user['last_name'].' commented on '.$project->name, [], ['request' => true], $project->id);
	                return $this->redirect(['action' => 'comments', $this->request->getData('project_id')]);
	            }
	            $this->Flash->error(__('The comment could not be saved. Please, try again.'));
	        }
		}else{
			$comment = $comments->newEntity();
			
	        if ($this->request->is('post')) {
				$project = $this->Projects->get($this->request->getData('project_id'));
	            $comment_post = $comments->patchEntity($comment, $this->request->getData());
	            if ($comments->save($comment_post)) {
					$this->Log->write('info', 'Project', $user['first_name'].' '.$user['last_name'].' commented on '.$project->name, [], ['request' => true], $project->id);
	                $this->Flash->success(__('The comment has been saved.'));

	                return $this->redirect(['action' => 'comments', $this->request->getData('project_id')]);
	            }
	            $this->Flash->error(__('The comment could not be saved. Please, try again.'));
	        }
		}
		
		$user = $this->Auth->user();
		
        $project = $this->Projects->get($id, [
            'contain' => ['ProjectsMembers']
        ]);
			
		$tasks = $task->find('all', [
		    'conditions' => ['Tasks.project_id' => $id],
			'contain' => ['Projects']
		]);
		
		//$data = $user_details->toArray();
        $this->paginate = [
			'conditions'=>['Comments.comment_src'=>1, 'Comments.project_id'=>$project->id],
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
		$mediaTable = TableRegistry::get('Media');
		
		$user = $this->Auth->user();
		
		$check_user = $department_members->find('all')->where(['DepartmentsMembers.user_id' => $user['id']])->contain(['Users', 'Departments'])->first();
		
        $project = $this->Projects->newEntity();
		$media = $mediaTable->newEntity();
        if ($this->request->is('post')) {
            $project = $this->Projects->patchEntity($project, $this->request->getData());
            if ($result = $this->Projects->save($project)) {
				
				$media->source_id = $result->id;
				$media->folder_name = $this->request->getData('name');
				$media->department_id = $check_user->department_id;
				$media->uploaded_by = $user['id'];
				
				if($mediaTable->save($media)){
					$dir = new Folder(WWW_ROOT . 'files'.DS.'media'.DS.$check_user->department->name.DS.$this->request->getData('name'), true, 0755);
				}
					
                $this->Flash->success(__('The project has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The project could not be saved. Please, try again.'));
        }
        $this->set(compact('project'));
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
		$mediaTable = TableRegistry::get('Media');
		
		$user = $this->Auth->user();
		
        $project = $this->Projects->get($id, [
            'contain' => []
        ]);
		
		$check_user = $department_members->find('all')->where(['DepartmentsMembers.user_id' => $user['id']])->contain(['Users', 'Departments'])->first();
		$check_folder = $mediaTable->find('all')->where(['Media.source_id' => $project->id])->contain([])->first();
				
        if ($this->request->is(['patch', 'post', 'put'])) {
            $project = $this->Projects->patchEntity($project, $this->request->getData());
			
            if ($result = $this->Projects->save($project)) {
                $this->Flash->success(__($project->name.' has been updated.'));
				
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
            $this->Flash->error(__($project->name.' could not be saved. Please, try again.'));
        }
        $this->set(compact('project'));
        $this->set('_serialize', ['project']);
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
		$userA = $this->Auth->user();
		$project_members = TableRegistry::get('ProjectsMembers');
		$tasks = TableRegistry::get('Tasks');
		$comments = TableRegistry::get('Comments');
		
        $this->request->allowMethod(['post', 'delete']);
        $project = $this->Projects->get($id);
        if ($this->Projects->delete($project)) {
			$project_members->deleteAll([
			    'project_id' => $project->id
			]);
				
			$tasks->deleteAll([
			    'project_id' => $project->id
			]);
				
			$comments->deleteAll([
			    'project_id' => $project->id
			]);
				
            $this->Flash->success(__($project->name.' has been deleted.'));
        } else {
            $this->Flash->error(__($project->name.' could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
	
    public function deleteComment($id = null)
    {
		$userA = $this->Auth->user();
		$comments = TableRegistry::get('Comments');
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
