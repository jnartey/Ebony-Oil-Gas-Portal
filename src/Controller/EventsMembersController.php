<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Mailer\Email;

/**
 * EventsMembers Controller
 *
 * @property \App\Model\Table\EventsMembersTable $EventsMembers
 *
 * @method \App\Model\Entity\EventsMember[] paginate($object = null, array $settings = [])
 */
class EventsMembersController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Events', 'Users']
        ];
        $eventsMembers = $this->paginate($this->EventsMembers);

        $this->set(compact('eventsMembers'));
        $this->set('_serialize', ['eventsMembers']);
    }

    /**
     * View method
     *
     * @param string|null $id Events Member id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $eventsMember = $this->EventsMembers->get($id, [
            'contain' => ['Events', 'Users']
        ]);

        $this->set('eventsMember', $eventsMember);
        $this->set('_serialize', ['eventsMember']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
		$userA = $this->Auth->user();
        $eventsMember = $this->EventsMembers->newEntity();
        if ($this->request->is('post')) {
			$staff = TableRegistry::get('Users');
			$eMember = $staff->get($this->request->getData('user_id'));
			
            $eventsMember = $this->EventsMembers->patchEntity($eventsMember, $this->request->getData());
			
            if ($this->EventsMembers->save($eventsMember)) {
                $this->Flash->success(__('The events member has been saved.'));
				$this->Log->write('info', 'Event', $userA['first_name'].' '.$userA['last_name'].' added '.$eMember->name, [], ['request' => true], $this->request->getData('user_id'));	
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The events member could not be saved. Please, try again.'));
        }
        $events = $this->EventsMembers->Events->find('list', ['limit' => 200]);
        $users = $this->EventsMembers->Users->find('list', ['limit' => 200]);
        $this->set(compact('eventsMember', 'events', 'users'));
        $this->set('_serialize', ['eventsMember']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Events Member id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
		$userA = $this->Auth->user();
        $eventsMember = $this->EventsMembers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
			$staff = TableRegistry::get('Users');
			$eMember = $staff->get($this->request->getData('user_id'));
			
            $eventsMember = $this->EventsMembers->patchEntity($eventsMember, $this->request->getData());
            if ($this->EventsMembers->save($eventsMember)) {
				$this->Log->write('info', 'Event', $userA['first_name'].' '.$userA['last_name'].' edited '.$eMember->name, [], ['request' => true], $this->request->getData('user_id'));
				
                $this->Flash->success(__('The events member has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The events member could not be saved. Please, try again.'));
        }
        $events = $this->EventsMembers->Events->find('list', ['limit' => 200]);
        $users = $this->EventsMembers->Users->find('list', ['limit' => 200]);
        $this->set(compact('eventsMember', 'events', 'users'));
        $this->set('_serialize', ['eventsMember']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Events Member id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null, $event_id = null)
    {
		$userA = $this->Auth->user();
        $this->request->allowMethod(['post', 'delete']);
        $eventsMember = $this->EventsMembers->get($id, ['contain' => ['Users']]);
        if ($this->EventsMembers->delete($eventsMember)) {
			$this->Log->write('info', 'Event', $userA['first_name'].' '.$userA['last_name'].' deleted '.$eventsMember->user->name, [], ['request' => true], $eventsMember->user_id);
            $this->Flash->success(__($eventsMember->user->name.' has been deleted.'));
        } else {
            $this->Flash->error(__($$eventsMember->user->name.' could not be deleted. Please, try again.'));
        }
		
		if($event_id){
			return $this->redirect(['controller'=>'Events', 'action' => 'view', $event_id]);
		}else{
			return $this->redirect(['action' => 'index']);
		}
    }
}
