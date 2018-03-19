<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Mailer\Email;

/**
 * Workgroups Controller
 *
 * @property \App\Model\Table\WorkgroupsTable $Workgroups
 */
class WorkgroupsController extends AppController
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
			
        $workgroups = $this->paginate($this->Workgroups);
				
        $this->set(compact('workgroups'));
        $this->set('_serialize', ['workgroups']);
    }

    /**
     * View method
     *
     * @param string|null $id Workgroup id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $workgroup = $this->Workgroups->get($id, [
            'contain' => ['WorkgroupsMembers']
        ]);

        $this->set('workgroup', $workgroup);
        $this->set('_serialize', ['workgroup']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
		$userA = $this->Auth->user();
        $workgroup = $this->Workgroups->newEntity();
        if ($this->request->is('post')) {
            $workgroup = $this->Workgroups->patchEntity($workgroup, $this->request->getData());
            if ($this->Workgroups->save($workgroup)) {
                $this->Flash->success(__('The workgroup has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The workgroup could not be saved. Please, try again.'));
        }
        $this->set(compact('workgroup'));
        $this->set('_serialize', ['workgroup']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Workgroup id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
		$userA = $this->Auth->user();
        $workgroup = $this->Workgroups->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $workgroup = $this->Workgroups->patchEntity($workgroup, $this->request->getData());
            if ($this->Workgroups->save($workgroup)) {
                $this->Flash->success(__('The workgroup has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The workgroup could not be saved. Please, try again.'));
        }
        $this->set(compact('workgroup'));
        $this->set('_serialize', ['workgroup']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Workgroup id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
		$userA = $this->Auth->user();
		$workgroup_members = TableRegistry::get('WorkgroupsMembers');
        $this->request->allowMethod(['post', 'delete']);
        $workgroup = $this->Workgroups->get($id);
        if ($this->Workgroups->delete($workgroup)) {
			$workgroup_members->deleteAll([
				'workgroup_id' => $workgroup->id
			]);
				
            $this->Flash->success(__($workgroup->name.' has been deleted.'));
        } else {
            $this->Flash->error(__($workgroup->name.' could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
	
    public function approve($id = null, $status = null)
    {
        $this->request->allowMethod(['post']);
        $workgroup = $this->Workgroups->get($id);
		$workgroup_r = $this->Workgroups->newEntity();
		$workgroup_r->id = $id;
		$workgroup_r->is_approved = $status;
				
        if ($this->Workgroups->save($workgroup_r)) {
			if($status == 2){
				$this->Flash->success(__($workgroup->name.' has been approved.'));
			}
			
			if($status == 1){
				$this->Flash->success(__($workgroup->name.' has been disabled.'));
			}
        } else {
            $this->Flash->error(__($workgroup->name.' request could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
