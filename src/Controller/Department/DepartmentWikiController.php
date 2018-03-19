<?php
namespace App\Controller\Department;
use App\Controller\Department\AppController;
use Cake\ORM\TableRegistry;
use Cake\Mailer\Email;
use Cake\Routing\Router;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;

/**
 * DepartmentWiki Controller
 *
 * @property \App\Model\Table\DepartmentWikiTable $DepartmentWiki
 *
 * @method \App\Model\Entity\DepartmentWiki[] paginate($object = null, array $settings = [])
 */
class DepartmentWikiController extends AppController
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
		
		$department_members = TableRegistry::get('DepartmentsMembers');
		$department_member = $department_members->find('all')->where(['DepartmentsMembers.user_id'=>$user['id']])->first();
		
        $wiki = $this->DepartmentWiki->find('all', [
			'conditions' => ['DepartmentWiki.department_id' => $get_user->department_access]
		]);

        $this->set(compact('wiki'));
        $this->set('_serialize', ['wiki']);
    }

    /**
     * View method
     *
     * @param string|null $id DepartmentWiki id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
		$mediaTable = TableRegistry::get('DepartmentMedia');
		
        $wiki = $this->DepartmentWiki->get($id, [
            'contain' => ['Departments']
        ]);
			
		$media_files = $mediaTable->find('all')->where(['DepartmentMedia.wiki_id' => $id, 'DepartmentMedia.file_name IS NOT'=>'']);
		$media_files_count = $mediaTable->find('all')->where(['DepartmentMedia.wiki_id' => $id, 'DepartmentMedia.file_name IS NOT'=>''])->count();
		
		$this->set(compact('media_files', 'media_files_count'));
        $this->set('wiki', $wiki);
        $this->set('_serialize', ['wiki']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $wiki = $this->DepartmentWiki->newEntity();
		$user = $this->Auth->user();
		$user_table = TableRegistry::get('Users');		
		$department_members = TableRegistry::get('DepartmentsMembers');
		$get_user = $user_table->find('all')->where(['Users.id' => $user['id']])->first();
		
		$check_user = $department_members->find('all')->where(['DepartmentsMembers.user_id' => $user['id']])->contain(['Users', 'Departments'])->first();
		
        if ($this->request->is('post')) {
            $wiki = $this->DepartmentWiki->patchEntity($wiki, $this->request->getData());
			$wiki->department_id = $get_user->department_access;
			
            if ($result = $this->DepartmentWiki->save($wiki)) {
				$this->Log->write('info', 'Wiki', $user['first_name'].' '.$user['last_name'].' added '.$this->request->getData('title'), [], ['request' => true], $result->id, $get_user->department_access);
                $this->Flash->success(__('The wiki has been saved.'));
				
				$dir = new Folder(WWW_ROOT . 'files'.DS.'media'.DS.$check_user->department->name.DS.$this->request->getData('title'), true, 0755);

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The wiki could not be saved. Please, try again.'));
        }
        $departments = $this->DepartmentWiki->Departments->find('list', ['limit' => 200]);
        $this->set(compact('wiki', 'departments'));
        $this->set('_serialize', ['wiki']);
    }

    /**
     * Edit method
     *
     * @param string|null $id DepartmentWiki id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
		$user = $this->Auth->user();
        $wiki = $this->DepartmentWiki->get($id, [
            'contain' => []
        ]);
		
		$user_table = TableRegistry::get('Users');
		$get_user = $user_table->find('all')->where(['Users.id' => $user['id']])->first();	
		$department = TableRegistry::get('Departments');	
			
		$department_details = $department->find('all', [
		    'conditions' => ['Departments.id' => $get_user->department_access],
		]);
		
        if ($this->request->is(['patch', 'post', 'put'])) {
            $wiki = $this->DepartmentWiki->patchEntity($wiki, $this->request->getData());
            if ($this->DepartmentWiki->save($wiki)) {
				$this->Log->write('info', 'Wiki', $user['first_name'].' '.$user['last_name'].' edited '.$wiki->title, [], ['request' => true], $wiki->id, $get_user->department_access);
                $this->Flash->success(__('The wiki has been saved.'));
				
				$dir_path = new Folder(WWW_ROOT . 'files'.DS.'media'.DS.$department_details->name);
				
				if($dir_path->cd($this->request->getData('title'))){
					rename(WWW_ROOT . 'files'.DS.'media'.DS.$department_details->name.DS.$wiki->title, WWW_ROOT . 'files'.DS.'media'.DS.$department_details->name.DS.$this->request->getData('title'));
				}else{
					$dir = new Folder(WWW_ROOT . 'files'.DS.'media'.DS.$department_details->name.DS.$this->request->getData('title'), true, 0755);
				}

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The wiki could not be saved. Please, try again.'));
        }
        $departments = $this->DepartmentWiki->Departments->find('list', ['limit' => 200]);
        $this->set(compact('wiki', 'departments'));
        $this->set('_serialize', ['wiki']);
    }
	
    public function upload($id = null)
    {
 		$user = $this->Auth->user();

 		$parent_id = $id;
 		$current_media = null;
		
		$departments = TableRegistry::get('Departments');
		$mediaTable = TableRegistry::get('DepartmentMedia');
		$user_table = TableRegistry::get('Users');
		$get_user = $user_table->find('all')->where(['Users.id' => $user['id']])->first();
		
		$media = $mediaTable->newEntity();
		
		$current_department = $departments->get($get_user->department_access);
		
		$wiki = $this->DepartmentWiki->find('all')->where(['DepartmentWiki.id' => $id])->first();

        if ($this->request->is('post')) {
 			//pr($this->request->getData());
 			
 			$current_media = $mediaTable->find('all')->where(['DepartmentMedia.department_id' => $current_department->id, 'DepartmentMedia.wiki_id' => $project->id])->first();
			
			$media = $mediaTable->patchEntity($media, $this->request->getData());
			
 			//pr($this->request->getData());
			$media->source_id = $wiki->id;
			
			$media->parent_id = $current_media->id;
			
			$media->department_id = $get_user->department_access;
			$media->wiki_id = $wiki->id;

 			$media->uploaded_by = $user['id'];

 			// if($id){
// 				if($current_media->media_dir){
// 					$media->media_dir = $current_media->media_dir.DS.$wiki->name;
// 				}else{
// 					$media->media_dir = $current_media->folder_name;
// 				}
//  			}else{
 				$media->media_dir = 'files'.DS.'media'.DS.$current_department->name.DS.$wiki->title;
				//}

            if ($result = $mediaTable->save($media)) {
				$this->Log->write('info', 'Project', $user['first_name'].' '.$user['last_name'].' uploaded '.$this->request->data['file_name']['name'], [], ['request' => true], $result->id, $get_user->department_access);
				
				$resultJ = json_encode(array('result' => '<div class="callout success">'.$this->request->data['file_name']['name'].' uploaded successfully.</div>'));
				$this->response->type('json');
				$this->response->body($resultJ);
				return $this->response;
				
				if($id){
					return $this->redirect(['action' => 'view', $project->id]);
				}else{
					return $this->redirect(['action' => 'index']);
				}
            }
			$resultJ = json_encode(array('result' => '<div class="callout error">'.$this->request->data['file_name']['name'].' could not be uploaded. Please, try again..</div>'));
			$this->response->type('json');
			$this->response->body($resultJ);
			return $this->response;
        }

        $this->set(compact('media', 'user', 'parent_id'));
        $this->set('_serialize', ['media']);
    }

    /**
     * Delete method
     *
     * @param string|null $id DepartmentWiki id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
		$user = $this->Auth->user();
        $this->request->allowMethod(['post', 'delete']);
        $wiki = $this->DepartmentWiki->get($id);
		
		$user_table = TableRegistry::get('Users');
		$get_user = $user_table->find('all')->where(['Users.id' => $user['id']])->first();
		
        if ($this->DepartmentWiki->delete($wiki)) {
			$this->Log->write('info', 'Wiki', $user['first_name'].' '.$user['last_name'].' deleted '.$wiki->title, [], ['request' => true], $wiki->id, $get_user->department_access);
            $this->Flash->success(__('The wiki has been deleted.'));
        } else {
            $this->Flash->error(__('The wiki could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
