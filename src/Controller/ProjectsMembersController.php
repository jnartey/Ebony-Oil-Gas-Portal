<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Mailer\Email;
/**
 * ProjectsMembers Controller
 *
 * @property \App\Model\Table\ProjectsMembersTable $ProjectsMembers
 */
class ProjectsMembersController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Projects', 'Users']
        ];
        $projectsMembers = $this->paginate($this->ProjectsMembers);

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
        $projectsMember = $this->ProjectsMembers->get($id, [
            'contain' => ['Projects', 'Users']
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
		$project = TableRegistry::get('Projects');
		$department_members = TableRegistry::get('DepartmentsMembers');
		$projects_members = TableRegistry::get('ProjectsMembers');
		$staff = TableRegistry::get('Users');
		
		$existing_ids = null;
		
		$user = $this->Auth->user();
		
						
        $projectsMember = $this->ProjectsMembers->newEntity();
		
        if ($this->request->is('post')) {
			foreach($this->request->getData(['user_id']) as $u_ids):
				//pr($u_ids);
				$projectsMember->user_id = $u_ids;
				$projectsMember->project_id = $this->request->getData(['project_id']);
				$projectsMember = $this->ProjectsMembers->patchEntity($projectsMember, $this->request->getData());
				if(!$this->ProjectsMembers->save($projectsMember)){
					$this->Flash->error(__('The projects member could not be saved. Please, try again.'));
					return false;
				}
			endforeach;
			
			$this->Flash->success(__('The projects member has been saved.'));
			return $this->redirect(['controller'=>'Projects', 'action' => 'view', $this->request->getData(['project_id'])]);
			// $projectsMember->user_id = implode(',', $this->request->getData(['user_id']));
// 			$projectsMember->project_id = $this->request->getData(['project_id']);
//
//             if ($this->ProjectsMembers->save($projectsMember)) {
//
//
//                 return $this->redirect(['action' => 'index']);
//             }
//             $this->Flash->error(__('The projects member could not be saved. Please, try again.'));
        }
        $projects = $this->ProjectsMembers->Projects->find('list', []);
        //$users = $this->ProjectsMembers->Users->find('list', ['limit' => 200]);
		
		$project = $project->get($id);
		$users_collect = $department_members->find('all', [
		    'conditions' => ['DepartmentsMembers.department_id' => $project->department_id, 'NOT'=>['DepartmentsMembers.user_id'=>$user['id']]]
		]);
		
		foreach($users_collect as $collect):
			$user_ids[] = $collect->user_id;
		endforeach;
		
		$existing_staff = $projects_members->find('all', [
		    'conditions' => ['ProjectsMembers.project_id' => $project->id]
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
        $projectsMember = $this->ProjectsMembers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $projectsMember = $this->ProjectsMembers->patchEntity($projectsMember, $this->request->getData());
            if ($this->ProjectsMembers->save($projectsMember)) {
                $this->Flash->success(__('The projects member has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The projects member could not be saved. Please, try again.'));
        }
        $projects = $this->ProjectsMembers->Projects->find('list', ['limit' => 200]);
        $users = $this->ProjectsMembers->Users->find('list', ['limit' => 200]);
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
		$userA = $this->Auth->user();
        $this->request->allowMethod(['post', 'delete']);
        $projectsMember = $this->ProjectsMembers->get($id, ['contain' => ['Users']]);
        if ($this->ProjectsMembers->delete($projectsMember)) {
            $this->Flash->success(__($projectsMember->user->name.' has been deleted.'));
        } else {
            $this->Flash->error(__($projectsMember->user->name.' could not be deleted. Please, try again.'));
        }

        return $this->redirect(['controller'=>'Projects', 'action' => 'view', $projectsMember->project_id]);
    }
}
