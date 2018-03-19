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
		
		//EventManager::instance()->on(new RequestMetadata($this->request, $this->Auth->user('id')));
		
        $user_checker = $this->Auth->identify();
		
        if(is_null($user_checker)) {
        	return $this->redirect(['controller'=>'Users', 'action' => 'login']);
        }
		
		$workgroup_members = TableRegistry::get('WorkgroupsMembers');
		$workgroup = TableRegistry::get('Workgroups');
			
		$user_table = TableRegistry::get('Users');
		
		if(!empty($this->request->getQuery('workgroup'))){
			$user_save = $user_table->newEntity();
			$user_save->id = $activeUser['id'];
			$user_save->workgroup_access = $this->request->getQuery('workgroup');
			$user_table->save($user_save);
		}	
		
		$get_user = $user_table->find('all')->where(['Users.id' => $activeUser['id']])->first();
			
		$workgroup_details = $workgroup_members->find('all', [
		    'conditions' => ['WorkgroupsMembers.user_id' => $activeUser['id'], 'WorkgroupsMembers.workgroup_id' => $get_user->workgroup_access],
		]);
		
		$workgroup_details = $workgroup_details->first();
		
		$workgroup_data = $workgroup->find('all', [
		    'conditions' => ['Workgroups.id' => $get_user->workgroup_access],
		]);
		
		$workgroup_data = $workgroup_data->first();
			
		$workgroup_id = null;
		$workgroup_data = null;
					
		if(empty($workgroup_details)){
			if($activeUser['role_id'] == 1 || $activeUser['id'] == $workgroup_data->user_id){
				
				if($get_user->workgroup_access){
					
					$department_data = $department->find('all', [
					    'conditions' => ['Workgroups.id' => $get_user->workgroup_access],
					]);
												
					$workgroup_data = $workgroup->first();
					$workgroup_details = null;
					
				}else{
					//$this->Flash->error(__('Invalid Url'));
					return $this->redirect('/');
				}					
			}else{
				$this->Flash->error(__('You are not a member of this workgroup'));
				return $this->redirect('/');
			}
		}else{
			$workgroup_data = $workgroup->find('all', [
			    'conditions' => ['Workgroups.id' => $get_user->workgroup_access],
			]);
			
			$workgroup_data = $workgroup_data->first();
			
			//$this->Flash->error(__('You are not a member of this workgroup'));
			//return $this->redirect('/workgroup');
			
		}
		
		//pr($department_data);
												
		$this->set(compact('activeUser', 'user_details', 'workgroup_members', 'workgroup_details', 'workgroup_data', 'user_pro'));
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
