<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;

/**
 * RequestHandlers Controller
 *
 * @property \App\Model\Table\RequestHandlersTable $RequestHandlers
 *
 * @method \App\Model\Entity\RequestHandler[] paginate($object = null, array $settings = [])
 */
class RequestHandlersController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['RequestForms', 'Departments']
        ];
        $requestHandlers = $this->paginate($this->RequestHandlers);

        $this->set(compact('requestHandlers'));
        $this->set('_serialize', ['requestHandlers']);
    }

    /**
     * View method
     *
     * @param string|null $id Request Handler id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $requestHandler = $this->RequestHandlers->get($id, [
            'contain' => ['RequestForms', 'Departments']
        ]);

        $this->set('requestHandler', $requestHandler);
        $this->set('_serialize', ['requestHandler']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $requestHandler = $this->RequestHandlers->newEntity();
        if ($this->request->is('post')) {
            $requestHandler = $this->RequestHandlers->patchEntity($requestHandler, $this->request->getData());
            if ($this->RequestHandlers->save($requestHandler)) {
                $this->Flash->success(__('The request handler has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The request handler could not be saved. Please, try again.'));
        }
        $requestForms = $this->RequestHandlers->RequestForms->find('list', ['limit' => 200]);
        $departments = $this->RequestHandlers->Departments->find('list', ['limit' => 200]);
		$users = $this->RequestHandlers->Users->find('list', ['conditions'=>['NOT'=>['Users.id'=>1]], 'limit' => 200]);
        $this->set(compact('requestHandler', 'requestForms', 'departments', 'users'));
        $this->set('_serialize', ['requestHandler']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Request Handler id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $requestHandler = $this->RequestHandlers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $requestHandler = $this->RequestHandlers->patchEntity($requestHandler, $this->request->getData());
            if ($this->RequestHandlers->save($requestHandler)) {
                $this->Flash->success(__('The request handler has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The request handler could not be saved. Please, try again.'));
        }
        $requestForms = $this->RequestHandlers->RequestForms->find('list', ['limit' => 200]);
        $departments = $this->RequestHandlers->Departments->find('list', ['limit' => 200]);
		$users = $this->RequestHandlers->Users->find('list', ['conditions'=>['NOT'=>['Users.id'=>1]], 'limit' => 200]);
        $this->set(compact('requestHandler', 'requestForms', 'departments', 'users'));
        $this->set('_serialize', ['requestHandler']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Request Handler id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $requestHandler = $this->RequestHandlers->get($id);
        if ($this->RequestHandlers->delete($requestHandler)) {
            $this->Flash->success(__('The request handler has been deleted.'));
        } else {
            $this->Flash->error(__('The request handler could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
