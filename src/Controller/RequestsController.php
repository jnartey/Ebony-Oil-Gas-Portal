<?php
namespace App\Controller;
use App\Controller\AppController;

use Cake\ORM\TableRegistry;
/**
 * Requests Controller
 *
 * @property \App\Model\Table\RequestsTable $Requests
 *
 * @method \App\Model\Entity\LeaveRequest[] paginate($object = null, array $settings = [])
 */
class RequestsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
	
	/*
		Status: 1 Pending, 2 Approved, 3 Declined, 4 Cancelled
	*/
	
    public function index()
    {
		$user = $this->Auth->user();
		$department_members = TableRegistry::get('DepartmentsMembers');
		$department = TableRegistry::get('Departments');
		$department_details = null;
		$department_member = null;
		
		$user_table = TableRegistry::get('Users');		
		$get_user = $user_table->find('all')->where(['Users.id' => $user['id']])->first();
		
		$department_member = $department_members->find('all')->where(['DepartmentsMembers.user_id'=>$get_user->id])->first();
		
		if(!empty($department_member)){
			$department_details = $department->find('all')->where(['Departments.id'=>$department_member->department_id])->first();
		}
		
		
		$leaveRequests = null;
		
		if($user['role_id'] == 1 || $department_details->department_role == 2){
	        $leaveRequests = $this->Requests->find('all', [
				'conditions' => ['Requests.department_id' => $get_user->department_access],
	            'contain' => ['Departments', 'Users'],
				'order' => ['Requests.created'=>'DESC', 'Requests.status'=>'ASC']
			]);
		}elseif($user['role_id'] == 1 || $department_details->department_role == 3){
	        $leaveRequests = $this->Requests->find('all', [
				'conditions' => [],
	            'contain' => ['Departments', 'Users'],
				'order' => ['Requests.created'=>'DESC', 'Requests.status'=>'ASC']
			]);
		}else{
	        $leaveRequests = $this->Requests->find('all', [
				'conditions' => ['Requests.user_id' => $user['id']],
	            'contain' => ['Departments', 'Users'],
				'order' => ['Requests.created'=>'DESC', 'Requests.status'=>'DESC']
			]);
		}
		
		$check_request = $this->Requests->find('all', [
			'conditions' => ['Requests.user_id' => $get_user->id, 'Requests.status' => 1],
		]);
		
		$check_request = $check_request->toArray();

        $this->set(compact('leaveRequests', 'check_request', 'department_member', 'department_details'));
        $this->set('_serialize', ['leaveRequests']);
    }

    /**
     * View method
     *
     * @param string|null $id Leave Request id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
		$user = $this->Auth->user();
		
        $leaveRequest = $this->Requests->get($id, [
            'contain' => ['Users', 'Departments']
        ]);
			
		$department_members = TableRegistry::get('DepartmentsMembers');
		$department_member = $department_members->find('all')->where(['DepartmentsMembers.user_id'=>$user['id']])->first();
			
		$users = TableRegistry::get('Users');
		$reviewer = $users->find('all')->where(['Users.id'=>$leaveRequest->reviewed_by])->first();
		
		$recommended = $users->find('all')->where(['Users.id'=>$leaveRequest->recommended_by])->first();
		$approve = $users->find('all')->where(['Users.id'=>$leaveRequest->approved_by])->first();
		$relief = $users->find('all')->where(['Users.id'=>$leaveRequest->relieved_by])->first();
		$administration = $users->find('all')->where(['Users.id'=>$leaveRequest->approved_by_management])->first();

        $this->set('leaveRequest', $leaveRequest);
		$this->set('reviewer', $reviewer);
		$this->set(compact('check_request', 'recommended', 'relief', 'approve', 'administration', 'department_member'));
        $this->set('_serialize', ['leaveRequest']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
		$user = $this->Auth->user();
		$department_members = TableRegistry::get('DepartmentsMembers');
		$users = TableRegistry::get('Users');
		
		$user = $this->Auth->user();
		$user_table = TableRegistry::get('Users');		
		$get_user = $user_table->find('all')->where(['Users.id' => $user['id']])->first();
		
		$user_det = $users->find('all')->where(['Users.id'=>$user['id']])->first();
		
        $leaveRequest = $this->Requests->newEntity();
        if ($this->request->is('post')) {
            $leaveRequest = $this->Requests->patchEntity($leaveRequest, $this->request->getData());
            if ($this->Requests->save($leaveRequest)) {
                $this->Flash->success(__('The leave request has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The leave request could not be saved. Please, try again.'));
        }
		
        $department_member = $department_members->find('all')->where(['DepartmentsMembers.user_id'=>$user['id']])->first();
		
		$user_details = $department_members->find('all', [
		    'conditions' => ['DepartmentsMembers.department_id' => $department_member->department_id, 'NOT'=>['DepartmentsMembers.user_id'=>$user['id'], 'DepartmentsMembers.user_id'=>$leaveRequest->user_id]],
		]);
					
		$user_ids = null;
		$relieve_staff = null;

		if($user_details){
			foreach($user_details as $collect):
				$user_ids[] = $collect->user_id;
			endforeach;

			$relieve_staff = $users->find('list')->where(['Users.id IN' => $user_ids]);
		}
		
		$check_request = $this->Requests->find('all', [
			'conditions' => ['Requests.user_id' => $user['id'], 'Requests.status' => 1],
		]);
		
		$check_request = $check_request->toArray();
		
        $this->set(compact('leaveRequest', 'users', 'department_member', 'check_request', 'user_det', 'get_user', 'relieve_staff'));
        $this->set('_serialize', ['leaveRequest']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Leave Request id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
		$user = $this->Auth->user();
		$department_members = TableRegistry::get('DepartmentsMembers');
		
        $leaveRequest = $this->Requests->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $leaveRequest = $this->Requests->patchEntity($leaveRequest, $this->request->getData());
            if ($this->Requests->save($leaveRequest)) {
                $this->Flash->success(__('The leave request has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The leave request could not be saved. Please, try again.'));
        }
		
        $department_member = $department_members->find('all')->where(['DepartmentsMembers.user_id'=>$user['id']])->first();
		
		$user_details = $department_members->find('all', [
		    'conditions' => ['DepartmentsMembers.department_id' => $department_member->department_id, 'NOT'=>['DepartmentsMembers.user_id'=>$user['id'], 'DepartmentsMembers.user_id'=>$leaveRequest->user_id]],
		]);
					
		$user_ids = null;
		$relieve_staff = null;

		if($user_details){
			foreach($user_details as $collect):
				$user_ids[] = $collect->user_id;
			endforeach;

			$relieve_staff = $users->find('list')->where(['Users.id IN' => $user_ids]);
		}
		
		$check_request = $this->Requests->find('all', [
			'conditions' => ['Requests.user_id' => $user['id'], 'OR' => ['Requests.status' => 2, 'Requests.status' => 3]],
		]);
		
		$check_request = $check_request->toArray();
		
        $this->set(compact('leaveRequest', 'users', 'department_member', 'check_request', 'relieve_staff'));
        $this->set('_serialize', ['leaveRequest']);
        
    }
	
    public function review($id = null)
    {
		$user = $this->Auth->user();
		$department_members = TableRegistry::get('DepartmentsMembers');
		$users = TableRegistry::get('Users');
		
        $leaveRequest = $this->Requests->get($id, [
            'contain' => []
        ]);
		
        if ($this->request->is(['patch', 'post', 'put'])) {
            $leaveRequest = $this->Requests->patchEntity($leaveRequest, $this->request->getData());
            if ($this->Requests->save($leaveRequest)) {
                $this->Flash->success(__('The leave request has been approved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The leave request could not be saved. Please, try again.'));
        }
		
        $department_member = $department_members->find('all')->where(['DepartmentsMembers.user_id'=>$user['id']])->first();
		$recommended = $users->find('all')->where(['Users.id'=>$leaveRequest->recommended_by])->first();
		
		$user_details = $department_members->find('all', [
		    'conditions' => ['DepartmentsMembers.department_id' => $department_member->department_id, 'NOT'=>['DepartmentsMembers.user_id'=>$user['id'], 'DepartmentsMembers.user_id'=>$leaveRequest->user_id]],
		]);
					
		$user_ids = null;
		$staff = null;

		if($user_details){
			foreach($user_details as $collect):
				$user_ids[] = $collect->user_id;
			endforeach;

			$relieve_staff = $users->find('list')->where(['Users.id IN' => $user_ids]);
		}
		
		
		
		$check_request = $this->Requests->find('all', [
			'conditions' => ['Requests.user_id' => $user['id'], 'OR' => ['Requests.status' => 2, 'Requests.status' => 3]],
		]);
		
		$check_request = $check_request->toArray();
		
        $this->set(compact('leaveRequest', 'users', 'department_member', 'check_request', 'recommended', 'relieve_staff'));
        $this->set('_serialize', ['leaveRequest']);
        
    }
	
    public function recommend($id = null)
    {
		$user = $this->Auth->user();
		$department_members = TableRegistry::get('DepartmentsMembers');
		
        $leaveRequest = $this->Requests->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $leaveRequest = $this->Requests->patchEntity($leaveRequest, $this->request->getData());
            if ($this->Requests->save($leaveRequest)) {
                $this->Flash->success(__('The leave request has been recommended.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The leave request could not be saved. Please, try again.'));
        }
		
        $department_member = $department_members->find('all')->where(['DepartmentsMembers.user_id'=>$user['id']])->first();
		
		$check_request = $this->Requests->find('all', [
			'conditions' => ['Requests.user_id' => $user['id'], 'OR' => ['Requests.status' => 2, 'Requests.status' => 3]],
		]);
		
		$check_request = $check_request->toArray();
		
        $this->set(compact('leaveRequest', 'users', 'department_member', 'check_request'));
        $this->set('_serialize', ['leaveRequest']);
        
    }
	
    public function approve($id = null)
    {
		$user = $this->Auth->user();
		$department_members = TableRegistry::get('DepartmentsMembers');
		$users = TableRegistry::get('Users');
		
        $leaveRequest = $this->Requests->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $leaveRequest = $this->Requests->patchEntity($leaveRequest, $this->request->getData());
            if ($this->Requests->save($leaveRequest)) {
                $this->Flash->success(__('The leave request has been approved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The leave request could not be saved. Please, try again.'));
        }
		
        $department_member = $department_members->find('all')->where(['DepartmentsMembers.user_id'=>$user['id']])->first();
		$recommended = $users->find('all')->where(['Users.id'=>$leaveRequest->recommended_by])->first();
		$approve = $users->find('all')->where(['Users.id'=>$leaveRequest->approved_by])->first();
		$relief = $users->find('all')->where(['Users.id'=>$leaveRequest->relieved_by])->first();
		
		$check_request = $this->Requests->find('all', [
			'conditions' => ['Requests.user_id' => $user['id'], 'OR' => ['Requests.status' => 2, 'Requests.status' => 3]],
		]);
		
		$check_request = $check_request->toArray();
		
        $this->set(compact('leaveRequest', 'users', 'department_member', 'check_request', 'recommended', 'approve', 'relief'));
        $this->set('_serialize', ['leaveRequest']);
        
    }

    /**
     * Delete method
     *
     * @param string|null $id Leave Request id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
		$userA = $this->Auth->user();
        $this->request->allowMethod(['post', 'delete']);
        $leaveRequest = $this->Requests->get($id);
        if ($this->Requests->delete($leaveRequest)) {
            $this->Flash->success(__($leaveRequest->request_type.' request has been deleted.'));
        } else {
            $this->Flash->error(__($leaveRequest->request_type.' request could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
	
    public function setStatus($id = null, $status = null)
    {
		$userA = $this->Auth->user();
        $this->request->allowMethod(['post']);
        $leaveRequest = $this->Requests->get($id);
		$lrequest = $this->Requests->newEntity();
		$lrequest->id = $id;
		$lrequest->status = $status;
				
        if ($this->Requests->save($lrequest)) {
			if($status == 4){
				$this->Flash->success(__($leaveRequest->request_type.' request has been cancelled.'));
			}
			
			if($status == 1){
				$this->Flash->success(__($leaveRequest->request_type.' request has been re-activated.'));
			}
        } else {
            $this->Flash->error(__($leaveRequest->request_type.' request could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
