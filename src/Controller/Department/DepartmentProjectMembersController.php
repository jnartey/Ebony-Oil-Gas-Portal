<?php
namespace App\Controller\Department;
use App\Controller\Department\AppController;
use Cake\ORM\TableRegistry;
use Cake\Mailer\Email;
use Cake\Routing\Router;


/**
 * DepartmentProjectMembers Controller
 *
 * @property \App\Model\Table\DepartmentProjectMembersTable $DepartmentProjectMembers
 *
 * @method \App\Model\Entity\DepartmentProjectMember[] paginate($object = null, array $settings = [])
 */
class DepartmentProjectMembersController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['DepartmentProjects', 'Users']
        ];
        $projectsMembers = $this->paginate($this->DepartmentProjectMembers);

        $this->set(compact('projectsMembers'));
        $this->set('_serialize', ['projectsMembers']);
    }

    /**
     * View method
     *
     * @param string|null $id Projects Member id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $projectsMember = $this->DepartmentProjectMembers->get($id, [
            'contain' => ['DepartmentProjects', 'Users']
        ]);

        $this->set('projectsMember', $projectsMember);
        $this->set('_serialize', ['projectsMember']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($id=null)
    {
		$projects = TableRegistry::get('DepartmentProjects');
		$department_members = TableRegistry::get('DepartmentsMembers');
		$department = TableRegistry::get('Departments');
		$projects_members = TableRegistry::get('DepartmentProjectMembers');
		$staff = TableRegistry::get('Users');
		
		$existing_ids = null;
		
		$user = $this->Auth->user();
		
		$get_user = $staff->find('all')->where(['Users.id' => $user['id']])->first();
		
		$department_details = $department->find('all', [
		    'conditions' => ['Department.id' => $get_user->department_access],
		]);
						
        $projectsMember = $this->DepartmentProjectMembers->newEntity();
		
		$project = $projects->get($id);
		
        if ($this->request->is('post')) {
			$i = 1;
			$data_x = array();
			$userIDs = array();
			
			foreach($this->request->getData(['user_id']) as $u_ids):
				$data_x[$i]['user_id'] = $u_ids;
				$data_x[$i]['project_id'] = $this->request->getData(['project_id']);
				$i++;
			endforeach;
			
			foreach($this->request->getData(['user_id']) as $u_ids):
				$userIDs[] = $u_ids;
			endforeach;
			
			$members_entities = $this->DepartmentProjectMembers->newEntities($data_x);
			if($this->DepartmentProjectMembers->saveMany($members_entities)){
				$added_members = $staff->find('all', [
				    'conditions' => ['Users.id IN' => $userIDs],
				]);
				
				$d_member_array = $added_members->toArray();
				
				foreach($added_members as $added_member):
					$this->Log->write('info', 'Project', $user['first_name'].' '.$user['last_name'].' added '.$added_member->name.' to project::'.$project->name, [], ['request' => true], $added_member->id, $get_user->department_access);
				endforeach;
				
				$this->Flash->success(__('The project member(s) has been added.'));
				
				if($d_member_array){
					$recipients = array();
					$email = new Email('default');
					
					foreach($added_members as $added_member) {
					    $recipients[] = $added_member->email;
					}
					
					$link =  Router::url(['controller' => 'DepartmentProjects', 'action' => 'view', $project->id, 'department'=>$project->department_id], true);
					
					try{
					  	$email->from(['info@eogportal.com' => 'Ebony Oil & Gas Portal::Projects'])
						    ->to($recipients)
						    ->subject($project->name)
							->emailFormat('html')
							->send($user['first_name'].' '.$user['last_name'].' has added you to a project<br />'
								.'<strong>Project Title: </strong>'.$project->name.'<br />'
								.'<strong>Project Duration: </strong>'.$project->start_date.' - '.$project->end_date.'<br />'
								.'<strong>Project Description</strong><br />'.$project->description.'<br />'
								.'<a href="'.$link.'">Click here to view</a>'); 
					} catch (Exception $e) {
			            echo 'Exception : ',  $e->getMessage(), "\n";
			        }
				  	
				}
				
				return $this->redirect(['controller'=>'DepartmentProjects', 'action' => 'view', $this->request->getData(['project_id'])]);
			}
			
			$this->Flash->error(__('Project members could not be saved. Please, try again.'));
        }
		
        //$projects = $this->DepartmentProjectMembers->DepartmentProjects->find('list', []);
        //$users = $this->DepartmentProjectMembers->Users->find('list', ['limit' => 200]);
		
		$users_collect = $department_members->find('all', [
		    'conditions' => ['DepartmentsMembers.department_id' => $project->department_id, 'NOT'=>['DepartmentsMembers.user_id'=>$user['id']]]
		]);
		
		foreach($users_collect as $collect):
			$user_ids[] = $collect->user_id;
		endforeach;
		
		$existing_staff = $projects_members->find('all', [
		    'conditions' => ['DepartmentProjectMembers.project_id' => $project->id]
		]);
		
		foreach($existing_staff as $collect):
			$existing_ids[] = $collect->user_id;
		endforeach;
		
		//$user_ids = implode(',', array_values($user_ids));
		
		if($existing_ids){
			$users = $staff->find('list')->where(['Users.id IN' => $user_ids, 'NOT'=>['AND'=>['Users.id IN' => $existing_ids]]]);
		}else{
			$users = $staff->find('list')->where(['Users.id IN' => $user_ids]);
		}
		
		//pr($users->toArray());
		
        $this->set(compact('projectsMember', 'projects', 'users', 'project'));
        $this->set('_serialize', ['projectsMember']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Projects Member id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
		$userA = $this->Auth->user();
        $projectsMember = $this->DepartmentProjectMembers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $projectsMember = $this->DepartmentProjectMembers->patchEntity($projectsMember, $this->request->getData());
            if ($this->DepartmentProjectMembers->save($projectsMember)) {
                $this->Flash->success(__('The projects member has been updated.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The projects member could not be saved. Please, try again.'));
        }
        $projects = $this->DepartmentProjectMembers->DepartmentProjects->find('list', ['limit' => 200]);
        $users = $this->DepartmentProjectMembers->Users->find('list', ['limit' => 200]);
        $this->set(compact('projectsMember', 'projects', 'users'));
        $this->set('_serialize', ['projectsMember']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Projects Member id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
		$projects = TableRegistry::get('DepartmentProjects');
		
		$user = $this->Auth->user();
        $this->request->allowMethod(['post', 'delete']);
        $projectsMember = $this->DepartmentProjectMembers->get($id, ['contain' => ['Users']]);
		$project = $projects->get($projectsMember->project_id);
		
		$staff = TableRegistry::get('Users');
		
		$get_user = $staff->find('all')->where(['Users.id' => $user['id']])->first();
		
        if ($this->DepartmentProjectMembers->delete($projectsMember)) {
			$this->Log->write('info', 'Project', $user['first_name'].' '.$user['last_name'].' deleted '.$projectsMember->user->name.' from project::'.$project->name, [], ['request' => true], $projectsMember->user->id, $get_user->department_access);
			
			$email = new Email('default');
			$email->from(['info@eogportal.com' => 'Ebony Oil & Gas Portal::Projects'])
			    ->to($projectsMember->user->email)
			    ->subject('Removal from project')
			    ->send($user['first_name'].' '.$user['last_name'].' has removed you from project::'.$project->name);
			
            $this->Flash->success(__($projectsMember->user->name.' has been removed.'));
        } else {
            $this->Flash->error(__($projectsMember->user->name.' could not be deleted. Please, try again.'));
        }

        return $this->redirect(['controller'=>'DepartmentProjects', 'action' => 'view', $projectsMember->project_id]);
    }
}
