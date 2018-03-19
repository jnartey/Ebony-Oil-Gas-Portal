<?php
namespace App\Controller\Department;
use App\Controller\Department\AppController;

use Cake\ORM\TableRegistry;
use Cake\Mailer\Email;
use Cake\Routing\Router;

/**
 * CashRequests Controller
 *
 * @property \App\Model\Table\CashRequestsTable $CashRequests
 *
 * @method \App\Model\Entity\CashRequest[] paginate($object = null, array $settings = [])
 */
class CashRequestsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    // public function index()
//     {
//         $cashRequests = $this->paginate($this->CashRequests);
//
//         $this->set(compact('cashRequests'));
//         $this->set('_serialize', ['cashRequests']);
//     }

    /**
     * View method
     *
     * @param string|null $id Cash Request id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    // public function view($id = null)
 //    {
 //        $cashRequest = $this->CashRequests->get($id, [
 //            'contain' => []
 //        ]);
 //
 //        $this->set('cashRequest', $cashRequest);
 //        $this->set('_serialize', ['cashRequest']);
 //    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    // public function add()
//     {
//         $cashRequest = $this->CashRequests->newEntity();
//         if ($this->request->is('post')) {
//             $cashRequest = $this->CashRequests->patchEntity($cashRequest, $this->request->getData());
//             if ($this->CashRequests->save($cashRequest)) {
//                 $this->Flash->success(__('The cash request has been saved.'));
//
//                 return $this->redirect(['action' => 'index']);
//             }
//             $this->Flash->error(__('The cash request could not be saved. Please, try again.'));
//         }
//         $this->set(compact('cashRequest'));
//         $this->set('_serialize', ['cashRequest']);
//     }

    /**
     * Edit method
     *
     * @param string|null $id Cash Request id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    // public function edit($id = null)
//     {
//         $cashRequest = $this->CashRequests->get($id, [
//             'contain' => []
//         ]);
//         if ($this->request->is(['patch', 'post', 'put'])) {
//             $cashRequest = $this->CashRequests->patchEntity($cashRequest, $this->request->getData());
//             if ($this->CashRequests->save($cashRequest)) {
//                 $this->Flash->success(__('The cash request has been saved.'));
//
//                 return $this->redirect(['action' => 'index']);
//             }
//             $this->Flash->error(__('The cash request could not be saved. Please, try again.'));
//         }
//         $this->set(compact('cashRequest'));
//         $this->set('_serialize', ['cashRequest']);
//     }

    /**
     * Delete method
     *
     * @param string|null $id Cash Request id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    // public function delete($id = null)
//     {
//         $this->request->allowMethod(['post', 'delete']);
//         $cashRequest = $this->CashRequests->get($id);
//         if ($this->CashRequests->delete($cashRequest)) {
//             $this->Flash->success(__('The cash request has been deleted.'));
//         } else {
//             $this->Flash->error(__('The cash request could not be deleted. Please, try again.'));
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
	
		$check_request_admin = $requestHandlers->find('all')->where(['RequestHandlers.department_id' => $get_user->department_access, 'RequestHandlers.request_forms_id' => 3])->contain(['Departments'])->first();
		
		if(!empty($check_request_admin) && !empty($check_request_admin->user_id) && isset($check_request_admin->user_id)){
			$check_request_admin = $requestHandlers->find('all')->where(['RequestHandlers.user_id' => $get_user->id, 'RequestHandlers.request_forms_id' => 3])->contain(['Departments'])->first();
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
	
		$cashRequests = null;
	
		if($user['role_id'] == 1 || $current_department->department_role == 2 || $current_department->department_role == 3){
			if($check_request_admin){
		        $cashRequests = $this->CashRequests->find('all', [
					'conditions' => ['CashRequests.request_type'=>3],
		            'contain' => ['Departments', 'Users'],
					'order' => ['CashRequests.created'=>'DESC', 'CashRequests.status'=>'ASC']
				]);
			}else{
		        $cashRequests = $this->CashRequests->find('all', [
					'conditions' => ['CashRequests.request_type'=>3, 'OR'=>['CashRequests.user_id' => $user['id'], 'CashRequests.department_id' => $get_user->department_access]],
		            'contain' => ['Departments', 'Users'],
					'order' => ['CashRequests.created'=>'DESC', 'CashRequests.status'=>'ASC']
				]);
			}
		}else{
	        $cashRequests = $this->CashRequests->find('all', [
				'conditions' => ['CashRequests.user_id' => $user['id'], 'CashRequests.request_type'=>3],
	            'contain' => ['Departments', 'Users'],
				'order' => ['CashRequests.created'=>'DESC', 'CashRequests.status'=>'DESC']
			]);
		}
		
	
		$check_request = $this->CashRequests->find('all', [
			'conditions' => ['CashRequests.user_id' => $get_user->id, 'CashRequests.status' => 1, 'CashRequests.request_type'=>3],
		]);
	
		$check_request = $check_request->toArray();
	
		if(!empty($department_details)){
			$department_details_ch = $department_details->toArray();
		}

	    $this->set(compact('cashRequests', 'check_request', 'department_member', 'department_details', 'department_details_ch', 'current_department', 'check_request_admin'));
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
		$users = TableRegistry::get('Users');	
	    $cashRequest = $this->CashRequests->get($id, [
	        'contain' => ['Users', 'Departments']
	    ]);
		
		$department_members = TableRegistry::get('DepartmentsMembers');
		$department_member = $department_members->find('all')->where(['DepartmentsMembers.user_id'=>$user['id']])->first();
		
		$users = TableRegistry::get('Users');
		
		$approve = $users->find('all')->where(['Users.id'=>$cashRequest->approved_by])->first();
		
	    $this->set('cashRequest', $cashRequest);
		$this->set(compact('check_request', 'approve', 'department_member'));
	    $this->set('_serialize', ['cashRequest']);
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
	
	    $cashRequest = $this->CashRequests->newEntity();
	    if ($this->request->is('post')) {
	        $cashRequest = $this->CashRequests->patchEntity($cashRequest, $this->request->getData());
        	//debug($cashRequest);
            if ($result = $this->CashRequests->save($cashRequest)) {
                $this->Flash->success(__('Cash Request has been submitted.'));
				$this->Log->write('info', 'Cash Request', $user['first_name'].' '.$user['last_name'].' requested for cash ', [], ['request' => true], $result->id, $get_user->department_access);
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Cash Request could not be submitted. Please, try again.'));
	    }
	
	    $department_member = $department_members->find('all')->where(['DepartmentsMembers.user_id'=>$user['id']])->first();
						
	
		$check_request = $this->CashRequests->find('all', [
			'conditions' => ['CashRequests.user_id' => $user['id'], 'CashRequests.status' => 1],
		]);
	
		$check_request = $check_request->toArray();
		
	    $this->set(compact('cashRequest', 'users', 'department_member', 'check_request', 'user_det', 'get_user'));
	    $this->set('_serialize', ['cashRequest']);
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
	
	    $cashRequest = $this->CashRequests->get($id, [
	        'contain' => []
	    ]);
		
	    if ($this->request->is(['patch', 'post', 'put'])) {
	        $cashRequest = $this->CashRequests->patchEntity($cashRequest, $this->request->getData());
        	
            if ($result = $this->CashRequests->save($cashRequest)) {
                $this->Flash->success(__('Cash Request has been updated.'));
				$this->Log->write('info', 'Cash Request', $user['first_name'].' '.$user['last_name'].' edited request for cash ', [], ['request' => true], $result->id, $get_user->department_access);
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Cash Request could not be updated. Please, try again.'));	
	    }
	
	    $department_member = $department_members->find('all')->where(['DepartmentsMembers.user_id'=>$user['id']])->first();
	
		$user_details = $department_members->find('all', [
		    'conditions' => ['DepartmentsMembers.department_id' => $get_user->department_access, 'NOT'=>['DepartmentsMembers.user_id'=>$user['id']]],
		]);
	
		$check_request = $this->CashRequests->find('all', [
			'conditions' => ['CashRequests.user_id' => $user['id'], 'OR' => ['CashRequests.status' => 2, 'CashRequests.status' => 3]],
		]);
	
		$check_request = $check_request->toArray();
	
	    $this->set(compact('cashRequest', 'users', 'department_member', 'check_request'));
	    $this->set('_serialize', ['cashRequest']);
    
	}

	public function approve($id = null)
	{
		$user = $this->Auth->user();
		$department_members = TableRegistry::get('DepartmentsMembers');
		$requestHandlers = TableRegistry::get('RequestHandlers');
		$users = TableRegistry::get('Users');
	
	    $cashRequest = $this->CashRequests->get($id, [
	        'contain' => ['Users']
	    ]);
		
		$get_user = $users->find('all')->where(['Users.id' => $user['id']])->first();
	
		$check_request_admin = $requestHandlers->find('all')->where(['RequestHandlers.department_id' => $get_user->department_access, 'RequestHandlers.request_forms_id' => 1])->contain(['Departments'])->first();
	
	    if ($this->request->is(['patch', 'post', 'put'])) {
	        $cashRequest = $this->CashRequests->patchEntity($cashRequest, $this->request->getData());
	        if ($this->CashRequests->save($cashRequest)) {
	            $this->Flash->success(__('The leave request has been approved.'));
				$this->Log->write('info', 'Cash Request', $user['first_name'].' '.$user['last_name'].' approved '.$cashRequest->type.' for '.$cashRequest->user->name, [], ['request' => true], $cashRequest->id, $get_user->department_access);
			
				if($this->request->getData('status') == 4){
					$email = new Email('default');
					$link =  Router::url(['controller' => 'CashRequests', 'action' => 'view', $cashRequest->id, 'department'=>$cashRequest->department_id], true);
				
					try{
					  	$email->from(['info@eogportal.com' => 'Ebony Oil & Gas Portal::Cash Request'])
						    ->to($cashRequest->user->email)
						    ->subject('Cash request')
							->emailFormat('html')
							->send($user['first_name'].' '.$user['last_name'].' has approved your cash request<br />'
								.'<a href="'.$link.'">Click here to view</a>'); 
					} catch (Exception $e) {
			            echo 'Exception : ',  $e->getMessage(), "\n";
			        }
				
				}elseif($this->request->getData('status') == 5){
					$email = new Email('default');
					$link =  Router::url(['controller' => 'CashRequests', 'action' => 'view', $cashRequest->id, 'department'=>$cashRequest->department_id], true);
				
					try{
					  	$email->from(['info@eogportal.com' => 'Ebony Oil & Gas Portal::Cash Request'])
						    ->to($cashRequest->user->email)
						    ->subject('Cash request')
							->emailFormat('html')
							->send($user['first_name'].' '.$user['last_name'].' has declined your cash request<br />'
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
		$recommended = $users->find('all')->where(['Users.id'=>$cashRequest->recommended_by])->first();
		$approve = $users->find('all')->where(['Users.id'=>$cashRequest->approved_by])->first();
		$relief = $users->find('all')->where(['Users.id'=>$cashRequest->relieved_by])->first();
	
		$check_request = $this->CashRequests->find('all', [
			'conditions' => ['CashRequests.user_id' => $user['id'], 'OR' => ['CashRequests.status' => 2, 'CashRequests.status' => 3]],
		]);
	
		$check_request = $check_request->toArray();
	
	    $this->set(compact('cashRequest', 'users', 'department_member', 'check_request', 'recommended', 'approve', 'relief', 'check_request_admin'));
	    $this->set('_serialize', ['cashRequest']);
    
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
	    $cashRequest = $this->CashRequests->get($id);
	    if ($this->CashRequests->delete($cashRequest)) {
	        $this->Flash->success(__($cashRequest->request_type.' request has been deleted.'));
	    } else {
	        $this->Flash->error(__($cashRequest->request_type.' request could not be deleted. Please, try again.'));
	    }

	    return $this->redirect(['action' => 'index']);
	}

	public function setStatus($id = null, $status = null)
	{
		$userA = $this->Auth->user();
	    $this->request->allowMethod(['post']);
	    $cashRequest = $this->CashRequests->get($id);
		$lrequest = $this->CashRequests->newEntity();
		$lrequest->id = $id;
		$lrequest->status = $status;
			
	    if ($this->CashRequests->save($lrequest)) {
			if($status == 4){
				$this->Flash->success(__('Cash request has been cancelled.'));
			}
		
			if($status == 1){
				$this->Flash->success(__('Cash request has been re-activated.'));
			}
	    } else {
	        $this->Flash->error(__('Cash request could not be deleted. Please, try again.'));
	    }

	    return $this->redirect(['action' => 'index']);
	}
	
}
