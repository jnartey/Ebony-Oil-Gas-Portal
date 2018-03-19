<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
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
        // $this->paginate = [
//             'contain' => ['Users', 'Departments']
//         ];
//         $tasks = $this->paginate($this->Tasks);
		
		$tasks = $this->Tasks->find('all', [
		    'conditions' => [],
			'contain' => ['Projects', 'Users']
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
    public function view($id = null)
    {
        $task = $this->Tasks->get($id, [
            'contain' => ['Users', 'Departments']
        ]);

        $this->set('task', $task);
        $this->set('_serialize', ['task']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($project_id = null)
    {
		$userA = $this->Auth->user();
        $task = $this->Tasks->newEntity();
        if ($this->request->is('post')) {
            $task = $this->Tasks->patchEntity($task, $this->request->getData());
            if ($this->Tasks->save($task)) {
                $this->Flash->success(__('The task has been saved.'));
				
				if($project_id){
					return $this->redirect(['controller'=>'projects', 'action' => 'view', $project_id]);
				}else{
					return $this->redirect(['action' => 'index']);
				}
            }
            $this->Flash->error(__('The task could not be saved. Please, try again.'));
        }
        $users = $this->Tasks->Users->find('list', []);
        $departments = $this->Tasks->Departments->find('list', []);
        $this->set(compact('task', 'users', 'departments'));
        $this->set('_serialize', ['task']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Task id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null, $project_id = null)
    {
		$userA = $this->Auth->user();
        $task = $this->Tasks->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $task = $this->Tasks->patchEntity($task, $this->request->getData());
            if ($this->Tasks->save($task)) {
                $this->Flash->success(__('The task has been saved.'));

				if($project_id){
					return $this->redirect(['controller'=>'projects', 'action' => 'view', $project_id]);
				}else{
					return $this->redirect(['action' => 'index']);
				}
            }
            $this->Flash->error(__('The task could not be saved. Please, try again.'));
        }
        $users = $this->Tasks->Users->find('list', ['limit' => 200]);
        $departments = $this->Tasks->Departments->find('list', ['limit' => 200]);
        $this->set(compact('task', 'users', 'departments'));
        $this->set('_serialize', ['task']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Task id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null, $project_id = null)
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

		if($project_id){
			return $this->redirect(['controller'=>'projects', 'action' => 'view', $project_id]);
		}else{
			return $this->redirect(['action' => 'index']);
		}
    }
}
