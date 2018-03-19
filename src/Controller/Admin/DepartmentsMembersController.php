<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Mailer\Email;

/**
 * DepartmentsMembers Controller
 *
 * @property \App\Model\Table\DepartmentsMembersTable $DepartmentsMembers
 *
 * @method \App\Model\Entity\DepartmentsMember[] paginate($object = null, array $settings = [])
 */
class DepartmentsMembersController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Departments', 'Users']
        ];
        $departmentsMembers = $this->paginate($this->DepartmentsMembers);

        $this->set(compact('departmentsMembers'));
        $this->set('_serialize', ['departmentsMembers']);
    }

    /**
     * View method
     *
     * @param string|null $id Departments Member id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $departmentsMember = $this->DepartmentsMembers->get($id, [
            'contain' => ['Departments', 'Users']
        ]);

        $this->set('departmentsMember', $departmentsMember);
        $this->set('_serialize', ['departmentsMember']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($department_id = null)
    {
		$userA = $this->Auth->user();
        $departmentsMember = $this->DepartmentsMembers->newEntity();
        if ($this->request->is('post')) {
            $departmentsMember = $this->DepartmentsMembers->patchEntity($departmentsMember, $this->request->getData());
            if ($this->DepartmentsMembers->save($departmentsMember)) {
				$this->Log->write('info', 'Department', $userA['first_name'].' '.$userA['last_name'].' added', [], ['request' => true], $this->request->getData('user_id'));
                $this->Flash->success(__('The department member has been saved.'));
				
				if($department_id){
					return $this->redirect(['controller'=>'departments', 'action' => 'view', $department_id]);
				}else{
					return $this->redirect(['action' => 'index']);
				}
            }
            $this->Flash->error(__('The department member could not be saved. Please, try again.'));
        }
        $departments = $this->DepartmentsMembers->Departments->find('list', []);
        $users = $this->DepartmentsMembers->Users->find('list', ['conditions'=>['NOT'=>['Users.id'=>1]]]);
        $this->set(compact('departmentsMember', 'departments', 'users', 'department_id'));
        $this->set('_serialize', ['departmentsMember']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Departments Member id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null, $department_id = null)
    {
		$userA = $this->Auth->user();
        $departmentsMember = $this->DepartmentsMembers->get($id, [
            'contain' => ['Departments', 'Users']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $departmentsMember = $this->DepartmentsMembers->patchEntity($departmentsMember, $this->request->getData());
            if ($this->DepartmentsMembers->save($departmentsMember)) {
                $this->Flash->success(__('The departments member has been saved.'));
				$this->Log->write('info', 'Department', $userA['first_name'].' '.$userA['last_name'].' edited', [], ['request' => true], $this->request->getData('user_id'));
				if($department_id){
					return $this->redirect(['controller'=>'departments', 'action' => 'view', $department_id]);
				}else{
					return $this->redirect(['action' => 'index']);
				}
            }
            $this->Flash->error(__('The departments member could not be saved. Please, try again.'));
        }
        $departments = $this->DepartmentsMembers->Departments->find('list', []);
        $users = $this->DepartmentsMembers->Users->find('list');
        $this->set(compact('departmentsMember', 'departments', 'users'));
        $this->set('_serialize', ['departmentsMember']);
    }
	
    public function setRole($id = null, $role = null, $department_id = null)
    {
		$userA = $this->Auth->user();
        $this->request->allowMethod(['post', 'delete']);
		$role_name = null;
        $departmentsMember = $this->DepartmentsMembers->get($id, ['contain' => ['Users']]);
		$departmentMember = $this->DepartmentsMembers->newEntity();
		$departmentMember->id = $departmentsMember->id;
		$departmentMember->department_role = $role;
		
		if($role == 1){
			$role_name = 'Department staff';
		}elseif($role == 2){
			$role_name = 'Supervisor';
		}elseif($role == 3){
			$role_name = 'Department head';
		}
		
        if ($this->DepartmentsMembers->save($departmentMember)) {
			$this->Log->write('info', 'Department', $userA['first_name'].' '.$userA['last_name'].' set '.$departmentsMember->user->name.'\'s role to '.$role_name, [], ['request' => true], $departmentsMember->user_id, $departmentsMember->department_id);
            $this->Flash->success(__($departmentsMember->user->name.'\'s role has been updated.'));
        } else {
            $this->Flash->error(__($departmentsMember->user->name.'\'s role could not be updated. Please, try again.'));
        }

		if($department_id){
			return $this->redirect(['controller'=>'departments', 'action' => 'view', $department_id]);
		}else{
			return $this->redirect(['action' => 'index']);
		}
    }

    /**
     * Delete method
     *
     * @param string|null $id Departments Member id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null, $department_id = null)
    {
		$userA = $this->Auth->user();
        $this->request->allowMethod(['post', 'delete']);
        $departmentsMember = $this->DepartmentsMembers->get($id, ['contain' => ['Users']]);
        if ($this->DepartmentsMembers->delete($departmentsMember)) {
            $this->Flash->success(__($departmentsMember->user->name.' has been deleted.'));
        } else {
            $this->Flash->error(__($departmentsMember->user->name.' could not be deleted. Please, try again.'));
        }
		
		$this->Log->write('info', 'Department', $userA['first_name'].' '.$userA['last_name'].' removed '.$departmentsMember->user->name, [], ['request' => true], $departmentsMember->user_id, $department_id);

		if($department_id){
			return $this->redirect(['controller'=>'departments', 'action' => 'view', $department_id]);
		}else{
			return $this->redirect(['action' => 'index']);
		}
    }
}
