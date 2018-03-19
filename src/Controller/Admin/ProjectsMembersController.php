<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Mailer\Email;

/**
 * ProjectsMembers Controller
 *
 * @property \App\Model\Table\ProjectsMembersTable $ProjectsMembers
 */
class ProjectsMembersController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Projects', 'Users']
        ];
        $projectsMembers = $this->paginate($this->ProjectsMembers);

        $this->set(compact('projectsMembers'));
        $this->set('_serialize', ['projectsMembers']);
    }

    /**
     * View method
     *
     * @param string|null $id Projects Member id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $projectsMember = $this->ProjectsMembers->get($id, [
            'contain' => ['Projects', 'Users']
        ]);

        $this->set('projectsMember', $projectsMember);
        $this->set('_serialize', ['projectsMember']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
		$userA = $this->Auth->user();
        $projectsMember = $this->ProjectsMembers->newEntity();
        if ($this->request->is('post')) {
            $projectsMember = $this->ProjectsMembers->patchEntity($projectsMember, $this->request->getData());
            if ($this->ProjectsMembers->save($projectsMember)) {
                $this->Flash->success(__('The projects member has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The projects member could not be saved. Please, try again.'));
        }
        $projects = $this->ProjectsMembers->Projects->find('list', ['limit' => 200]);
        $users = $this->ProjectsMembers->Users->find('list', ['limit' => 200]);
        $this->set(compact('projectsMember', 'projects', 'users'));
        $this->set('_serialize', ['projectsMember']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Projects Member id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
		$userA = $this->Auth->user();
        $projectsMember = $this->ProjectsMembers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $projectsMember = $this->ProjectsMembers->patchEntity($projectsMember, $this->request->getData());
            if ($this->ProjectsMembers->save($projectsMember)) {
                $this->Flash->success(__('The projects member has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The projects member could not be saved. Please, try again.'));
        }
        $projects = $this->ProjectsMembers->Projects->find('list', ['limit' => 200]);
        $users = $this->ProjectsMembers->Users->find('list', ['limit' => 200]);
        $this->set(compact('projectsMember', 'projects', 'users'));
        $this->set('_serialize', ['projectsMember']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Projects Member id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
		$userA = $this->Auth->user();
        $this->request->allowMethod(['post', 'delete']);
        $projectsMember = $this->ProjectsMembers->get($id, ['contain' => ['Users']]);
        if ($this->ProjectsMembers->delete($projectsMember)) {
            $this->Flash->success(__($projectsMember->user->name.' has been deleted.'));
        } else {
            $this->Flash->error(__($projectsMember->user->name.' could not be deleted. Please, try again.'));
        }

        return $this->redirect(['controller'=>'Projects', 'action' => 'view', $projectsMember->project_id]);
    }
}
