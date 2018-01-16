<?php

namespace App\Controller;

use App\Controller\AppController;
use App\Model\Entity;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
use Cake\Mailer\Email;
use Cake\Routing\Router;

class UsersController extends AppController {

    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
        $this->Auth->allow('activationLink');
        $this->Auth->allow('resetPassword');
        $this->Auth->allow('checkUniqueEmail');
        $this->Auth->allow('getStates');
        $this->Auth->allow('departmentAdd');
        $this->Auth->allow('getDepartment');
    }

    public function login() {
//        pr('sdhfosgd');
        $this->viewBuilder()->setLayout('default');
        $userTable = TableRegistry::get('users');
        $ProvidersSettings = TableRegistry::get('fees_settings');
        $ProviderPaymentsDetails = TableRegistry::get('provider_payments_details');
        $userData =array();
        if ($this->request->is('post')) {
//            $this->request->data['email'] = $userTable->encrypt($this->request->data['email']);
            $this->request->data['email'] = $this->request->data['email'];
            $user = $this->Auth->identify();
//             var_dump($user); die();
            if ($user) {
                $this->Auth->setUser($user);
                /* BOF-For writing session -Mahalaxmi */
                $userData = $userTable->find('all', array('fields' => array('id', 'role_id', 'first_name', 'last_name', 'status', 'email','is_deleted'), 'conditions' => array('email' => $this->request->data['email'], 'role_id IN' => ['2', '3'])))->first();

                if ($userData['status'] == 1 && $userData['is_deleted'] == 0) {
                    $dataWrite = array(
                        'id' => $userData['id'],
                        'email' => $userData['email'],
                        'role_id' => $userData['role_id'],
                        'first_name' => $userData['first_name'],
                        'last_name' => $userData['last_name']
                    );
                    $this->request->session()->write('LoginUser', $dataWrite);
                    $this->request->session()->check('LoginUser');
                    /* EOF-For writing session -Mahalaxmi */
                    if ($user['role_id'] == 2) {
                        
                        $ProvidersSettingsData = $ProvidersSettings->getPaymentSettings($userData['id']);
                        $providerPaymentData = $ProviderPaymentsDetails->getProviderAccId($userData['id']);
                       
                        if ((!isset($ProvidersSettingsData['id'])) || (!isset($providerPaymentData['id']))) {
//                        if (empty($ProvidersSettingsData['id'])) {
                            $this->Flash->error('Please update the below fields.', ['params' => ['class' => 'alert alert-danger']]);
                            return $this->redirect(['controller' => 'providers', 'action' => 'settings']);
                        } else {
                            return $this->redirect(['controller' => 'providers', 'action' => 'providersDashboard']);
                        }
                    } elseif ($user['role_id'] == 3) {
                        return $this->redirect(['controller' => 'requestors', 'action' => 'requestorsDashboard']);
                    } else {
                        return $this->redirect($this->Auth->redirectUrl());
                    }
                } elseif ($userData['status'] == 0) {
//                    $this->request->data['email'] = $userTable->decrypt($this->request->data['email']);
                    $this->request->data['email'] = $this->request->data['email'];
                    $this->Flash->error('The account type you are trying to access is either admin or your account is in-activate', ['params' => ['class' => 'alert alert-danger']]);
                }elseif($userData['is_deleted'] == 1){
                    $this->Flash->error('Your account has been deleted by admin!', ['params' => ['class' => 'alert alert-danger']]);
                } else {
                    $this->Flash->error('Invalid username or password, try again', ['params' => ['class' => 'alert alert-danger']]);
                }
            } else {
//                $this->request->data['email'] = $userTable->decrypt($this->request->data['email']);
                $this->request->data['email'] = $this->request->data['email'];
                $this->Flash->error('Invalid username or password, try again', ['params' => ['class' => 'alert alert-danger']]);
            }
        }
    }

    public function logout() {
        $this->request->session()->destroy('LoginUser');
        return $this->redirect($this->Auth->logout());
    }

    public function index() {
        $this->viewBuilder()->setLayout('website_layout');
//        $page = $this->request->query('page');
//        $rows = $this->request->query('rows');
//
//        $settings = array(
//            'limit' => 10
//        );
//
//        $this->set('users', $this->paginate($this->Users, $settings));
    }

    public function view($id) {
        $user = $this->Users->get($id);
        $this->set(compact('user'));
    }

