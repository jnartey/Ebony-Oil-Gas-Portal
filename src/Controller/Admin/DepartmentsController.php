<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;
use Cake\Mailer\Email;

/**
 * Departments Controller
 *
 * @property \App\Model\Table\DepartmentsTable $Departments
 *
 * @method \App\Model\Entity\Department[] paginate($object = null, array $settings = [])
 */
class DepartmentsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users']
        ];
        $departments = $this->paginate($this->Departments);

        $this->set(compact('departments'));
        $this->set('_serialize', ['departments']);
    }

    /**
     * View method
     *
     * @param string|null $id Department id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $department = $this->Departments->get($id, [
            'contain' => ['Users', 'DepartmentForums', 'DepartmentsMembers', 'DepartmentMedia', 'DepartmentWiki']
        ]);
			
		$department_members = TableRegistry::get('DepartmentsMembers');
			
		$members = $department_members->find('all', [
		    'conditions' => ['DepartmentsMembers.department_id' => $id],
			'contain' => ['Users']
		]);

        $this->set('department', $department);
		$this->set('members', $members);
        $this->set('_serialize', ['department']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
		$userA = $this->Auth->user();
		$mediaTable = TableRegistry::get('DepartmentMedia');
		
        $department = $this->Departments->newEntity();
		$media = $mediaTable->newEntity();
		
        if ($this->request->is('post')) {
            $department = $this->Departments->patchEntity($department, $this->request->getData());
            if ($result = $this->Departments->save($department)) {
                $this->Flash->success(__('The department has been saved.'));
				$this->Log->write('info', 'Department', $userA['first_name'].' '.$userA['last_name'].' added '.$this->request->getData('name'), [], ['request' => true], $result->id);
				
				$media->folder_name = $this->request->getData('name');
				$media->department_id = $result->id;
				$media->media_dir = 'files'.DS.'media';
				
				if($mediaTable->save($media)){
					$dir = new Folder(WWW_ROOT . 'files'.DS.'media'.DS.$this->request->getData('name'), true, 0755);
				}
				
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The department could not be saved. Please, try again.'));
        }
        $users = $this->Departments->Users->find('list');
        $this->set(compact('department', 'users'));
        $this->set('_serialize', ['department']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Department id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
		$userA = $this->Auth->user();
        $department = $this->Departments->get($id, [
            'contain' => []
        ]);
		
		$mediaTable = TableRegistry::get('DepartmentMedia');
		$media = $mediaTable->newEntity();
		
		$current_media = $mediaTable->find('all', [
		    'conditions' => ['DepartmentMedia.department_id' => $department->id]
		]);
			
		$current_media_array = $current_media->toArray();
			
		$current_media = $current_media->first();
		
        if ($this->request->is(['patch', 'post', 'put'])) {
            $department = $this->Departments->patchEntity($department, $this->request->getData());
            if ($this->Departments->save($department)) {
                $this->Flash->success(__('The department has been saved.'));
				$this->Log->write('info', 'Department', $userA['first_name'].' '.$userA['last_name'].' edited '.$department->name, [], ['request' => true], $department->id);
				
				if(!$current_media_array){
					$media->folder_name = $department->name;
					$media->department_id = $department->id;
					$media->media_dir = 'files'.DS.'media';
				
					if($mediaTable->save($media)){
						$dir = new Folder(WWW_ROOT . 'files'.DS.'media'.DS.$department->name, true, 0755);
					}
				}else{
					$media->id = $current_media->id;
					$media->folder_name = $this->request->getData('name');
					$media->media_dir = 'files'.DS.'media';
					
					$mediaTable->save($media);
					
					$dir_path = new Folder(WWW_ROOT . 'files'.DS.'media');
					
					if($dir_path->cd($this->request->getData('name'))){
						rename(WWW_ROOT . 'files'.DS.'media'.DS.$department->name, WWW_ROOT . 'files'.DS.'media'.DS.$this->request->getData('name'));
					}else{
						$dir = new Folder(WWW_ROOT . 'files'.DS.'media'.DS.$this->request->getData('name'), true, 0755);
					}
				}
				
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The department could not be saved. Please, try again.'));
        }
        $users = $this->Departments->Users->find('list');
        $this->set(compact('department', 'users'));
        $this->set('_serialize', ['department']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Department id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
		$userA = $this->Auth->user();
		$department_members = TableRegistry::get('DepartmentsMembers');
        $this->request->allowMethod(['post', 'delete']);
        $department = $this->Departments->get($id);
        if ($this->Departments->delete($department)) {
			$department_members->deleteAll([
			    'department_id' => $department->id
			]);
			$this->Log->write('info', 'Department', $userA['first_name'].' '.$userA['last_name'].' added '.$department->name, [], ['request' => true]);
            $this->Flash->success(__($department->name.' has been deleted.'));
        } else {
            $this->Flash->error(__($department->name.' could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
