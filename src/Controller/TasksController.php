<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;
use Cake\Mailer\Email;

/**
 * Tasks Controller
 *
 * @property \App\Model\Table\TasksTable $Tasks
 *
 * @method \App\Model\Entity\Task[] paginate($object = null, array $settings = [])
 */
class TasksController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'Departments', 'Projects']
        ];
        $tasks = $this->paginate($this->Tasks);

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
		$project = TableRegistry::get('Projects');
		$project_members = TableRegistry::get('ProjectsMembers');
		$department_members = TableRegistry::get('DepartmentsMembers');
		$department = TableRegistry::get('Departments');
		$users = TableRegistry::get('Users');
		$comments = TableRegistry::get('Comments');
		//$comment = $comments->newEntity();
		
		$post = null;
		$task_members = null;
		
		if($comment_id){
	        $comment = $comments->get($comment_id, [
	            'contain' => []
	        ]);
				
	        if ($this->request->is(['patch', 'post', 'put'])) {
	            $comment_post = $comments->patchEntity($comment, $this->request->getData());
	            if ($comments->save($comment_post)) {
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
	                $this->Flash->success(__('The comment has been saved.'));

	                return $this->redirect(['action' => 'view', $this->request->getData('project_id')]);
	            }
	            $this->Flash->error(__('The comment could not be saved. Please, try again.'));
	        }
		}
		
        
		
        $task = $this->Tasks->get($id, [
            'contain' => ['Departments', 'Projects']
        ]);
					
		$project = $project->get($task->project_id);
		
        if($this->request->is(['patch', 'post', 'put'])) {
            $task_rec = $this->Tasks->patchEntity($task, $this->request->getData());
			
            if ($result = $this->Tasks->save($task_rec)) {
                $this->Flash->success(__($task->name.' timeline has been updated.'));
				return $this->redirect(['controller'=>'projects', 'action' => 'view', $project->id]);
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
			'conditions'=>['Comments.source_id'=>$task->id, 'Comments.project_id'=>$project->id],
            'contain' => ['Users']
        ];
		
        $posts = $this->paginate($comments);
				
        $this->set(compact('task', 'users', 'project', 'task_members', 'comment', 'posts', 'comment_id'));
        $this->set('_serialize', ['task']);
    }
	
    public function review($id = null, $comment_id = null)
    {
		$userA = $this->Auth->user();
		$project = TableRegistry::get('Projects');
		$project_members = TableRegistry::get('ProjectsMembers');
		$department_members = TableRegistry::get('DepartmentsMembers');
		$department = TableRegistry::get('Departments');
		$users = TableRegistry::get('Users');
		$comments = TableRegistry::get('Comments');
		//$comment = $comments->newEntity();
		
		$post = null;
		
		if($comment_id){
	        $comment = $comments->get($comment_id, [
	            'contain' => []
	        ]);
				
	        if ($this->request->is(['patch', 'post', 'put'])) {
	            $comment_post = $comments->patchEntity($comment, $this->request->getData());
	            if ($comments->save($comment_post)) {
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
	                $this->Flash->success(__('The comment has been saved.'));

	                return $this->redirect(['action' => 'view', $this->request->getData('project_id')]);
	            }
	            $this->Flash->error(__('The comment could not be saved. Please, try again.'));
	        }
		}
		
		$review = $this->Tasks->get($id, [
            'contain' => ['Users', 'Departments', 'Projects']
        ]);
		
        if($this->request->is(['patch', 'post', 'put'])) {
			$review = $this->Tasks->patchEntity($review, $this->request->getData());
            if ($this->Tasks->save($review)) {
                $this->Flash->success(__($review->name.' has been updated.'));
				return $this->redirect(['action' => 'view', $review->id]);
            }
            $this->Flash->error(__('The task could not be saved. Please, try again.'));
        }        
		
        $task = $this->Tasks->get($id, [
            'contain' => ['Users', 'Departments', 'Projects']
        ]);
		
		$project = $project->get($id);
		
		$expanded_ids = explode(',', $task->user_id);
        $task_members = $users->find('all', ['conditions'=>['Users.id IN'=>$expanded_ids]]);
		//pr($task_members->toArray());
		
        $this->paginate = [
			'conditions'=>['Comments.source_id'=>$task->id, 'Comments.project_id'=>$project->id],
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
		$project = TableRegistry::get('Projects');
		$project_members = TableRegistry::get('ProjectsMembers');
		$mediaTable = TableRegistry::get('Media');
		$department_members = TableRegistry::get('DepartmentsMembers');
		
		$user_ids = null;
		$users = null;
		
        // $task_rec = $this->Tasks->get($id, [
//             'contain' => []
//         ]);
		
		$project = $project->get($id);
		$user = $this->Auth->user();
		$check_user = $department_members->find('all')->where(['DepartmentsMembers.user_id' => $user['id']])->contain(['Users', 'Departments'])->first();
		
        $task = $this->Tasks->newEntity();
        if ($this->request->is('post')) {
			
            $task = $this->Tasks->patchEntity($task, $this->request->getData());
			$media = $mediaTable->newEntity();
			
			if($this->request->getData(['user_id'])){
				$task->user_id = implode(',', $this->request->getData(['user_id']));
			}
			
			//pr($task);
			//debug($this->request->getData(['user_id']));
			
            if ($result = $this->Tasks->save($task)) {
				$parent_m = $mediaTable->find('all')->where(['Media.source_id' => $project->id])->first();
				$media->parent_id = $parent_m->id;
				$media->source_id = $result->id;
				$media->folder_name = $this->request->getData('name');
				$media->department_id = $check_user->department_id;
				$media->uploaded_by = $user['id'];
				
				if($mediaTable->save($media)){
					$dir = new Folder(WWW_ROOT . 'files'.DS.'media'.DS.$check_user->department->name.DS.$project->name.DS.$this->request->getData('name'), true, 0755);
				}
					
                $this->Flash->success(__('The task has been saved.'));

                return $this->redirect(['controller'=>'Projects', 'action' => 'view', $this->request->getData(['project_id'])]);
            }
			
            $this->Flash->error(__('The task could not be saved. Please, try again.'));
        }
		
        //$users = $this->Tasks->Users->find('list', ['conditions'=>['']]);
		//$users_collect = $department_members->find('all')->where(['DepartmentsMembers.department_id' => $project->department_id]);
		$users_collect = $project_members->find('all', [
		    'conditions' => ['ProjectsMembers.project_id' => $project->id]
		]);
		
		// $data = $users_collect->toArray();
//
// 		pr($data);
		
		foreach($users_collect as $collect):
			$user_ids[] = $collect->user_id;
		endforeach;
		
		if($user_ids){
			$user_ids = implode(',', array_values($user_ids));
			$users = $this->Tasks->Users->find('list')->where(['Users.id IN' => $user_ids]);
		}
		
        $departments = $this->Tasks->Departments->find('list', []);
        $projects = $this->Tasks->Projects->find('list', []);
        $this->set(compact('task', 'users', 'departments', 'projects', 'project', 'user_ids'));
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
		$project = TableRegistry::get('Projects');
		$project_members = TableRegistry::get('ProjectsMembers');
		$mediaTable = TableRegistry::get('Media');
		
		$users = null;
		$user_ids = null;
		
        $task = $this->Tasks->get($id, [
            'contain' => []
        ]);
			
		$project = $project->get($task->project_id);
			
		$check_user = $department_members->find('all')->where(['DepartmentsMembers.user_id' => $user['id']])->contain(['Users', 'Departments'])->first();
		$check_folder = $mediaTable->find('all')->where(['Media.source_id' => $project->id])->contain([])->first();
			
        if ($this->request->is(['patch', 'post', 'put'])) {
            $task = $this->Tasks->patchEntity($task, $this->request->getData());
			
			if($this->request->getData(['user_id'])){
				$task->user_id = implode(',', $this->request->getData(['user_id']));
			}
			
            if ($this->Tasks->save($task)) {
                $this->Flash->success(__('The task has been saved.'));

				$media = $mediaTable->newEntity();
				if($check_folder){
					//$parent_m = $mediaTable->find('all')->where(['Media.source_id' => $project->id])->first();
					//$media->parent_id = $parent_m->id;
					$media->id = $check_folder->id;
					$media->folder_name = $this->request->getData('name');
					$mediaTable->save($media);
					
					$dir_path = new Folder(WWW_ROOT . 'files'.DS.'media'.DS.$check_user->department->name);
					
					if($dir_path->cd($this->request->getData('name'))){
						rename(WWW_ROOT . 'files'.DS.'media'.DS.$check_user->department->name.DS.$project->name.DS.$task->name, WWW_ROOT . 'files'.DS.'media'.DS.$check_user->department->name.DS.$project->name.DS.$this->request->getData('name'));
					}else{
						$dir = new Folder(WWW_ROOT . 'files'.DS.'media'.DS.$check_user->department->name.DS.$project->name.DS.$this->request->getData('name'), true, 0755);
					}
					
				}else{
					//$parent_m = $mediaTable->find('all')->where(['Media.source_id' => $project->id])->first();
					//$media->parent_id = $parent_m->id;
					$media->source_id = $result->id;
					$media->folder_name = $this->request->getData('name');
					$media->department_id = $check_user->department_id;
					$media->uploaded_by = $user['id'];
					
					if($mediaTable->save($media)){
						$dir = new Folder(WWW_ROOT . 'files'.DS.'media'.DS.$check_user->department->name.DS.$this->request->getData('name'), true, 0755);
					}
				}
				
				return $this->redirect(['controller'=>'projects', 'action' => 'view', $task->project_id]);
            }else{
            	$this->Flash->error(__('The task could not be saved. Please, try again.'));
            }
        }
		
        //$users = $this->Tasks->Users->find('list', ['limit' => 200]);
        $departments = $this->Tasks->Departments->find('list', []);
        //$projects = $this->Tasks->Projects->find('list', []);
		
		$users_collect = $project_members->find('all', [
		    'conditions' => ['ProjectsMembers.project_id' => $project->id]
		]);
		
		foreach($users_collect as $collect):
			$user_ids[] = $collect->user_id;
		endforeach;
		
		//$user_ids = implode(',', array_values($user_ids));
		if($user_ids){
			$users = $this->Tasks->Users->find('list')->where(['Users.id IN' => $user_ids]);
		}
		
		$default_ids = explode(',', $task->user_id);
		
		$default_ids = array_values($default_ids);
						
        $this->set(compact('task', 'users', 'departments', 'project', 'default_ids'));
        $this->set('_serialize', ['task']);
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
		$userA = $this->Auth->user();
		$comments = TableRegistry::get('Comments');
        $this->request->allowMethod(['post', 'delete']);
        $task = $this->Tasks->get($id);
        if ($this->Tasks->delete($task)) {
			$comments->deleteAll([
			    'comment_src' => 2,
				'source_id' => $task->id
			]);
            $this->Flash->success(__($task->name.' has been deleted.'));
        } else {
            $this->Flash->error(__($task->name.' could not be deleted. Please, try again.'));
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
	
    public function setStatus($id = null, $user_id = null, $status = null)
    {
		$userA = $this->Auth->user();
        $this->request->allowMethod(['post']);
        $task = $this->Tasks->get($id);
		$task_e = $this->Tasks->newEntity();
		$task_e->id = $id;
		$task_e->status = $status;
		$task_e->attended_by = $user_id;
				
        if ($this->Tasks->save($task_e)) {
			if($status == 2){
				$this->Flash->success(__($task->name.' has been marked as done.'));
			}
        } else {
            $this->Flash->error(__($task->name.' could not be marked as done. Please, try again.'));
        }

        return $this->redirect(['controller' => 'projects','action' => 'view', $task->project_id]);
    }
}
