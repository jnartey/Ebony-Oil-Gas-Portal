<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * UsersLeave Controller
 *
 * @property \App\Model\Table\UsersLeaveTable $UsersLeave
 */
class UsersLeaveController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $usersLeave = $this->paginate($this->UsersLeave);

        $this->set(compact('usersLeave'));
        $this->set('_serialize', ['usersLeave']);
    }

    /**
     * View method
     *
     * @param string|null $id Users Leave id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $usersLeave = $this->UsersLeave->get($id, [
            'contain' => []
        ]);

        $this->set('usersLeave', $usersLeave);
        $this->set('_serialize', ['usersLeave']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $usersLeave = $this->UsersLeave->newEntity();
        if ($this->request->is('post')) {
            $usersLeave = $this->UsersLeave->patchEntity($usersLeave, $this->request->getData());
            if ($this->UsersLeave->save($usersLeave)) {
                $this->Flash->success(__('The users leave has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The users leave could not be saved. Please, try again.'));
        }
        $this->set(compact('usersLeave'));
        $this->set('_serialize', ['usersLeave']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Users Leave id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $usersLeave = $this->UsersLeave->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $usersLeave = $this->UsersLeave->patchEntity($usersLeave, $this->request->getData());
            if ($this->UsersLeave->save($usersLeave)) {
                $this->Flash->success(__('The users leave has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The users leave could not be saved. Please, try again.'));
        }
        $this->set(compact('usersLeave'));
        $this->set('_serialize', ['usersLeave']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Users Leave id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $usersLeave = $this->UsersLeave->get($id);
        if ($this->UsersLeave->delete($usersLeave)) {
            $this->Flash->success(__('The users leave has been deleted.'));
        } else {
            $this->Flash->error(__('The users leave could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