//    public function registration() {
//        $this->viewBuilder()->setLayout('default');
//        $user = $this->Users->newEntity();
//        if ($this->request->is('post')) {
//            $user = $this->Users->patchEntity($user, $this->request->getData());
//            $user['role_id'] = 2;
////            pr($user); exit();
//            if ($this->Users->save($user)) {
//                $this->Flash->success('The user has been saved.', ['params' => ['class' => 'alert alert-success']]);
//                return $this->redirect(['action' => 'registration']);
//            }
//            $this->Flash->error('Unable to add the user.', ['params' => ['class' => 'alert alert-danger']]);
//        }
//        $this->set('user', $user);
//    }

    public function add() {
        $this->viewBuilder()->setLayout('website_layout');
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success('The user has been saved.', ['params' => ['class' => 'alert alert-success']]);
                return $this->redirect(['action' => 'add']);
            }
            $this->Flash->error('Unable to add the user.', ['params' => ['class' => 'alert alert-danger']]);
        }
        $this->set('user', $user);
    }

    public function edit($id) {
        $users = TableRegistry::get('Users');
        $all_users = $users->find('all');
        //debug($all_users);

        foreach ($all_users as $muser) {
            $u_user = $users->find('all')->where(['user_id' => $muser['user_id']])->first();

            $u_user->email = $muser['username'] . '@gmail.com';
            $users->save($u_user);
        }
    }

    /* @auther Mahalaxmi    
      @params $id
      @return no
     */

    public function companyProfile($id = null) {
        $this->viewBuilder()->setLayout('website_layout');
//        $users = TableRegistry::get('users');
//        $user = $this->Users->get($id);
//        if ($this->request->is(['post', 'put'])) {
//            $this->Users->patchEntity($user, $this->request->data);
//            if ($this->Users->save($user)) {
//                $this->Flash->success(__('Your profile data has been updated.'));
//                return $this->redirect(['action' => 'index']);
//            }
//            $this->Flash->error(__('Unable to update your profile.'));
//        }
//        $this->set('user', $user);  

        $users = TableRegistry::get('users');
        $id = $this->request->session()->read('LoginUser')['id'];
        $userData = $users->findUserByID($id);
        $this->set('userData', $userData);
        $countryTable = TableRegistry::get('countries');
        $countryArr = $countryTable->listCountries();
        foreach($countryArr as $country){
            $countryList[$country['id']] = $country['name'];
        }
        $this->set('countryList', $countryList);
        $stateArr = $this->getStates2($userData['country_id']);
//        pr($stateArr);
//        foreach($stateArr as $key=>){
//            $stateList[$state['id']] = $state['name'];
//        }
        $this->set('stateList', $stateArr);
        $user = $users->get($id);
        if ($this->request->is('post')) {

            $users->patchEntity($user, $this->request->getData(), ['validate' => 'OnlyCheck']);

            if ($users->save($user)) {
                $this->Flash->success('Your profile have been updated successfully!', ['params' => ['class' => 'alert alert-success']]);
                if ($this->request->session()->read('LoginUser')['role_id'] == 2) {
                    return $this->redirect($this->referer());
                } elseif ($this->request->session()->read('LoginUser')['role_id'] == 3) {
                    return $this->redirect($this->referer());
                } else {
                    return $this->redirect($this->Auth->redirectUrl());
                }
            }
//            debug($user->errors());
            $this->Flash->error('Unable to update the user.', ['params' => ['class' => 'alert alert-danger']]);
        }
        $this->set('user', $users);
    }

    /*  @auther Mahalaxmi    
      @params null
      @return no
     */

    public function changePassword() {
        $this->viewBuilder()->setLayout('website_layout');
        $userSession = $this->request->session()->read('LoginUser');
        $user = $this->Users->get($userSession['id']);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success('Password has been updated successfully.', ['params' => ['class' => 'alert alert-success']]);

                if ($userSession['role_id'] == 2) {
                    return $this->redirect(['controller' => 'providers', 'action' => 'providersDashboard']);
                } elseif ($userSession['role_id'] == 3) {
                    return $this->redirect(['controller' => 'requestors', 'action' => 'requestorsDashboard']);
                } else {
                    return $this->redirect($this->Auth->redirectUrl());
                }
            } else {
                $this->Flash->error('Entered old password does not match.Please try again.', ['params' => ['class' => 'alert alert-danger']]);
            }
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    /*  @author Mahalaxmi    
      @params no
      @return no
     */

    public function forgotPassword() {
        $this->viewBuilder()->setLayout('default');
        if ($this->request->is(['patch', 'post', 'put']) && !empty($this->request->data['email'])) {
            $userTable = TableRegistry::get('users');
//            $emailEncrypted = $userTable->encrypt($this->request->data['email']);
            $emailEncrypted = $this->request->data['email'];
            $userData = $userTable->findUserByEmailID($emailEncrypted);

            if ($userData['email'] == $this->request->data['email']) {

                $hashCode = md5(uniqid(rand(), true));
                $user = $userTable->get($userData['id']);
                $userTable->patchEntity($user, $this->request->getData());
                $userTable->updateAll(["key_token " => $hashCode, "reset_password_flag" => 1], ["email IN " => $emailEncrypted]);

                // $resetUrl = SITE_URL."/users/resetPassword/".$hashCode;
                $this->Common->sendEmail($userData['id'], 'Forget Password', $this->request->data['email'], 'forgetpassword', $emailData = ['first_name' => $userData['first_name'], 'last_name' => $userData['last_name'], 'hashCode' => $hashCode]);
                $this->Flash->success('Check your e-mail to reset your password.', ['params' => ['class' => 'alert alert-success']]);
                return $this->redirect(['controller' => 'Users', 'action' => 'login']);
            } else {
                $this->Flash->error('The e-mail address you have entered does not exists.', ['params' => ['class' => 'alert alert-danger']]);
            }
        }
    }

    /*  @author Mahalaxmi    
      @params $token
      @return no
     */

    public function resetPassword($token = null) {
        $this->viewBuilder()->setLayout('default');
        $userTable = TableRegistry::get('users');  
        $userData = $userTable->findUserBytokenID($token);
        if (!empty($userData)) {
            if ($this->request->is(['patch', 'post', 'put'])) {
                $user = $userTable->get($userData['id']);
                $user->reset_password_flag = 0;
                $user = $userTable->patchEntity($user, $this->request->data);
                if ($userTable->save($user)) {
                    $this->Flash->success('Password has been updated successfully.', ['params' => ['class' => 'alert alert-success']]);
                    return $this->redirect(['controller' => 'Users', 'action' => 'login']);
                } else {
                    $this->Flash->error('Entered old password does not match.Please try again.', ['params' => ['class' => 'alert alert-danger']]);
                }
            }
        } else {
            $this->Flash->error('This link has been expired.Please try again.', ['params' => ['class' => 'alert alert-danger']]);
            return $this->redirect(['controller' => 'Users', 'action' => 'login']);
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    public function listAllCountries() {

        $countryTable = TableRegistry::get('countries');
        $this->autoRender = false;
//         $countryList=$countryTable->listCountries(); 
    }

    public function activationLink($token = null) {
        $this->autoRender = false;
        $userTable = TableRegistry::get('users');
        $userData = $userTable->findUserBytokenIDForActivate($token);

        if ($token == $userData['key_token']) {
            if ($userData['status'] == '1') {
                $this->Flash->error('Your Account has been already activated successfully', ['params' => ['class' => 'alert alert-danger']]);
            } else {
                $user = $this->Users->get($userData['id']);
                $user->status = 1;
                $user = $this->Users->patchEntity($user, $this->request->data);
                if ($this->Users->save($user)) {
                    $this->Flash->success('Your Account has been activated successfully.', ['params' => ['class' => 'alert alert-success']]);
                }
            }
        } else {
            $this->Flash->error('Your Account does not exists.', ['params' => ['class' => 'alert alert-danger']]);
        }
        return $this->redirect(['controller' => 'Users', 'action' => 'login']);
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    public function checkUniqueEmail($roleId) {
        $this->autoRender = false;
        $userTable = TableRegistry::get('users');
        if ($this->request->is('ajax')) {
            $email = $this->request->data['email'];
//            $userArray = $userTable->find('all', array('fields' => array('id', 'role_id', 'first_name', 'last_name', 'status'), 'conditions' => array('email' => $userTable->encrypt($email), 'role_id' => $roleId, 'is_deleted' => 0)))->first();
            $userArray = $userTable->find('all', array('fields' => array('id', 'role_id', 'first_name', 'last_name', 'status'), 'conditions' => array('email' => $email, 'role_id' => $roleId, 'is_deleted' => 0)))->first();
            if (!empty($userArray)) {
                echo "false";
            } else {
                echo "true";
            }
        }
        die;
    }

    /* @auther Mahalaxmi    
      @params no
      @return no
     */

    public function departmentAdd() {
        $this->autoRender = false;
        $departmentTable = TableRegistry::get('departments');
        $departments = $departmentTable->newEntity();
        $userSession = $this->request->session()->read('LoginUser');
        if ($this->request->is('post')) {
            $deptData = $departmentTable->patchEntity($departments, $this->request->getData());
            $deptData->user_id = $userSession['id'];
            $deptData->name = $deptData['name'];
            if ($departmentTable->save($deptData)) {
                // $this->Flash->success('You have add department Successfully.', ['params' => ['class' => 'alert alert-success']]);               
            }
            //$this->Flash->error('Unable to add the department.', ['params' => ['class' => 'alert alert-danger']]);         
            $this->set('department', $departments);
        }
    }

    /* @auther Mahalaxmi    
      @params no
      @return list of department
     */

    public function getDepartment() {
        $this->autoRender = false;
        $departments = array();
        $userSession = $this->request->session()->read('LoginUser');
        $departmentTable = TableRegistry::get('departments');
        $departmentData = $departmentTable->find('all', array('fields' => array('id', 'name'), 'conditions' => array(
                'user_id' => $userSession['id'],
                'is_deleted' => 0,
                'status' => 1,
            ),
        ));
        foreach ($departmentData as $key => $value) {
            $departments[$value['id']] = $value['name'];
        }
        /* $departments = $departmentTable->find('list', [
          'keyField' => 'id',
          'valueField' => 'name',
          'conditions' => [
          'is_deleted' => 0,
          'status' => 1,'user_id'=>$userSession['role_id']
          ],
          ]); */
        if (!empty($departments)) {
            
        }

        echo json_encode($departments);
        exit();
    }

    /* @auther Mahalaxmi    
      @params provider ID
      @return departement id and name respective provider id
     */

    public function getDepartmentByProviderId() {
        $this->autoRender = false;
        //$userTable = TableRegistry::get('users');  
        $departmentTable = TableRegistry::get('departments');
        $departmentdata = $departmentTable->findDepartmentByID($this->request->data['providerId']);
        echo json_encode($departmentdata);
        exit();
    }

    /* @auther Sneha G    
      @params user Id from session
      @return
     */

    public function setting() {
        $this->viewBuilder()->setLayout('website_layout');
        $userSession = $this->request->session()->read('LoginUser');
        $userId = $userSession['id'];
        $arrResponse = array();
        $userTable = TableRegistry::get('users');
        $cardDetailsTable = TableRegistry::get('card_details');
        $userData = $userTable->findUserByID($userId);

        $this->set('userData', $userData);
        //find user card preference id if exist then show card
        $userCardPref = $userTable->getCardPreference($userSession['id']);
        //find card details for prefered card
//        $cardPreferenceDetails  = $cardDetailsTable->getCardDetails($userCardPref['card_preference_id']);
        $cardPreferenceDetails = $cardDetailsTable->getCardAllDetails($userSession['id']);
        $this->set('cardPreferenceDetails', $cardPreferenceDetails);
        if ($this->request->is('ajax')) {
//          pr($this->request->data);
//          exit('m here');
            $user = $userTable->get($userId);
            $reqData = $userTable->patchEntity($user, $this->request->getData());
//            pr($reqData);
//            exit();

            if ($userTable->save($reqData)) {
                $arrResponse['status'] = 'success';
            } else {
                $arrResponse['status'] = 'error';
            }

            $this->set('user', $user);
            echo json_encode($arrResponse);
            exit();
        }
    }

    /* @auther Sneha G    
      @params default value of credit card
      @return
     */

    public function ccSettings() {
        $this->autoRender = false;
        $userSession = $this->request->session()->read('LoginUser');
        $userId = $userSession['id'];
        $arrResponse = array();
        $userTable = TableRegistry::get('users');
        $cardDetailsTable = TableRegistry::get('card_details');
        $userData = $userTable->findUserByID($userId);
        $this->set('userData', $userData);
        //find user card preference id if exist then show card
        $userCardPref = $userTable->getCardPreference($userSession['id']);
        //find card details for prefered card
//        $cardPreferenceDetails  = $cardDetailsTable->getCardDetails($userCardPref['card_preference_id']);
        $cardPreferenceDetails = $cardDetailsTable->getCardAllDetails($userSession['id']);
        $this->set('cardPreferenceDetails', $cardPreferenceDetails);
        if ($this->request->is('ajax')) {
//          pr($this->request->data);
//          exit('m here');
//            $user = $userTable->get($userId);
            $cardId = $this->request->data['formData'];
            if (!empty($cardId)) {
                // making all the cards of user default NO
                if (!empty($cardPreferenceDetails)) {
                    foreach ($cardPreferenceDetails as $card) {
                        $cardDetails = $cardDetailsTable->get($card['id']);
                        $cardDetails->default_card = "N";
                        $res = $cardDetailsTable->save($cardDetails);
                    }
                }
                //for making selected card as default YES
                $cardData = $cardDetailsTable->get($cardId);
                $cardData->default_card = "Y";
                $res = $cardDetailsTable->save($cardData);
                if ($res) {
                    $arrResponse['status'] = 'success';
                    $arrResponse['message'] = 'Settings have been saved successfully!';
                } else {
                    $arrResponse['status'] = 'error';
                    $arrResponse['message'] = 'Unable to save data, please try again!';
                }
            } else {
                $arrResponse['status'] = 'error';
                $arrResponse['message'] = 'Please select a card as default settings';
            }

            echo json_encode($arrResponse);
            exit();
        }
    }

    /* @author Sneha G    
      @params
      @return no
     * addEdit Requestor
     */

    public function addEditRequestor($id = null) {
        $this->viewBuilder()->setLayout('website_layout');
        $userSession = $this->request->session()->read('LoginUser');
        $userTable = TableRegistry::get('users');

        $countryTable = TableRegistry::get('countries');
        $countryList = $countryTable->listCountries();
        $userData = array();
        $userDataArr = array();
        if (!empty($id)) {
            $id = $userTable->decrypt($id);
            $userData = $userTable->findUserByID($id);
        }

        if ($this->request->is(['patch', 'post'])) {
//            pr($this->request->data);
//           exit('in 233');
            if (!empty($id)) {
                $users = $userTable->get($id);
//                 $users = $this->request->data['User'];
                unset($this->request->data['User']['password']);
                unset($this->request->data['User']['confirm_password']);
                $user = $userTable->patchEntity($users, $this->request->getData(), ['validate' => 'OnlyCheck']);
            } else {
                $users = $userTable->newEntity();
                $user = $userTable->patchEntity($users, $this->request->getData());
            }

            $user['role_id'] = 3;
            $user['status'] = 1;
//             pr($id);



            if ($userTable->save($user)) {
//                $id = $user['id'];
//                $hashCode = md5(uniqid(rand(), true));
//                $userDataForUpdate = $userTable->get($id);
//                $userTable->patchEntity($userDataForUpdate, $this->request->getData());
//                $userTable->updateAll(["key_token " => $hashCode], ["id IN " => $id]);
//
//                $this->Common->sendEmail($id, 'Activation Link', $this->request->data['email'], 'activationlink', $emailData = ['first_name' => $userSession['first_name'], 'last_name' => $userSession['last_name'], 'hashCode' => $hashCode]);
                if (!empty($id)) {
                    $this->Flash->success('Requestor updated Successfully.', ['params' => ['class' => 'alert alert-success']]);
                } else {
                    $this->Flash->success('Requestor added Successfully.', ['params' => ['class' => 'alert alert-success']]);
                }

                return $this->redirect(['controller' => 'admins', 'action' => 'requestors']);
            }
            $this->Flash->error('Unable to add the user.', ['params' => ['class' => 'alert alert-danger']]);
        }
        $this->set('user', $user);
        $this->set('id', $id);
        $this->set('countryList', $countryList);
        $this->set('userData', $userData);
    }

    public function isShowClientMatter() {
        $this->autoRender = false;
        $userSession = $this->request->session()->read('LoginUser');
        $userId = $userSession['id'];
        $arrResponse = array();
        $userTable = TableRegistry::get('users');
        $userData = $userTable->findUserByID($userId);
        $this->set('userData', $userData);
        if ($this->request->is('ajax')) {
            $user = $userTable->get($userId);
            $query = $userTable->query();
            $update = $query->update()
                    ->set(['is_client_matter_preference' => $this->request->data['is_client_matter_preference']])
                    ->where(['id' => $userId])
                    ->execute();
            if ($update) {
                $arrResponse['status'] = 'success';
            } else {
                $arrResponse['status'] = 'error';
            }

            $this->set('user', $user);
            echo json_encode($arrResponse);
            exit();
        }
    }
    
     public function getStates() {
        if ($this->request->is('post')) {
            $post_data = $this->request->getData();
            $stateTable = TableRegistry::get('states');
            $stateList = $stateTable->listStateList($post_data['countryID']);
            echo json_encode($stateList); 
            die();
        }
    }
   
     public function getStates2($country_id) {
            $stateTable = TableRegistry::get('states');
            return $stateList = $stateTable->listStateList($country_id);
}
   
}
