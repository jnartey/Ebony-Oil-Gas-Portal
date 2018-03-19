<?php
namespace App\Controller\Workgroup;
use App\Controller\Workgroup\AppController;
use Cake\Mailer\Email;
use Cake\Routing\Router;

/**
 * WorkgroupComments Controller
 *
 * @property \App\Model\Table\WorkgroupCommentsTable $WorkgroupComments
 *
 * @method \App\Model\Entity\WorkgroupComment[] paginate($object = null, array $settings = [])
 */
class WorkgroupCommentsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Sources', 'Projects', 'Forums', 'ParentWorkgroupComments', 'Users']
        ];
        $workgroupComments = $this->paginate($this->WorkgroupComments);

        $this->set(compact('workgroupComments'));
        $this->set('_serialize', ['workgroupComments']);
    }

    /**
     * View method
     *
     * @param string|null $id Workgroup Comment id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $workgroupComment = $this->WorkgroupComments->get($id, [
            'contain' => ['Sources', 'Projects', 'Forums', 'ParentWorkgroupComments', 'Users', 'ChildWorkgroupComments']
        ]);

        $this->set('workgroupComment', $workgroupComment);
        $this->set('_serialize', ['workgroupComment']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
		$userA = $this->Auth->user();
        $workgroupComment = $this->WorkgroupComments->newEntity();
        if ($this->request->is('post')) {
            $workgroupComment = $this->WorkgroupComments->patchEntity($workgroupComment, $this->request->getData());
            if ($this->WorkgroupComments->save($workgroupComment)) {
                $this->Flash->success(__('The workgroup comment has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The workgroup comment could not be saved. Please, try again.'));
        }
        $sources = $this->WorkgroupComments->Sources->find('list', ['limit' => 200]);
        $projects = $this->WorkgroupComments->Projects->find('list', ['limit' => 200]);
        $forums = $this->WorkgroupComments->Forums->find('list', ['limit' => 200]);
        $parentWorkgroupComments = $this->WorkgroupComments->ParentWorkgroupComments->find('list', ['limit' => 200]);
        $users = $this->WorkgroupComments->Users->find('list', ['limit' => 200]);
        $this->set(compact('workgroupComment', 'sources', 'projects', 'forums', 'parentWorkgroupComments', 'users'));
        $this->set('_serialize', ['workgroupComment']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Workgroup Comment id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
		$userA = $this->Auth->user();
        $workgroupComment = $this->WorkgroupComments->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $workgroupComment = $this->WorkgroupComments->patchEntity($workgroupComment, $this->request->getData());
            if ($this->WorkgroupComments->save($workgroupComment)) {
                $this->Flash->success(__('The workgroup comment has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The workgroup comment could not be saved. Please, try again.'));
        }
        $sources = $this->WorkgroupComments->Sources->find('list', ['limit' => 200]);
        $projects = $this->WorkgroupComments->Projects->find('list', ['limit' => 200]);
        $forums = $this->WorkgroupComments->Forums->find('list', ['limit' => 200]);
        $parentWorkgroupComments = $this->WorkgroupComments->ParentWorkgroupComments->find('list', ['limit' => 200]);
        $users = $this->WorkgroupComments->Users->find('list', ['limit' => 200]);
        $this->set(compact('workgroupComment', 'sources', 'projects', 'forums', 'parentWorkgroupComments', 'users'));
        $this->set('_serialize', ['workgroupComment']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Workgroup Comment id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
		$userA = $this->Auth->user();
        $this->request->allowMethod(['post', 'delete']);
        $workgroupComment = $this->WorkgroupComments->get($id);
        if ($this->WorkgroupComments->delete($workgroupComment)) {
            $this->Flash->success(__('The workgroup comment has been deleted.'));
        } else {
            $this->Flash->error(__('The workgroup comment could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
