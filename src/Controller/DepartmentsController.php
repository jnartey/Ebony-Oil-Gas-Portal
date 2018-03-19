<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
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
		
		$department_ids = null;
		$department = null;
		$staff = null;
		
		$user = $this->Auth->user();
		
		$department_members = TableRegistry::get('DepartmentsMembers');
		$users = TableRegistry::get('Users');
		
		$user_details = $department_members->find('all', [
		    'conditions' => ['DepartmentsMembers.user_id' => $user['id']],
			'contain' => ['Departments']
		]);
			
		//$user_check = $user_details->first();
			
		//$data = $user_details->toArray();
					
		$department_ids = null;
		
		if($user_details){
			foreach($user_details as $collect):
				$department_ids[] = $collect->department->id;
			endforeach;
			
			if(is_array($department_ids)){
				//$department_ids = implode(',', array_values($department_ids));
				$staff = $department_members->find('all')->where(['DepartmentsMembers.department_id IN' => $department_ids, 'NOT'=>['DepartmentsMembers.user_id' => $user['id']]])->contain(['Users', 'Departments']);
			}elseif(!empty($department_ids)){
				$staff = $department_members->find('all')->where(['DepartmentsMembers.department_id' => $department_ids, 'NOT'=>['DepartmentsMembers.user_id' => $user['id']]])->contain(['Users', 'Departments']);
				$department = $this->Departments->get($department_ids);
			}
		}
				
		//$department = $this->Departments->get($department_ids);
		
		//$data = $staff->toArray();
		//pr($data);

        $this->set(compact('departments', 'staff', 'department', 'user_details', 'user_check'));
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
            'contain' => ['Users', 'DepartmentsMembers']
        ]);
		
		$session = $this->request->session();	
		$session->write('departmentid', $id);
		
		if ($session->check('departmentid')) {
		    // Config.language exists and is not null.
			
			//return $this->redirect(['controller'=>'pages', 'action'=>'index', 'department'=>true]);
		}

        $this->set('department', $department);
        $this->set('_serialize', ['department']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
		$user = $this->Auth->user();
		$mediaTable = TableRegistry::get('DepartmentMedia');
		
        $department = $this->Departments->newEntity();
		$media = $mediaTable->newEntity();
		
        if ($this->request->is('post')) {
            $department = $this->Departments->patchEntity($department, $this->request->getData());
            if ($result = $this->Departments->save($department)) {
				$this->Log->write('info', 'Department', $user['first_name'].' '.$user['last_name'].' added '.$this->request->getData('name'), [], ['request' => true], $result->id);
				$media->source_id = $result->id;
				$media->folder_name = $this->request->getData('name');
				$media->department_id = $result->id;
				$media->media_dir = 'files'.DS.'media';
				
				if($mediaTable->save($media)){
					$dir = new Folder(WWW_ROOT . 'files'.DS.'media'.DS.$this->request->getData('name'), true, 0755);
				}
				
                $this->Flash->success(__('The department has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The department could not be saved. Please, try again.'));
        }
        $users = $this->Departments->Users->find('list', ['limit' => 200]);
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
        if ($this->request->is(['patch', 'post', 'put'])) {
            $department = $this->Departments->patchEntity($department, $this->request->getData());
            if ($this->Departments->save($department)) {
				$this->Log->write('info', 'Department', $user['first_name'].' '.$user['last_name'].' edited '.$department->name, [], ['request' => true], $department->id);
                $this->Flash->success(__('The department has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The department could not be saved. Please, try again.'));
        }
        $users = $this->Departments->Users->find('list', ['limit' => 200]);
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
			$this->Log->write('info', 'Department', $user['first_name'].' '.$user['last_name'].' deleted '.$department->name, [], ['request' => true], $department->id);
            $this->Flash->success(__($department->name.' has been deleted.'));
        } else {
            $this->Flash->error(__($department->name.' could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
