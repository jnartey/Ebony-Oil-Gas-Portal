<?php
namespace App\Controller\Department;
use App\Controller\Department\AppController;
use Cake\Mailer\Email;
/**
 * DepartmentMessages Controller
 *
 * @property \App\Model\Table\DepartmentMessagesTable $DepartmentMessages
 *
 * @method \App\Model\Entity\DepartmentMessage[] paginate($object = null, array $settings = [])
 */
class DepartmentMessagesController extends AppController
{

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
		
        $messages = $this->paginate($this->DepartmentMessages);

        $this->set(compact('messages'));
        $this->set('_serialize', ['messages']);
    }
	
	public function chatHeartbeat() {
		$session = $this->request->session();
		
		$user = $this->Auth->user();
		$messages = $this->DepartmentMessages->find('all', ['conditions'=>['DepartmentMessages.chat_to'=>$user['username'], 'DepartmentMessages.recd'=>0], 'order'=>['DepartmentMessages.id'=>'ASC']]);
		
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
		
		$col_message = $this->DepartmentMessages->find('all')->where(['DepartmentMessages.chat_to'=>$user['username']])->first();
		$message_q = $this->DepartmentMessages->newEntity();
		
		$message_q->id = $col_message->id;
		$message_q->recd = 1;
		
		$this->DepartmentMessages->save($message_q);

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
		
		$message_q = $this->DepartmentMessages->newEntity();
		$message_q->chat_from = $from;
		$message_q->chat_to = $to;
		$message_q->message = $message;
		
		$this->DepartmentMessages->save($message_q);
		
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
     * @param string|null $id Department Message id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $departmentMessage = $this->DepartmentMessages->get($id, [
            'contain' => ['Departments']
        ]);

        $this->set('departmentMessage', $departmentMessage);
        $this->set('_serialize', ['departmentMessage']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
		$userA = $this->Auth->user();
        $departmentMessage = $this->DepartmentMessages->newEntity();
        if ($this->request->is('post')) {
            $departmentMessage = $this->DepartmentMessages->patchEntity($departmentMessage, $this->request->getData());
            if ($this->DepartmentMessages->save($departmentMessage)) {
                $this->Flash->success(__('The department message has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The department message could not be saved. Please, try again.'));
        }
        $departments = $this->DepartmentMessages->Departments->find('list', ['limit' => 200]);
        $this->set(compact('departmentMessage', 'departments'));
        $this->set('_serialize', ['departmentMessage']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Department Message id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
		$userA = $this->Auth->user();
        $departmentMessage = $this->DepartmentMessages->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $departmentMessage = $this->DepartmentMessages->patchEntity($departmentMessage, $this->request->getData());
            if ($this->DepartmentMessages->save($departmentMessage)) {
                $this->Flash->success(__('The department message has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The department message could not be saved. Please, try again.'));
        }
        $departments = $this->DepartmentMessages->Departments->find('list', ['limit' => 200]);
        $this->set(compact('departmentMessage', 'departments'));
        $this->set('_serialize', ['departmentMessage']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Department Message id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
		$userA = $this->Auth->user();
        $this->request->allowMethod(['post', 'delete']);
        $departmentMessage = $this->DepartmentMessages->get($id);
        if ($this->DepartmentMessages->delete($departmentMessage)) {
            $this->Flash->success(__('The department message has been deleted.'));
        } else {
            $this->Flash->error(__('The department message could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
