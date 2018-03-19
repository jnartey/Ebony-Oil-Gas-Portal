<?php
namespace App\Controller\Department;
use App\Controller\Department\AppController;

use Cake\ORM\TableRegistry;
use Cake\Mailer\Email;
use Cake\Routing\Router;

/**
 * VehicleServicings Controller
 *
 * @property \App\Model\Table\VehicleServicingsTable $VehicleServicings
 *
 * @method \App\Model\Entity\VehicleServicing[] paginate($object = null, array $settings = [])
 */
class VehicleServicingsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    // public function index()
//     {
//         $this->paginate = [
//             'contain' => ['Users', 'Departments', 'Vehicles']
//         ];
//         $vehicleServicings = $this->paginate($this->VehicleServicings);
//
//         $this->set(compact('vehicleServicings'));
//         $this->set('_serialize', ['vehicleServicings']);
//     }

    /**
     * View method
     *
     * @param string|null $id Vehicle Servicing id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    // public function view($id = null)
 //    {
 //        $vehicleServicing = $this->VehicleServicings->get($id, [
 //            'contain' => ['Users', 'Departments', 'Vehicles']
 //        ]);
 //
 //        $this->set('vehicleServicing', $vehicleServicing);
 //        $this->set('_serialize', ['vehicleServicing']);
 //    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    // public function add()
//     {
//         $vehicleServicing = $this->VehicleServicings->newEntity();
//         if ($this->request->is('post')) {
//             $vehicleServicing = $this->VehicleServicings->patchEntity($vehicleServicing, $this->request->getData());
//             if ($this->VehicleServicings->save($vehicleServicing)) {
//                 $this->Flash->success(__('The vehicle servicing has been saved.'));
//
//                 return $this->redirect(['action' => 'index']);
//             }
//             $this->Flash->error(__('The vehicle servicing could not be saved. Please, try again.'));
//         }
//         $users = $this->VehicleServicings->Users->find('list', ['limit' => 200]);
//         $departments = $this->VehicleServicings->Departments->find('list', ['limit' => 200]);
//         $vehicles = $this->VehicleServicings->Vehicles->find('list', ['limit' => 200]);
//         $this->set(compact('vehicleServicing', 'users', 'departments', 'vehicles'));
//         $this->set('_serialize', ['vehicleServicing']);
//     }

    /**
     * Edit method
     *
     * @param string|null $id Vehicle Servicing id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    // public function edit($id = null)
//     {
//         $vehicleServicing = $this->VehicleServicings->get($id, [
//             'contain' => []
//         ]);
//         if ($this->request->is(['patch', 'post', 'put'])) {
//             $vehicleServicing = $this->VehicleServicings->patchEntity($vehicleServicing, $this->request->getData());
//             if ($this->VehicleServicings->save($vehicleServicing)) {
//                 $this->Flash->success(__('The vehicle servicing has been saved.'));
//
//                 return $this->redirect(['action' => 'index']);
//             }
//             $this->Flash->error(__('The vehicle servicing could not be saved. Please, try again.'));
//         }
//         $users = $this->VehicleServicings->Users->find('list', ['limit' => 200]);
//         $departments = $this->VehicleServicings->Departments->find('list', ['limit' => 200]);
//         $vehicles = $this->VehicleServicings->Vehicles->find('list', ['limit' => 200]);
//         $this->set(compact('vehicleServicing', 'users', 'departments', 'vehicles'));
//         $this->set('_serialize', ['vehicleServicing']);
//     }

    /**
     * Delete method
     *
     * @param string|null $id Vehicle Servicing id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    // public function delete($id = null)
//     {
//         $this->request->allowMethod(['post', 'delete']);
//         $vehicleServicing = $this->VehicleServicings->get($id);
//         if ($this->VehicleServicings->delete($vehicleServicing)) {
//             $this->Flash->success(__('The vehicle servicing has been deleted.'));
//         } else {
//             $this->Flash->error(__('The vehicle servicing could not be deleted. Please, try again.'));
//         }
//
//         return $this->redirect(['action' => 'index']);
//     }
		
	public function index()
	{
		$user = $this->Auth->user();
		$department_members = TableRegistry::get('DepartmentsMembers');
		$department = TableRegistry::get('Departments');
		$requestHandlers = TableRegistry::get('RequestHandlers');
		$department_details = null;
		$department_member = null;
		$department_details_ch = null;
	
		$user_table = TableRegistry::get('Users');		
		$get_user = $user_table->find('all')->where(['Users.id' => $user['id']])->first();
	
		$department_member = $department_members->find('all', [
		    'conditions' => ['DepartmentsMembers.user_id' => $user['id']],
		]);
	
		$check_request_admin = $requestHandlers->find('all')->where(['RequestHandlers.department_id' => $get_user->department_access, 'RequestHandlers.request_forms_id' => 4])->contain(['Departments'])->first();
		
		if(!empty($check_request_admin) && !empty($check_request_admin->user_id) && isset($check_request_admin->user_id)){
			$check_request_admin = $requestHandlers->find('all')->where(['RequestHandlers.user_id' => $get_user->id, 'RequestHandlers.request_forms_id' => 4])->contain(['Departments'])->first();
		}
	
		//$check_request_admin = $check_request_admin->toArray();
	
		//pr($check_request_admin);
	
		$check = $department_member->toArray();
				
		$department_ids = null;
	
		if($check){
			foreach($department_member as $collect):
				$user_ids[] = $collect->user_id;
			endforeach;
					
			if(is_array($user_ids)){
				$department_details = $department_members->find('all')->where(['DepartmentsMembers.user_id IN' => $user_ids])->contain(['Users', 'Departments']);
			}else{
				$department_details = $department_members->find('all')->where(['DepartmentsMembers.user_id' => $user_ids])->contain(['Users', 'Departments']);
			}
		}
	
		$current_department = $department_members->find('all')->where(['DepartmentsMembers.department_id' => $get_user->department_access])->contain(['Users', 'Departments'])->first();
	
		$VSRequests = null;
	
		if($user['role_id'] == 1 || $current_department->department_role == 2 || $current_department->department_role == 3){
			if($check_request_admin){
		        $VSRequests = $this->VehicleServicings->find('all', [
					'conditions' => ['VehicleServicings.request_type'=>4],
		            'contain' => ['Departments', 'Users', 'Vehicles'],
					'order' => ['VehicleServicings.created'=>'DESC', 'VehicleServicings.status'=>'ASC']
				]);
			}else{
		        $VSRequests = $this->VehicleServicings->find('all', [
					'conditions' => ['VehicleServicings.request_type'=>4, 'OR'=>['VehicleServicings.user_id' => $user['id'], 'VehicleServicings.department_id' => $get_user->department_access]],
		            'contain' => ['Departments', 'Users', 'Vehicles'],
					'order' => ['VehicleServicings.created'=>'DESC', 'VehicleServicings.status'=>'ASC']
				]);
			}
		}else{
	        $VSRequests = $this->VehicleServicings->find('all', [
				'conditions' => ['VehicleServicings.user_id' => $user['id'], 'VehicleServicings.request_type'=>4],
	            'contain' => ['Departments', 'Users', 'Vehicles'],
				'order' => ['VehicleServicings.created'=>'DESC', 'VehicleServicings.status'=>'DESC']
			]);
		}
		
		//pr($VSRequests->toArray());
	
		$check_request = $this->VehicleServicings->find('all', [
			'conditions' => ['VehicleServicings.user_id' => $get_user->id, 'VehicleServicings.status' => 1, 'VehicleServicings.request_type'=>4],
		]);
	
		$check_request = $check_request->toArray();
	
		if(!empty($department_details)){
			$department_details_ch = $department_details->toArray();
		}

	    $this->set(compact('VSRequests', 'check_request', 'department_member', 'department_details', 'department_details_ch', 'current_department', 'check_request_admin'));
	    $this->set('_serialize', ['VSRequests']);
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
	
	    $leaveRequest = $this->VehicleServicings->get($id, [
	        'contain' => ['Users', 'Departments', 'Vehicles']
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
		
		$vehiclesTable = TableRegistry::get('Vehicles');
		$vehicles = $vehiclesTable->find('list', ['keyField' => 'id', 'valueField' => 'model']);
	
		$user = $this->Auth->user();
		$get_user = $users->find('all')->where(['Users.id' => $user['id']])->first();
	
		$user_det = $users->find('all')->where(['Users.id'=>$user['id']])->first();
	
		$user_details = $department_members->find('all', [
		    'conditions' => ['DepartmentsMembers.department_id' => $get_user->department_access, 'NOT'=>['DepartmentsMembers.user_id'=>$user['id']]],
			'contain' => ['Users']
		]);
			
		$user_details_chk = $department_members->find('all', [
		    'conditions' => ['DepartmentsMembers.department_id' => $get_user->department_access, 'NOT'=>['DepartmentsMembers.user_id'=>$user['id']]],
			'contain' => ['Users']
		]);
		
		$user_details_chk = $user_details_chk->first();
	
	    $leaveRequest = $this->VehicleServicings->newEntity();
	    if ($this->request->is('post')) {
	        $leaveRequest = $this->VehicleServicings->patchEntity($leaveRequest, $this->request->getData());
			debug($leaveRequest);
			if ($result = $this->VehicleServicings->save($leaveRequest)) {
				$this->Flash->success(__('Vehicle Servicing request has been submitted.'));
				$this->Log->write('info', 'Vehicle Servicings', $user['first_name'].' '.$user['last_name'].' requested for vehicle servicing ', [], ['request' => true], $result->id, $get_user->department_access);
				return $this->redirect(['action' => 'index']);
			}else{
				$this->Flash->error(__('Vehicle Servicings request could not be submitted. Please, try again.'));
			}

        }
	
	    $department_member = $department_members->find('all')->where(['DepartmentsMembers.user_id'=>$user['id']])->first();
	
		$check_request = $this->VehicleServicings->find('all', [
			'conditions' => ['VehicleServicings.user_id' => $user['id'], 'VehicleServicings.status' => 1],
		]);
	
		$check_request = $check_request->toArray();
		
	    $this->set(compact('leaveRequest', 'users', 'department_member', 'check_request', 'user_det', 'get_user', 'vehicles'));
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
		$user_table = TableRegistry::get('Users');		
		$get_user = $user_table->find('all')->where(['Users.id' => $user['id']])->first();
		
		$vehiclesTable = TableRegistry::get('Vehicles');
		$vehicles = $vehiclesTable->find('list', ['keyField' => 'id', 'valueField' => 'model']);
	
	    $leaveRequest = $this->VehicleServicings->get($id, [
	        'contain' => []
	    ]);
		
	    if ($this->request->is(['patch', 'post', 'put'])) {
	        $leaveRequest = $this->VehicleServicings->patchEntity($leaveRequest, $this->request->getData());
			if ($result = $this->VehicleServicings->save($leaveRequest)) {
				$this->Flash->success(__('Vehicle Servicing request has been updated.'));
				$this->Log->write('info', 'Vehicle Servicings', $user['first_name'].' '.$user['last_name'].' vehicle servicing updated ', [], ['request' => true], $result->id, $get_user->department_access);
				return $this->redirect(['action' => 'index']);
			}else{
				$this->Flash->error(__('Vehicle Servicings request could not be updated. Please, try again.'));
			}
	    }
	
	    $department_member = $department_members->find('all')->where(['DepartmentsMembers.user_id'=>$user['id']])->first();
	
		$user_details = $department_members->find('all', [
		    'conditions' => ['DepartmentsMembers.department_id' => $get_user->department_access, 'NOT'=>['DepartmentsMembers.user_id'=>$user['id']]],
		]);
	
		$check_request = $this->VehicleServicings->find('all', [
			'conditions' => ['VehicleServicings.user_id' => $user['id'], 'OR' => ['VehicleServicings.status' => 2, 'VehicleServicings.status' => 3]],
		]);
	
		$check_request = $check_request->toArray();
	
	    $this->set(compact('leaveRequest', 'users', 'department_member', 'check_request', 'vehicles'));
	    $this->set('_serialize', ['leaveRequest']);
    
	}

	public function approve($id = null)
	{
		$user = $this->Auth->user();
		$department_members = TableRegistry::get('DepartmentsMembers');
		$requestHandlers = TableRegistry::get('RequestHandlers');
		$users = TableRegistry::get('Users');
	
	    $leaveRequest = $this->VehicleServicings->get($id, [
	        'contain' => ['Users', 'Departments', 'Vehicles']
	    ]);
		
		$get_user = $users->find('all')->where(['Users.id' => $user['id']])->first();
	
		$check_request_admin = $requestHandlers->find('all')->where(['RequestHandlers.department_id' => $get_user->department_access, 'RequestHandlers.request_forms_id' => 1])->contain(['Departments'])->first();
	
	    if ($this->request->is(['patch', 'post', 'put'])) {
	        $leaveRequest = $this->VehicleServicings->patchEntity($leaveRequest, $this->request->getData());
	        if ($this->VehicleServicings->save($leaveRequest)) {
	            $this->Flash->success(__('The leave request has been approved.'));
				$this->Log->write('info', 'Leave Request', $user['first_name'].' '.$user['last_name'].' approved '.$leaveRequest->type.' for '.$leaveRequest->user->name, [], ['request' => true], $leaveRequest->id, $get_user->department_access);
			
				if($this->request->getData('status') == 4){
					$email = new Email('default');
					$link =  Router::url(['controller' => 'VehicleServicings', 'action' => 'view', $leaveRequest->id, 'department'=>$leaveRequest->department_id], true);
				
					try{
					  	$email->from(['info@eogportal.com' => 'Ebony Oil & Gas Portal::VehicleServicings'])
						    ->to($leaveRequest->user->email)
						    ->subject($leaveRequest->leave_type.' leave request')
							->emailFormat('html')
							->send($user['first_name'].' '.$user['last_name'].' has approved your '.$leaveRequest->leave_type.' leave request<br />'
								.'<a href="'.$link.'">Click here to view</a>'); 
					} catch (Exception $e) {
			            echo 'Exception : ',  $e->getMessage(), "\n";
			        }
				
				}elseif($this->request->getData('status') == 5){
					$email = new Email('default');
					$link =  Router::url(['controller' => 'VehicleServicings', 'action' => 'view', $leaveRequest->id, 'department'=>$leaveRequest->department_id], true);
				
					try{
					  	$email->from(['info@eogportal.com' => 'Ebony Oil & Gas Portal::VehicleServicings'])
						    ->to($leaveRequest->user->email)
						    ->subject($leaveRequest->leave_type.' leave request')
							->emailFormat('html')
							->send($user['first_name'].' '.$user['last_name'].' has declined your '.$leaveRequest->leave_type.' leave request<br />'
								.'<a href="'.$link.'">Click here to view</a>'); 
					} catch (Exception $e) {
			            echo 'Exception : ',  $e->getMessage(), "\n";
			        }
				}
			
	            return $this->redirect(['action' => 'index']);
	        }
	        $this->Flash->error(__('The leave request could not be saved. Please, try again.'));
	    }
	
	    $department_member = $department_members->find('all')->where(['DepartmentsMembers.user_id'=>$user['id']])->first();
		$recommended = $users->find('all')->where(['Users.id'=>$leaveRequest->recommended_by])->first();
		$approve = $users->find('all')->where(['Users.id'=>$leaveRequest->approved_by])->first();
		$relief = $users->find('all')->where(['Users.id'=>$leaveRequest->relieved_by])->first();
	
		$check_request = $this->VehicleServicings->find('all', [
			'conditions' => ['VehicleServicings.user_id' => $user['id'], 'OR' => ['VehicleServicings.status' => 2, 'VehicleServicings.status' => 3]],
		]);
	
		$check_request = $check_request->toArray();
	
	    $this->set(compact('leaveRequest', 'users', 'department_member', 'check_request', 'recommended', 'approve', 'relief', 'check_request_admin'));
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
	    $leaveRequest = $this->VehicleServicings->get($id);
	    if ($this->VehicleServicings->delete($leaveRequest)) {
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
	    $leaveRequest = $this->VehicleServicings->get($id);
		$lrequest = $this->VehicleServicings->newEntity();
		$lrequest->id = $id;
		$lrequest->status = $status;
			
	    if ($this->VehicleServicings->save($lrequest)) {
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
