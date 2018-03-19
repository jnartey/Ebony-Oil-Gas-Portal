<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Holidays Controller
 *
 * @property \App\Model\Table\HolidaysTable $Holidays
 *
 * @method \App\Model\Entity\Holiday[] paginate($object = null, array $settings = [])
 */
class HolidaysController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $holidays = $this->paginate($this->Holidays);

        $this->set(compact('holidays'));
        $this->set('_serialize', ['holidays']);
    }

    /**
     * View method
     *
     * @param string|null $id Holiday id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $holiday = $this->Holidays->get($id, [
            'contain' => []
        ]);

        $this->set('holiday', $holiday);
        $this->set('_serialize', ['holiday']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
		$userA = $this->Auth->user();
        $holiday = $this->Holidays->newEntity();
        if ($this->request->is('post')) {
            $holiday = $this->Holidays->patchEntity($holiday, $this->request->getData());
            if ($this->Holidays->save($holiday)) {
                $this->Flash->success(__('The holiday has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The holiday could not be saved. Please, try again.'));
        }
        $this->set(compact('holiday'));
        $this->set('_serialize', ['holiday']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Holiday id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
		$userA = $this->Auth->user();
        $holiday = $this->Holidays->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $holiday = $this->Holidays->patchEntity($holiday, $this->request->getData());
            if ($this->Holidays->save($holiday)) {
                $this->Flash->success(__('The holiday has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The holiday could not be saved. Please, try again.'));
        }
        $this->set(compact('holiday'));
        $this->set('_serialize', ['holiday']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Holiday id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
		$userA = $this->Auth->user();
        $this->request->allowMethod(['post', 'delete']);
        $holiday = $this->Holidays->get($id);
        if ($this->Holidays->delete($holiday)) {
            $this->Flash->success(__('The holiday has been deleted.'));
        } else {
            $this->Flash->error(__('The holiday could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
