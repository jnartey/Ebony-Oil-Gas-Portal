<?php
namespace App\Controller\Department;
use App\Controller\Department\AppController;
use Cake\Mailer\Email;
use Cake\Routing\Router;

/**
 * DepartmentComments Controller
 *
 * @property \App\Model\Table\DepartmentCommentsTable $DepartmentComments
 *
 * @method \App\Model\Entity\DepartmentComment[] paginate($object = null, array $settings = [])
 */
class DepartmentCommentsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Sources', 'Projects', 'Forums', 'ParentDepartmentComments', 'Users']
        ];
        $departmentComments = $this->paginate($this->DepartmentComments);

        $this->set(compact('departmentComments'));
        $this->set('_serialize', ['departmentComments']);
    }

    /**
     * View method
     *
     * @param string|null $id Department Comment id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $departmentComment = $this->DepartmentComments->get($id, [
            'contain' => ['Sources', 'Projects', 'Forums', 'ParentDepartmentComments', 'Users', 'ChildDepartmentComments']
        ]);

        $this->set('departmentComment', $departmentComment);
        $this->set('_serialize', ['departmentComment']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
		$userA = $this->Auth->user();
        $departmentComment = $this->DepartmentComments->newEntity();
        if ($this->request->is('post')) {
            $departmentComment = $this->DepartmentComments->patchEntity($departmentComment, $this->request->getData());
            if ($this->DepartmentComments->save($departmentComment)) {
                $this->Flash->success(__('The department comment has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The department comment could not be saved. Please, try again.'));
        }
        $sources = $this->DepartmentComments->Sources->find('list', ['limit' => 200]);
        $projects = $this->DepartmentComments->Projects->find('list', ['limit' => 200]);
        $forums = $this->DepartmentComments->Forums->find('list', ['limit' => 200]);
        $parentDepartmentComments = $this->DepartmentComments->ParentDepartmentComments->find('list', ['limit' => 200]);
        $users = $this->DepartmentComments->Users->find('list', ['limit' => 200]);
        $this->set(compact('departmentComment', 'sources', 'projects', 'forums', 'parentDepartmentComments', 'users'));
        $this->set('_serialize', ['departmentComment']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Department Comment id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
		$userA = $this->Auth->user();
        $departmentComment = $this->DepartmentComments->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $departmentComment = $this->DepartmentComments->patchEntity($departmentComment, $this->request->getData());
            if ($this->DepartmentComments->save($departmentComment)) {
                $this->Flash->success(__('The department comment has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The department comment could not be saved. Please, try again.'));
        }
        $sources = $this->DepartmentComments->Sources->find('list', ['limit' => 200]);
        $projects = $this->DepartmentComments->Projects->find('list', ['limit' => 200]);
        $forums = $this->DepartmentComments->Forums->find('list', ['limit' => 200]);
        $parentDepartmentComments = $this->DepartmentComments->ParentDepartmentComments->find('list', ['limit' => 200]);
        $users = $this->DepartmentComments->Users->find('list', ['limit' => 200]);
        $this->set(compact('departmentComment', 'sources', 'projects', 'forums', 'parentDepartmentComments', 'users'));
        $this->set('_serialize', ['departmentComment']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Department Comment id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
		$userA = $this->Auth->user();
        $this->request->allowMethod(['post', 'delete']);
        $departmentComment = $this->DepartmentComments->get($id);
        if ($this->DepartmentComments->delete($departmentComment)) {
            $this->Flash->success(__('The department comment has been deleted.'));
        } else {
            $this->Flash->error(__('The department comment could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
