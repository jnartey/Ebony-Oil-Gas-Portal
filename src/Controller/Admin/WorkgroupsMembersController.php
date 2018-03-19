<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Mailer\Email;

/**
 * WorkgroupsMembers Controller
 *
 * @property \App\Model\Table\WorkgroupsMembersTable $WorkgroupsMembers
 */
class WorkgroupsMembersController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Workgroups', 'Users']
        ];
        $workgroupsMembers = $this->paginate($this->WorkgroupsMembers);

        $this->set(compact('workgroupsMembers'));
        $this->set('_serialize', ['workgroupsMembers']);
    }

    /**
     * View method
     *
     * @param string|null $id Workgroups Member id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $workgroupsMember = $this->WorkgroupsMembers->get($id, [
            'contain' => ['Workgroups', 'Users']
        ]);

        $this->set('workgroupsMember', $workgroupsMember);
        $this->set('_serialize', ['workgroupsMember']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
		$userA = $this->Auth->user();
        $workgroupsMember = $this->WorkgroupsMembers->newEntity();
        if ($this->request->is('post')) {
            $workgroupsMember = $this->WorkgroupsMembers->patchEntity($workgroupsMember, $this->request->getData());
            if ($this->WorkgroupsMembers->save($workgroupsMember)) {
                $this->Flash->success(__('The workgroups member has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The workgroups member could not be saved. Please, try again.'));
        }
        $workgroups = $this->WorkgroupsMembers->Workgroups->find('list', ['limit' => 200]);
        $users = $this->WorkgroupsMembers->Users->find('list', ['limit' => 200]);
        $this->set(compact('workgroupsMember', 'workgroups', 'users'));
        $this->set('_serialize', ['workgroupsMember']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Workgroups Member id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
		$userA = $this->Auth->user();
        $workgroupsMember = $this->WorkgroupsMembers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $workgroupsMember = $this->WorkgroupsMembers->patchEntity($workgroupsMember, $this->request->getData());
            if ($this->WorkgroupsMembers->save($workgroupsMember)) {
                $this->Flash->success(__('The workgroups member has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The workgroups member could not be saved. Please, try again.'));
        }
        $workgroups = $this->WorkgroupsMembers->Workgroups->find('list', ['limit' => 200]);
        $users = $this->WorkgroupsMembers->Users->find('list', ['limit' => 200]);
        $this->set(compact('workgroupsMember', 'workgroups', 'users'));
        $this->set('_serialize', ['workgroupsMember']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Workgroups Member id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
		$userA = $this->Auth->user();
        $this->request->allowMethod(['post', 'delete']);
        $workgroupsMember = $this->WorkgroupsMembers->get($id, ['contain' => ['Users']]);
        if ($this->WorkgroupsMembers->delete($workgroupsMember)) {
            $this->Flash->success(__($workgroupsMember->user->name.' has been deleted.'));
        } else {
            $this->Flash->error(__($workgroupsMember->user->name.' could not be deleted. Please, try again.'));
        }

        return $this->redirect(['controller'=>'workgroups', 'action' => 'view', $workgroupsMember->workgroup_id]);
    }
}
