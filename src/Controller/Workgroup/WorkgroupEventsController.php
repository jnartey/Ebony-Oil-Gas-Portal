<?php
namespace App\Controller\Workgroup;
use App\Controller\Workgroup\AppController;
use Cake\ORM\TableRegistry;
use Cake\Mailer\Email;
use Cake\Routing\Router;
/**
 * WorkgroupEvents Controller
 *
 * @property \App\Model\Table\WorkgroupEventsTable $WorkgroupEvents
 *
 * @method \App\Model\Entity\WorkgroupEvent[] paginate($object = null, array $settings = [])
 */

class WorkgroupEventsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
  	
    public function index()
    {
		$user = $this->Auth->user();
		$user_table = TableRegistry::get('Users');		
		$get_user = $user_table->find('all')->where(['Users.id' => $user['id']])->first();

		$workgroup_details = $workgroup->find('all', [
		    'conditions' => ['Workgroups.id' => $get_user->workgroup_access],
		]);
		
		$workgroup_details = $workgroup_details->first();
		
        $events = $this->WorkgroupEvents->find('all', [
			'conditions' => ['WorkgroupEvents.workgroup_id' => $get_user->workgroup_access],
            'limit' => 10
		]);
				
			
		$projects_table = TableRegistry::get('WorkgroupProjects');
	
		$userID = $user['id'];
		
        $all_events = $this->WorkgroupEvents->find('all', [
			'conditions' => ['WorkgroupEvents.workgroup_id' => $get_user->workgroup_access],
			'contain' => ['WorkgroupEventMembers']
		]);
				
		$birthdays = $user_table->find('all', [
			'conditions' => [],
		]);
	
		$projects = $projects_table->find('all', [
			'conditions' => ['WorkgroupProjects.workgroup_id' => $get_user->workgroup_access],
			'contain' => ['WorkgroupProjectMembers']
		]);
		
        $this->set(compact('events', 'workgroup_details', 'all_events', 'my_events', 'userID', 'birthdays', 'projects'));
				
        $this->set('_serialize', ['events']);
    }
	
    public function events()
    {
		$user = $this->Auth->user();
		$user_table = TableRegistry::get('Users');	
		$workgroup = TableRegistry::get('Workgroups');	
		$get_user = $user_table->find('all')->where(['Users.id' => $user['id']])->first();
		
		$workgroup_details = $workgroup->find('all', [
		    'conditions' => ['Workgroups.id' => $get_user->workgroup_access],
		]);
		
		$workgroup_details = $workgroup_details->first();
		
		$this->paginate = [
			'conditions' => ['WorkgroupEvents.workgroup_id' => $get_user->workgroup_access],
		    'contain' => ['WorkgroupEventMembers'],
			'limit' => 24
		];
		
        $events = $this->paginate($this->WorkgroupEvents);
				
        $this->set(compact('events', 'workgroup_details'));
        $this->set('_serialize', ['events']);
    }
	
    public function myEvents()
    {
		$user = $this->Auth->user();
		$user_table = TableRegistry::get('Users');	
		$workgroup = TableRegistry::get('Workgroups');	
		$get_user = $user_table->find('all')->where(['Users.id' => $user['id']])->first();
		
		$workgroup_details = $workgroup->find('all', [
		    'conditions' => ['Workgroups.id' => $get_user->workgroup_access],
		]);
		
		$workgroup_details = $workgroup_details->first();
					
		if($user){
			$events = $this->paginate($this->WorkgroupEvents, ['conditions'=>['WorkgroupEvents.user_id'=>$user['id'], 'WorkgroupEvents.workgroup_id' => $get_user->workgroup_access], 'limit' => 24]);
	        $this->set(compact('events', 'workgroup_details'));
	        $this->set('_serialize', ['events']);
		}
    }

    /**
     * View method
     *
     * @param string|null $id Event id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $event = $this->WorkgroupEvents->get($id, [
            'contain' => []
        ]);
			
		$events_members = TableRegistry::get('WorkgroupEventMembers');
		$users = TableRegistry::get('Users');
		
		
		$eventsMember = $events_members->newEntity();
	
		$user = $this->Auth->user();
		$user_table = TableRegistry::get('Users');	
		$workgroup = TableRegistry::get('Workgroups');	
		$get_user = $users->find('all')->where(['Users.id' => $user['id']])->first();
		
		$workgroup_details = $workgroup->find('all', [
		    'conditions' => ['Workgroups.id' => $get_user->workgroup_access],
		]);
		
		$workgroup_details = $workgroup_details->first();
			
		$check_user = $events_members->find('all')->where(['WorkgroupEventMembers.user_id' => $user['id'], 'WorkgroupEventMembers.event_id' => $event->id])->contain(['Users'])->first();
		
		$registered = $events_members->find('all')->where(['WorkgroupEventMembers.event_id' => $event->id])->contain(['Users']);
			
		$check_register = false;
	
		if(!empty($check_user)){
			if($check_user->user_id == $user['id']){
				$check_register = true;
			}
		}

        $this->set('event', $event);
		$this->set('check_register', $check_register);
		$this->set('check_user', $check_user);
		$this->set('eventsMember', $eventsMember);
		$this->set('registered', $registered);
		$this->set('workgroup_details', $workgroup_details);
        $this->set('_serialize', ['event']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
		$user = $this->Auth->user();
		$user_table = TableRegistry::get('Users');	
		$workgroup = TableRegistry::get('Workgroups');	
		$get_user = $user_table->find('all')->where(['Users.id' => $user['id']])->first();
		
		$workgroup_details = $workgroup->find('all', [
		    'conditions' => ['Workgroups.id' => $get_user->workgroup_access],
		]);
		
		$workgroup_details = $workgroup_details->first();
		
		$workgroup_members = TableRegistry::get('WorkgroupsMembers');
		
        $event = $this->WorkgroupEvents->newEntity();
        if ($this->request->is('post')) {
            $event = $this->WorkgroupEvents->patchEntity($event, $this->request->getData());
			$event->workgroup_id = $get_user->workgroup_access;
			
			$e_members = $workgroup_members->find('all', [
				'conditions' => ['WorkgroupsMembers.workgroup_id'=>$get_user->workgroup_access],
			    'contain' => ['Users']
			]);
				
			$e_member_array = $e_members->toArray();
			
            if ($result = $this->WorkgroupEvents->save($event)) {
                $this->Flash->success(__($this->request->getData('name').' has been added.'));
				$this->Log->write('info', 'Event', $user['first_name'].' '.$user['last_name'].' added '.$this->request->getData('name'), [], ['request' => true], $result->id, null, $get_user->workgroup_access);
				
				$recipients = array();
				
				if($e_member_array){
					$email = new Email('default');
					foreach($e_members as $e_member) {
					    $recipients[] = $e_member->user->email;
					}
					
					$link =  Router::url(['controller' => 'WorkgroupEvents', 'action' => 'view', $event->id, 'workgroup'=>$event->department_id], true);
					
					try{
						$email->from(['info@eogportal.com' => 'Ebony Oil & Gas Portal::Events'])
						    ->to($recipients)
						    ->subject($event->name)
						    ->send($user['first_name'].' '.$user['last_name'].' added '.$event->name.'<a href="'.$link.'">Click here to view</a>');
						
					} catch (Exception $e) {
			            echo 'Exception : ',  $e->getMessage(), "\n";
			        }
				}
				
                return $this->redirect(['action' => 'events']);
            }
            $this->Flash->error(__($this->request->getData('name').' could not be saved. Please, try again.'));
        }
        $this->set(compact('event', 'workgroup_details'));
        $this->set('_serialize', ['event']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Event id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $event = $this->WorkgroupEvents->get($id, [
            'contain' => []
        ]);
			
		$user = $this->Auth->user();
		$user_table = TableRegistry::get('Users');	
		$workgroup = TableRegistry::get('Workgroups');	
		$get_user = $user_table->find('all')->where(['Users.id' => $user['id']])->first();
	
		$workgroup_details = $workgroup->find('all', [
		    'conditions' => ['Workgroups.id' => $get_user->workgroup_access],
		]);
	
		$workgroup_details = $workgroup_details->first();
		
		$events_members = TableRegistry::get('WorkgroupEventMembers');
		$e_members = $events_members->find('all', [
			'conditions' => ['WorkgroupEventMembers.event_id'=>$id],
		    'contain' => ['Users']
		]);
			
		$e_member_array = $e_members->toArray();
			
		if($user['id'] == $event->user_id){
	        if ($this->request->is(['patch', 'post', 'put'])) {
	            $event = $this->WorkgroupEvents->patchEntity($event, $this->request->getData());
	            if ($this->WorkgroupEvents->save($event)) {
	                $this->Flash->success(__($event->name.' has been saved.'));
					$this->Log->write('info', 'Event', $user['first_name'].' '.$user['last_name'].' edited '.$this->request->getData('name'), [], ['request' => true], $event->id, null, $get_user->workgroup_access);
					
					$recipients = array();
					
					if($e_member_array){
						$email = new Email('default');
						foreach($e_members as $e_member) {
						    $recipients[] = $e_member->user->email;
						}
						
						$link =  Router::url(['controller' => 'WorkgroupEvents', 'action' => 'view', $event->id, 'workgroup'=>$event->workgroup_id], true);
						
						try{
							$email->from(['info@eogportal.com' => 'Ebony Oil & Gas Portal::Events'])
							    ->to($recipients)
							    ->subject($event->name)
							    ->send($user['first_name'].' '.$user['last_name'].' updated '.$event->name.'<a href="'.$link.'">Click here to view</a>');
							
						} catch (Exception $e) {
				            echo 'Exception : ',  $e->getMessage(), "\n";
				        }
					}
					
	                return $this->redirect(['action' => 'events']);
	            }
	            $this->Flash->error(__($event->name.' could not be saved. Please, try again.'));
	        }
	        $this->set(compact('event'));
	        $this->set('_serialize', ['event']);
		}else{
			return $this->redirect(['action' => 'events']);
		}
    }
	
    public function register()
    {
		$user = $this->Auth->user();
		$user_table = TableRegistry::get('Users');	
		$workgroup = TableRegistry::get('Workgroups');	
		$get_user = $user_table->find('all')->where(['Users.id' => $user['id']])->first();
		
		$workgroup_details = $workgroup->find('all', [
		    'conditions' => ['Workgroups.id' => $get_user->workgroup_access],
		]);
		
		$workgroup_details = $workgroup_details->first();
		$events_members = TableRegistry::get('WorkgroupEventMembers');
        $eventsMember = $events_members->newEntity();
        if ($this->request->is('post')) {
            $event = $events_members->patchEntity($eventsMember, $this->request->getData());
			$event->event_id = $this->request->getData('event_id');
			$event->user_id = $this->request->getData('user_id');
	        $registered_event = $this->WorkgroupEvents->get($this->request->getData('event_id'), [
	            'contain' => ['Users']
	        ]);
			$event->workgroup_id = $registered_event->workgroup_id;
			
			if($this->request->getData('id')){
				$event->id = $this->request->getData('id');
			}
			
			//debug($workgroups_members->save($workgroup));
            if ($events_members->save($event)) {
                $this->Flash->success(__('You have registered for this event '.$registered_event->name));
				$this->Log->write('info', 'Event', $user['first_name'].' '.$user['last_name'].' is attending this event - '.$registered_event->name, [], ['request' => true], $registered_event->id, null, $registered_event->workgroup_id);	
				
				$email = new Email('default');
				$email->from(['info@eogportal.com' => 'Ebony Oil & Gas Portal::Events'])
				    ->to($registered_event->user->email)
				    ->subject($registered_event->name)
				    ->send($user['first_name'].' '.$user['last_name'].' is attending this event - '.$registered_event->name);

                return $this->redirect(['action' => 'view', $registered_event->id]);
            }
            $this->Flash->error(__('Unable to join this event '.$registered_event->name.'. Please, try again.'));
			return $this->redirect(['action' => 'view', $registered_event->id]);
        }
        $this->set(compact('$eventsMember', 'workgroup_details'));
        $this->set('_serialize', ['$eventsMember']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Event id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
		$user = $this->Auth->user();
		$event_members = TableRegistry::get('WorkgroupEventMembers');
		$e_members = $events_members->find('all', [
			'conditions' => ['WorkgroupEventMembers.event_id'=>$id],
		    'contain' => ['Users']
		]);
			
		$e_member_array = $e_members->toArray();
		
        $this->request->allowMethod(['post', 'delete']);
        $event = $this->WorkgroupEvents->get($id);
        if ($this->WorkgroupEvents->delete($event)) {
			$event_members->deleteAll([
			    'WorkgroupEventMembers.event_id' => $event->id
			]);
				
			$this->Log->write('info', 'Event', $user['first_name'].' '.$user['last_name'].' deleted '.$event->name, [], ['request' => true], $event->id, null, $event->workgroup_id);	
			
			$recipients = array();
			
			if($e_member_array){
				$email = new Email('default');
				foreach($e_members as $e_member) {
				    $recipients[] = $e_member->user->email;
				}
				
				$email->from(['info@eogportal.com' => 'Ebony Oil & Gas Portal::Events'])
				    ->to($recipients)
				    ->subject($event->name)
				    ->send($user['first_name'].' '.$user['last_name'].' deleted '.$event->name);
			}
			
            $this->Flash->success(__($event->name.' has been deleted.'));
        } else {
            $this->Flash->error(__($event->name.' could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'events']);
    }
}
