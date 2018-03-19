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

namespace App\Controller;
use App\Controller\AppController;

use Cake\Core\Configure;
use Cake\Network\Exception\ForbiddenException;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
use Cake\View\Cell;
use Cake\View\CellTrait;
use Cake\Mailer\Email;

/**
 * Static content controller
 *
 * This controller will render views from Template/Pages/
 *
 * @link http://book.cakephp.org/3.0/en/controllers/pages-controller.html
 */
class PagesController extends AppController
{
    public function initialize()
    {
           parent::initialize();
           $this->loadComponent('Logging.Log');
    }
	
	public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(array('index', 'companyProfile'));
    }
	
	public function index(){
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if($user) {
                $this->Auth->setUser($user);
				$usersLog = TableRegistry::get('UsersLog');
				$users = TableRegistry::get('Users');
				$userLog = $usersLog->newEntity();
				$current_user = $users->newEntity();
				
				//pr($user);
				$userLog->user_id = $user['id'];
				$userLog->status = 2;
				//$userLog->isNew(true);
				//$userLog->unsetProperty('id');
				
				$current_user->id = $user['id'];
				$current_user->active = 2;
				
				if($users->save($current_user)){
					$usersLog->save($userLog, ['checkExisting' => true]);
				}
				
				$this->Log->write('info', 'Users', $user['first_name'].' '.$user['last_name'].' logged in', [], ['referer' => true]);
				
				//$this->Session->setFlash('You are logged in!');
                return $this->redirect($this->Auth->redirectUrl());
            }
			
            $this->Flash->error(__('Invalid username or password, try again'));
        }
		
		$events = TableRegistry::get('Events');
		$news = TableRegistry::get('News');
		$departments = TableRegistry::get('Departments');
		$canteen = TableRegistry::get('Canteen');
		
		$banner = TableRegistry::get('Banners');
		$banners = $banner->find('all');
		
		$events_data = $events->find('all', ['limit' => 5]);
		$news_data = $news->find('all', ['contain' => ['Categories'], 'limit' => 5]);
		$departments_data = $departments->find('all');	
		$default_menu = $canteen->find('all')->where(['Canteen.status' => 1])->first();
		$menu = $canteen->find('all')->where(['Canteen.menu' => $default_menu->id]);
		
		$user_table = TableRegistry::get('Users');
		$employee_of_the_year = $user_table->find('all')->where(['Users.employee_of_the_year' => 2])->first();	
		
		$this->set(compact('events_data', 'news_data', 'departments_data', 'projects', 'menu', 'banners', 'employee_of_the_year'));
	}
	
	public function dashboard(){
		$events = TableRegistry::get('Events');
		$news = TableRegistry::get('News');
		$project = TableRegistry::get('Projects');
		$canteen = TableRegistry::get('Canteen');
		$wiki = TableRegistry::get('Wiki');
		$events = TableRegistry::get('Events');
		
		$user = $this->Auth->user();
		$department_members = TableRegistry::get('DepartmentsMembers');
		$departments_forums = TableRegistry::get('Forums');
		$department_member = $department_members->find('all')->where(['DepartmentsMembers.user_id'=>$user['id']])->first();
		
		$events_data = $events->find('all', ['order' => ['Events.created' => 'DESC']]);
		//$projects = $project->find('all', ['conditions' => ['Projects.department_id'=>$department_member->department_id], 'order' => ['Projects.created' => 'DESC'], 'limit' => 5]);
		$upcoming_event = $events_data->first();
		
		//$projects_ch = $projects->toArray();
		
		$department_forums = $departments_forums->find('all', ['conditions' => [], 'contain'=>['Users'], 'order' => ['Forums.created' => 'DESC'], 'limit' => 5]);
		
		$department_forums_ch = $department_forums->toArray();
		
		$wikis = $wiki->find('all', ['conditions' => [], 'contain'=>['Departments'], 'order' => ['Wiki.created' => 'DESC'], 'limit' => 5]);
		
		$wikis_ch = $wikis->toArray();
		$events_data = $events->find('all', ['order' => ['Events.id' => 'DESC'], 'limit' => 5]);
		
		$news_data = $news->find('all', ['contain' => ['Categories'], 'order' => ['News.id' => 'DESC'], 'limit' => 5]);
		$default_menu = $canteen->find('all')->where(['Canteen.status' => 1])->first();
		$menu = $canteen->find('all')->where(['Canteen.menu' => $default_menu->id]);
		
		$this->set(compact('upcoming_event', 'news_data', 'events_data', 'menu', 'department_forums', 'department_forums_ch', 'wikis', 'wikis_ch'));
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
		
		$banner = TableRegistry::get('Banners');
		$banners = $banner->find('all');
		
		$this->set(compact('banners'));
		// $email = new Email('default');
//
// 		$email->from(['info@eogportal.com' => 'Ebony Oil & Gas Portal::Projects'])
// 		    ->to('jnartey@gmail.com')
// 		    ->subject('Test')
// 		    ->send('test');
	}
}
