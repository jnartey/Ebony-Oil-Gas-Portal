<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
use Cake\Mailer\Email;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{
	public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(array('login'));
		
		$actions = [
		    'resetPassword'
		];

		if (in_array($this->request->params['action'], $actions)) {
		    // for csrf
		    $this->eventManager()->off($this->Csrf);

		    // for security component
		    $this->Security->config('unlockedActions', $actions);
		}
    }
	
	public function login()
    {
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if($user) {
                $this->Auth->setUser($user);
				$usersLog = TableRegistry::get('UsersLog');
				$userLog = $usersLog->newEntity();
				$current_user = $this->Users->newEntity();
				
				//pr($user);
				$userLog->user_id = $user['id'];
				$userLog->status = 2;
				//$userLog->isNew(true);
				//$userLog->unsetProperty('id');
				
				$current_user->id = $user['id'];
				$current_user->active = 2;
				
				if($this->Users->save($current_user)){
					$usersLog->save($userLog, ['checkExisting' => true]);
				}
				
				$this->Log->write('info', 'Users', $user['first_name'].' '.$user['last_name'].' logged in', [], ['request' => true]);
				
				//$this->Session->setFlash('You are logged in!');
                return $this->redirect($this->Auth->redirectUrl());
            }
			
            $this->Flash->error(__('Invalid username or password, try again'));
        }
		
		if($this->Auth->user()) {
		 	return $this->redirect(['controller' => 'pages', 'action' => 'index']);
		}
    }

    public function logout()
    {
		$user = $this->Auth->user();
		$usersLog = TableRegistry::get('UsersLog');
		$userLog = $usersLog->newEntity();
		$current_user = $this->Users->newEntity();
		$user_now = $usersLog->find('all')->where(['UsersLog.user_id'=>$user['id']])->order(['UsersLog.created'=>'DESC'])->first();

		$userLog->id = $user_now->id;
		$userLog->status = 1;		
		
		$current_user->id = $user['id'];
		$current_user->active = 1;
		
		if($this->Users->save($current_user)){
			$usersLog->save($userLog, ['checkExisting' => true]);
		}
		
		$this->Log->write('info', 'Users', $user['first_name'].' '.$user['last_name'].' logged out', [], ['request' => true]);
		
		//$this->Session->setFlash('You are logged out!');
        return $this->redirect($this->Auth->logout());
    }
	
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        // $this->paginate = [
//             'contain' => ['Roles']
//         ];
//         $users = $this->paginate($this->Users);

		$users = $this->Users->find('all', [
			'conditions' => ['NOT'=>['Users.id'=>1]],
		    'contain' => ['Roles', 'Departments', 'DepartmentsMembers']
		]);
			
		$current_user = $this->Auth->user();

        $this->set(compact('users', 'current_user'));
        $this->set('_serialize', ['users']);
    }

    public function liveData()
    {
		$users = $this->Users->find('all', [
			'conditions' => ['NOT'=>['Users.id'=>1]],
		    'contain' => ['Roles', 'Departments', 'DepartmentsMembers']
		]);

        $this->set(compact('users'));
        $this->set('_serialize', ['users']);
    }
	
    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['Roles', 'DepartmentsMembers', 'ProjectsMembers', 'WorkgroupsMembers']
        ]);
			
		$roles = $this->Users->Roles->find('list', ['order'=>['Roles.id'=>'DESC'], 'limit' => 200]);

        $this->set('user', $user);
		$this->set('roles', $roles);
        $this->set('_serialize', ['user']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
		$userA = $this->Auth->user();
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($result = $this->Users->save($user)) {
				$this->Log->write('info', 'Users', $userA['first_name'].' '.$userA['last_name'].' added '.$this->request->getData('first_name').' '.$this->request->getData('last_name'), [], ['request' => true], $result->id);
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
		
        $roles = $this->Users->Roles->find('list', ['limit' => 200]);
        $this->set(compact('user', 'roles'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
		$userA = $this->Auth->user();
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
				$this->Log->write('info', 'Users', $userA['first_name'].' '.$userA['last_name'].' updated '.$user->name, [], ['request' => true], $id);
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $roles = $this->Users->Roles->find('list', ['limit' => 200]);
        $this->set(compact('user', 'roles'));
        $this->set('_serialize', ['user']);
    }
	
    public function uploadPhoto($id = null)
    {
		$userA = $this->Auth->user();
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
			//debug($this->Users->save($user));
            if ($this->Users->save($user)) {
				$this->Log->write('info', 'Users', $userA['first_name'].' '.$userA['last_name'].' updated '.$user->name, [], ['request' => true], $id);
				$resultJ = json_encode(array('result' => '<div class="callout success">'.$this->request->data['file_name']['name'].' uploaded successfully.</div>'));
				$this->response->type('json');
				$this->response->body($resultJ);
				return $this->response;

                return $this->redirect(['action' => 'view', $user->id]);
            }
			
			$resultJ = json_encode(array('result' => '<div class="callout error">'.$this->request->data['file_name']['name'].' could not be uploaded. Please, try again..</div>'));
			$this->response->type('json');
			$this->response->body($resultJ);
			return $this->response;
        }
        $roles = $this->Users->Roles->find('list', ['limit' => 200]);
        $this->set(compact('user', 'roles'));
        $this->set('_serialize', ['user']);
    }
	
    public function personalDetails($id = null)
    {
		$userA = $this->Auth->user();
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
				$this->Log->write('info', 'Users', $userA['first_name'].' '.$userA['last_name'].' updated '.$user->name, [], ['request' => true], $id);
				$resultJ = json_encode(array('result' => '<div class="callout success"><span class="fa fa-exclamation-circle"></span> User details has been updated.</div>'));
				$this->response->type('json');
				$this->response->body($resultJ);
				return $this->response;
            }else{
				$resultJ = json_encode(array('result' => '<div class="callout alert"><span class="fa fa-exclamation-circle"></span> User details could not be updated. Please, try again.</div>'));
				$this->response->type('json');
				$this->response->body($resultJ);
				return $this->response;
            }
        }
        $roles = $this->Users->Roles->find('list', ['limit' => 200]);
        $this->set(compact('user', 'roles'));
        $this->set('_serialize', ['user']);
    }
	
	public function changePassword($id=null){ 
		$userA = $this->Auth->user();
		
		if($id){
			$user =$this->Users->get($id); 
		}else{
			$user =$this->Users->get($this->Auth->user('id')); 
		}
		
		if(!empty($this->request->data)){ 
				$user = $this->Users->patchEntity($user, [ 
					'old_password' => $this->request->data['old_password'], 
					'password' => $this->request->data['password1'], 
					'password1' => $this->request->data['password1'], 
					'password2' => $this->request->data['password2'] 
				], 
				['validate' => 'password'] 
			); 
			
			if($this->Users->save($user)){ 
				$this->Log->write('info', 'Users', $userA['first_name'].' '.$userA['last_name'].' changed password for '.$user->name, [], ['request' => true], $user->id);
				$resultJ = json_encode(array('result' => '<div class="callout success"><span class="fa fa-exclamation-circle"></span> Password updated successfully.</div>'));
				$this->response->type('json');
				$this->response->body($resultJ);
				return $this->response;
			}else{ 
				$resultJ = json_encode(array('result' => '<div class="callout alert"><span class="fa fa-exclamation-circle"></span> Password could not be updated. Please, try again.</div>'));
				$this->response->type('json');
				$this->response->body($resultJ);
				return $this->response;
			} 
		} 
		$this->set('user',$user); 
	} /*- See more at: http://base-syst.com/2016/09/16/password-validation-when-changing-password-in-cakephp-3/#sthash.fTB8ejyy.dpuf*/
	
	public function resetPassword($id){ 
		$userA = $this->Auth->user();
		$user =$this->Users->get($id); 
		if(!empty($this->request->data)){ 
				$user = $this->Users->patchEntity($user, [ 
					'password' => $this->request->data['password1'],
					'password1' => $this->request->data['password1'], 
					'password2' => $this->request->data['password1'] 
				], 
				['validate' => 'password'] 
			); 
			
			if($this->Users->save($user)){ 
				$this->Log->write('info', 'Users', $userA['first_name'].' '.$userA['last_name'].' reset password for '.$user->name, [], ['request' => true], $user->id);
				
				$email = new Email('default');
				$email->from(['info@eogportal.com' => 'Ebony Oil & Gas Portal::Events'])
					->emailFormat('html')
				    ->to($user->email)
				    ->subject('Password reset - '.$user->name)
				    ->send('Your new <strong>password:</strong> '.$this->request->data['password1']);
				
				$resultJ = json_encode(array('result' => '<div class="callout success"><span class="fa fa-exclamation-circle"></span> Password updated successfully.</div>'));
				$this->response->type('json');
				$this->response->body($resultJ);
				return $this->response;
			}else{ 
				$resultJ = json_encode(array('result' => '<div class="callout alert"><span class="fa fa-exclamation-circle"></span> Password could not be updated. Please, try again.</div>'));
				$this->response->type('json');
				$this->response->body($resultJ);
				return $this->response;
			} 
		} 
		$this->set('user',$user); 
	}
	
	public function eoy($id = null, $status = null)
    {
        $this->request->allowMethod(['post']);
        $staff = $this->Users->get($id);
		$staff_r = $this->Users->newEntity();
		
		if($this->Users->updateAll(['employee_of_the_year' => 1], ['employee_of_the_year' => 2])){
			
			$staff_r->id = $id;
			$staff_r->employee_of_the_year = $status;
			
	        if ($this->Users->save($staff_r)) {
				if($status == 2){
					$this->Flash->success(__($staff->name.' has been set as employee of the year.'));
				}
			
	        } else {
	            $this->Flash->error(__($staff->name.' request could not be set as employee of the year. Please, try again.'));
	        }
		}

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
  	
    public function delete($id = null)
    {
		$department_project_members = TableRegistry::get('DepartmentProjectMembers');
		$workgroup_project_members = TableRegistry::get('WorkgroupProjectMembers');
		$workgroup_members = TableRegistry::get('WorkgroupsMembers');
		$department_members = TableRegistry::get('DepartmentsMembers');
		$userA = $this->Auth->user();
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
			$department_project_members->deleteAll([
			    'user_id' => $user->id
			]);
			$workgroup_project_members->deleteAll([
			    'user_id' => $user->id
			]);
			$workgroup_members->deleteAll([
			    'user_id' => $user->id
			]);
			$department_members->deleteAll([
			    'user_id' => $user->id
			]);
				
		$this->Flash->success(__($user->name.' has been deleted.'));
        } else {
            $this->Flash->error(__($user->name.' could not be deleted. Please, try again.'));
        }
		
		$this->Log->write('info', 'Users', $userA['first_name'].' '.$userA['last_name'].' changed password for '.$user->name, [], ['request' => true], $id);
        return $this->redirect(['action' => 'index']);
    }
}
