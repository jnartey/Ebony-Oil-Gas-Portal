<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;

/**
 * LeaveDays Controller
 *
 * @property \App\Model\Table\LeaveDaysTable $LeaveDays
 *
 * @method \App\Model\Entity\LeaveDay[] paginate($object = null, array $settings = [])
 */
class LeaveDaysController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        // $this->paginate = [
//             'contain' => ['Users']
//         ];
//         $leaveDays = $this->paginate($this->LeaveDays);
		
		$leaveDays = $this->LeaveDays->find('all', [
		    'contain' => ['Users']
		]);

        $this->set(compact('leaveDays'));
        $this->set('_serialize', ['leaveDays']);
    }

    /**
     * View method
     *
     * @param string|null $id Leave Day id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $leaveDay = $this->LeaveDays->get($id, [
            'contain' => ['Users']
        ]);

        $this->set('leaveDay', $leaveDay);
        $this->set('_serialize', ['leaveDay']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $leaveDay = $this->LeaveDays->newEntity();
        if ($this->request->is('post')) {
            $leaveDay = $this->LeaveDays->patchEntity($leaveDay, $this->request->getData());
            if ($this->LeaveDays->save($leaveDay)) {
                $this->Flash->success(__('The leave day has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The leave day could not be saved. Please, try again.'));
        }
        $users = $this->LeaveDays->Users->find('list', ['conditions'=>['NOT'=>['Users.id'=>1]], 'limit' => 200]);
        $this->set(compact('leaveDay', 'users'));
        $this->set('_serialize', ['leaveDay']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Leave Day id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $leaveDay = $this->LeaveDays->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $leaveDay = $this->LeaveDays->patchEntity($leaveDay, $this->request->getData());
            if ($this->LeaveDays->save($leaveDay)) {
                $this->Flash->success(__('The leave day has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The leave day could not be saved. Please, try again.'));
        }
        $users = $this->LeaveDays->Users->find('list', ['conditions'=>['NOT'=>['Users.id'=>1]], 'limit' => 200]);
        $this->set(compact('leaveDay', 'users'));
        $this->set('_serialize', ['leaveDay']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Leave Day id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $leaveDay = $this->LeaveDays->get($id);
        if ($this->LeaveDays->delete($leaveDay)) {
            $this->Flash->success(__('The leave day has been deleted.'));
        } else {
            $this->Flash->error(__('The leave day could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
