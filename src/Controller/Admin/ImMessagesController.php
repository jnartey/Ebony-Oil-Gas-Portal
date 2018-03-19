<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ImMessages Controller
 *
 * @property \App\Model\Table\ImMessagesTable $ImMessages
 */
class ImMessagesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $imMessages = $this->paginate($this->ImMessages);

        $this->set(compact('imMessages'));
        $this->set('_serialize', ['imMessages']);
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
        $imMessage = $this->ImMessages->get($id, [
            'contain' => []
        ]);

        $this->set('imMessage', $imMessage);
        $this->set('_serialize', ['imMessage']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $imMessage = $this->ImMessages->newEntity();
        if ($this->request->is('post')) {
            $imMessage = $this->ImMessages->patchEntity($imMessage, $this->request->getData());
            if ($this->ImMessages->save($imMessage)) {
                $this->Flash->success(__('The im message has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The im message could not be saved. Please, try again.'));
        }
        $this->set(compact('imMessage'));
        $this->set('_serialize', ['imMessage']);
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
        $imMessage = $this->ImMessages->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $imMessage = $this->ImMessages->patchEntity($imMessage, $this->request->getData());
            if ($this->ImMessages->save($imMessage)) {
                $this->Flash->success(__('The im message has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The im message could not be saved. Please, try again.'));
        }
        $this->set(compact('imMessage'));
        $this->set('_serialize', ['imMessage']);
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
        $imMessage = $this->ImMessages->get($id);
        if ($this->ImMessages->delete($imMessage)) {
            $this->Flash->success(__('The im message has been deleted.'));
        } else {
            $this->Flash->error(__('The im message could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
