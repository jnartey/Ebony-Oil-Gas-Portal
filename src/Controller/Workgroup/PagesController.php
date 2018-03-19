<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */

namespace App\Controller\Workgroup;
use App\Controller\Workgroup\AppController;
use Cake\Core\Configure;
use Cake\Network\Exception\ForbiddenException;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
use Cake\View\Cell;
use Cake\View\CellTrait;

/**
 * Static content controller
 *
 * This controller will render views from Template/Pages/
 *
 * @link http://book.cakephp.org/3.0/en/controllers/pages-controller.html
 */
class PagesController extends AppController
{
	public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
		//Router::parseNamedParams($this->request);
        //$this->Auth->allow(array('companyProfile'));
    }
	
	public function index(){
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
				$usersTable = TableRegistry::get('Users');
				$currentUser = $usersTable->get($user['id']);

				$currentUser->id = $user['id'];
				$currentUser->active = 1;
				$usersTable->save($currentUser);
				//$this->Session->setFlash('You are logged in!');
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error(__('Invalid username or password, try again'));
        }
		
		$events = TableRegistry::get('WorkgroupEvents');
		$news = TableRegistry::get('WorkgroupNews');
		$workgroups = TableRegistry::get('Workgroups');
		$canteen = TableRegistry::get('Canteen');
		
		$banner = TableRegistry::get('Banners');
		$banners = $banner->find('all');
		
		$user = $this->Auth->user();
		$user_table = TableRegistry::get('Users');		
		$get_user = $user_table->find('all')->where(['Users.id' => $user['id']])->first();
		
		
		$events_data = $events->find('all', ['conditions'=>['WorkgroupEvents.workgroup_id'=>$get_user->workgroup_access], 'order' => ['WorkgroupEvents.created' => 'DESC'], 'limit' => 5]);
		$news_data = $news->find('all', ['conditions'=>['WorkgroupNews.workgroup_id'=>$get_user->workgroup_access], 'contain' => ['Categories'], 'order' => ['WorkgroupNews.created' => 'DESC'], 'limit' => 5]);
		//$workgroups_data = $workgroups->find('all');	
		$default_menu = $canteen->find('all')->where(['Canteen.status' => 1])->first();
		$menu = $canteen->find('all')->where(['Canteen.menu' => $default_menu->id]);
		
		$user_table = TableRegistry::get('Users');
		$employee_of_the_year = $user_table->find('all')->where(['Users.employee_of_the_year' => 2])->first();		
		
		$this->set(compact('events_data', 'news_data', 'projects', 'menu', 'banners', 'employee_of_the_year'));
	}
	
	public function dashboard(){
		$events = TableRegistry::get('WorkgroupEvents');
		$news = TableRegistry::get('WorkgroupNews');
		$project = TableRegistry::get('WorkgroupProjects');
		$canteen = TableRegistry::get('Canteen');
		$wiki = TableRegistry::get('WorkgroupWiki');
		
		$user = $this->Auth->user();
		$workgroup_members = TableRegistry::get('WorkgroupsMembers');
		$workgroups_forums = TableRegistry::get('WorkgroupForums');
		$workgroup_member = $workgroup_members->find('all')->where(['WorkgroupsMembers.user_id'=>$user['id']])->first();
		
		$workgroup_id = $this->request->getQuery('workgroup');
		
		if(!empty($workgroup_member)){
			$projects = $project->find('all', ['conditions' => ['WorkgroupProjects.workgroup_id'=>$workgroup_member->workgroup_id], 'order' => ['WorkgroupProjects.created' => 'DESC'], 'limit' => 5]);
			
			$workgroup_forums = $workgroups_forums->find('all', ['conditions' => ['WorkgroupForums.workgroup_id'=>$workgroup_member->workgroup_id], 'contain'=>['Workgroups', 'Users'], 'order' => ['WorkgroupForums.created' => 'DESC'], 'limit' => 5]);
			
			$wikis = $wiki->find('all', ['conditions' => ['WorkgroupWiki.workgroup_id'=>$workgroup_member->workgroup_id], 'contain'=>['Workgroups'], 'order' => ['WorkgroupWiki.created' => 'DESC'], 'limit' => 5]);
			
			$events_data = $events->find('all', ['conditions'=>['WorkgroupEvents.workgroup_id' => $workgroup_member->workgroup_id], 'order' => ['WorkgroupEvents.created' => 'DESC']]);
			
			$news_data = $news->find('all', ['conditions'=>['WorkgroupNews.workgroup_id' => $workgroup_member->workgroup_id], 'contain' => ['Categories'], 'limit' => 5]);
		}else{
			$projects = $project->find('all', ['conditions' => ['WorkgroupProjects.workgroup_id'=>$workgroup_id], 'order' => ['WorkgroupProjects.created' => 'DESC'], 'limit' => 5]);
			
			$workgroup_forums = $workgroups_forums->find('all', ['conditions' => ['WorkgroupForums.workgroup_id'=>$workgroup_id], 'contain'=>['Workgroups', 'Users'], 'order' => ['WorkgroupForums.created' => 'DESC'], 'limit' => 5]);
			
			$wikis = $wiki->find('all', ['conditions' => ['WorkgroupWiki.workgroup_id'=>$workgroup_id], 'contain'=>['Workgroups'], 'order' => ['WorkgroupWiki.created' => 'DESC'], 'limit' => 5]);
			
			$events_data = $events->find('all', ['conditions'=>['WorkgroupEvents.workgroup_id' => $workgroup_id], 'order' => ['WorkgroupEvents.created' => 'DESC']]);
			$news_data = $news->find('all', ['conditions'=>['WorkgroupNews.workgroup_id' => $workgroup_id], 'contain' => ['Categories'], 'limit' => 5]);
		}
		
		$upcoming_event = $events_data->first();
		
		$projects_ch = $projects->toArray();
		
		$workgroup_forums_ch = $workgroup_forums->toArray();
		
		$wikis_ch = $wikis->toArray();
		
		$default_menu = $canteen->find('all')->where(['Canteen.status' => 1])->first();
		$menu = $canteen->find('all')->where(['Canteen.menu' => $default_menu->id]);
		
		$this->set(compact('upcoming_event', 'news_data', 'projects', 'menu', 'projects_ch', 'workgroup_forums', 'workgroup_forums_ch', 'wikis', 'wikis_ch'));
	}
	
	public function companyProfile(){
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
				$usersTable = TableRegistry::get('Users');
				$currentUser = $usersTable->get($user['id']);

				$currentUser->id = $user['id'];
				$currentUser->active = 1;
				$usersTable->save($currentUser);
				//$this->Session->setFlash('You are logged in!');
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error(__('Invalid username or password, try again'));
        }
	}
}
