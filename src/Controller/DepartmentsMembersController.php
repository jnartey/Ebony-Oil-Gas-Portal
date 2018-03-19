<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
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
    public function add($id = null)
    {
		$department = TableRegistry::get('Departments');
		$staff = TableRegistry::get('Users');
		
		$existing_ids = null;
		
		$user = $this->Auth->user();
		
        $departmentsMember = $this->DepartmentsMembers->newEntity();
		
		$department = $department->get($id);
		
        if ($this->request->is('post')) {
			foreach($this->request->getData(['user_id']) as $u_id):
				
				$departmentsMember->user_id = $u_id;
				$departmentsMember->department_id = $this->request->getData(['department_id']);
				
				$department_member->$staff->get($u_id);
				
				//$departmentsMember = $this->DepartmentsMembers->patchEntity($departmentsMember, $this->request->getData());
				//debug($this->DepartmentsMembers->save($departmentsMember));
				if(!$this->DepartmentsMembers->save($departmentsMember)){
					$this->Log->write('info', 'Department', $user['first_name'].' '.$user['last_name'].' added '.$department_member->name.' to '.$department->name, [], ['request' => true], $department_member->id);
					$this->Flash->error(__('The department member could not be saved. Please, try again.'));
					return false;
				}
			endforeach;
			
			$this->Flash->success(__('The department members has been saved.'));
			return $this->redirect(['controller'=>'departments', 'action' => 'index']);
		}
        
        $departments = $this->DepartmentsMembers->Departments->find('list', []);
		
		$users_collect = $this->DepartmentsMembers->find('all', [
		    'conditions' => ['DepartmentsMembers.department_id' => $department->id, 'NOT'=>['DepartmentsMembers.user_id'=>$user['id']]]
		]);
		
		foreach($users_collect as $collect):
			$user_ids[] = $collect->user_id;
		endforeach;
		
		$existing_staff = $this->DepartmentsMembers->find('all', [
		    'conditions' => []
		]);
		
		foreach($existing_staff as $collect):
			$existing_ids[] = $collect->user_id;
		endforeach;
		
		//$user_ids = implode(',', array_values($user_ids));
		
		if($existing_ids){
			$users = $staff->find('list')->where(['NOT'=>['OR'=>['Users.id IN' => $existing_ids, 'Users.id' => 1]]]);
		}else{
			$users = $staff->find('list')->where([]);
		}
		
        $this->set(compact('departmentsMember', 'departments', 'users', 'department'));
        $this->set('_serialize', ['departmentsMember']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Departments Member id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
		$user = $this->Auth->user();
        $departmentsMember = $this->DepartmentsMembers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $departmentsMember = $this->DepartmentsMembers->patchEntity($departmentsMember, $this->request->getData());
            if ($this->DepartmentsMembers->save($departmentsMember)) {
                $this->Flash->success(__('The departments member has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The departments member could not be saved. Please, try again.'));
        }
        $departments = $this->DepartmentsMembers->Departments->find('list', ['limit' => 200]);
        $users = $this->DepartmentsMembers->Users->find('list', ['limit' => 200]);
        $this->set(compact('departmentsMember', 'departments', 'users'));
        $this->set('_serialize', ['departmentsMember']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Departments Member id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
		$userA = $this->Auth->user();
        $this->request->allowMethod(['post', 'delete']);
        $departmentsMember = $this->DepartmentsMembers->get($id, ['contain' => ['Users']]);
        if ($this->DepartmentsMembers->delete($departmentsMember)) {
			$this->Log->write('info', 'Department', $user['first_name'].' '.$user['last_name'].' deleted '.$departmentsMember->user->name, [], ['request' => true], $departmentsMember->user->id);
            $this->Flash->success(__($departmentsMember->user->name.' has been deleted.'));
        } else {
            $this->Flash->error(__($departmentsMember->user->name.' could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
