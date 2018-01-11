<?php

namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;

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
        $this->checkUserSession();
        $this->checkAuthentication();
        
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

    public function checkUserSession() {
        $action = $this->request->params['action'];
        $controller = $this->request->params['controller'];
        $allowActions = array('login', 'forgotPassword', 'resetPassword', 'providerRegistration', 'requestorRegistration', 'home', 'logout');
        $userSession = '';
        $userSession = $this->request->session()->read('LoginUser');
        if (in_array($action, $allowActions)) {
            if (!empty($userSession['id'])) {
                if ($userSession['role_id'] == 2) {
                    $this->redirect(array('controller' => 'providers', 'action' => 'providersDashboard'));
                }
                if ($userSession['role_id'] == 3) {
                    $this->redirect(array('controller' => 'requestors', 'action' => 'requestorsDashboard'));
                }
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
