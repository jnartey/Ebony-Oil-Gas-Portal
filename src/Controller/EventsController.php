<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Mailer\Email;
use Cake\Routing\Router;

/**
 * Events Controller
 *
 * @property \App\Model\Table\EventsTable $Events
 */
class EventsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
		$user = $this->Auth->user();
		$users_table = TableRegistry::get('Users');
		
		$userID = $user['id'];
		
        $events = $this->Events->find('all', [
			'conditions' => [],
            'limit' => 10
		]);
			
        $all_events = $this->Events->find('all', [
			'conditions' => [],
			'contain' => ['EventsMembers']
		]);
					
		$birthdays = $users_table->find('all', [
			'conditions' => [],
		]);
		
		$projects = null;
		
		$my_project = null;
		
        $this->set(compact('events', 'all_events', 'my_events', 'userID', 'birthdays'));
        $this->set('_serialize', ['events']);
    }
	
    public function events()
    {
		$this->paginate = [
            'contain' => ['EventsMembers'],
			'limit' => 25
        ];
		
        $events = $this->paginate($this->Events);
		
        $this->set(compact('events'));
        $this->set('_serialize', ['events']);
    }
	
    public function myEvents()
    {
		$user = $this->Auth->user();
		if($user){
			$events = $this->paginate($this->Events, ['conditions'=>['Events.user_id'=>$user['id']]]);
	        $this->set(compact('events'));
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
        $event = $this->Events->get($id, [
            'contain' => []
        ]);
			
		$events_members = TableRegistry::get('EventsMembers');
		$users = TableRegistry::get('Users');
		
		$eventsMember = $events_members->newEntity();
	
		$user = $this->Auth->user();
			
		$check_user = $events_members->find('all')->where(['EventsMembers.user_id' => $user['id'], 'EventsMembers.event_id' => $event->id])->contain(['Users'])->first();
		
		$registered = $events_members->find('all')->where(['EventsMembers.event_id' => $event->id])->contain(['Users']);
			
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
		
		$e_members = $user_table->find('all', []);
			
		$e_member_array = $e_members->toArray();
		
        $event = $this->Events->newEntity();
        if ($this->request->is('post')) {
            $event = $this->Events->patchEntity($event, $this->request->getData());
            if ($result = $this->Events->save($event)) {
				$this->Log->write('info', 'Event', $user['first_name'].' '.$user['last_name'].' added '.$this->request->getData('name'), [], ['request' => true], $result->id);
                $this->Flash->success(__($this->request->getData('name').' has been added.'));
				
				$recipients = array();
				
				if($e_member_array){
					$email = new Email('default');
					foreach($e_members as $e_member) {
					    $recipients[] = $e_member->email;
					}
					
					$link =  Router::url(['controller' => 'Events', 'action' => 'view', $result->id], true);
					
					try{
						$email->from(['info@eogportal.com' => 'Ebony Oil & Gas Portal::Events'])
						    ->to($recipients)
						    ->subject($result->name)
						    ->send($user['first_name'].' '.$user['last_name'].' added '.$result->name.'<a href="'.$link.'">Click here to view</a>');
						
					} catch (Exception $e) {
			            echo 'Exception : ',  $e->getMessage(), "\n";
			        }
				}
				
                return $this->redirect(['action' => 'events']);
            }
            $this->Flash->error(__('The event could not be saved. Please, try again.'));
        }
        $this->set(compact('event'));
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
        $event = $this->Events->get($id, [
            'contain' => ['Users']
        ]);
		
		$events_members = TableRegistry::get('EventsMembers');
		$e_members = $events_members->find('all', [
			'conditions' => ['EventsMembers.event_id'=>$id],
		    'contain' => ['Users']
		]);
			
		$e_member_array = $e_members->toArray();
			
		$user = $this->Auth->user();
		if($user['id'] == $event->user_id){
	        if ($this->request->is(['patch', 'post', 'put'])) {
	            $event = $this->Events->patchEntity($event, $this->request->getData());
	            if ($this->Events->save($event)) {
	                $this->Flash->success(__('The event has been saved.'));
					$this->Log->write('info', 'Event', $user['first_name'].' '.$user['last_name'].' edited '.$this->request->getData('name'), [], ['request' => true]);
					
					if($e_member_array){
						$email = new Email('default');
						foreach($e_members as $e_member) {
						    $mail->addTo($e_member->user->email);
						}
						$email->from(['info@eogportal.com' => 'Ebony Oil & Gas Portal::Events'])
						    //->to('you@example.com')
						    ->subject($event->name)
						    ->send($user['first_name'].' '.$user['last_name'].' edited '.$event->name);
					}
					
	                return $this->redirect(['action' => 'events']);
	            }
	            $this->Flash->error(__('The event could not be saved. Please, try again.'));
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
		$events_members = TableRegistry::get('EventsMembers');
        $eventsMember = $events_members->newEntity();
        if ($this->request->is('post')) {
            $event = $events_members->patchEntity($eventsMember, $this->request->getData());
			$event->event_id = $this->request->getData('event_id');
			$event->user_id = $this->request->getData('user_id');
	        $registered_event = $this->Events->get($this->request->getData('event_id'), [
	            'contain' => ['Users']
	        ]);
				
			if($this->request->getData('id')){
				$event->id = $this->request->getData('id');
			}
			//debug($workgroups_members->save($workgroup));
            if ($events_members->save($event)) {
                $this->Flash->success(__('You have registered for this event '.$registered_event->name));
				$this->Log->write('info', 'Event', $user['first_name'].' '.$user['last_name'].' is attending this event - '.$registered_event->name, [], ['request' => true], $registered_event->id);	
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
        $this->set(compact('$eventsMember'));
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
		$events_members = TableRegistry::get('EventsMembers');
		$e_members = $events_members->find('all', [
			'conditions' => ['EventsMembers.event_id'=>$id],
		    'contain' => ['Users']
		]);
			
		$e_member_array = $e_members->toArray();
		
        $this->request->allowMethod(['post', 'delete']);
        $event = $this->Events->get($id);
        if ($this->Events->delete($event)) {
			$events_members->deleteAll([
			    'EventsMembers.event_id' => $event->id
			]);
			
			if($e_member_array){
				$email = new Email('default');
				foreach($e_members as $e_member) {
				    $mail->addTo($e_member->user->email);
				}
				$email->from(['info@eogportal.com' => 'Ebony Oil & Gas Portal::Events'])
				    //->to('you@example.com')
				    ->subject($event->name)
				    ->send($user['first_name'].' '.$user['last_name'].' edited '.$event->name);
			}
			
			$this->Log->write('info', 'Event', $user['first_name'].' '.$user['last_name'].' deleted '.$event->name, [], ['request' => true], $event->id);	
            $this->Flash->success(__($event->name.' has been deleted.'));
        } else {
            $this->Flash->error(__($event->name.' could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'events']);
    }
}
