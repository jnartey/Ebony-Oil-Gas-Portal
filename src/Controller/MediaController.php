<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;
use Cake\Event\Event;
use Cake\Mailer\Email;

/**
 * Media Controller
 *
 * @property \App\Model\Table\MediaTable $Media
 */
class MediaController extends AppController
{
	public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Security');
    }
		
	public function beforeFilter(Event $event)
    {
        $this->Security->setConfig('unlockedActions', ['add']);
 		$activeUser = $this->Auth->user();
		 
 		$userTable = TableRegistry::get('Users');
 		$user_pro = $userTable->find('all')->where(['Users.id'=>$activeUser['id']])->first();
		 
		$this->set(compact('activeUser', 'user_pro'));
    }
	
	
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
	
	//Media Access | 1=>Access to public, 2=>Private, 3=>Department only
	
    public function index($id = null, $parent_id = null)
    {
		$user = $this->Auth->user();
		$check_id = null;
		$parent_media = null;
		$check_parent_media = null;
		$media = null;
		$crumbs = null;
		
		if($id && !empty($id)){
			$parent_media = $this->Media->find('all')->where(['Media.id'=>$id])->first();
			$media = $this->Media->find('all', [
			    'conditions' => ['Media.parent_id' => $id],
				'contain' => []
			]);
			$check_parent_media = $parent_media->toArray();
			$check_id = $id;
			$crumbs = $this->Media->find('path', ['for' => $id]);
		}else{
			$media = $this->Media->find('all', [
			    'conditions' => ['Media.parent_id IS' => null],
				'contain' => []
			]);
		}
								
        $this->set(compact('media', 'check_id', 'parent_media', 'check_parent_media', 'crumbs'));
        $this->set('_serialize', ['media']);
    }

    /**
     * View method
     *
     * @param string|null $id Media id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $media = $this->Media->get($id);

        $this->set('media', $media);
        $this->set('_serialize', ['media']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($id = null)
    {
 		$user = $this->Auth->user();

 		$parent_id = $id;
 		$current_media = null;

 		$media = $this->Media->newEntity();


        if ($this->request->is('post')) {
 			//pr($this->request->getData());
 			if($this->request->getData('parent_id')){
 				$current_media = $this->Media->get($this->request->getData('parent_id'));
 			}

 			//pr($this->request->getData());

 			if($id){
 				if($current_media->source_id){
 					$media->source_id = $current_media->source_id;
 				}

 				$media->parent_id = $current_media->id;
 			}

 			$media->uploaded_by = $user['id'];

 			if($id){
				if($current_media->media_dir){
					$media->media_dir = $current_media->media_dir;
				}else{
					$media->media_dir = $current_media->folder_name;
				}
 			}else{
 				$media->media_dir = 'files'.DS.'media';
 			}

            $media = $this->Media->patchEntity($media, $this->request->getData());

            if ($result = $this->Media->save($media)) {
                $this->Flash->success(__('The media has been saved.'));
				if($id){
					$this->Log->write('info', 'Media', $user['first_name'].' '.$user['last_name'].' uploaded '.$this->request->data['file_name']['name'], [], ['request' => true], $result->id);
					//return $this->redirect(['action' => 'index', $id]);
					$resultJ = json_encode(array('result' => '<div class="callout success">'.$this->request->data['file_name']['name'].' uploaded successfully.</div>'));
					$this->response->type('json');
					$this->response->body($resultJ);
					return $this->response;
				}else{
					$resultJ = json_encode(array('result' => '<div class="callout success">'.$this->request->data['file_name']['name'].' uploaded successfully.</div>'));
					$this->response->type('json');
					$this->response->body($resultJ);
					return $this->response;
				}
            }
			
			$resultJ = json_encode(array('result' => '<div class="callout success">'.$this->request->data['file_name']['name'].' could not be saved. Please, try again.</div>'));
			$this->response->type('json');
			$this->response->body($resultJ);
			return $this->response;
        }

        $this->set(compact('media', 'user', 'parent_id'));
        $this->set('_serialize', ['media']);
    }
	
	public function mediaContent($id = null){
		$user = $this->Auth->user();
		$check_id = null;
		$parent_media = null;
		$check_parent_media = null;
		$media = null;
		$crumbs = null;
		
		if($id && !empty($id)){
			$parent_media = $this->Media->find('all')->where(['Media.id'=>$id])->first();
			$media = $this->Media->find('all', [
			    'conditions' => ['Media.parent_id' => $id],
				'contain' => []
			]);
			$check_parent_media = $parent_media->toArray();
			$check_id = $id;
			$crumbs = $this->Media->find('path', ['for' => $id]);
		}else{
			$media = $this->Media->find('all', [
			    'conditions' => ['Media.parent_id IS' => null],
				'contain' => []
			]);
		}
								
        $this->set(compact('media', 'check_id', 'parent_media', 'check_parent_media', 'crumbs'));
        $this->set('_serialize', ['media']);
	}
	
    // public function add($id = null)
//     {
//  		$user = $this->Auth->user();
//
//  		$parent_id = $id;
//  		$current_media = null;
//
//  		$media = $this->Media->newEntity();
//
//
//         if ($this->request->is('post')) {
//  			//pr($this->request->getData());
//  			if($this->request->getData('parent_id')){
//  				$current_media = $this->Media->get($this->request->getData('parent_id'));
//  			}
//
//  			//pr($this->request->getData());
//
//  			$i = 1;
//  			$data_x = array();
//  			foreach($this->request->getData('file_name') as $data):
//
//  					if($id){
//  						if($current_media->source_id){
//  							$data_x[$i]['source_id'] = $current_media->source_id;
//  						}
//
//  						$data_x[$i]['parent_id'] = $current_media->id;
//  					}
//
//  					$data_x[$i]['uploaded_by'] = $user['id'];
//
//  					if($id){
//  						$data_x[$i]['media_dir']  = $current_media->media_dir;
//  					}else{
//  						$data_x[$i]['media_dir'] = 'files'.DS.'media';
//  					}
//
//  					//$data_x[$i]['file_name'] = $data[$i];
//  					$data_x[$i]['file_name']['tmp_name'] = $data['tmp_name'];
//  					$data_x[$i]['file_name']['name'] = $data['name'];
//  					$data_x[$i]['file_name']['type'] = $data['type'];
//  					$data_x[$i]['file_name']['size'] = $data['size'];
//
//
//
//  				$i++;
//  			endforeach;
//
//  			//pr($data_x);
//  			$media = $this->Media->newEntities($data_x);
//  			//debug($this->Media->saveMany($media));
//  			if($this->Media->saveMany($media)){
//  				$this->Flash->success(__('Upload successful'));
//
//  				// if($this->request->getData('parent_id')){
// //  					return $this->redirect(['action' => 'index', $this->request->getData('parent_id')]);
// //  				}else{
// //  					return $this->redirect(['action' => 'index']);
// //  				}
//  			}
//
//             $this->Flash->error(__('The media could not be saved. Please, try again.'));
//         }
//
//         $this->set(compact('media', 'user', 'parent_id'));
//         $this->set('_serialize', ['media']);
//     }
	
    public function addFolder($id=null)
    {
		
		if($id){
			$current_media = $this->Media->get($id);
		}
		
		$user = $this->Auth->user();
		
        $media = $this->Media->newEntity();
        if ($this->request->is('post')) {
            $media = $this->Media->patchEntity($media, $this->request->getData());
            if ($result = $this->Media->save($media)) {
				if($id){
					$media->source_id = $current_media->source_id;
					$media->parent_id = $current_media->id;
				}
				
				$str = strtolower(trim($this->request->getData('folder_name')));
				$str = preg_replace('/[^a-z0-9-]/', '-', $str);
				$str = preg_replace('/-+/', "-", $str);
				$dir_name = rtrim($str, '-');
				
				
				$media->folder_name = $this->request->getData('folder_name');
				//$media->department_id = $check_user->department_id;
				$media->uploaded_by = $user['id'];
				
				if($id){
					$media->media_dir = $current_media->media_dir.DS.$dir_name;
				}else{
					$media->media_dir = 'files'.DS.'media'.DS.'public'.DS.$dir_name;
				}
				
				if($this->Media->save($media)){
					if($id){
						$dir = new Folder(WWW_ROOT.$current_media->media_dir.DS.$dir_name, true, 0755);
					}else{
						$dir = new Folder(WWW_ROOT.'files'.DS.'media'.DS.'public'.DS.$dir_name, true, 0755);
					}
				}
				
				$this->Log->write('info', 'Media', $user['first_name'].' '.$user['last_name'].' created folder - '.$this->request->getData('folder_name'), [], ['request' => true], $result->id);	
                $this->Flash->success(__('New folder '.$this->request->getData('folder_name').' created'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The media could not be saved. Please, try again.'));
        }
        $this->set(compact('media', 'current_media'));
        $this->set('_serialize', ['media']);
    }
	
    /**
     * Edit method
     *
     * @param string|null $id Media id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
		$user = $this->Auth->user();
        $media = $this->Media->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $media = $this->Media->patchEntity($media, $this->request->getData());
            if ($this->Media->save($media)) {
				if($media->folder_name){
					$this->Log->write('info', 'Media', $user['first_name'].' '.$user['last_name'].' edited '.$media->folder_name, [], ['request' => true], $media->id);
				}else{
					$this->Log->write('info', 'Media', $user['first_name'].' '.$user['last_name'].' edited '.$media->file_name, [], ['request' => true], $media->id);
				}
				
                $this->Flash->success(__('The media has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The media could not be saved. Please, try again.'));
        }
        $departments = $this->Media->Departments->find('list', ['limit' => 200]);
        $this->set(compact('media', 'departments'));
        $this->set('_serialize', ['media']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Media id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
		$user = $this->Auth->user();
        $this->request->allowMethod(['post', 'delete']);
        $media = $this->Media->get($id);
        if ($this->Media->delete($media)) {
			if($media->folder_name){
				$this->Log->write('info', 'Media', $user['first_name'].' '.$user['last_name'].' deleted '.$media->folder_name, [], ['request' => true], $media->id);
			}else{
				$this->Log->write('info', 'Media', $user['first_name'].' '.$user['last_name'].' deleted '.$media->file_name, [], ['request' => true], $media->id);
			}
            $this->Flash->success(__('The media has been deleted.'));
        } else {
            $this->Flash->error(__('The media could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
