<?php
namespace App\Controller\Department;
use App\Controller\Department\AppController;
use Cake\ORM\TableRegistry;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;
use Cake\Event\Event;
use Cake\Mailer\Email;
use Cake\Routing\Router;

/**
 * DepartmentMedia Controller
 *
 * @property \App\Model\Table\DepartmentMediaTable $DepartmentMedia
 *
 * @method \App\Model\Entity\DepartmentMedia[] paginate($object = null, array $settings = [])
 */
class DepartmentMediaController extends AppController
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
		
 		$department_members = TableRegistry::get('DepartmentsMembers');
 		$department = TableRegistry::get('Departments');
		$user_table = TableRegistry::get('Users');
 		$department_details = null;
		
 		$department_members = TableRegistry::get('DepartmentsMembers');
		$user_table = TableRegistry::get('Users');
		$get_user = $user_table->find('all')->where(['Users.id' => $activeUser['id']])->first();
			
		$department_details = $department_members->find('all', [
		    'conditions' => ['DepartmentsMembers.user_id' => $activeUser['id'], 'DepartmentsMembers.department_id' => $get_user->department_access],
		]);
			
		$department_details = $department_details->first();
		
		//$department_details_ch = $department_details->toArray();
		$department_id = null;
		$department_data = null;
		//$department_id = $this->request->getQuery('department');
					
		if(empty($department_details)){
			if($activeUser['role_id'] == 1){
				
				if($get_user->department_access){
					
					$department_data = $department->find('all', [
					    'conditions' => ['Departments.id' => $get_user->department_access],
					]);
												
					$department_data = $department_data->first();
					$department_details = null;
					
				}else{
					//$this->Flash->error(__('Invalid Url'));
					return $this->redirect('/');
				}					
			}else{
				$this->Flash->error(__('You are not a member of this department'));
				return $this->redirect('/');
			}
		}else{
			$department_data = $department->find('all', [
			    'conditions' => ['Departments.id' => $department_details->department_id],
			]);
			
			$department_data = $department_data->first();
			
		}
												
 		$this->set(compact('activeUser', 'user_details', 'department_members', 'department_details', 'department_data'));
    }
	
	public $components = ['CakephpBlueimpUpload.Uploader'];
	public $helpers    = ['CakephpBlueimpUpload.BlueimpUpload'];
	
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
	
	//Media Access | 1=>Access to public, 2=>Private, 3=>Department only
	
    public function index($id = null)
    {
		$department_members = TableRegistry::get('DepartmentsMembers');	
		$project_members = TableRegistry::get('DepartmentProjects');		
		$user = $this->Auth->user();
		$user_table = TableRegistry::get('Users');		
		$get_user = $user_table->find('all')->where(['Users.id' => $user['id']])->first();
		$check_id = null;
		$parent_media = null;
		$check_parent_media = null;
		$crumbs = null;
		
		$check_user = $department_members->find('all')->where(['DepartmentsMembers.user_id' => $user['id']])->contain(['Users', 'Departments'])->first();
		
		if($id){
			$media = $this->DepartmentMedia->find('children', ['for' => $id])->find('threaded');
			$crumbs = $this->DepartmentMedia->find('path', ['for' => $id]);
			$parent_media = $this->DepartmentMedia->find('all')->where(['DepartmentMedia.id' => $id])->contain(['Departments'])->first();
			$check_parent_media = $parent_media->toArray();
			$check_id = $id;
			$crumbs = $this->DepartmentMedia->find('path', ['for' => $id]);
		}else{
			
			$current_media = $this->DepartmentMedia->find('all')->where(['DepartmentMedia.department_id' => $get_user->department_access])->first();
			
			$media = $this->DepartmentMedia->find('children', ['for' => $current_media->id])->find('threaded');
		}
		
		$check_media = $media->toArray();
		
 		$userTable = TableRegistry::get('Users');
 		$user_pro = $userTable->find('all')->where(['Users.id'=>$user['id']])->first();
		 				
        $this->set(compact('media', 'check_user', 'check_id', 'parent_media', 'check_media', 'check_parent_media', 'get_user', 'crumbs', 'user_pro'));
        $this->set('_serialize', ['media']);
    }
	
	public function mediaContent($id = null){
		$department_members = TableRegistry::get('DepartmentsMembers');	
		$project_members = TableRegistry::get('DepartmentProjects');		
		$user = $this->Auth->user();
		$user_table = TableRegistry::get('Users');		
		$get_user = $user_table->find('all')->where(['Users.id' => $user['id']])->first();
		$check_id = null;
		$parent_media = null;
		$check_parent_media = null;
		$crumbs = null;
		
		$check_user = $department_members->find('all')->where(['DepartmentsMembers.user_id' => $user['id']])->contain(['Users', 'Departments'])->first();
		
		if($id){
			$media = $this->DepartmentMedia->find('children', ['for' => $id])->find('threaded');
			$crumbs = $this->DepartmentMedia->find('path', ['for' => $id]);
			$parent_media = $this->DepartmentMedia->find('all')->where(['DepartmentMedia.id' => $id])->contain(['Departments'])->first();
			$check_parent_media = $parent_media->toArray();
			$check_id = $id;
			$crumbs = $this->DepartmentMedia->find('path', ['for' => $id]);
		}else{
			
			$current_media = $this->DepartmentMedia->find('all')->where(['DepartmentMedia.department_id' => $get_user->department_access])->first();
			
			$media = $this->DepartmentMedia->find('children', ['for' => $current_media->id])->find('threaded');
		}
		
		$check_media = $media->toArray();
		
 		$userTable = TableRegistry::get('Users');
 		$user_pro = $userTable->find('all')->where(['Users.id'=>$user['id']])->first();
		 				
        $this->set(compact('media', 'check_user', 'check_id', 'parent_media', 'check_media', 'check_parent_media', 'get_user', 'crumbs', 'user_pro'));
        $this->set('_serialize', ['media']);
	}

    /**
     * View method
     *
     * @param string|null $id DepartmentMedia id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $media = $this->DepartmentMedia->get($id, [
            'contain' => ['Departments']
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

 		$media = $this->DepartmentMedia->newEntity();
		
		$departments = TableRegistry::get('Departments');
		$user_table = TableRegistry::get('Users');
		$get_user = $user_table->find('all')->where(['Users.id' => $user['id']])->first();
		
		$current_department = $departments->get($get_user->department_access);

        if ($this->request->is('post')) {
 			//pr($this->request->getData());
 			if($this->request->getData('parent_id')){
 				$current_media = $this->DepartmentMedia->get($this->request->getData('parent_id'));
 			}else{
 				$current_media = $this->DepartmentMedia->find('all')->where(['DepartmentMedia.department_id' => $current_department->id, 'DepartmentMedia.parent_id IS' => null])->first();
 			}
			
			$media = $this->DepartmentMedia->patchEntity($media, $this->request->getData());
			
 			//pr($this->request->getData());

 			if($id){
 				if($current_media->source_id){
 					$media->source_id = $current_media->source_id;
 				}
 			}
			
			$media->parent_id = $current_media->id;
			
			$media->department_id = $get_user->department_access;

 			$media->uploaded_by = $user['id'];

 			if($id){
				if($current_media->media_dir){
					$media->media_dir = $current_media->media_dir;
				}else{
					$media->media_dir = $current_media->folder_name;
				}
 			}else{
 				$media->media_dir = 'files'.DS.'media'.DS.$current_department->name;
 			}

            if ($result = $this->DepartmentMedia->save($media)) {
				$this->Log->write('info', 'Forum', $user['first_name'].' '.$user['last_name'].' uploaded '.$this->request->data['file_name']['name'], [], ['request' => true], $result->id, $get_user->department_access);
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
			
			$resultJ = json_encode(array('result' => '<div class="callout success">'.$this->request->data['file_name']['name'].' could not be uploaded. Please, try again.</div>'));
			$this->response->type('json');
			$this->response->body($resultJ);
			return $this->response;
        }

        $this->set(compact('media', 'user', 'parent_id'));
        $this->set('_serialize', ['media']);
    }
	
    public function addFolder($id=null, $parent_id=null)
    {
		$department_members = TableRegistry::get('DepartmentsMembers');
		$mediaTable = TableRegistry::get('DepartmentMedia');
		$departments = TableRegistry::get('Departments');
		$user_table = TableRegistry::get('Users');
		
		$user = $this->Auth->user();
		$get_user = $user_table->find('all')->where(['Users.id' => $user['id']])->first();
		
		$check_user = $department_members->find('all')->where(['DepartmentsMembers.user_id' => $user['id']])->contain(['Users', 'Departments'])->first();
		
		$current_department = $departments->get($get_user->department_access);
		
        $media = $this->DepartmentMedia->newEntity();
        if ($this->request->is('post')) {
 			
 			$current_media = $this->DepartmentMedia->find('all')->where(['DepartmentMedia.department_id' => $current_department->id, 'DepartmentMedia.parent_id IS' => null])->first();
			
            $media = $this->DepartmentMedia->patchEntity($media, $this->request->getData());
			if($id){
				$media->source_id = $id;
			}
			
			$media->parent_id = $current_department->id;
			//$media->source_id = $result->id;
			$media->folder_name = $this->request->getData('folder_name');
			$media->department_id = $get_user->department_access;
			$media->uploaded_by = $user['id'];
			
            if ($result = $this->DepartmentMedia->save($media)) {
				$dir = new Folder(WWW_ROOT . 'files'.DS.'media'.DS.$current_department->name.DS.$this->request->getData('name'), true, 0755);
                $this->Flash->success(__('New folder '.$this->request->getData('folder_name').' created'));
				$this->Log->write('info', 'Media', $user['first_name'].' '.$user['last_name'].' created folder - '.$this->request->getData('folder_name'), [], ['request' => true], $result->id, $get_user->department_access);
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The media could not be saved. Please, try again.'));
        }
        $departments = $this->DepartmentMedia->Departments->find('list', ['limit' => 200]);
        $this->set(compact('media', 'departments'));
        $this->set('_serialize', ['media']);
    }

    /**
     * Edit method
     *
     * @param string|null $id DepartmentMedia id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
		$user = $this->Auth->user();
        $media = $this->DepartmentMedia->get($id, [
            'contain' => []
        ]);
			
		$user_table = TableRegistry::get('Users');
		$get_user = $user_table->find('all')->where(['Users.id' => $user['id']])->first();
			
        if ($this->request->is(['patch', 'post', 'put'])) {
            $media = $this->DepartmentMedia->patchEntity($media, $this->request->getData());
            if ($this->DepartmentMedia->save($media)) {
				if($media->folder_name){
					$this->Log->write('info', 'Media', $user['first_name'].' '.$user['last_name'].' edited '.$media->folder_name, [], ['request' => true], $media->id, $get_user->department_access);
				}else{
					$this->Log->write('info', 'Media', $user['first_name'].' '.$user['last_name'].' edited '.$media->file_name, [], ['request' => true], $media->id, $get_user->department_access);
				}
                $this->Flash->success(__('The media has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The media could not be saved. Please, try again.'));
        }
        $departments = $this->DepartmentMedia->Departments->find('list', ['limit' => 200]);
        $this->set(compact('media', 'departments'));
        $this->set('_serialize', ['media']);
    }

    /**
     * Delete method
     *
     * @param string|null $id DepartmentMedia id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
		$user = $this->Auth->user();
        $this->request->allowMethod(['post', 'delete']);
        $media = $this->DepartmentMedia->get($id);
		
		$user_table = TableRegistry::get('Users');
		$get_user = $user_table->find('all')->where(['Users.id' => $user['id']])->first();
		
        if ($this->DepartmentMedia->delete($media)) {
			if($media->folder_name){
				$this->Log->write('info', 'Media', $user['first_name'].' '.$user['last_name'].' deleted '.$media->folder_name, [], ['request' => true], $media->id, $get_user->department_access);
			}else{
				$this->Log->write('info', 'Media', $user['first_name'].' '.$user['last_name'].' deleted '.$media->file_name, [], ['request' => true], $media->id, $get_user->department_access);
			}
            $this->Flash->success(__('The media has been deleted.'));
        } else {
            $this->Flash->error(__('The media could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
