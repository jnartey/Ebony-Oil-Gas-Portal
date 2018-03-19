<?php
namespace App\Controller\Department;
use App\Controller\Department\AppController;

use Cake\ORM\TableRegistry;
use Cake\Mailer\Email;
use Cake\Routing\Router;
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
		$requestHandlers = TableRegistry::get('RequestHandlers');
		$department_details = null;
		$department_member = null;
		$department_details_ch = null;
		
		$user_table = TableRegistry::get('Users');		
		$get_user = $user_table->find('all')->where(['Users.id' => $user['id']])->first();
		
		$department_member = $department_members->find('all', [
		    'conditions' => ['DepartmentsMembers.user_id' => $user['id']],
		]);
		
		$check_request_admin = $requestHandlers->find('all')->where(['RequestHandlers.department_id' => $get_user->department_access, 'RequestHandlers.request_forms_id' => 1])->contain(['Departments'])->first();
		
		if(!empty($check_request_admin) && !empty($check_request_admin->user_id) && isset($check_request_admin->user_id)){
			$check_request_admin = $requestHandlers->find('all')->where(['RequestHandlers.user_id' => $get_user->id, 'RequestHandlers.request_forms_id' => 1])->contain(['Departments'])->first();
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
		
		$current_user = $department_members->find('all')->where(['DepartmentsMembers.user_id' => $user['id']])->contain(['Users', 'Departments'])->first();
		
		$leaveRequests = null;
		
		if($user['role_id'] == 1 || $current_user->department_role == 2 || $current_user->department_role == 3){
			if($check_request_admin){
		        $leaveRequests = $this->Requests->find('all', [
					'conditions' => ['Requests.request_type'=>1, 'Requests.status'=>3],
		            'contain' => ['Departments', 'Users'],
					'order' => ['Requests.created'=>'DESC', 'Requests.status'=>'ASC']
				]);
			}else{
		        $leaveRequests = $this->Requests->find('all', [
					'conditions' => ['Requests.request_type'=>1, 'OR'=>['Requests.department_id' => $get_user->department_access]],
		            'contain' => ['Departments', 'Users'],
					'order' => ['Requests.created'=>'DESC', 'Requests.status'=>'ASC']
				]);
			}
		}else{
	        $leaveRequests = $this->Requests->find('all', [
				'conditions' => ['Requests.user_id' => $user['id'], 'Requests.request_type'=>1],
	            'contain' => ['Departments', 'Users'],
				'order' => ['Requests.created'=>'DESC', 'Requests.status'=>'DESC']
			]);
		}
		
		$check_request = $this->Requests->find('all', [
			'conditions' => ['Requests.user_id' => $get_user->id, 'Requests.status' => 1, 'Requests.request_type'=>1],
		]);
		
		$check_request = $check_request->toArray();
		
		if(!empty($department_details)){
			$department_details_ch = $department_details->toArray();
		}

        $this->set(compact('leaveRequests', 'check_request', 'department_member', 'department_details', 'department_details_ch', 'current_department', 'check_request_admin'));
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
		$department_member = $department_members->find('all')->where(['DepartmentsMembers.user_id'=>$user['id']])->contain(['Departments'])->first();
			
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
		$holidays = TableRegistry::get('Holidays');
		$users = TableRegistry::get('Users');
		$leave_days = TableRegistry::get('LeaveDays');
		$requestHandlers = TableRegistry::get('RequestHandlers');
		
		$user = $this->Auth->user();
		$get_user = $users->find('all')->where(['Users.id' => $user['id']])->first();
		
		$user_det = $users->find('all')->where(['Users.id'=>$user['id']])->first();
		$leave_d = $leave_days->find('all')->where(['LeaveDays.user_id' => $user['id']])->first();
		
		$user_details = $department_members->find('all', [
		    'conditions' => ['DepartmentsMembers.department_id' => $get_user->department_access, 'NOT'=>['DepartmentsMembers.user_id'=>$get_user->id]],
			'contain' => ['Users']
		]);
			
		$user_details_chk = $department_members->find('all', [
		    'conditions' => ['DepartmentsMembers.department_id' => $get_user->department_access, 'DepartmentsMembers.user_id'=>$get_user->id],
			'contain' => ['Users']
		]);
			
		$user_details_chk = $user_details_chk->first();
		
		//pr($user_details_chk);
						
		$check_request_admin = $requestHandlers->find('all')->where(['RequestHandlers.department_id' => $get_user->department_access, 'RequestHandlers.request_forms_id' => 1])->contain(['Departments'])->first();
		
        $leaveRequest = $this->Requests->newEntity();
        if ($this->request->is('post')) {
            $leaveRequest = $this->Requests->patchEntity($leaveRequest, $this->request->getData());
            
				$leaveDays = $leave_days->newEntity();
				$leaveDays->id = $leave_d->id;
				
				if(!empty($check_request_admin) && isset($check_request_admin)){
					if($check_request_admin || $user_details_chk->department_role == 3){
						$leaveRequest->status = 3;
					}
				}elseif($user_details_chk->department_role == 3){
					$leaveRequest->status = 3;
				}
				
				if($this->request->getData('leave_type') == 'Annual'){
					if($leave_d->annual_leave_days >= $this->request->getData('number_of_days_requested')){
						$leaveDays->annual_leave_days = $leave_d->annual_leave_days - $this->request->getData('number_of_days_requested');
						if ($result = $this->Requests->save($leaveRequest)) {
							$leave_days->save($leaveDays);
							$this->Flash->success(__('The leave request has been submitted.'));
							$this->Log->write('info', 'Leave Request', $user['first_name'].' '.$user['last_name'].' requested for annual leave ', [], ['request' => true], $result->id, $get_user->department_access);
							return $this->redirect(['action' => 'index']);
						}else{
							$this->Flash->error(__('The leave request could not be submitted. Please, try again.'));
						}
					}else{
						$this->Flash->error(__('Invalid leave days'));
					}
				}elseif($this->request->getData('leave_type') == 'Study'){
					if($leave_d->study_leave_days >= $this->request->getData('number_of_days_requested')){
						$leaveDays->study_leave_days = $leave_d->study_leave_days - $this->request->getData('number_of_days_requested');
						if ($result = $this->Requests->save($leaveRequest)) {
							$leave_days->save($leaveDays);
							$this->Flash->success(__('The leave request has been submitted.'));
							$this->Log->write('info', 'Leave Request', $user['first_name'].' '.$user['last_name'].' requested for study leave ', [], ['request' => true], $result->id, $get_user->department_access);
							return $this->redirect(['action' => 'index']);
						}else{
							$this->Flash->error(__('The leave request could not be submitted. Please, try again.'));
						}
					}else{
						$this->Flash->error(__('The leave request could not be saved. Please, try again.'));
					}
				}elseif($this->request->getData('leave_type') == 'Maternity'){
					if($leave_d->maternity_leave_days >= $this->request->getData('number_of_days_requested')){
						$leaveDays->maternity_leave_days = $leave_d->maternity_leave_days - $this->request->getData('number_of_days_requested');
						if ($result = $this->Requests->save($leaveRequest)) {
							$leave_days->save($leaveDays);
							$this->Flash->success(__('The leave request has been submitted.'));
							$this->Log->write('info', 'Leave Request', $user['first_name'].' '.$user['last_name'].' requested for maternity leave ', [], ['request' => true], $result->id, $get_user->department_access);
							return $this->redirect(['action' => 'index']);
						}else{
							$this->Flash->error(__('The leave request could not be submitted. Please, try again.'));
						}
					}else{
						$this->Flash->error(__('Invalid leave days'));
					}
				}elseif($this->request->getData('leave_type') == 'Paternity'){
					if($leave_d->paternity_leave_days >= $this->request->getData('number_of_days_requested')){
						$leaveDays->paternity_leave_days = $leave_d->paternity_leave_days - $this->request->getData('number_of_days_requested');
						if ($result = $this->Requests->save($leaveRequest)) {
							$leave_days->save($leaveDays);
							$this->Flash->success(__('The leave request has been submitted.'));
							$this->Log->write('info', 'Leave Request', $user['first_name'].' '.$user['last_name'].' requested for paternity leave ', [], ['request' => true], $result->id, $get_user->department_access);
							return $this->redirect(['action' => 'index']);
						}else{
							$this->Flash->error(__('The leave request could not be submitted. Please, try again.'));
						}
					}else{
						$this->Flash->error(__('Invalid leave days'));
					}
				}elseif($this->request->getData('leave_type') == 'Sick'){
					if ($result = $this->Requests->save($leaveRequest)) {
						$this->Flash->success(__('The leave request has been submitted.'));
						$this->Log->write('info', 'Leave Request', $user['first_name'].' '.$user['last_name'].' requested for sick leave ', [], ['request' => true], $result->id, $get_user->department_access);
						return $this->redirect(['action' => 'index']);
					}else{
						$this->Flash->error(__('The leave request could not be submitted. Please, try again.'));
					}
				}

                
            }
            
		
        $department_member = $department_members->find('all')->where(['DepartmentsMembers.user_id'=>$user['id']])->first();
							
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
		
		$all_holidays = $holidays->find('all');
		
        $this->set(compact('leaveRequest', 'users', 'department_member', 'check_request', 'user_det', 'get_user', 'all_holidays', 'leave_d', 'relieve_staff', 'user_details_chk'));
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
		$holidays = TableRegistry::get('Holidays');
		$user_table = TableRegistry::get('Users');		
		$get_user = $user_table->find('all')->where(['Users.id' => $user['id']])->first();
		$leave_days = TableRegistry::get('LeaveDays');
		
        $leaveRequest = $this->Requests->get($id, [
            'contain' => []
        ]);
		
		$leave_d = $leave_days->find('all')->where(['LeaveDays.user_id' => $user['id']])->first();	
		
        if ($this->request->is(['patch', 'post', 'put'])) {
            $leaveRequest = $this->Requests->patchEntity($leaveRequest, $this->request->getData());
            
				$leaveDays = $leave_days->newEntity();
				$leaveDays->id = $leave_d->id;
				
				if($this->request->getData('leave_type') == 'Annual'){
					if($leave_d->annual_leave_days >= $this->request->getData('number_of_days_requested')){
						$leaveDays->annual_leave_days = ($leave_d->annual_leave_days + $leaveRequest->number_of_days_requested) - $this->request->getData('number_of_days_requested');
						if ($result = $this->Requests->save($leaveRequest)) {
							$leaveDays->save($leaveDays);
							$this->Flash->success(__('The leave request has been submitted.'));
							$this->Log->write('info', 'Leave Request', $user['first_name'].' '.$user['last_name'].' requested for annual leave ', [], ['request' => true], $result->id, $get_user->department_access);
							return $this->redirect(['action' => 'index']);
						}else{
							$this->Flash->error(__('The leave request could not be submitted. Please, try again.'));
						}
					}else{
						$this->Flash->error(__('Invalid leave days'));
					}
				}elseif($this->request->getData('leave_type') == 'Study'){
					if($leave_d->study_leave_days >= $this->request->getData('number_of_days_requested')){
						$leaveDays->study_leave_days = ($leave_d->study_leave_days + $leaveRequest->number_of_days_requested) - $this->request->getData('number_of_days_requested');
						if ($result = $this->Requests->save($leaveRequest)) {
							$leaveDays->save($leaveDays);
							$this->Flash->success(__('The leave request has been submitted.'));
							$this->Log->write('info', 'Leave Request', $user['first_name'].' '.$user['last_name'].' requested for study leave ', [], ['request' => true], $result->id, $get_user->department_access);
							return $this->redirect(['action' => 'index']);
						}else{
							$this->Flash->error(__('The leave request could not be submitted. Please, try again.'));
						}
					}else{
						$this->Flash->error(__('The leave request could not be saved. Please, try again.'));
					}
				}elseif($this->request->getData('leave_type') == 'Maternity'){
					if($leave_d->maternity_leave_days >= $this->request->getData('number_of_days_requested')){
						$leaveDays->maternity_leave_days = ($leave_d->maternity_leave_days + $leaveRequest->number_of_days_requested) - $this->request->getData('number_of_days_requested');
						if ($result = $this->Requests->save($leaveRequest)) {
							$leaveDays->save($leaveDays);
							$this->Flash->success(__('The leave request has been submitted.'));
							$this->Log->write('info', 'Leave Request', $user['first_name'].' '.$user['last_name'].' requested for maternity leave ', [], ['request' => true], $result->id, $get_user->department_access);
							return $this->redirect(['action' => 'index']);
						}else{
							$this->Flash->error(__('The leave request could not be submitted. Please, try again.'));
						}
					}else{
						$this->Flash->error(__('Invalid leave days'));
					}
				}elseif($this->request->getData('leave_type') == 'Paternity'){
					if($leave_d->paternity_leave_days >= $this->request->getData('number_of_days_requested')){
						$leaveDays->paternity_leave_days = ($leave_d->paternity_leave_days + $leaveRequest->number_of_days_requested) - $this->request->getData('number_of_days_requested');
						if ($result = $this->Requests->save($leaveRequest)) {
							$leaveDays->save($leaveDays);
							$this->Flash->success(__('The leave request has been submitted.'));
							$this->Log->write('info', 'Leave Request', $user['first_name'].' '.$user['last_name'].' requested for paternity leave ', [], ['request' => true], $result->id, $get_user->department_access);
							return $this->redirect(['action' => 'index']);
						}else{
							$this->Flash->error(__('The leave request could not be submitted. Please, try again.'));
						}
					}else{
						$this->Flash->error(__('Invalid leave days'));
					}
				}elseif($this->request->getData('leave_type') == 'Sick'){
					if ($result = $this->Requests->save($leaveRequest)) {
						$this->Flash->success(__('The leave request has been submitted.'));
						$this->Log->write('info', 'Leave Request', $user['first_name'].' '.$user['last_name'].' requested for sick leave ', [], ['request' => true], $result->id, $get_user->department_access);
						return $this->redirect(['action' => 'index']);
					}else{
						$this->Flash->error(__('The leave request could not be submitted. Please, try again.'));
					}
				}
        }
		
        $department_member = $department_members->find('all')->where(['DepartmentsMembers.user_id'=>$user['id']])->first();
		
		$user_details = $department_members->find('all', [
		    'conditions' => ['DepartmentsMembers.department_id' => $get_user->department_access, 'NOT'=>['DepartmentsMembers.user_id'=>$user['id']]],
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
		$all_holidays = $holidays->find('all');
		
        $this->set(compact('leaveRequest', 'users', 'department_member', 'check_request', 'all_holidays', 'relieve_staff'));
        $this->set('_serialize', ['leaveRequest']);
        
    }
	
    public function review($id = null)
    {
		$user = $this->Auth->user();
		$department_members = TableRegistry::get('DepartmentsMembers');
		$requestHandlers = TableRegistry::get('RequestHandlers');
		$users = TableRegistry::get('Users');
		
		$get_user = $users->find('all')->where(['Users.id' => $user['id']])->first();
		
        $leaveRequest = $this->Requests->get($id, [
            'contain' => ['Users']
        ]);
			
		$relieve = $users->find('all')->where(['Users.id'=>$leaveRequest->relieved_by])->first();
		
		$check_request_admin = $requestHandlers->find('all')->where(['RequestHandlers.request_forms_id' => 1])->contain(['Departments'])->first();
		
		$request_department_head = $department_members->find('all')->where(['DepartmentsMembers.department_id'=>$check_request_admin->department_id, 'DepartmentsMembers.department_role'=>3])->contain(['Users'])->first();
								
        if ($this->request->is(['patch', 'post', 'put'])) {
            $leaveRequest = $this->Requests->patchEntity($leaveRequest, $this->request->getData());
            if ($this->Requests->save($leaveRequest)) {
                $this->Flash->success(__('The leave request has been approved.'));
				$this->Log->write('info', 'Leave Request', $user['first_name'].' '.$user['last_name'].' reviewed '.$leaveRequest->type.' for '.$leaveRequest->user->name, [], ['request' => true], $leaveRequest->id, $get_user->department_access);
					
				if($this->request->getData('status') == 3){
					$email = new Email('default');
					$link =  Router::url(['controller' => 'Requests', 'action' => 'view', $leaveRequest->id, 'department'=>$leaveRequest->department_id], true);
					
					try{
					  	$email->from(['info@eogportal.com' => 'Ebony Oil & Gas Portal::Requests'])
						    ->to($leaveRequest->user->email)
						    ->subject($leaveRequest->leave_type.' leave request')
							->emailFormat('html')
							->send($user['first_name'].' '.$user['last_name'].' has approved your '.$leaveRequest->leave_type.' leave request<br />'
								.'<a href="'.$link.'">Click here to view</a>'); 
					} catch (Exception $e) {
			            echo 'Exception : ',  $e->getMessage(), "\n";
			        }
					
					$emailA = new Email('default');
					$linkA =  Router::url(['controller' => 'Requests', 'action' => 'approve', $leaveRequest->id, 'department'=>$request_department_head->department_id], true);
					
					try{
					  	$emailA->from(['info@eogportal.com' => 'Ebony Oil & Gas Portal::Requests'])
						    ->to($request_department_head->user->email)
						    ->subject($leaveRequest->leave_type.' leave request')
							->emailFormat('html')
							->send($leaveRequest->name.' has requested for '.$leaveRequest->leave_type.' leave<br />'
								.'<a href="'.$linkA.'">Click here to view</a>'); 
					} catch (Exception $e) {
			            echo 'Exception : ',  $e->getMessage(), "\n";
			        }
					
				}elseif($this->request->getData('status') == 5){
					$email = new Email('default');
					$link =  Router::url(['controller' => 'Requests', 'action' => 'view', $leaveRequest->id, 'department'=>$leaveRequest->department_id], true);
					
					try{
					  	$email->from(['info@eogportal.com' => 'Ebony Oil & Gas Portal::Requests'])
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
		
        $this->set(compact('leaveRequest', 'users', 'department_member', 'check_request', 'recommended', 'relieve_staff', 'relieve'));
        $this->set('_serialize', ['leaveRequest']);
        
    }
	
    public function recommend($id = null)
    {
		$user = $this->Auth->user();
		$department_members = TableRegistry::get('DepartmentsMembers');
		$requestHandlers = TableRegistry::get('RequestHandlers');
		$users = TableRegistry::get('Users');
		
        $leaveRequest = $this->Requests->get($id, [
            'contain' => ['Users']
        ]);
			
		$get_user = $users->find('all')->where(['Users.id' => $user['id']])->first();
		
		$relieve = $users->find('all')->where(['Users.id'=>$leaveRequest->relieved_by])->first();
		
		$check_request_admin = $requestHandlers->find('all')->where(['RequestHandlers.department_id' => $get_user->department_access, 'RequestHandlers.request_forms_id' => 1])->contain(['Departments'])->first();
		
		//pr($check_request_admin);
		
        if ($this->request->is(['patch', 'post', 'put'])) {
            $leaveRequest = $this->Requests->patchEntity($leaveRequest, $this->request->getData());
            if ($this->Requests->save($leaveRequest)) {
                $this->Flash->success(__('The leave request has been recommended.'));
				$this->Log->write('info', 'Leave Request', $user['first_name'].' '.$user['last_name'].' recommended '.$leaveRequest->type.' for '.$leaveRequest->user->name, [], ['request' => true], $leaveRequest->id, $get_user->department_access);
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The leave request could not be saved. Please, try again.'));
        }
		
        $department_member = $department_members->find('all')->where(['DepartmentsMembers.user_id'=>$user['id']])->first();
		
		$check_request = $this->Requests->find('all', [
			'conditions' => ['Requests.user_id' => $user['id'], 'OR' => ['Requests.status' => 2, 'Requests.status' => 3]],
		]);
		
		$check_request = $check_request->toArray();
		
        $this->set(compact('leaveRequest', 'users', 'department_member', 'check_request', 'relieve'));
        $this->set('_serialize', ['leaveRequest']);
        
    }
	
    public function approve($id = null)
    {
		$user = $this->Auth->user();
		$department_members = TableRegistry::get('DepartmentsMembers');
		$requestHandlers = TableRegistry::get('RequestHandlers');
		$users = TableRegistry::get('Users');
		
        $leaveRequest = $this->Requests->get($id, [
            'contain' => ['Users']
        ]);
			
		$get_user = $users->find('all')->where(['Users.id' => $user['id']])->first();
		
		$check_request_admin = $requestHandlers->find('all')->where(['RequestHandlers.department_id' => $get_user->department_access, 'RequestHandlers.request_forms_id' => 1])->contain(['Departments'])->first();
		
        if ($this->request->is(['patch', 'post', 'put'])) {
            $leaveRequest = $this->Requests->patchEntity($leaveRequest, $this->request->getData());
            if ($this->Requests->save($leaveRequest)) {
                $this->Flash->success(__('The leave request has been approved.'));
				$this->Log->write('info', 'Leave Request', $user['first_name'].' '.$user['last_name'].' approved '.$leaveRequest->type.' for '.$leaveRequest->user->name, [], ['request' => true], $leaveRequest->id, $get_user->department_access);
				
				if($this->request->getData('status') == 4){
					$email = new Email('default');
					$link =  Router::url(['controller' => 'Requests', 'action' => 'view', $leaveRequest->id, 'department'=>$leaveRequest->department_id], true);
					
					try{
					  	$email->from(['info@eogportal.com' => 'Ebony Oil & Gas Portal::Requests'])
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
					$link =  Router::url(['controller' => 'Requests', 'action' => 'view', $leaveRequest->id, 'department'=>$leaveRequest->department_id], true);
					
					try{
					  	$email->from(['info@eogportal.com' => 'Ebony Oil & Gas Portal::Requests'])
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
		
		$check_request = $this->Requests->find('all', [
			'conditions' => ['Requests.user_id' => $user['id'], 'OR' => ['Requests.status' => 2, 'Requests.status' => 3]],
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
        $leaveRequest = $this->Requests->get($id);
		$leave_days = TableRegistry::get('LeaveDays');
		
		$leave_d = $leave_days->find('all')->where(['LeaveDays.user_id' => $leaveRequest->user_id])->first();
		
		$leaveDays = $leave_days->newEntity();
		$leaveDays->id = $leave_d->id;	
		
		if($leaveRequest->leave_type == 'Annual'){
			$leaveDays->annual_leave_days = $leave_d->annual_leave_days + $leaveRequest->number_of_days_requested;
			if($leave_days->save($leaveDays)) {
		        if ($this->Requests->delete($leaveRequest)) {
		            $this->Flash->success(__($leaveRequest->request_type.' request has been deleted.'));
		        } else {
		            $this->Flash->error(__($leaveRequest->request_type.' request could not be deleted. Please, try again.'));
		        }
			}
		}
		
		if($leaveRequest->leave_type == 'Study'){
			$leaveDays->study_leave_days = $leave_d->study_leave_days + $leaveRequest->number_of_days_requested;
			if($leave_days->save($leaveDays)) {
		        if ($this->Requests->delete($leaveRequest)) {
		            $this->Flash->success(__($leaveRequest->request_type.' request has been deleted.'));
		        } else {
		            $this->Flash->error(__($leaveRequest->request_type.' request could not be deleted. Please, try again.'));
		        }
			}
		}
		
		if($leaveRequest->leave_type == 'Maternity'){
			$leaveDays->maternity_leave_days = $leave_d->maternity_leave_days + $leaveRequest->number_of_days_requested;
			if($leave_days->save($leaveDays)) {
		        if ($this->Requests->delete($leaveRequest)) {
		            $this->Flash->success(__($leaveRequest->request_type.' request has been deleted.'));
		        } else {
		            $this->Flash->error(__($leaveRequest->request_type.' request could not be deleted. Please, try again.'));
		        }
			}
		}
		
		if($leaveRequest->leave_type == 'Paternity'){
			$leaveDays->paternity_leave_days = $leave_d->paternity_leave_days + $leaveRequest->number_of_days_requested;
			if($leave_days->save($leaveDays)) {
		        if ($this->Requests->delete($leaveRequest)) {
		            $this->Flash->success(__($leaveRequest->request_type.' request has been deleted.'));
		        } else {
		            $this->Flash->error(__($leaveRequest->request_type.' request could not be deleted. Please, try again.'));
		        }
			}
		}
		
		if($leaveRequest->leave_type == 'Sick'){
	        if ($this->Requests->delete($leaveRequest)) {
	            $this->Flash->success(__($leaveRequest->request_type.' request has been deleted.'));
	        } else {
	            $this->Flash->error(__($leaveRequest->request_type.' request could not be deleted. Please, try again.'));
	        }
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
