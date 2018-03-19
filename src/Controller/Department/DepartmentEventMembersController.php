<?php
namespace App\Controller\Department;
use App\Controller\Department\AppController;
use Cake\Mailer\Email;
use Cake\Routing\Router;
/**
 * DepartmentEventMembers Controller
 *
 * @property \App\Model\Table\DepartmentEventMembersTable $DepartmentEventMembers
 *
 * @method \App\Model\Entity\DepartmentEventMember[] paginate($object = null, array $settings = [])
 */
class DepartmentEventMembersController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Events', 'Users', 'Departments']
        ];
        $departmentEventMembers = $this->paginate($this->DepartmentEventMembers);

        $this->set(compact('departmentEventMembers'));
        $this->set('_serialize', ['departmentEventMembers']);
    }

    /**
     * View method
     *
     * @param string|null $id Department Event Member id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $departmentEventMember = $this->DepartmentEventMembers->get($id, [
            'contain' => ['Events', 'Users', 'Departments']
        ]);

        $this->set('departmentEventMember', $departmentEventMember);
        $this->set('_serialize', ['departmentEventMember']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
		$userA = $this->Auth->user();
        $departmentEventMember = $this->DepartmentEventMembers->newEntity();
        if ($this->request->is('post')) {
			$staff = TableRegistry::get('Users');
			$eMember = $staff->get($this->request->getData('user_id'));
			
            $departmentEventMember = $this->DepartmentEventMembers->patchEntity($departmentEventMember, $this->request->getData());
            if ($this->DepartmentEventMembers->save($departmentEventMember)) {
                $this->Flash->success(__('The department event member has been saved.'));
				$this->Log->write('info', 'Event', $userA['first_name'].' '.$userA['last_name'].' added '.$eMember->name, [], ['request' => true], $this->request->getData('user_id'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The department event member could not be saved. Please, try again.'));
        }
        $events = $this->DepartmentEventMembers->Events->find('list', ['limit' => 200]);
        $users = $this->DepartmentEventMembers->Users->find('list', ['limit' => 200]);
        $departments = $this->DepartmentEventMembers->Departments->find('list', ['limit' => 200]);
        $this->set(compact('departmentEventMember', 'events', 'users', 'departments'));
        $this->set('_serialize', ['departmentEventMember']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Department Event Member id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
		$userA = $this->Auth->user();
        $departmentEventMember = $this->DepartmentEventMembers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
			$staff = TableRegistry::get('Users');
			$eMember = $staff->get($this->request->getData('user_id'));
			
            $departmentEventMember = $this->DepartmentEventMembers->patchEntity($departmentEventMember, $this->request->getData());
            if ($this->DepartmentEventMembers->save($departmentEventMember)) {
				$this->Log->write('info', 'Event', $userA['first_name'].' '.$userA['last_name'].' edited '.$eMember->name, [], ['request' => true], $this->request->getData('user_id'));
                $this->Flash->success(__('The department event member has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The department event member could not be saved. Please, try again.'));
        }
        $events = $this->DepartmentEventMembers->Events->find('list', ['limit' => 200]);
        $users = $this->DepartmentEventMembers->Users->find('list', ['limit' => 200]);
        $departments = $this->DepartmentEventMembers->Departments->find('list', ['limit' => 200]);
        $this->set(compact('departmentEventMember', 'events', 'users', 'departments'));
        $this->set('_serialize', ['departmentEventMember']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Department Event Member id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
		$userA = $this->Auth->user();
        $this->request->allowMethod(['post', 'delete']);
        $departmentEventMember = $this->DepartmentEventMembers->get($id, ['contain'=>['Users', 'DepartmentEvents']]);
        if ($this->DepartmentEventMembers->delete($departmentEventMember)) {
			$this->Log->write('info', 'Event', $userA['first_name'].' '.$userA['last_name'].' deleted '.$departmentEventMember->user->name, [], ['request' => true], $this->request->getData('user_id'));
            $this->Flash->success(__('The department event member has been deleted.'));
        } else {
            $this->Flash->error(__('The department event member could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
