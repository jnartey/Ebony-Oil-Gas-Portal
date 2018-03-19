<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;
use Cake\Event\Event;

/**
 * Messages Controller
 *
 * @property \App\Model\Table\MessagesTable $Messages
 */
class MessagesController extends AppController
{
	public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Security');
    }
	
    public function beforeFilter(Event $event)
    {		
		$this->Security->setConfig('unlockedActions', ['chatHeartbeat', 'chatBoxSession', 'startChatSession', 'sendChat', 'closeChat', 'index']);
		
		$session = $this->request->session();
		
		$chathistory = $session->read('chatHistory');
		$openChatBoxes = $session->read('openChatBoxes');
		
		if(!isset($chathistory)) {
			$session->write('chatHistory', array());
		}

		if(!isset($openChatBoxes)) {
			$session->write('openChatBoxes', array());
		}
	}
	
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
		
		if ($_GET['action'] == "chatheartbeat") { $this->chatHeartbeat(); } 
		if ($_GET['action'] == "sendchat") { $this->sendChat(); } 
		if ($_GET['action'] == "closechat") { $this->closeChat(); } 
		if ($_GET['action'] == "startchatsession") { $this->startChatSession(); } 
		
        $messages = $this->paginate($this->Messages);

        $this->set(compact('messages'));
        $this->set('_serialize', ['messages']);
    }
	
	public function chatHeartbeat() {
		$session = $this->request->session();
		
		$user = $this->Auth->user();
		$messages = $this->Messages->find('all', ['conditions'=>['Messages.chat_to'=>$user['username'], 'Messages.recd'=>0], 'order'=>['Messages.id'=>'ASC']]);
		
		$messages_ch = $messages->toArray();
				
		$items = '';

		$chatBoxes = array();
		
		//if(!empty($messages_ch)){
			foreach($messages as $message):
				
				$chathistory = $session->read('chatHistory.'.$message->chat_from);
				$openChatBoxes = $session->read('openChatBoxes.'.$message->chat_from);
				
				if (!isset($openChatBoxes) && isset($chathistory)) {
					$items = $session->read('chatHistory.'.$message->chat_from);
				}
							
				$message->message = $this->sanitize($message->message);
			
				$items .= '{"s":"0","f":"{'.$message->chat_from.'}","m":"{'.$message->message.'}"}, ';
				//$items = json_encode($items);
				
				if (!isset($chathistory)) {
					$session->write('chatHistory.'.$message->chat_from, '');
				}
			
				$session->write('chatHistory.'.$message->chat_from, '{"s":"0","f":"{'.$message->chat_from.'}","m":"{'.$message->message.'}"}, ');

				$session->consume('tsChatBoxes.'.$message->chat_from);
				$session->write('openChatBoxes.'.$message->chat_from, $message->created);
			
			endforeach;
			
			$openchatboxes = $session->read('openChatBoxes');
			
			if(!empty($openchatboxes)) {
				foreach ($openchatboxes as $chatbox => $time) {
					$tsChatBoxes = $session->read('tsChatBoxes.'.$chatbox);
					if (!isset($tsChatBoxes)) {
						$now = time() - strtotime($time);
						$time = date('g:iA M dS', strtotime($time));

						$message = "Sent at ".$time;
						if ($now > 180) {
							$items .= '{"s":"2","f":"'.$chatbox.'","m":"{'.$message.'}"}, ';
							//$items = json_encode($items);
							
							$chathistory = $session->read('chatHistory.'.$chatbox);
							
							if (!isset($chathistory)) {
								$session->write('chatHistory.'.$chatbox, '');
							}

							$session->write('chatHistory.'.$chatbox, '{"s":"2","f":"'.$chatbox.'","m":"{'.$message.'}"}, ');
							$session->write('tsChatBoxes.'.$chatbox, 1);
						}
					}
				}
			}
			//}
		
		$col_message = $this->Messages->find('all')->where(['Messages.chat_to'=>$user['username']])->first();
		$message_q = $this->Messages->newEntity();
		
		$message_q->id = $col_message->id;
		$message_q->recd = 1;
		
		$this->Messages->save($message_q);

		if ($items != '') {
			$items = substr($items, 0, -1);
		}
		
		header('Content-type: application/json');
	?>
	{
			"items": [
				<?php echo $items;?>
	        ]
	}

	<?php
				exit(0);
	}
	
	public function chatBoxSession($chatbox) {
		$session = $this->request->session();
		$items = '';
		
		$chathistory = $session->read('chatHistory.'.$chatbox);
		
		if (isset($chathistory)) {
			$items = $chathistory;
		}
		
		return $items;
	}

	public function startChatSession() {
		$user = $this->Auth->user();
		$session = $this->request->session();
		$items = '';
		
		$openchatboxes = $session->read('openChatBoxes');
				
		if (!empty($openchatboxes)) {
			foreach ($openchatboxes as $chatbox => $void) {
				$items .= $this->chatBoxSession($chatbox);
			}
		}


		if ($items != '') {
			$items = substr($items, 0, -1);
		}
		
		
	header('Content-type: application/json');
	?>
	{
			"username": "<?php echo $user['username'];?>",
			"items": [
				<?php echo $items;?>
	        ]
	}

	<?php


		exit(0);
	}

	public function sendChat() {
		$user = $this->Auth->user();
		$session = $this->request->session();
		$from = $user['username'];
		$to = $_GET['to'];
		$message = $_GET['message'];
		
		$session->write('openChatBoxes.'.$_GET['to'], date('Y-m-d H:i:s', time()));
	
		$messagesan = $this->sanitize($message);
		
		$chathistory = $session->read('chatHistory.'.$_GET['to']);
		
		if (!isset($chathistory)) {
			$session->write('chatHistory.'.$_GET['to'], '');
		}
		
		$session->write('chatHistory.'.$_GET['to'], '{"s":"1","f":"{'.$to.'}","m":"{'.$messagesan.'}"}, ');

		$session->consume('tsChatBoxes.'.$_GET['to']);
		
		$message_q = $this->Messages->newEntity();
		$message_q->chat_from = $from;
		$message_q->chat_to = $to;
		$message_q->message = $message;
		
		$this->Messages->save($message_q);
		
		echo "1";
		exit(0);
	}

	public function closeChat() {
		$session = $this->request->session();
		$session->consume('openChatBoxes.'.$_GET['chatbox']);
	
		echo "1";
		exit(0);
	}
	
	public function sanitize($text) {
		$text = htmlspecialchars($text, ENT_QUOTES);
		$text = str_replace("\n\r","\n",$text);
		$text = str_replace("\r\n","\n",$text);
		$text = str_replace("\n","<br>",$text);
		return $text;
	}

    /**
     * View method
     *
     * @param string|null $id Im Message id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $message = $this->Messages->get($id, [
            'contain' => []
        ]);

        $this->set('message', $message);
        $this->set('_serialize', ['message']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $message = $this->Messages->newEntity();
        if ($this->request->is('post')) {
            $message = $this->Messages->patchEntity($message, $this->request->getData());
            if ($this->Messages->save($message)) {
                $this->Flash->success(__('The im message has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The im message could not be saved. Please, try again.'));
        }
        $this->set(compact('message'));
        $this->set('_serialize', ['message']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Im Message id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $message = $this->Messages->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $message = $this->Messages->patchEntity($message, $this->request->getData());
            if ($this->Messages->save($message)) {
                $this->Flash->success(__('The im message has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The im message could not be saved. Please, try again.'));
        }
        $this->set(compact('message'));
        $this->set('_serialize', ['message']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Im Message id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $message = $this->Messages->get($id);
        if ($this->Messages->delete($message)) {
            $this->Flash->success(__('The im message has been deleted.'));
        } else {
            $this->Flash->error(__('The im message could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
