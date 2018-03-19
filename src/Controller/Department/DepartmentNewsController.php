<?php
namespace App\Controller\Department;
use App\Controller\Department\AppController;

use Cake\ORM\TableRegistry;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;
use Cake\Mailer\Email;
use Cake\Routing\Router;

/**
 * DepartmentNews Controller
 *
 * @property \App\Model\Table\DepartmentNewsTable $DepartmentNews
 *
 * @method \App\Model\Entity\DepartmentNews[] paginate($object = null, array $settings = [])
 */
class DepartmentNewsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
		$user = $this->Auth->user();
		$user_table = TableRegistry::get('Users');		
		$get_user = $user_table->find('all')->where(['Users.id' => $user['id']])->first();
		
        $this->paginate = [
			'conditions' => ['DepartmentNews.department_id' => $get_user->department_access],
            'contain' => ['Categories'],
			'limit' => 24
        ];
		
        $news = $this->paginate($this->DepartmentNews);

        $this->set(compact('news'));
        $this->set('_serialize', ['news']);
    }
	
    public function myNews()
    {
		$user = $this->Auth->user();
		$user_table = TableRegistry::get('Users');		
		$get_user = $user_table->find('all')->where(['Users.id' => $user['id']])->first();
		
		if($user){
			$news = $this->paginate($this->DepartmentNews, ['conditions'=>['DepartmentNews.user_id'=>$user['id'], 'DepartmentNews.department_id' => $get_user->department_access], 'contain'=>['Categories'], 'limit' => 24]);
	        $this->set(compact('news'));
	        $this->set('_serialize', ['news']);
		}
    }

    /**
     * View method
     *
     * @param string|null $id DepartmentNews id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $news = $this->DepartmentNews->get($id, [
            'contain' => ['Categories']
        ]);

        $this->set('news', $news);
        $this->set('_serialize', ['news']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
		$user = $this->Auth->user();
		$user_table = TableRegistry::get('Users');		
		$get_user = $user_table->find('all')->where(['Users.id' => $user['id']])->first();
		
        $news = $this->DepartmentNews->newEntity();
        if ($this->request->is('post')) {
            $news = $this->DepartmentNews->patchEntity($news, $this->request->getData());
			$news->department_id = $get_user->department_access;
            if ($result = $this->DepartmentNews->save($news)) {
				$this->Log->write('info', 'News', $user['first_name'].' '.$user['last_name'].' added '.$this->request->getData('title'), [], ['request' => true], $result->id, $get_user->department_access);
                $this->Flash->success(__($this->request->getData('title').' has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__($this->request->getData('title').' could not be saved. Please, try again.'));
        }
        $categories = $this->DepartmentNews->Categories->find('list', ['limit' => 200]);
        $this->set(compact('news', 'categories'));
        $this->set('_serialize', ['news']);
    }

    /**
     * Edit method
     *
     * @param string|null $id News id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $news = $this->DepartmentNews->get($id, [
            'contain' => []
        ]);
		
		$user = $this->Auth->user();
			
		$user_table = TableRegistry::get('Users');		
		$get_user = $user_table->find('all')->where(['Users.id' => $user['id']])->first();
		
		if($user['id'] == $news->user_id){
	        if ($this->request->is(['patch', 'post', 'put'])) {
	            $news = $this->DepartmentNews->patchEntity($news, $this->request->getData());
	            if ($this->DepartmentNews->save($news)) {
					$this->Log->write('info', 'News', $user['first_name'].' '.$user['last_name'].' edited '.$news->title, [], ['request' => true], $news->id, $get_user->department_access);
	                $this->Flash->success(__($news->title.' has been updated.'));

	                return $this->redirect(['action' => 'index']);
	            }
	            $this->Flash->error(__($news->title.' could not be saved. Please, try again.'));
	        }
	        $categories = $this->DepartmentNews->Categories->find('list', ['limit' => 200]);
	        $this->set(compact('news', 'categories'));
	        $this->set('_serialize', ['news']);
		}else{
			return $this->redirect(['action' => 'index']);
		}
    }

    /**
     * Delete method
     *
     * @param string|null $id DepartmentNews id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
		$user = $this->Auth->user();
        $this->request->allowMethod(['post', 'delete']);
        $news = $this->DepartmentNews->get($id);
		
		$user_table = TableRegistry::get('Users');		
		$get_user = $user_table->find('all')->where(['Users.id' => $user['id']])->first();
		
        if ($this->DepartmentNews->delete($news)) {
            $this->Flash->success(__($news->title.' has been deleted.'));
			$this->Log->write('info', 'News', $user['first_name'].' '.$user['last_name'].' deleted '.$news->title, [], ['request' => true], $news->id, $get_user->department_access);
        } else {
            $this->Flash->error(__($news->title.' could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
