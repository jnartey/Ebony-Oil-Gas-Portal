<?php
namespace App\Controller\Admin;

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
        $events = $this->paginate($this->Events);

        $this->set(compact('events'));
        $this->set('_serialize', ['events']);
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

        $this->set('event', $event);
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
				
                return $this->redirect(['action' => 'index']);
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
					
	                return $this->redirect(['action' => 'index']);
	            }
	            $this->Flash->error(__('The event could not be saved. Please, try again.'));
	        }
	        $this->set(compact('event'));
	        $this->set('_serialize', ['event']);
		}else{
			return $this->redirect(['action' => 'index']);
		}
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

        return $this->redirect(['action' => 'index']);
    }
}
