<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
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
		        'contain' => ['Users']
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
		$task = TableRegistry::get('Tasks');
		$comments = TableRegistry::get('Comments');
		
        $project = $this->Projects->get($id, [
            'contain' => ['ProjectsMembers', 'Tasks']
        ]);
			
		$project_members = $projects_members->find('all', [
		    'conditions' => ['ProjectsMembers.project_id' => $id],
			'contain' => ['Users']
		]);
		
		$tasks = $task->find('all', [
		    'conditions' => ['Tasks.project_id' => $id],
			'contain' => ['Projects']
		]);
		
		$comment_cat = array(1, 2);
			
		$comments = $comments->find('all', [
			'conditions'=>['Comments.comment_src IN'=>$comment_cat, 'Comments.project_id'=>$project->id],
            'contain' => ['Users']
		]);

        $this->set('project', $project);
		$this->set('project_members', $project_members);
		$this->set('tasks', $tasks);
		$this->set('comments', $comments);
        $this->set('_serialize', ['project']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
		$userA = $this->Auth->user();
        $project = $this->Projects->newEntity();
        if ($this->request->is('post')) {
            $project = $this->Projects->patchEntity($project, $this->request->getData());
            if ($this->Projects->save($project)) {
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
		$userA = $this->Auth->user();
        $project = $this->Projects->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $project = $this->Projects->patchEntity($project, $this->request->getData());
            if ($this->Projects->save($project)) {
                $this->Flash->success(__('The project has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The project could not be saved. Please, try again.'));
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
}
