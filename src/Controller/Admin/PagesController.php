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

namespace App\Controller\Admin;
use App\Controller\AppController;

use Cake\Core\Configure;
use Cake\Network\Exception\ForbiddenException;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
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
	use CellTrait;
	
	public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(array(''));
    }

    /**
     * Displays a view
     *
     * @param string ...$path Path segments.
     * @return void|\Cake\Network\Response
     * @throws \Cake\Network\Exception\ForbiddenException When a directory traversal attempt.
     * @throws \Cake\Network\Exception\NotFoundException When the view file could not
     *   be found or \Cake\View\Exception\MissingTemplateException in debug mode.
     */
    public function display(...$path)
    {
        $count = count($path);
        if (!$count) {
            return $this->redirect('/');
        }
        if (in_array('..', $path, true) || in_array('.', $path, true)) {
            throw new ForbiddenException();
        }
        $page = $subpage = null;

        if (!empty($path[0])) {
            $page = $path[0];
        }
        if (!empty($path[1])) {
            $subpage = $path[1];
        }
        $this->set(compact('page', 'subpage'));

        try {
            $this->render(implode('/', $path));
        } catch (MissingTemplateException $e) {
            if (Configure::read('debug')) {
                throw $e;
            }
            throw new NotFoundException();
        }
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
		
		$events = TableRegistry::get('Events');
		$news = TableRegistry::get('News');
		$departments = TableRegistry::get('Departments');
		$users = TableRegistry::get('Users');
		$canteen = TableRegistry::get('Canteen');
		
		$events_data = $events->find('all', ['limit' => 10]);
		$news_data = $news->find('all', ['contain' => ['Categories'], 'limit' => 10]);
		$departments_data = $departments->find('all');	
		
		$departments_count = $departments->find('all')->count();
		
		$staff = $users->find('all', ['conditions' => ['NOT'=>['Users.id'=>1]], 'limit'=>5]);
		$default_menu = $canteen->find('all')->where(['Canteen.status' => 1])->first();
		$menu = $canteen->find('all')->where(['Canteen.menu' => $default_menu->id]);
		
		$staff_count = $staff->count();
		
		$this->set(compact('events_data', 'news_data', 'departments_data', 'departments_count', 'staff', 'staff_count', 'menu'));
		
		// $query = $articles->find('all', [
// 		    'conditions' => ['Articles.title LIKE' => '%Ovens%']
// 		]);
// 		$number = $query->count();

	}
	
	public function dashboard(){
		
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
