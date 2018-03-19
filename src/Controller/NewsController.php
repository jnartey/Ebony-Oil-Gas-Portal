<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Mailer\Email;

/**
 * News Controller
 *
 * @property \App\Model\Table\NewsTable $News
 *
 * @method \App\Model\Entity\News[] paginate($object = null, array $settings = [])
 */
class NewsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Categories']
        ];
        $news = $this->paginate($this->News);

        $this->set(compact('news'));
        $this->set('_serialize', ['news']);
    }
	
    public function myNews()
    {
		$user = $this->Auth->user();
		if($user){
			$news = $this->paginate($this->News, ['conditions'=>['News.user_id'=>$user['id']]]);
	        $this->set(compact('news'));
	        $this->set('_serialize', ['news']);
		}
    }

    /**
     * View method
     *
     * @param string|null $id News id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $news = $this->News->get($id, [
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
        $news = $this->News->newEntity();
        if ($this->request->is('post')) {
            $news = $this->News->patchEntity($news, $this->request->getData());
            if ($result = $this->News->save($news)) {
				$this->Log->write('info', 'News', $user['first_name'].' '.$user['last_name'].' added '.$this->request->getData('title'), [], ['request' => true], $result->id);
                $this->Flash->success(__('The news has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The news could not be saved. Please, try again.'));
        }
        $categories = $this->News->Categories->find('list', ['limit' => 200]);
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
        $news = $this->News->get($id, [
            'contain' => []
        ]);
			
		$user = $this->Auth->user();
		if($user['id'] == $news->user_id){
	        if ($this->request->is(['patch', 'post', 'put'])) {
	            $news = $this->News->patchEntity($news, $this->request->getData());
	            if ($this->News->save($news)) {
					$this->Log->write('info', 'News', $user['first_name'].' '.$user['last_name'].' edited '.$news->title, [], ['request' => true], $news->id);
	                $this->Flash->success(__('The news has been saved.'));

	                return $this->redirect(['action' => 'index']);
	            }
	            $this->Flash->error(__('The news could not be saved. Please, try again.'));
	        }
	        $categories = $this->News->Categories->find('list', ['limit' => 200]);
	        $this->set(compact('news', 'categories'));
	        $this->set('_serialize', ['news']);
		}else{
			return $this->redirect(['action' => 'index']);
		}
    }

    /**
     * Delete method
     *
     * @param string|null $id News id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
		$user = $this->Auth->user();
        $this->request->allowMethod(['post', 'delete']);
        $news = $this->News->get($id);
        if ($this->News->delete($news)) {
            $this->Flash->success(__('The news has been deleted.'));
			$this->Log->write('info', 'News', $user['first_name'].' '.$user['last_name'].' deleted '.$news->title, [], ['request' => true], $news->id);
        } else {
            $this->Flash->error(__('The news could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
