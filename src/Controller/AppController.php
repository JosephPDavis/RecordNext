<?php

namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;

class AppController extends Controller {

    public function beforeFilter(Event $event) {
//     echo 1; exit('in before filter');
        parent::beforeFilter($event);

        $sessionData = $this->request->session()->read('LoginUser');
        $this->set('userSession', $sessionData);
        $this->set('loggedInUsersId', $sessionData['id']);
        $this->Auth->allow('forgotPassword', 'resetPassword', 'home', 'login', 'logout', 'registration', 'requestorRegistration', 'providerRegistration', 'activationLink', 'contactUs');
        $this->Auth->allow('contactUs');
        $this->Auth->allow('getDepartmentByProviderId');
        $this->Auth->allow('getMatterList');
        $this->Auth->allow('getMatterData');
        $this->Auth->allow('adminForgetPassword');
        $this->Auth->allow('adminResetPassword');
        $this->Auth->allow('requestNotification');
        $this->Auth->allow('readNotification');
//        $this->checkUserSession();
        //$this->checkAuthentication();
       
    }

    public function initialize() {

        parent::initialize();
        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
        $this->loadComponent('Auth', [
            'Form' => [
                'fields' => [
                    'username' => 'email',
                    'password' => 'password'
                ]
            ],
            'loginRedirect' => [
                'controller' => 'Pages',
                'action' => 'home'
            ],
            'logoutRedirect' => [
                'controller' => 'Users',
                'action' => 'login',
            ],
            'authError' => '',
            'authenticate' => [
                'Form' => [
                    'fields' => ['username' => 'email']
                ]
            ],
            'storage' => 'Session'
        ]);
        $this->loadComponent('Common');
        $uid = $this->Auth->User('id');
//        if(empty($uid)){
//            
//        }
        $this->checkUserSession($uid);
    }

//    public function isAuthorized($user)
//    {
//        // Admin can access every action
//        if (isset($user['role']) && $user['role'] === 'admin') {
//    	   return true;
//        }
//
//        // Default deny
//        return false;
//    }


    public function beforeRender(Event $event) {
//	   $this->Auth->allow('add', 'logout', 'login');      
//	   $this->Auth->allow('home','login','registration');      
        if (!array_key_exists('_serialize', $this->viewVars) && in_array($this->response->type(), ['application/json', 'application/xml'])) {
            $this->set('_serialize', true);
        }
    }

    public function checkUserSession($id = null) {
        $users = TableRegistry::get('users');
        $userData = $users->findUserByID($id);
        $ProviderArr = array('Notifications','Users','Providers'); 
        $RequestorArr = array('Notifications','Users','Requestors'); 
        $AdminsArr = array('Notifications','Users','Admins'); 
        
            if (!empty($userData['id'])) {
                
                if ($userData['role_id'] == 2 && !in_array($this->request->controller, $ProviderArr)) {
                  return $this->redirect(array('controller' => 'Providers', 'action' => 'providersDashboard'));
                }
                if ($userData['role_id'] == 3 && !in_array($this->request->controller, $RequestorArr)) {
                   return $this->redirect(array('controller' => 'Requestors', 'action' => 'requestorsDashboard'));
                }
                if ($userData['role_id'] == 1 && !in_array($this->request->controller, $AdminsArr)) {
                   return $this->redirect(array('controller' => 'Admins', 'action' => 'dashboard'));
                }
            }
        
    }
/* @author Sneha G    
      @params name
      @return id and name
     */

    public function keepAlive() {
        $this->autoRender = false;
        echo 'OK';
    }
    public function checkAuthentication() {
//        pr($this->request->params);
//        $action = $this->request->params['action'];
//        $controller = $this->request->params['controller'];
//        $userSession = '';
//        $userSession = $this->request->session()->read('LoginUser');
//        if($userSession['role_id' ==2]){
//            if($controller =='Requestors' && $action!=''){
//               $this->Flash->error('You are not allowed to access this page directly', ['params' => ['class' => 'alert alert-danger']]); 
//            }
//        }elseif($userSession['role_id' ==3]){
//            if($controller =='Requestors' && $action!=''){
//               $this->Flash->error('You are not allowed to access this page directly', ['params' => ['class' => 'alert alert-danger']]); 
//            }
//        }
    }
    
    public function checkIsset($keysArr, $valueArr) {
        
        foreach ($keysArr as $key){
            $valueArr[$key] =  isset($valueArr[$key]) || !empty($valueArr[$key]) ? $valueArr[$key] : 'NA';
        }
        return $valueArr;
    } 
    
    
}
