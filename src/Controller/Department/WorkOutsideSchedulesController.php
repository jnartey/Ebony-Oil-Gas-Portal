<?php
namespace App\Controller\Department;
use App\Controller\Department\AppController;

use Cake\ORM\TableRegistry;
use Cake\Mailer\Email;
use Cake\Routing\Router;
/**
 * WorkOutsideSchedules Controller
 *
 * @property \App\Model\Table\WorkOutsideSchedulesTable $WorkOutsideSchedules
 *
 * @method \App\Model\Entity\WorkOutsideSchedule[] paginate($object = null, array $settings = [])
 */
class WorkOutsideSchedulesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
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
		
		$check_request_admin = $requestHandlers->find('all')->where(['RequestHandlers.department_id' => $get_user->department_access, 'RequestHandlers.request_forms_id' => 2])->contain(['Departments'])->first();
		
		if(!empty($check_request_admin) && !empty($check_request_admin->user_id) && isset($check_request_admin->user_id)){
			$check_request_admin = $requestHandlers->find('all')->where(['RequestHandlers.user_id' => $get_user->id, 'RequestHandlers.request_forms_id' => 1])->contain(['Departments'])->first();
		}
		
		//$check_request_admin_arr = $check_request_admin->toArray();
		
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
		
		$wosRequests = null;
		
		if($user['role_id'] == 1 || $current_department->department_role == 2 || $current_department->department_role == 3){
			if($check_request_admin){
				if($check_request_admin->department_id == $get_user->department_access){
			        $wosRequests = $this->WorkOutsideSchedules->find('all', [
						'conditions' => ['WorkOutsideSchedules.request_type'=>2],
			            'contain' => ['Departments', 'Users'],
						'order' => ['WorkOutsideSchedules.created'=>'DESC', 'WorkOutsideSchedules.status'=>'ASC']
					]);
				}else{
			        $wosRequests = $this->WorkOutsideSchedules->find('all', [
						'conditions' => ['WorkOutsideSchedules.request_type'=>2, 'OR'=>['WorkOutsideSchedules.user_id' => $user['id'], 'WorkOutsideSchedules.department_id' => $get_user->department_access]],
			            'contain' => ['Departments', 'Users'],
						'order' => ['WorkOutsideSchedules.created'=>'DESC', 'WorkOutsideSchedules.status'=>'ASC']
					]);
				}
			}else{
		        $wosRequests = $this->WorkOutsideSchedules->find('all', [
					'conditions' => ['WorkOutsideSchedules.request_type'=>2, 'OR'=>['WorkOutsideSchedules.user_id' => $user['id'], 'WorkOutsideSchedules.department_id' => $get_user->department_access]],
		            'contain' => ['Departments', 'Users'],
					'order' => ['WorkOutsideSchedules.created'=>'DESC', 'WorkOutsideSchedules.status'=>'ASC']
				]);
			}
		}else{
	        $wosRequests = $this->WorkOutsideSchedules->find('all', [
				'conditions' => ['WorkOutsideSchedules.user_id' => $user['id'], 'WorkOutsideSchedules.request_type'=>2],
	            'contain' => ['Departments', 'Users'],
				'order' => ['WorkOutsideSchedules.created'=>'DESC', 'WorkOutsideSchedules.status'=>'DESC']
			]);
		}
		
		$check_request = $this->WorkOutsideSchedules->find('all', [
			'conditions' => ['WorkOutsideSchedules.user_id' => $get_user->id, 'WorkOutsideSchedules.status' => 1, 'WorkOutsideSchedules.request_type'=>1],
		]);
		
		$check_request = $check_request->toArray();
		
		if(!empty($department_details)){
			$department_details_ch = $department_details->toArray();
		}

        $this->set(compact('wosRequests', 'check_request', 'department_member', 'department_details', 'department_details_ch', 'current_department', 'check_request_admin'));
        $this->set('_serialize', ['wosRequests']);
    }

    /**
     * View method
     *
     * @param string|null $id Work Outside Schedule id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
		$user_table = TableRegistry::get('Users');
        $workOutsideSchedule = $this->WorkOutsideSchedules->get($id, [
            'contain' => ['Users']
        ]);
		
		$users = TableRegistry::get('Users');
		$recommended = $users->find('all')->where(['Users.id'=>$workOutsideSchedule->department_head])->first();
		$approve = $users->find('all')->where(['Users.id'=>$workOutsideSchedule->approved_by])->first();
		
		$department_members = TableRegistry::get('DepartmentsMembers');
		$department_details = $department_members->find('all')->where(['DepartmentsMembers.user_id' => $workOutsideSchedule->user_id])->contain(['Users', 'Departments'])->first();

        $this->set('workOutsideSchedule', $workOutsideSchedule);
        $this->set('_serialize', ['workOutsideSchedule']);
		$this->set(compact('recommended', 'approve', 'department_details'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
		$user = $this->Auth->user();
		$user_table = TableRegistry::get('Users');		
		$get_user = $user_table->find('all')->where(['Users.id' => $user['id']])->first();
		
        $workOutsideSchedule = $this->WorkOutsideSchedules->newEntity();
        if ($this->request->is('post')) {
            $workOutsideSchedule = $this->WorkOutsideSchedules->patchEntity($workOutsideSchedule, $this->request->getData());
            if ($result = $this->WorkOutsideSchedules->save($workOutsideSchedule)) {
                $this->Flash->success(__('The work outside schedule has been submitted.'));
				$this->Log->write('info', 'Work Outside Schedule', $user['first_name'].' '.$user['last_name'].' requested for work outside schedule ', [], ['request' => true], $result->id, $get_user->department_access);
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The work outside schedule could not be submitted. Please, try again.'));
        }
        $users = $this->WorkOutsideSchedules->Users->find('list');
		
		$check_request = $this->WorkOutsideSchedules->find('all', [
			'conditions' => ['WorkOutsideSchedules.user_id' => $user['id'], 'WorkOutsideSchedules.status' => 1],
		]);
		
		$check_request = $check_request->toArray();
				
        $this->set(compact('workOutsideSchedule', 'users', 'check_request', 'get_user'));
        $this->set('_serialize', ['workOutsideSchedule']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Work Outside Schedule id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
		$user = $this->Auth->user();
		
        $workOutsideSchedule = $this->WorkOutsideSchedules->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $workOutsideSchedule = $this->WorkOutsideSchedules->patchEntity($workOutsideSchedule, $this->request->getData());
            if ($this->WorkOutsideSchedules->save($workOutsideSchedule)) {
                $this->Flash->success(__('The work outside schedule has been edited.'));
				$this->Log->write('info', 'Work Outside Schedule', $user['first_name'].' '.$user['last_name'].' requested for work outside schedule ', [], ['request' => true], $workOutsideSchedule->id, $workOutsideSchedule->department_id);
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The work outside schedule could not be saved. Please, try again.'));
        }
        $users = $this->WorkOutsideSchedules->Users->find('list', ['limit' => 200]);
        $this->set(compact('workOutsideSchedule', 'users'));
        $this->set('_serialize', ['workOutsideSchedule']);
    }
	
    public function approved($id = null)
    {
		$user = $this->Auth->user();
		$department_members = TableRegistry::get('DepartmentsMembers');
		$requestHandlers = TableRegistry::get('RequestHandlers');
		$users = TableRegistry::get('Users');
		
        $workOutsideSchedule = $this->WorkOutsideSchedules->get($id, [
            'contain' => ['Users']
        ]);
			
		$get_user = $users->find('all')->where(['Users.id' => $user['id']])->first();
				
		$check_request_admin = $requestHandlers->find('all')->where(['RequestHandlers.department_id' => $get_user->department_access, 'RequestHandlers.request_forms_id' => 1])->contain(['Departments'])->first();
		
		$recommended = $users->find('all')->where(['Users.id'=>$workOutsideSchedule->department_head])->first();
		$approve = $users->find('all')->where(['Users.id'=>$workOutsideSchedule->approved_by])->first();
		
		//pr($check_request_admin);
		
        if ($this->request->is(['patch', 'post', 'put'])) {
            $workOutsideSchedule = $this->WorkOutsideSchedules->patchEntity($workOutsideSchedule, $this->request->getData());
            if ($this->WorkOutsideSchedules->save($workOutsideSchedule)) {
                $this->Flash->success(__('Work outside schedule request has been recommended.'));
				if($this->request->getData('status') == 2){
					
					$this->Log->write('info', 'Work outside schedule', $user['first_name'].' '.$user['last_name'].' recommended '.$workOutsideSchedule->type.' for '.$workOutsideSchedule->user->name, [], ['request' => true], $workOutsideSchedule->id, $get_user->department_access);
					
				}elseif($this->request->getData('status') == 3 || $this->request->getData('status') == 4){
					$email = new Email('default');
					$link =  Router::url(['controller' => 'Requests', 'action' => 'view', $workOutsideSchedule->id, 'department'=>$workOutsideSchedule->department_id], true);
					
					try{
					  	$email->from(['info@eogportal.com' => 'Ebony Oil & Gas Portal::Requests'])
						    ->to($workOutsideSchedule->user->email)
						    ->subject('Work Outside Schedule')
							->emailFormat('html')
							->send($user['first_name'].' '.$user['last_name'].' has approved your work outside work schedule request<br />'
								.'<a href="'.$link.'">Click here to view</a>'); 
					} catch (Exception $e) {
			            echo 'Exception : ',  $e->getMessage(), "\n";
			        }
				}elseif($this->request->getData('status') == 5){
					$email = new Email('default');
					$link =  Router::url(['controller' => 'Requests', 'action' => 'view', $workOutsideSchedule->id, 'department'=>$workOutsideSchedule->department_id], true);
					
					try{
					  	$email->from(['info@eogportal.com' => 'Ebony Oil & Gas Portal::Requests'])
						    ->to($workOutsideSchedule->user->email)
						    ->subject('Work Outside Schedule')
							->emailFormat('html')
							->send($user['first_name'].' '.$user['last_name'].' has declined your work outside work schedule request<br />'
								.'<a href="'.$link.'">Click here to view</a>'); 
					} catch (Exception $e) {
			            echo 'Exception : ',  $e->getMessage(), "\n";
			        }
				}
				
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Work outside schedule could not be recommended. Please, try again.'));
        }
		
        $department_member = $department_members->find('all')->where(['DepartmentsMembers.user_id'=>$user['id']])->contain(['Users', 'Departments'])->first();
		
		$check_request = $this->WorkOutsideSchedules->find('all', [
			'conditions' => ['WorkOutsideSchedules.user_id' => $user['id'], 'OR' => ['WorkOutsideSchedules.status' => 2, 'WorkOutsideSchedules.status' => 3]],
		]);
		
		$check_request = $check_request->toArray();
		
        $this->set(compact('workOutsideSchedule', 'users', 'department_member', 'check_request', 'relieve', 'recommended', 'approve'));
        $this->set('_serialize', ['workOutsideSchedule']);
        
    }

    /**
     * Delete method
     *
     * @param string|null $id Work Outside Schedule id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $workOutsideSchedule = $this->WorkOutsideSchedules->get($id);
        if ($this->WorkOutsideSchedules->delete($workOutsideSchedule)) {
            $this->Flash->success(__('Work outside schedule has been deleted.'));
        } else {
            $this->Flash->error(__('Work outside schedule could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
	
	public function setStatus($id = null, $status = null)
	{
		$userA = $this->Auth->user();
	    $this->request->allowMethod(['post']);
	    $cashRequest = $this->WorkOutsideSchedules->get($id);
		$lrequest = $this->WorkOutsideSchedules->newEntity();
		$lrequest->id = $id;
		$lrequest->status = $status;
			
	    if ($this->WorkOutsideSchedules->save($lrequest)) {
			if($status == 4){
				$this->Flash->success(__('Work outside schedule request has been cancelled.'));
			}
		
			if($status == 1){
				$this->Flash->success(__('Work outside schedule request has been re-activated.'));
			}
	    } else {
	        $this->Flash->error(__('Work outside schedule request could not be deleted. Please, try again.'));
	    }

	    return $this->redirect(['action' => 'index']);
	}
}
