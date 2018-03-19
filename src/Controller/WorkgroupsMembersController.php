<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Mailer\Email;
use Cake\Routing\Router;

/**
 * WorkgroupsMembers Controller
 *
 * @property \App\Model\Table\WorkgroupsMembersTable $WorkgroupsMembers
 */
class WorkgroupsMembersController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Workgroups', 'Users']
        ];
        $workgroupsMembers = $this->paginate($this->WorkgroupsMembers);

        $this->set(compact('workgroupsMembers'));
        $this->set('_serialize', ['workgroupsMembers']);
    }

    /**
     * View method
     *
     * @param string|null $id Workgroups Member id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $workgroupsMember = $this->WorkgroupsMembers->get($id, [
            'contain' => ['Workgroups', 'Users']
        ]);

        $this->set('workgroupsMember', $workgroupsMember);
        $this->set('_serialize', ['workgroupsMember']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($id = null)
    {
		$workgroups = TableRegistry::get('Workgroups');
		$staff = TableRegistry::get('Users');
		
		$existing_ids = null;
		$user_ids = null;
		$user = $this->Auth->user();
		
		$workgroup = $workgroups->get($id);
				
        $workgroups = $this->WorkgroupsMembers->Workgroups->find('list', []);
        //$users = $this->ProjectsMembers->Users->find('list', ['limit' => 200]);
		$workgroupsMember = $this->WorkgroupsMembers->newEntity();
		
		$i = 1;
		$data_x = array();
		$userIDs = array();
		
		if ($this->request->is('post')) {
					
			foreach($this->request->getData(['user_id']) as $u_ids):
				$data_x[$i]['user_id'] = $u_ids;
				$data_x[$i]['workgroup_id'] = $this->request->getData(['workgroup_id']);
				$i++;
			endforeach;
								
			foreach($this->request->getData(['user_id']) as $u_ids):
				$userIDs[] = $u_ids;
			endforeach;
			
			//pr($data_x);
		
			$members_entities = $this->WorkgroupsMembers->newEntities($data_x);
			
			if($this->WorkgroupsMembers->saveMany($members_entities)){
				$added_members = $staff->find('all', [
				    'conditions' => ['Users.id IN' => $userIDs],
				]);
			
				$d_member_array = $added_members->toArray();
			
				foreach($added_members as $added_member):
					$this->Log->write('info', 'Workgroup', $user['first_name'].' '.$user['last_name'].' added '.$added_member->name.' to workgroup::'.$workgroup->name, [], ['request' => true], $added_member->id);
				endforeach;
			
				$this->Flash->success(__('The workgroup member(s) has been added.'));
			
				if($d_member_array){
					$recipients = array();
					$email = new Email('default');
				
					foreach($added_members as $added_member) {
					    $recipients[] = $added_member->email;
					}
				
					$link =  Router::url(['controller' => 'Workgroups', 'action' => 'view', $workgroup->id, 'workgroup'=>$workgroup->id], true);
				
					try{
					  	$email->from(['info@eogportal.com' => 'Ebony Oil & Gas Portal::Workgroups'])
						    ->to($recipients)
						    ->subject($workgroup->name)
							->emailFormat('html')
							->send($user['first_name'].' '.$user['last_name'].' has added you to a workgroup<br />'
								.'<strong>Workgroup Title: </strong>'.$workgroup->name.'<br />'
								.'<strong>Workgroup Description</strong><br />'.$workgroup->description.'<br />'
								.'<a href="'.$link.'">Click here to view</a>'); 
					} catch (Exception $e) {
			            echo 'Exception : ',  $e->getMessage(), "\n";
			        }
			  	
				}
			
				return $this->redirect(['controller'=>'workgroups', 'action' => 'view', $this->request->getData(['workgroup_id'])]);
			}
		
			$this->Flash->error(__('Workgroup member(s) could not be saved. Please, try again.'));
	    }
	
	    //$projects = $this->DepartmentProjectMembers->DepartmentProjects->find('list', []);
	    //$users = $this->DepartmentProjectMembers->Users->find('list', ['limit' => 200]);
	
		$users_collect = $staff->find('all', [
		    'NOT'=>['Users.id'=>$user['id']]
		]);
	
		foreach($users_collect as $collect):
			$user_ids[] = $collect->user_id;
		endforeach;
	
		$existing_staff = $this->WorkgroupsMembers->find('all', [
		    'conditions' => ['WorkgroupsMembers.workgroup_id' => $workgroup->id]
		]);
	
		foreach($existing_staff as $collect):
			$existing_ids[] = $collect->user_id;
		endforeach;
	
		//$user_ids = implode(',', array_values($user_ids));
	
		if($existing_ids){
			$users = $staff->find('list')->where(['NOT'=>['AND'=>['Users.id IN' => $existing_ids, 'Users.id' => $user['id']]]]);
		}else{
			$users = $staff->find('list')->where(['NOT'=>['AND'=>['Users.id' => $user['id']]]]);
		}
		
		//pr($users->toArray());
		
        $this->set(compact('workgroupsMember', 'workgroups', 'users', 'workgroup'));
        $this->set('_serialize', ['workgroupsMember']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Workgroups Member id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
		$userA = $this->Auth->user();
        $workgroupsMember = $this->WorkgroupsMembers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $workgroupsMember = $this->WorkgroupsMembers->patchEntity($workgroupsMember, $this->request->getData());
            if ($this->WorkgroupsMembers->save($workgroupsMember)) {
                $this->Flash->success(__('The workgroups member has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The workgroups member could not be saved. Please, try again.'));
        }
        $workgroups = $this->WorkgroupsMembers->Workgroups->find('list', ['limit' => 200]);
        $users = $this->WorkgroupsMembers->Users->find('list', ['limit' => 200]);
        $this->set(compact('workgroupsMember', 'workgroups', 'users'));
        $this->set('_serialize', ['workgroupsMember']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Workgroups Member id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
  	
    public function delete($id = null)
    {
		$workgroups = TableRegistry::get('Workgroups');
		
		$user = $this->Auth->user();
        $this->request->allowMethod(['post', 'delete']);
        $workgroupMember = $this->WorkgroupsMembers->get($id, ['contain' => ['Users']]);
		$workgroup = $workgroups->get($workgroupMember->workgroup_id);
		
		$staff = TableRegistry::get('Users');
		
		$get_user = $staff->find('all')->where(['Users.id' => $user['id']])->first();
		
        if ($this->WorkgroupsMembers->delete($workgroupMember)) {
			$this->Log->write('info', 'Workgroups', $user['first_name'].' '.$user['last_name'].' deleted '.$workgroupMember->user->name.' from workgroup::'.$workgroup->name, [], ['request' => true], $workgroupMember->user->id, null, $get_user->workgroup_access);
			
			$email = new Email('default');
			$email->from(['info@eogportal.com' => 'Ebony Oil & Gas Portal::Workgroups'])
			    ->to($workgroupMember->user->email)
			    ->subject('Removal from project')
			    ->send($user['first_name'].' '.$user['last_name'].' has removed you from workgroup::'.$workgroup->name);
			
            $this->Flash->success(__($workgroupMember->user->name.' has been removed.'));
        } else {
            $this->Flash->error(__($workgroupMember->user->name.' could not be deleted. Please, try again.'));
        }

        return $this->redirect(['controller'=>'Workgroups', 'action' => 'view', $workgroupMember->workgroup_id]);
    }
}
