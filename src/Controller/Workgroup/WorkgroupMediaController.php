<?php
namespace App\Controller\Workgroup;
use App\Controller\Workgroup\AppController;
use Cake\ORM\TableRegistry;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;
use Cake\Event\Event;
use Cake\Mailer\Email;
use Cake\Routing\Router;

/**
 * WorkgroupMedia Controller
 *
 * @property \App\Model\Table\WorkgroupMediaTable $WorkgroupMedia
 *
 * @method \App\Model\Entity\WorkgroupMedia[] paginate($object = null, array $settings = [])
 */
class WorkgroupMediaController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
	public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Security');
    }
		
	public function beforeFilter(Event $event)
    {
         $this->Security->setConfig('unlockedActions', ['add']);
 		 $activeUser = $this->Auth->user();
		
 		$workgroup_members = TableRegistry::get('WorkgroupsMembers');
 		$workgroup = TableRegistry::get('Workgroups');
			
 		$user_table = TableRegistry::get('Users');
		
 		if(!empty($this->request->getQuery('workgroup'))){
 			$user_save = $user_table->newEntity();
 			$user_save->id = $activeUser['id'];
 			$user_save->workgroup_access = $this->request->getQuery('workgroup');
 			$user_table->save($user_save);
 		}	
		
 		$get_user = $user_table->find('all')->where(['Users.id' => $activeUser['id']])->first();
			
 		$workgroup_details = $workgroup_members->find('all', [
 		    'conditions' => ['WorkgroupsMembers.user_id' => $activeUser['id'], 'WorkgroupsMembers.workgroup_id' => $get_user->workgroup_access],
 		]);
		
 		$workgroup_details = $workgroup_details->first();
		
 		$workgroup_data = $workgroup->find('all', [
 		    'conditions' => ['Workgroups.id' => $get_user->workgroup_access],
 		]);
		
 		$workgroup_data = $workgroup_data->first();
			
 		//pr($workgroup_data);
 		//$department_details_ch = $department_details->toArray();
 		//$department_id = $this->request->getQuery('department');
					
 		if(empty($workgroup_details)){
 			if($activeUser['role_id'] == 1 || $activeUser['id'] == $workgroup_data->user_id){
				
 				if($get_user->workgroup_access){
					
 					$workgroup_details = null;
					
 				}else{
 					//$this->Flash->error(__('Invalid Url'));
 					return $this->redirect('/');
 				}					
 			}else{
 				$this->Flash->error(__('You are not a member of this workgroup'));
 				return $this->redirect('/');
 			}
 		}else{
 			$workgroup_details = $workgroup->find('all', [
 			    'conditions' => ['Workgroups.id' => $get_user->workgroup_access],
 			]);
			
 			$workgroup_details = $workgroup_details->first();
			
 		}
		
 		$userTable = TableRegistry::get('Users');
 		$user_pro = $userTable->find('all')->where(['Users.id'=>$activeUser['id']])->first();
		 		
 		//pr($department_data);
												
 		$this->set(compact('activeUser', 'user_details', 'workgroup_members', 'workgroup_details', 'workgroup_data', 'user_pro'));
    }
	
	public $components = ['CakephpBlueimpUpload.Uploader'];
	public $helpers    = ['CakephpBlueimpUpload.BlueimpUpload'];
	
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
	
	//Media Access | 1=>Access to public, 2=>Private, 3=>Workgroup only
	
    public function index($id = null)
    {
		$workgroup_members = TableRegistry::get('WorkgroupsMembers');		
		$user = $this->Auth->user();
		$user_table = TableRegistry::get('Users');		
		$get_user = $user_table->find('all')->where(['Users.id' => $user['id']])->first();
		$check_id = null;
		$parent_media = null;
		$check_parent_media = null;
		$crumbs = null;
		
		$check_user = $workgroup_members->find('all')->where(['WorkgroupsMembers.user_id' => $user['id']])->contain(['Users', 'Workgroups'])->first();
		
		if($id){
			$media = $this->WorkgroupMedia->find('children', ['for' => $id])->find('threaded');
			$crumbs = $this->WorkgroupMedia->find('path', ['for' => $id]);
			$parent_media = $this->WorkgroupMedia->find('all')->where(['WorkgroupMedia.id' => $id])->contain(['Workgroups'])->first();
			$check_parent_media = $parent_media->toArray();
			$check_id = $id;
			$crumbs = $this->WorkgroupMedia->find('path', ['for' => $id]);
		}else{
			$media = $this->WorkgroupMedia->find('all', [
			    'conditions' => ['WorkgroupMedia.workgroup_id' => $get_user->workgroup_access, 'WorkgroupMedia.parent_id IS NOT' => null, 'WorkgroupMedia.task_id IS' => null],
				'contain' => ['Workgroups']
			]);
				
			$current_media = $this->WorkgroupMedia->find('all')->where(['WorkgroupMedia.workgroup_id' => $get_user->workgroup_access])->first();
			
			$media = $this->WorkgroupMedia->find('children', ['for' => $current_media->id])->find('threaded');
		}
		
		$check_media = $media->toArray();
				
        $this->set(compact('media', 'check_user', 'check_id', 'parent_media', 'check_media', 'check_parent_media', 'get_user', 'crumbs'));
        $this->set('_serialize', ['media']);
    }
	
	public function mediaContent($id = null){
		$workgroup_members = TableRegistry::get('WorkgroupsMembers');		
		$user = $this->Auth->user();
		$user_table = TableRegistry::get('Users');		
		$get_user = $user_table->find('all')->where(['Users.id' => $user['id']])->first();
		$check_id = null;
		$parent_media = null;
		$check_parent_media = null;
		$crumbs = null;
		
		$check_user = $workgroup_members->find('all')->where(['WorkgroupsMembers.user_id' => $user['id']])->contain(['Users', 'Workgroups'])->first();
		
		if($id){
			$media = $this->WorkgroupMedia->find('children', ['for' => $id])->find('threaded');
			$crumbs = $this->WorkgroupMedia->find('path', ['for' => $id]);
			$parent_media = $this->WorkgroupMedia->find('all')->where(['WorkgroupMedia.id' => $id])->contain(['Workgroups'])->first();
			$check_parent_media = $parent_media->toArray();
			$check_id = $id;
			$crumbs = $this->WorkgroupMedia->find('path', ['for' => $id]);
		}else{
			$media = $this->WorkgroupMedia->find('all', [
			    'conditions' => ['WorkgroupMedia.workgroup_id' => $get_user->workgroup_access, 'WorkgroupMedia.parent_id IS NOT' => null, 'WorkgroupMedia.task_id IS' => null],
				'contain' => ['Workgroups']
			]);
				
			$current_media = $this->WorkgroupMedia->find('all')->where(['WorkgroupMedia.workgroup_id' => $get_user->workgroup_access])->first();
			
			$media = $this->WorkgroupMedia->find('children', ['for' => $current_media->id])->find('threaded');
		}
		
		$check_media = $media->toArray();
				
        $this->set(compact('media', 'check_user', 'check_id', 'parent_media', 'check_media', 'check_parent_media', 'get_user', 'crumbs'));
        $this->set('_serialize', ['media']);
	}

    /**
     * View method
     *
     * @param string|null $id WorkgroupMedia id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $media = $this->WorkgroupMedia->get($id, [
            'contain' => ['Workgroups']
        ]);

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

 		$media = $this->WorkgroupMedia->newEntity();
		$workgroups = TableRegistry::get('Workgroups');
		$user_table = TableRegistry::get('Users');
		$get_user = $user_table->find('all')->where(['Users.id' => $user['id']])->first();
		
		$current_workgroup = $workgroups->get($get_user->workgroup_access);

        if ($this->request->is('post')) {
 			//pr($this->request->getData());
 			if($this->request->getData('parent_id')){
 				$current_media = $this->WorkgroupMedia->get($this->request->getData('parent_id'));
 			}else{
 				$current_media = $this->WorkgroupMedia->find('all')->where(['WorkgroupMedia.workgroup_id' => $current_workgroup->id, 'WorkgroupMedia.parent_id IS' => null])->first();
 			}
			
			$media = $this->WorkgroupMedia->patchEntity($media, $this->request->getData());

 			//pr($this->request->getData());

 			if($id){
 				if($current_media->source_id){
 					$media->source_id = $current_media->source_id;
 				}
 			}
			
			$media->parent_id = $current_media->id;
			
			$media->workgroup_id = $get_user->workgroup_access;

 			$media->uploaded_by = $user['id'];

 			if($id){
				if($current_media->media_dir){
					$media->media_dir = $current_media->media_dir;
				}else{
					$media->media_dir = $current_media->folder_name;
				}
 				
 			}else{
 				$media->media_dir = 'files'.DS.'media'.DS.$current_workgroup->name;
 			}

            if ($result = $this->WorkgroupMedia->save($media)) {
				$this->Log->write('info', 'Forum', $user['first_name'].' '.$user['last_name'].' uploaded '.$this->request->data['file_name']['name'], [], ['request' => true], $result->id, null, $get_user->workgroup_access);
                $this->Flash->success(__('The media has been saved.'));
				if($id){
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
	
    public function addFolder($id=null, $parent_id=null)
    {
		$workgroup_members = TableRegistry::get('WorkgroupsMembers');
		$mediaTable = TableRegistry::get('WorkgroupMedia');
		$workgroups = TableRegistry::get('Workgroups');
		$user_table = TableRegistry::get('Users');
		
		$user = $this->Auth->user();
		$get_user = $user_table->find('all')->where(['Users.id' => $user['id']])->first();
		
		$check_user = $workgroup_members->find('all')->where(['WorkgroupsMembers.user_id' => $user['id']])->contain(['Users', 'Workgroups'])->first();
		
		$current_workgroup = $workgroups->get($get_user->workgroup_access);
		
        $media = $this->WorkgroupMedia->newEntity();
        if ($this->request->is('post')) {
 			
 			$current_media = $this->WorkgroupMedia->find('all')->where(['WorkgroupMedia.workgroup_id' => $current_workgroup->id, 'WorkgroupMedia.parent_id IS' => null])->first();
			
            $media = $this->WorkgroupMedia->patchEntity($media, $this->request->getData());
			if($id){
				$media->source_id = $id;
			}
			
			$media->parent_id = $current_workgroup->id;
			//$media->source_id = $result->id;
			$media->folder_name = $this->request->getData('folder_name');
			$media->workgroup_id = $get_user->workgroup_access;
			$media->uploaded_by = $user['id'];
			
            if ($result = $this->WorkgroupMedia->save($media)) {
				$dir = new Folder(WWW_ROOT . 'files'.DS.'media'.DS.$current_workgroup->name.DS.$this->request->getData('name'), true, 0755);
                $this->Flash->success(__('New folder '.$this->request->getData('folder_name').' created'));
				$this->Log->write('info', 'Media', $user['first_name'].' '.$user['last_name'].' created folder - '.$this->request->getData('folder_name'), [], ['request' => true], $result->id, null, $get_user->workgroup_access);
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The media could not be saved. Please, try again.'));
        }
        $workgroups = $this->WorkgroupMedia->Workgroups->find('list', ['limit' => 200]);
        $this->set(compact('media', 'workgroups'));
        $this->set('_serialize', ['media']);
    }

    /**
     * Edit method
     *
     * @param string|null $id WorkgroupMedia id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
		$user = $this->Auth->user();
        $media = $this->WorkgroupMedia->get($id, [
            'contain' => []
        ]);
		
		$user_table = TableRegistry::get('Users');
		$get_user = $user_table->find('all')->where(['Users.id' => $user['id']])->first();	
		
        if ($this->request->is(['patch', 'post', 'put'])) {
            $media = $this->WorkgroupMedia->patchEntity($media, $this->request->getData());
            if ($this->WorkgroupMedia->save($media)) {
				if($media->folder_name){
					$this->Log->write('info', 'Media', $user['first_name'].' '.$user['last_name'].' edited '.$media->folder_name, [], ['request' => true], $media->id, null, $get_user->workgroup_access);
				}else{
					$this->Log->write('info', 'Media', $user['first_name'].' '.$user['last_name'].' edited '.$media->file_name, [], ['request' => true], $media->id, null, $get_user->workgroup_access);
				}
                $this->Flash->success(__('The media has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The media could not be saved. Please, try again.'));
        }
        $workgroups = $this->WorkgroupMedia->Workgroups->find('list', ['limit' => 200]);
        $this->set(compact('media', 'workgroups'));
        $this->set('_serialize', ['media']);
    }

    /**
     * Delete method
     *
     * @param string|null $id WorkgroupMedia id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
		$user = $this->Auth->user();
        $this->request->allowMethod(['post', 'delete']);
        $media = $this->WorkgroupMedia->get($id);
		
		$user_table = TableRegistry::get('Users');
		$get_user = $user_table->find('all')->where(['Users.id' => $user['id']])->first();
		
        if ($this->WorkgroupMedia->delete($media)) {
			if($media->folder_name){
				$this->Log->write('info', 'Media', $user['first_name'].' '.$user['last_name'].' deleted '.$media->folder_name, [], ['request' => true], $media->id, null, $get_user->workgroup_access);
			}else{
				$this->Log->write('info', 'Media', $user['first_name'].' '.$user['last_name'].' deleted '.$media->file_name, [], ['request' => true], $media->id, null, $get_user->workgroup_access);
			}
            $this->Flash->success(__('The media has been deleted.'));
        } else {
            $this->Flash->error(__('The media could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
