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
namespace App\Controller\Department;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
use Cake\Event\EventManager;
/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
		
    public function initialize()
    {
        parent::initialize();
		
        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
		$this->loadComponent('Logging.Log');
        $this->loadComponent('Auth', [
			'authorize' => 'Controller', // Added this line
            // 'loginRedirect' => [
//                 'controller' => 'Pages',
//                 'action' => 'dashboard'
//             ],
			'loginAction' => [
				'controller' => 'Users',
				'action' => 'login'
			],
            'logoutRedirect' => [
                'controller' => 'Pages',
                'action' => 'index',
				'admin' => false
            ],
	        'authenticate' => [
	            'Form' => [
	                'fields' => ['username' => 'username', 'password' => 'password']
	            ]
	        ],
	        'storage' => 'Session',
			'flash' => [
			        'element' => 'default'
			],
			//'authError' => false
			//'authError' => __d('cake', 'You must login to access portal administration area')
        ]);
			
        /*
         * Enable the following components for recommended CakePHP security settings.
         * see http://book.cakephp.org/3.0/en/controllers/components/security.html
         */
        $this->loadComponent('Security');
        $this->loadComponent('Csrf');
    }
	
	public function beforeFilter(Event $event) {
		
	    $this->Security->csrfExpires = '+1 hour';
		$activeUser = $this->Auth->user();
		
		$userTable = TableRegistry::get('Users');
		$user_pro = $userTable->find('all')->where(['Users.id'=>$activeUser['id']])->first();
		
		$department_members = TableRegistry::get('DepartmentsMembers');
		$department = TableRegistry::get('Departments');
		$department_details = null;
			
		$user_table = TableRegistry::get('Users');
		
        $user_checker = $this->Auth->identify();
		
        if(is_null($user_checker)) {
        	return $this->redirect(['controller'=>'Users', 'action' => 'login']);
        }
		
		if(!empty($this->request->getQuery('department'))){
			$user_save = $user_table->newEntity();
			$user_save->id = $activeUser['id'];
			$user_save->department_access = $this->request->getQuery('department');
			$user_table->save($user_save);
		}	
		
		$get_user = $user_table->find('all')->where(['Users.id' => $activeUser['id']])->first();
			
		$department_details = $department_members->find('all', [
		    'conditions' => ['DepartmentsMembers.user_id' => $activeUser['id'], 'DepartmentsMembers.department_id' => $get_user->department_access],
		]);
			
		$department_details = $department_details->first();
		
		//$department_details_ch = $department_details->toArray();
		$department_id = null;
		$department_data = null;
		//$department_id = $this->request->getQuery('department');
					
		if(empty($department_details)){
			if($activeUser['role_id'] == 1){
				if($get_user->department_access){
					
					$department_data = $department->find('all', [
					    'conditions' => ['Departments.id' => $get_user->department_access],
					]);
												
					$department_data = $department_data->first();
					$department_details = null;
					
				}else{
					$this->Flash->error(__('Invalid Url'));
					return $this->redirect('/');
				}					
			}else{
				$this->Flash->error(__('You are not a member of this department'));
				return $this->redirect('/');
			}
		}else{
			$department_data = $department->find('all', [
			    'conditions' => ['Departments.id' => $get_user->department_access],
			]);
			
			$department_data = $department_data->first();
			
		}
		
		//pr($department_data);
												
		$this->set(compact('activeUser', 'user_details', 'department_members', 'department_details', 'department_data', 'user_pro'));
	}

    /**
     * Before render callback.
     *
     * @param \Cake\Event\Event $event The beforeRender event.
     * @return \Cake\Network\Response|null|void
     */
    public function beforeRender(Event $event)
    {
		
        if (!array_key_exists('_serialize', $this->viewVars) &&
            in_array($this->response->type(), ['application/json', 'application/xml'])
        ) {
            $this->set('_serialize', true);
        }
    }
	
	public function isAuthorized($user)
	{
	    // Admin can access every action
	    if (isset($user['role_id']) && $user['role_id'] == 1) {
	        return true;
	    }
		
		if ($this->request->getParam('prefix')) {
            return true;
        }

        // Only admins can access admin functions
        if ($this->request->getParam('prefix') == 'admin') {
            return (bool)($user['role_id'] == 1);
        }

	    // Default deny
	    return false;
	}
}
