<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Mailer\Email;

/**
 * Canteen Controller
 *
 * @property \App\Model\Table\CanteenTable $Canteen
 */
class CanteenController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
		$default_menu = $this->Canteen->find('all')->where(['Canteen.status' => 1])->first();
		$canteen = $this->Canteen->find('all')->where(['Canteen.menu' => $default_menu->id]);	

        $this->set(compact('canteen'));
        $this->set('_serialize', ['canteen']);
    }

    /**
     * View method
     *
     * @param string|null $id Canteen id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $canteen = $this->Canteen->get($id, [
            'contain' => []
        ]);

        $this->set('canteen', $canteen);
        $this->set('_serialize', ['canteen']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
		$userA = $this->Auth->user();
        $canteen = $this->Canteen->newEntity();
        if ($this->request->is('post')) {
            $canteen = $this->Canteen->patchEntity($canteen, $this->request->getData());
            if ($this->Canteen->save($canteen)) {
                $this->Flash->success(__('The canteen has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The canteen could not be saved. Please, try again.'));
        }
        $this->set(compact('canteen'));
        $this->set('_serialize', ['canteen']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Canteen id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
		$userA = $this->Auth->user();
        $canteen = $this->Canteen->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $canteen = $this->Canteen->patchEntity($canteen, $this->request->getData());
            if ($this->Canteen->save($canteen)) {
                $this->Flash->success(__('The canteen has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The canteen could not be saved. Please, try again.'));
        }
        $this->set(compact('canteen'));
        $this->set('_serialize', ['canteen']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Canteen id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
		$userA = $this->Auth->user();
        $this->request->allowMethod(['post', 'delete']);
        $canteen = $this->Canteen->get($id);
        if ($this->Canteen->delete($canteen)) {
			$this->Canteen->deleteAll([
			    'menu' => $canteen->id
			]);
			
            $this->Flash->success(__($canteen->name.' has been deleted.'));
        } else {
            $this->Flash->error(__($canteen->name.' could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
