<?php
namespace App\Controller\Workgroup;
use App\Controller\Workgroup\AppController;
use Cake\ORM\TableRegistry;
use Cake\Mailer\Email;
use Cake\Routing\Router;

/**
 * WorkgroupProjectMembers Controller
 *
 * @property \App\Model\Table\WorkgroupProjectMembersTable $WorkgroupProjectMembers
 *
 * @method \App\Model\Entity\WorkgroupProjectMember[] paginate($object = null, array $settings = [])
 */
class WorkgroupProjectMembersController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['WorkgroupProjects', 'Users']
        ];
        $projectsMembers = $this->paginate($this->WorkgroupProjectMembers);

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
        $projectsMember = $this->WorkgroupProjectMembers->get($id, [
            'contain' => ['WorkgroupProjects', 'Users']
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
		$project = TableRegistry::get('WorkgroupProjects');
		$workgroup_members = TableRegistry::get('WorkgroupsMembers');
		$projects_members = TableRegistry::get('WorkgroupProjectMembers');
		$staff = TableRegistry::get('Users');
		
		$existing_ids = null;
		$user_ids = null;
		$users = null;
		
		$user = $this->Auth->user();
		$user_table = TableRegistry::get('Users');	
		$workgroup = TableRegistry::get('Workgroups');	
		$get_user = $user_table->find('all')->where(['Users.id' => $user['id']])->first();
		
		$workgroup_details = $workgroup->find('all', [
		    'conditions' => ['Workgroups.id' => $get_user->workgroup_access],
		]);
		
		$project = $project->get($id);
		
		$workgroup_details = $workgroup_details->first();
						
        $projectsMember = $this->WorkgroupProjectMembers->newEntity();
		
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
			
			$members_entities = $this->WorkgroupProjectMembers->newEntities($data_x);
			if($this->WorkgroupProjectMembers->saveMany($members_entities)){
				$added_members = $staff->find('all', [
				    'conditions' => ['Users.id IN' => $userIDs],
				]);
				
				$w_member_array = $added_members->toArray();
				
				foreach($added_members as $added_members):
					$this->Log->write('info', 'Project', $user['first_name'].' '.$user['last_name'].' added '.$added_members->name.' to '.$workgroup_details->name, [], ['request' => true], $added_members->id, null, $get_user->workgroup_access);
				endforeach;
				
				if($w_member_array){
					$recipients = array();
					$email = new Email('default');
					
					foreach($added_members as $added_member) {
					    $recipients[] = $added_member->email;
					}
					
					$link =  Router::url(['controller' => 'WorkgroupProjects', 'action' => 'view', $project->id, 'workgroup'=>$project->workgroup_id], true);
					
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
				
				$this->Flash->success(__('The project member(s) has been saved.'));
				return $this->redirect(['controller'=>'WorkgroupProjects', 'action' => 'view', $this->request->getData(['project_id'])]);
			}
			
			$this->Flash->error(__('Project members could not be saved. Please, try again.'));
        }
		
        $projects = $this->WorkgroupProjectMembers->WorkgroupProjects->find('list', []);
        //$users = $this->WorkgroupProjectMembers->Users->find('list', ['limit' => 200]);
		
		$users_collect = $workgroup_members->find('all', [
		    'conditions' => ['WorkgroupsMembers.workgroup_id' => $project->workgroup_id, 'NOT'=>['WorkgroupsMembers.user_id'=>$user['id']]]
		]);
		
		foreach($users_collect as $collect):
			$user_ids[] = $collect->user_id;
		endforeach;
		
		$existing_staff = $projects_members->find('all', [
		    'conditions' => ['WorkgroupProjectMembers.project_id' => $project->id]
		]);
		
		foreach($existing_staff as $collect):
			$existing_ids[] = $collect->user_id;
		endforeach;
		
		//$user_ids = implode(',', array_values($user_ids));
		
		if($existing_ids && $user_ids){
			$users = $staff->find('list')->where(['Users.id IN' => $user_ids, 'NOT'=>['AND'=>['Users.id IN' => $existing_ids]]]);
		}elseif($existing_ids){
			$users = $staff->find('list')->where(['Users.id IN' => $existing_ids]);
		}
		
		//pr($users->toArray());
		
        $this->set(compact('projectsMember', 'projects', 'users', 'project', 'workgroup_details'));
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
        $projectsMember = $this->WorkgroupProjectMembers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $projectsMember = $this->WorkgroupProjectMembers->patchEntity($projectsMember, $this->request->getData());
            if ($this->WorkgroupProjectMembers->save($projectsMember)) {
                $this->Flash->success(__('The projects member has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The projects member could not be saved. Please, try again.'));
        }
        $projects = $this->WorkgroupProjectMembers->WorkgroupProjects->find('list', ['limit' => 200]);
        $users = $this->WorkgroupProjectMembers->Users->find('list', ['limit' => 200]);
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
        $projectsMember = $this->WorkgroupProjectMembers->get($id, ['contain' => ['Users']]);
		$project = $projects->get($projectsMember->project_id);
		
		$staff = TableRegistry::get('Users');
		
		$get_user = $staff->find('all')->where(['Users.id' => $user['id']])->first();
		
        if ($this->WorkgroupProjectMembers->delete($projectsMember)) {
			$this->Log->write('info', 'Project', $user['first_name'].' '.$user['last_name'].' deleted '.$projectsMember->user->name, [], ['request' => true], $projectsMember->user->id, null, $get_user->workgroup_access);
			
			$email = new Email('default');
			$email->from(['info@eogportal.com' => 'Ebony Oil & Gas Portal::Projects'])
			    ->to($projectsMember->user->email)
			    ->subject('Removal from project')
			    ->send($user['first_name'].' '.$user['last_name'].' has removed you from project::'.$project->name);
			
            $this->Flash->success(__($projectsMember->user->name.' has been deleted.'));
        } else {
            $this->Flash->error(__($projectsMember->user->name.' could not be deleted. Please, try again.'));
        }

        return $this->redirect(['controller'=>'WorkgroupProjects', 'action' => 'view', $projectsMember->project_id]);
    }
}
