<?php
namespace App\Controller\Workgroup;
use App\Controller\Workgroup\AppController;
use Cake\ORM\TableRegistry;
use Cake\Mailer\Email;
use Cake\Routing\Router;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;

/**
 * WorkgroupWiki Controller
 *
 * @property \App\Model\Table\WorkgroupWikiTable $WorkgroupWiki
 *
 * @method \App\Model\Entity\WorkgroupWiki[] paginate($object = null, array $settings = [])
 */
class WorkgroupWikiController extends AppController
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
		$workgroup = TableRegistry::get('Workgroups');	
		$get_user = $user_table->find('all')->where(['Users.id' => $user['id']])->first();
	
		$workgroup_details = $workgroup->find('all', [
		    'conditions' => ['Workgroups.id' => $get_user->workgroup_access],
		]);
	
		$workgroup_details = $workgroup_details->first();
		
		$workgroup_members = TableRegistry::get('WorkgroupsMembers');
		$workgroup_member = $workgroup_members->find('all')->where(['WorkgroupsMembers.user_id'=>$user['id']])->first();
		
        $wiki = $this->WorkgroupWiki->find('all', [
			'conditions' => ['WorkgroupWiki.workgroup_id' => $get_user->workgroup_access]
		]);

        $this->set(compact('wiki', 'workgroup_details'));
        $this->set('_serialize', ['wiki']);
    }

    /**
     * View method
     *
     * @param string|null $id WorkgroupWiki id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
		$mediaTable = TableRegistry::get('WorkgroupMedia');
		
        $wiki = $this->WorkgroupWiki->get($id, [
            'contain' => ['Workgroups']
        ]);
			
		$media_files = $mediaTable->find('all')->where(['WorkgroupMedia.wiki_id' => $id, 'WorkgroupMedia.file_name IS NOT'=>'']);
		$media_files_count = $mediaTable->find('all')->where(['WorkgroupMedia.wiki_id' => $id, 'WorkgroupMedia.file_name IS NOT'=>''])->count();
			
		$user = $this->Auth->user();
		$user_table = TableRegistry::get('Users');	
		$workgroup = TableRegistry::get('Workgroups');	
		$get_user = $user_table->find('all')->where(['Users.id' => $user['id']])->first();

		$workgroup_details = $workgroup->find('all', [
		    'conditions' => ['Workgroups.id' => $get_user->workgroup_access],
		]);

		$workgroup_details = $workgroup_details->first();
		
		$this->set(compact('media_files', 'media_files_count'));
        $this->set('wiki', $wiki);
		$this->set('workgroup_details', $workgroup_details);
        $this->set('_serialize', ['wiki']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $wiki = $this->WorkgroupWiki->newEntity();
		$user = $this->Auth->user();
		$user_table = TableRegistry::get('Users');	
		$workgroup = TableRegistry::get('Workgroups');
		$workgroup_members = TableRegistry::get('WorkgroupsMembers');	
		$get_user = $user_table->find('all')->where(['Users.id' => $user['id']])->first();
	
		$workgroup_details = $workgroup->find('all', [
		    'conditions' => ['Workgroups.id' => $get_user->workgroup_access],
		]);
	
		$workgroup_details = $workgroup_details->first();
		
		$check_user = $workgroup_members->find('all')->where(['WorkgroupsMembers.user_id' => $user['id']])->contain(['Users', 'Workgroups'])->first();
		
        if ($this->request->is('post')) {
            $wiki = $this->WorkgroupWiki->patchEntity($wiki, $this->request->getData());
			$wiki->workgroup_id = $get_user->workgroup_access;
			
            if ($result = $this->WorkgroupWiki->save($wiki)) {
				$this->Log->write('info', 'Wiki', $user['first_name'].' '.$user['last_name'].' added '.$this->request->getData('title'), [], ['request' => true], $result->id, null, $get_user->workgroup_access);
                $this->Flash->success(__('The wiki has been saved.'));
				
				$dir = new Folder(WWW_ROOT . 'files'.DS.'media'.DS.$check_user->workgroup->name.DS.$this->request->getData('title'), true, 0755);

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The wiki could not be saved. Please, try again.'));
        }
        $workgroups = $this->WorkgroupWiki->Workgroups->find('list', ['limit' => 200]);
        $this->set(compact('wiki', 'workgroups', 'workgroup_details'));
        $this->set('_serialize', ['wiki']);
    }
	
    public function upload($id = null)
    {
 		$user = $this->Auth->user();

 		$parent_id = $id;
 		$current_media = null;
		
		$workgroups = TableRegistry::get('Workgroups');
		$mediaTable = TableRegistry::get('WorkgrouptMedia');
		$user_table = TableRegistry::get('Users');
		$get_user = $user_table->find('all')->where(['Users.id' => $user['id']])->first();
		
		$media = $mediaTable->newEntity();
		
		$current_workgroup = $workgroups->get($get_user->workgroup_access);
		
		$wiki = $this->WorkgroupWiki->find('all')->where(['WorkgroupWiki.id' => $id])->first();

        if ($this->request->is('post')) {
 			//pr($this->request->getData());
 			
 			$current_media = $mediaTable->find('all')->where(['WorkgroupMedia.workgroup_id' => $current_workgroup->id, 'WorkgroupMedia.wiki_id' => $project->id])->first();
			
			$media = $mediaTable->patchEntity($media, $this->request->getData());
			
 			//pr($this->request->getData());
			$media->source_id = $wiki->id;
			
			$media->parent_id = $current_media->id;
			
			$media->workgroup_id = $get_user->workgroup_access;
			$media->wiki_id = $wiki->id;

 			$media->uploaded_by = $user['id'];

 			// if($id){
// 				if($current_media->media_dir){
// 					$media->media_dir = $current_media->media_dir.DS.$wiki->name;
// 				}else{
// 					$media->media_dir = $current_media->folder_name;
// 				}
//  			}else{
 				$media->media_dir = 'files'.DS.'media'.DS.$current_workgroup->name.DS.$wiki->title;
				//}

            if ($result = $mediaTable->save($media)) {
				$this->Log->write('info', 'Project', $user['first_name'].' '.$user['last_name'].' uploaded '.$this->request->data['file_name']['name'], [], ['request' => true], $result->id, $get_user->workgroup_access);
				
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
     * Edit method
     *
     * @param string|null $id WorkgroupWiki id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $wiki = $this->WorkgroupWiki->get($id, [
            'contain' => []
        ]);
			
		$user = $this->Auth->user();
		$user_table = TableRegistry::get('Users');	
		$workgroup = TableRegistry::get('Workgroups');	
		$get_user = $user_table->find('all')->where(['Users.id' => $user['id']])->first();

		$workgroup_details = $workgroup->find('all', [
		    'conditions' => ['Workgroups.id' => $get_user->workgroup_access],
		]);
	
		$workgroup_details = $workgroup_details->first();
			
        if ($this->request->is(['patch', 'post', 'put'])) {
            $wiki = $this->WorkgroupWiki->patchEntity($wiki, $this->request->getData());
            if ($this->WorkgroupWiki->save($wiki)) {
				$this->Log->write('info', 'Wiki', $user['first_name'].' '.$user['last_name'].' edited '.$wiki->title, [], ['request' => true], $wiki->id, null, $get_user->workgroup_access);
                $this->Flash->success(__('The wiki has been saved.'));
				
				$dir_path = new Folder(WWW_ROOT . 'files'.DS.'media'.DS.$department_details->name);
				
				if($dir_path->cd($this->request->getData('title'))){
					rename(WWW_ROOT . 'files'.DS.'media'.DS.$workgroup_details->name.DS.$wiki->title, WWW_ROOT . 'files'.DS.'media'.DS.$workgroup_details->name.DS.$this->request->getData('title'));
				}else{
					$dir = new Folder(WWW_ROOT . 'files'.DS.'media'.DS.$workgroup_details->name.DS.$this->request->getData('title'), true, 0755);
				}

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The wiki could not be saved. Please, try again.'));
        }
        $workgroups = $this->WorkgroupWiki->Workgroups->find('list', ['limit' => 200]);
        $this->set(compact('wiki', 'workgroups', 'workgroup_details'));
        $this->set('_serialize', ['wiki']);
    }

    /**
     * Delete method
     *
     * @param string|null $id WorkgroupWiki id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
		$user = $this->Auth->user();
        $this->request->allowMethod(['post', 'delete']);
        $wiki = $this->WorkgroupWiki->get($id);
		
		$user_table = TableRegistry::get('Users');
		$get_user = $user_table->find('all')->where(['Users.id' => $user['id']])->first();
		
        if ($this->WorkgroupWiki->delete($wiki)) {
			$this->Log->write('info', 'Wiki', $user['first_name'].' '.$user['last_name'].' deleted '.$wiki->title, [], ['request' => true], $wiki->id, null, $get_user->workgroup_access);
            $this->Flash->success(__('The wiki has been deleted.'));
        } else {
            $this->Flash->error(__('The wiki could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
