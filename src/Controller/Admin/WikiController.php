<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Mailer\Email;

/**
 * Wiki Controller
 *
 * @property \App\Model\Table\WikiTable $Wiki
 */
class WikiController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Departments']
        ];
        $wiki = $this->paginate($this->Wiki);

        $this->set(compact('wiki'));
        $this->set('_serialize', ['wiki']);
    }

    /**
     * View method
     *
     * @param string|null $id Wiki id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $wiki = $this->Wiki->get($id, [
            'contain' => ['Departments']
        ]);

        $this->set('wiki', $wiki);
        $this->set('_serialize', ['wiki']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
		$user = $this->Auth->user();
        $wiki = $this->Wiki->newEntity();
        if ($this->request->is('post')) {
            $wiki = $this->Wiki->patchEntity($wiki, $this->request->getData());
            if ($result = $this->Wiki->save($wiki)) {
				$this->Log->write('info', 'Wiki', $user['first_name'].' '.$user['last_name'].' added '.$this->request->getData('title'), [], ['request' => true], $result->id);
                $this->Flash->success(__('The wiki has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The wiki could not be saved. Please, try again.'));
        }
        $departments = $this->Wiki->Departments->find('list', ['limit' => 200]);
        $this->set(compact('wiki', 'departments'));
        $this->set('_serialize', ['wiki']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Wiki id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
		$user = $this->Auth->user();
        $wiki = $this->Wiki->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $wiki = $this->Wiki->patchEntity($wiki, $this->request->getData());
            if ($this->Wiki->save($wiki)) {
				$this->Log->write('info', 'Wiki', $user['first_name'].' '.$user['last_name'].' edited '.$wiki->title, [], ['request' => true], $wiki->id);
                $this->Flash->success(__('The wiki has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The wiki could not be saved. Please, try again.'));
        }
        $departments = $this->Wiki->Departments->find('list', ['limit' => 200]);
        $this->set(compact('wiki', 'departments'));
        $this->set('_serialize', ['wiki']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Wiki id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
		$user = $this->Auth->user();
        $this->request->allowMethod(['post', 'delete']);
        $wiki = $this->Wiki->get($id);
        if ($this->Wiki->delete($wiki)) {
			$this->Log->write('info', 'Wiki', $user['first_name'].' '.$user['last_name'].' deleted '.$wiki->title, [], ['request' => true], $wiki->id);
            $this->Flash->success(__('The wiki has been deleted.'));
        } else {
            $this->Flash->error(__('The wiki could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
