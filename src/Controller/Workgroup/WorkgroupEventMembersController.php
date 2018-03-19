<?php
namespace App\Controller\Workgroup;
use App\Controller\Workgroup\AppController;
use Cake\Mailer\Email;
use Cake\Routing\Router;
/**
 * WorkgroupEventMembers Controller
 *
 * @property \App\Model\Table\WorkgroupEventMembersTable $WorkgroupEventMembers
 *
 * @method \App\Model\Entity\WorkgroupEventMember[] paginate($object = null, array $settings = [])
 */
class WorkgroupEventMembersController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Events', 'Users', 'Workgroups']
        ];
        $workgroupEventMembers = $this->paginate($this->WorkgroupEventMembers);

        $this->set(compact('workgroupEventMembers'));
        $this->set('_serialize', ['workgroupEventMembers']);
    }

    /**
     * View method
     *
     * @param string|null $id Workgroup Event Member id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $workgroupEventMember = $this->WorkgroupEventMembers->get($id, [
            'contain' => ['Events', 'Users', 'Workgroups']
        ]);

        $this->set('workgroupEventMember', $workgroupEventMember);
        $this->set('_serialize', ['workgroupEventMember']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
		$userA = $this->Auth->user();
        $workgroupEventMember = $this->WorkgroupEventMembers->newEntity();
        if ($this->request->is('post')) {
            $workgroupEventMember = $this->WorkgroupEventMembers->patchEntity($workgroupEventMember, $this->request->getData());
            if ($this->WorkgroupEventMembers->save($workgroupEventMember)) {
				$staff = TableRegistry::get('Users');
				$eMember = $staff->get($this->request->getData('user_id'));
				
                $this->Flash->success(__('The workgroup event member has been saved.'));
				$this->Log->write('info', 'Event', $userA['first_name'].' '.$userA['last_name'].' added '.$eMember->name, [], ['request' => true], $this->request->getData('user_id'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The workgroup event member could not be saved. Please, try again.'));
        }
        $events = $this->WorkgroupEventMembers->Events->find('list', ['limit' => 200]);
        $users = $this->WorkgroupEventMembers->Users->find('list', ['limit' => 200]);
        $workgroups = $this->WorkgroupEventMembers->Workgroups->find('list', ['limit' => 200]);
        $this->set(compact('workgroupEventMember', 'events', 'users', 'workgroups'));
        $this->set('_serialize', ['workgroupEventMember']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Workgroup Event Member id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
		$userA = $this->Auth->user();
        $workgroupEventMember = $this->WorkgroupEventMembers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
			$staff = TableRegistry::get('Users');
			$eMember = $staff->get($this->request->getData('user_id'));
			
            $workgroupEventMember = $this->WorkgroupEventMembers->patchEntity($workgroupEventMember, $this->request->getData());
            if ($this->WorkgroupEventMembers->save($workgroupEventMember)) {
				
				$this->Log->write('info', 'Event', $userA['first_name'].' '.$userA['last_name'].' edited '.$eMember->name, [], ['request' => true], $this->request->getData('user_id'));
				
                $this->Flash->success(__('The workgroup event member has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The workgroup event member could not be saved. Please, try again.'));
        }
        $events = $this->WorkgroupEventMembers->Events->find('list', ['limit' => 200]);
        $users = $this->WorkgroupEventMembers->Users->find('list', ['limit' => 200]);
        $workgroups = $this->WorkgroupEventMembers->Workgroups->find('list', ['limit' => 200]);
        $this->set(compact('workgroupEventMember', 'events', 'users', 'workgroups'));
        $this->set('_serialize', ['workgroupEventMember']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Workgroup Event Member id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
		$userA = $this->Auth->user();
        $this->request->allowMethod(['post', 'delete']);
        $workgroupEventMember = $this->WorkgroupEventMembers->get($id, ['contain'=>['Users']]);
        if ($this->WorkgroupEventMembers->delete($workgroupEventMember)) {
			$this->Log->write('info', 'Event', $userA['first_name'].' '.$userA['last_name'].' deleted '.$workgroupEventMember->user->name, [], ['request' => true], $this->request->getData('user_id'));
            $this->Flash->success(__('The workgroup event member has been deleted.'));
        } else {
            $this->Flash->error(__('The workgroup event member could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
