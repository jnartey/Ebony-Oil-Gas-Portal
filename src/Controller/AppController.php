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
		$this->Security->setConfig('unlockedActions', ['chatHeartbeat', 'chatBoxSession', 'startChatSession', 'sendChat', 'closeChat']);
		
		$userlog = null;
		
		
		// $usersLog = TableRegistry::get('UsersLog');
//
//         $userlog = $usersLog->find('all', ['conditions'=>['UsersLog.user_id'=>$activeUser['id']], 'order'=>['UsersLog.created'=>'DESC']]);
// 		$userlog = $userlog->first();
//
// 		if(!empty($userlog)){
// 			$session_expire = strtotime($userlog->created) + strtotime(SESSION_EXPIRES);
//
// 			if($session_expire == strtotime("now")){
// 				$userLog = $usersLog->newEntity();
// 				$userLog->id = $userlog->id;
// 				$userLog->status = 1;
//
// 				$usersLog->save($userLog);
// 				//$this->Session->setFlash('You are logged out!');
// 		        return $this->redirect($this->Auth->logout());
// 			}
// 		}
		
		$department_members = TableRegistry::get('DepartmentsMembers');
		$workgroup_members = TableRegistry::get('WorkgroupsMembers');
		$userTable = TableRegistry::get('Users');
		$user_pro = $userTable->find('all')->where(['Users.id'=>$activeUser['id']])->first();
			
		$user_details = $department_members->find('all', [
		    'conditions' => ['DepartmentsMembers.user_id' => $activeUser['id']],
			'contain' => ['Departments']
		]);
			
		$department_details = $department_members->find('all', [
		    'conditions' => ['DepartmentsMembers.user_id' => $activeUser['id']],
			'contain' => ['Departments']
		]);
			
		$department_details = $department_details->first();
		
        $user_checker = $this->Auth->identify();
        if(is_null($user_checker)) {
        	return $this->redirect(['controller'=>'Users', 'action' => 'login']);
        }
		
		$groups_m = $workgroup_members->find('all', [
		    'conditions' => ['WorkgroupsMembers.user_id' => $activeUser['id']],
			'contain' => ['Workgroups']
		]);
			
		$groups_m_ch = $groups_m->toArray();
												
		$this->set(compact('activeUser', 'user_details', 'department_members', 'department_details', 'user_pro', 'groups_m', 'groups_m_ch'));
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
		
		if (!$this->request->getParam('prefix')) {
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
