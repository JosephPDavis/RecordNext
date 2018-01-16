<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
use Stripe\Stripe;

class AdminsController extends AppController {

    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
        $this->Auth->allow('adminLogin');
        $userSession = $this->request->session()->read('LoginUser');
        $this->loadComponent('Stripe');
    }

    /* @auther Sneha G    
      @params no
      @return no
     */

    public function initialize() {
        parent::initialize();
        $loguser = $this->request->session()->read('LoginUser');
        $this->set('loguser', $loguser);
    }

    public function index() {
        $this->viewBuilder()->setLayout('website_layout');
    }

    public function adminLogin() {
        $loguser = $this->request->session()->read('LoginUser');
        if ($loguser) {
            return $this->redirect(['controller' => 'admins', 'action' => 'dashboard']);
        }
        //layout is only used for login
        $this->viewBuilder()->setLayout('admin_layout');
        $userTable = TableRegistry::get('users');
        if ($this->request->is('post')) {
//            $this->request->data['email'] = $userTable->encrypt($this->request->data['email']);
            $this->request->data['email'] = $this->request->data['email'];
            $user = $this->Auth->identify();
            if ($user) {
                $this->request->session()->write('LoginUser', $user);
                $this->request->session()->check('LoginUser');
                $this->Auth->setUser($user);
                $this->set('userSession', $user);
                if ($user['role_id'] == 1) {
                    return $this->redirect(['controller' => 'admins', 'action' => 'dashboard']);
                } else {
                    return $this->redirect($this->Auth->redirectUrl());
                }
            } else {
//                $this->request->data['email'] = $userTable->decrypt($this->request->data['email']);
                $this->request->data['email'] = $this->request->data['email'];
                $this->adminLogout();
                $this->Flash->error('Invalid username or password, try again', ['params' => ['class' => 'alert alert-danger']]);
            }
        }
    }

    public function dashboard() {
        $this->viewBuilder()->setLayout('website_layout');
        $userSession = $this->request->session()->read('LoginUser');
        $user_id = $userSession['id'];
        $data = array();
        $userTable = TableRegistry::get('users');
        $requestTable = TableRegistry::get('requests');
        $data = $requestTable->find('all', array('fields' => array('id', 'request_status', 'provider_id', 'requestor_id', 'request_id'),
                    'conditions' => array(
                        'OR' => array(
                            'request_status' => '7',
                            'request_status' => '8'
                        ),
                    ), 'limit' => REC0RDS_LIMIT, 'order' => ['modified' => 'desc']
                ))->all()->toArray();
        $output = array();
        $index = 1;
        if (!empty($data)) {
            foreach ($data as $notice) {
                $requestorData = $userTable->findRequestorByID($notice['requestor_id']);
                $providerData = $userTable->findProviderByID($notice['provider_id']);
                $requestorName = $requestorData['first_name'] . ' ' . $requestorData['last_name'];
                $providerName = $providerData['first_name'] . ' ' . $providerData['last_name'];
                $status = $this->getStatusByID($notice['request_status']);
                $link = SITE_URL . 'providers/view-request/' . $userTable->encrypt($notice['id']);

                array_push($output, "<div class='warningInfo'>$index. The request status is " . $status . " for request ID <a href='" . $link . "'>#" . $notice['request_id'] . "</a> </div>");

                $index++;
            }
        }
        $this->set('data', $output);
    }

    public function getStatusByID($request_id) {
        switch ($request_id) {
            case 0:
                return 'Submitted';
                break;

            case 1:
                return 'Provider Acknowledged';
                break;

            case 2:
                return 'Provider Denied';
                break;

            case 3:
                return 'Record Found';
                break;

            case 4:
                return 'No Records Found';
                break;

            case 5:
                return 'In Progress';
                break;

            case 6:
                return 'Upload Records';
                break;

            case 8:
                return 'Records Available for Download';
                break;

            case 9:
                return 'Requestor Denied';
                break;

            case 10:
                return 'Requestor Confirmed';
                break;

            case 11:
                return 'Closed';
                break;

            case 12:
                return 'Closed';
                break;

            case 13:
                return 'Closed';
                break;

            case 14:
                return 'Closed';
                break;

            default:
                return 'NA';
                break;
        }
    }

    public function requests() {
        $this->viewBuilder()->setLayout('website_layout');
        $requestTable = TableRegistry::get('requests');
        $conditions = [];
        $conditions += ['requests.is_deleted' => 0];
        if ($this->request->is('post')) {
            $post_data = $this->request->getData();
            $name_keyword = $post_data['by_name'];
            $id_keyword = $post_data['by_id'];
            $start_date = $post_data['by_start_date'];
            $end_date = $post_data['by_end_date'];

            if (isset($name_keyword) && $name_keyword != '') {
                $conditions += array(
                    "OR" => array(
                        'requests.first_name LIKE' => '%' . $name_keyword . '%',
                        'requests.last_name LIKE' => '%' . $name_keyword . '%',
                        'Provider.first_name LIKE' => '%' . $name_keyword . '%',
                        'Provider.last_name LIKE' => '%' . $name_keyword . '%',
//                        'CONCAT(first_name," ", last_name) LIKE' => '%' . $name_keyword . '%',
//                        'CONCAT(Provider.first_name," ", Provider.last_name) LIKE' => '%' . $name_keyword . '%',
                    ),
                );
            }
            if (isset($id_keyword) && $id_keyword != '') {
                $conditions += array(
                    "OR" => array(
                        'Matters.matter_no' => $id_keyword,
                        'requests.request_id' => $id_keyword
                    ),
                );
            }
            if (isset($start_date) && $start_date != '') {
                $conditions += array('requests.date_of_request >=' => date('Y-m-d', strtotime($start_date)));
            }
            if (isset($end_date) && $end_date != '') {
                $conditions += array('requests.date_of_request <=' => date('Y-m-d', strtotime($end_date)));
            }
        }
        $this->paginate = [
            'contain' => ['Provider', 'Clients', 'Matters'],
            'maxLimit' => REC0RDS_LIMIT,
            'conditions' => $conditions,
            'order' => ['id' => 'DESC']
        ];
        $requestData = $this->paginate($requestTable->find())->toArray();
        $this->set('requestData', $requestData);
    }

    public function requestors() {
        $this->viewBuilder()->setLayout('website_layout');
        $userTable = TableRegistry::get('users');
        $conditions = ['is_deleted' => 0, 'role_id' => 3];

        if ($this->request->is('post')) {
            $post_data = $this->request->getData();
            $name_keyword = $post_data['by_name'];
//            $lname_keyword = $post_data['by_lname'];
            $email_keyword = $post_data['by_email'];
            $created_date = $post_data['by_date'];
//            $company_keyword = $post_data['by_company'];
            if (isset($name_keyword) && $name_keyword != '') {
                $conditions += array('OR' => array(
                        'first_name LIKE' => '%' . $name_keyword . '%',
                        'last_name LIKE' => '%' . $name_keyword . '%',
                        'CONCAT(first_name," ", last_name) LIKE' => '%' . $name_keyword . '%',
                ));
            }
//            if (isset($lname_keyword) && $lname_keyword != '') {
//                $lname_keyword = $userTable->encrypt($lname_keyword);
//                $conditions += array('last_name' => $lname_keyword);
//            }
            if (isset($email_keyword) && $email_keyword != '') {
//                $email_keyword = $userTable->encrypt($email_keyword);
                $conditions += array('email' => $email_keyword);
            }
            if (isset($created_date) && $created_date != '') {
                $conditions += array('date(created)' => date('Y-m-d H:i:s ', strtotime($created_date)));
            }
//            if (isset($company_keyword) && $company_keyword != '') {
////                $company_keyword = $userTable->encrypt($company_keyword);
//                $conditions += array('company_name' => $company_keyword);
//            }
        }

        $this->paginate = [
            'maxLimit' => REC0RDS_LIMIT,
            'conditions' => $conditions,
            'order' => ['id' => 'DESC']
        ];
        $requestors = $this->paginate($userTable->find())->toArray();
        $this->set('requestors', $requestors);
    }

    public function providers() {
        $this->viewBuilder()->setLayout('website_layout');
        $userTable = TableRegistry::get('users');
        $conditions = ['is_deleted' => 0, 'role_id' => 2];

        if ($this->request->is('post')) {
            $post_data = $this->request->getData();
            $name_keyword = $post_data['by_name'];
//            $lname_keyword = $post_data['by_lname'];
            $email_keyword = $post_data['by_email'];
            $created_date = $post_data['by_date'];
            $company_keyword = (!empty($post_data['by_company'])) ? $post_data['by_company'] : '';
            if (isset($name_keyword) && $name_keyword != '') {
                //$fname_keyword = $userTable->encrypt($fname_keyword);
                $conditions += array('OR' => array(
                        'first_name LIKE' => '%' . $name_keyword . '%',
                        'last_name LIKE' => '%' . $name_keyword . '%',
                        'CONCAT(first_name," ", last_name) LIKE' => '%' . $name_keyword . '%',
                ));
            }

            if (isset($email_keyword) && $email_keyword != '') {
//                $email_keyword = $userTable->encrypt($email_keyword);
                $conditions += array('email' => $email_keyword);
            }
            if (isset($created_date) && $created_date != '') {
                $conditions += array('date(created)' => date('Y-m-d H:i:s ', strtotime($created_date)));
            }
        }
//        pr($conditions);
        $this->paginate = [
            'maxLimit' => REC0RDS_LIMIT,
            'conditions' => $conditions,
            'order' => ['id' => 'DESC']
        ];
        $providers = $this->paginate($userTable->find())->toArray();
        $this->set('providers', $providers);
    }

    public function adminLogout() {
        $this->request->session()->destroy('Auth.User');
        return $this->redirect(['action' => 'adminLogin']);
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
//          
            if ($userTable->save($user)) {
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

    /* @author Sneha G    
      @params
      @return no
     * addEdit Provider
     */

    public function addEditProvider($id = null) {
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
            if (!empty($id)) {
                $users = $userTable->get($id);
                unset($this->request->data['User']['password']);
                unset($this->request->data['User']['confirm_password']);
                $user = $userTable->patchEntity($users, $this->request->getData(), ['validate' => 'OnlyCheck']);
            } else {
                $users = $userTable->newEntity();
                $user = $userTable->patchEntity($users, $this->request->getData());
            }

            $user['role_id'] = 2;
            $user['status'] = 1;
//          
            if ($userTable->save($user)) {
                if (!empty($id)) {
                    $this->Flash->success('Requestor updated Successfully.', ['params' => ['class' => 'alert alert-success']]);
                } else {
                    $this->Flash->success('Requestor added Successfully.', ['params' => ['class' => 'alert alert-success']]);
                }

                return $this->redirect(['controller' => 'admins', 'action' => 'providers']);
            }
            $this->Flash->error('Unable to add the user.', ['params' => ['class' => 'alert alert-danger']]);
        }
        $this->set('user', $user);
        $this->set('id', $id);
        $this->set('countryList', $countryList);
        $this->set('userData', $userData);
    }

    /* @author Sneha G    
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
        if (!empty($departments)) {
            
        }
        echo json_encode($departments);
        exit();
    }

    /* @author Sneha G    
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

    public function bulkImport($id = null) {
        $this->viewBuilder()->setLayout('website_layout');
        $userTable = TableRegistry::get('users');
        $countryTable = TableRegistry::get('countries');
        $roleId = $userTable->decrypt($id);
        $saveFlag;
        $errorUser = array();
        $savedUser = array();
        $isErrorExist = false;
        $columns = array();
        if (!empty($this->request->data)) {
            $data = $this->request->data['CSV'];
            if (!empty($data)) {
                $fileName = $data['name'];
                $checkExtensn = explode('.', $fileName);
                if ($checkExtensn[1] == 'csv') { //check file is valid csv
                    if ($roleId == 1) { //check type of user adding
                        //import for requestor
                        $roleId = 3;
                    } else {
                        //import for provider
                        $roleId = 2;
                    }
                    $file = $data['tmp_name'];
                    $handle = fopen($file, "r");
                    $i = 0;
                    $flag = true;
                    while (($row = fgetcsv($handle, 1000, ",")) !== FALSE) {

                        if ($row[0] == 'First Name' && $row[1] == 'Last Name' && $row[2] == 'email' && $row[3] == 'Password' && $row[4] == 'phone' && $row[5] == 'city' && $row[6] == 'state' && $row[7] == 'zip_code' && $row[8] == 'country' && $row[9] == 'street_address') {
                            continue;
                        }
                        if ($flag) {
                            $flag = false;
                            continue;
                        }

                        //function for get country id by name
                        $countryName = $countryTable->getCountryIDbyName($row[7]);
                        $columns = [
                            'first_name' => $row[0],
                            'last_name' => $row[1],
                            'email' => $row[2],
                            'password' => $row[3],
                            'phone' => $row[4],
                            'city' => $row[5],
                            'state' => $row[6],
                            'zip_code' => $row[7],
                            'country' => $countryName,
                            'street_address' => $row[9],
                            'role_id' => $roleId,
                        ];

                        $userEnity = $userTable->newEntity($columns);
                        if ($userEnity->errors()) {

                            $isErrorExist = true;
                            array_push($errorUser, array('userEntity' => $userEnity, 'rowNumber' => ($i + 2)));
//                            array_push($errorUser,  $row[2].' is failed to register. Reason ');
//                            break;
                        } else {
                            $saveFlag = $userTable->save($userEnity);
                            array_push($savedUser, array('userEntity' => $userEnity, 'rowNumber' => ($i + 2)));
                        }
                        $i++;
                    }
                    echo $isErrorExist;
                    if ($isErrorExist == false) {

                        $this->Flash->success('CSV uploaded Successfully.', ['params' => ['class' => 'alert alert-success']]);
                    } else {
                        //for error starts
                        $errDom = '';
                        foreach ($errorUser as $index => $errUser) {
                            if ($index > 0) {
                                //$errDom .="<div> Row number ".$errUser['rowNumber'];
                                $invEmail = $errUser['userEntity']->invalid();
                                $emailAddr = isset($invEmail['email']) ? $invEmail['email'] : $errUser['userEntity']['email'];
                                $errDom .="<div>";
                                $errDom .="<ul>";

                                foreach ($errUser['userEntity']->errors() as $key => $val) {
                                    $errDom .="<li class='text-danger'> Error found for   " . $key . " field";
                                    if (isset($val['_empty'])) {
                                        $errDom .=" is empty ";
                                    } else if (isset($val['email'])) {
                                        $errDom .= $emailAddr . " already exist";
                                    }
                                    $errDom .="</li>";
                                }
                                $errDom .="</ul>";
                                $errDom .="</div>";
                            }
                        }
                        //for error ends
                        //for saved user starts
                        $savedDom = "<ul>";

                        foreach ($savedUser as $index => $savUser) {
                            //pr($savUser);
                            $savedDom .="<li class='text-success'> Row number " . $savUser['rowNumber'] . ' with email id' . $savUser['userEntity']['email'] . ' saved</li>';
                        }
                        $savedDom .="</ul>";
                        $this->Flash->error('Unable to upload the file, please rectify below errors!', ['params' => ['class' => 'alert alert-danger']]);
//                        array_shift($errDom); 
                        $this->set('errDom', $errDom);
                        $this->set('savedDom', $savedDom);
                    }
                } else {
                    $this->Flash->error('Invalid file type, please upload CSV file!', ['params' => ['class' => 'alert alert-danger']]);
                }
            } else {
                $this->Flash->error('Please upload CSV file!', ['params' => ['class' => 'alert alert-danger']]);
            }
        }
    }

    public function delete($getId = null) {
        $userSession = $this->request->session()->read('LoginUser');
        $userTable = TableRegistry::get('users');
        $id = $userTable->decrypt($getId);
        $update = $userTable->updateAll(
                array('users.is_deleted' => '1'), array('users.id' => $id)
        );
        if ($update) {
            $this->Flash->success('User has been deleted Successfully.', ['params' => ['class' => 'alert alert-success']]);
        } else {
            $this->Flash->error('Unable to delete the department.', ['params' => ['class' => 'alert alert-danger']]);
        }
        $this->redirect($this->referer());
    }

    public function changeStatus($id = null) {

        $this->autoRender = false;
//        $this->layout = "ajax";
        $userSession = $this->request->session()->read('LoginUser');
        $userTable = TableRegistry::get('users');
        $arrResp = array();
//        pr($id);
        if (!empty($id)) {
            $userId = $id;
            $UserData = $userTable->get($id);
            if (!empty($UserData)) {
                if ($UserData['status'] == 0) {
                    echo 'in if';
                    $activeStatus = 1;
                } else {
                    echo 'in else';
                    $activeStatus = 0;
                }
//                            exit('401');

                $statusUpdate = $userTable->updateAll(
                        array('users.status' => $activeStatus), array('users.id' => $userId));
                if ($statusUpdate) {
                    $arrResp['status'] = $activeStatus;
                    $arrResp['result'] = 'Status Changed';
                }
            }
            echo json_encode($arrResp);
            exit;
        }
    }

    /* @author Sneha G   
      @params id
      @return request details
     */

    public function viewRequest($id = null) {
//        echo 1; exit('in pages/dashboard');
        $this->viewBuilder()->setLayout('website_layout');
        $userTable = TableRegistry::get('users');
        $data = array();
        $id = $userTable->decrypt($id);
        $requestTable = TableRegistry::get('requests');
        $data = $requestTable->find('all', array(
                    'conditions' => array('id' => $id)
                ))->first();
        $this->set('data', $data);

//        pr($data); exit;
    }

    /* @author Sneha G   
      @params id
      @return
     */

    public function deleteRequest($getId = null) {

        $userTable = TableRegistry::get('users');
        $requestTable = TableRegistry::get('requests');
        $id = $userTable->decrypt($getId);
//        $update = $requestTable->updateAll(
//                array('requests.is_deleted' => '1'), array('requests.id' => 7)
//        );
        $query = $requestTable->query();
        $update = $query->update()
                ->set(['is_deleted' => '1'])
                ->where(['id' => $id])
                ->execute();

        if ($update) {
            $this->Flash->success('Request has been deleted Successfully.', ['params' => ['class' => 'alert alert-success']]);
        } else {
            $this->Flash->error('Unable to delete the request.', ['params' => ['class' => 'alert alert-danger']]);
        }
        $this->redirect($this->referer());
    }

    public function paymentSettings() {
        $this->viewBuilder()->setLayout('website_layout');
        $userTable = TableRegistry::get('users');
        $adminSettingsTable = TableRegistry::get('admin_settings');
        $userSession = $this->request->session()->read('LoginUser');
        $settings = $adminSettingsTable->newEntity();
        $adminSettings = $adminSettingsTable->get($userSession['id']);
        if (!empty($this->request->data)) {
            $setting = $userTable->patchEntity($settings, $this->request->getData());
//            pr($this->request->data);
            $adminSettingsTable->save($setting);
            if ($adminSettingsTable) {
                $this->Flash->success('Settings have been saved Successfully.', ['params' => ['class' => 'alert alert-success']]);
            } else {
                $this->Flash->error('Unable to save request.', ['params' => ['class' => 'alert alert-danger']]);
            }
            $this->redirect($this->referer());
        }
        $this->set('settings', $settings);
        $this->set('adminSettings', $adminSettings);
        $this->set('id', $userSession['id']);
    }

    /* @author Sneha G   
      @params none
      @return listing of requests payment to prsovider
     */

    public function paymentListings() {
        $this->viewBuilder()->setLayout('website_layout');
        $userSession = $this->request->session()->read('LoginUser');
        $requestTable = TableRegistry::get('requests');
        $ProviderPaymentsDetails = TableRegistry::get('provider_payments_details');
//        $providerAccountData = $ProviderPaymentsDetails->getProviderAccId($userSession['id']);
        $userTable = TableRegistry::get('users');
        $start_date = $end_date = $name_keyword = $payment_status = '';
        $conditions = array(
            "OR" => array(
                'requests.paid_to_provider' => '1',
                'requests.paid_to_admin' => '1'
            ),
            "AND" => array(
                'requests.payment_status' => '1',
                'requests.request_status !=' => '9'
            ),
        );

        if ($this->request->is('post')) {
            $post_data = $this->request->getData();
            $name_keyword = $post_data['by_name'];
            $start_date = $post_data['by_start_date'];
            $end_date = $post_data['by_end_date'];
            $payment_status = $post_data['payment_status'];
            if (isset($name_keyword) && $name_keyword != '') {
                $conditions += array(
                    "OR" => array(
                        'requests.first_name LIKE' => '%' . $name_keyword . '%',
                        'requests.last_name LIKE' => '%' . $name_keyword . '%',
                        'Provider.first_name LIKE' => '%' . $name_keyword . '%',
                        'Provider.last_name LIKE' => '%' . $name_keyword . '%',
                    ),
                );
            }

            if (isset($start_date) && $start_date != '') {
                $conditions += array('requests.date_of_request >=' => date('Y-m-d', strtotime($start_date)));
            }

            if (isset($end_date) && $end_date != '') {
                $conditions += array('requests.date_of_request <=' => date('Y-m-d', strtotime($end_date)));
            }

            if (isset($payment_status) && $payment_status != '') {
                if ($payment_status == 'Paid') {
                    $conditions += array('requests.paid_to_provider' => '1', 'requests.payment_status' => '1');
                }
                if ($payment_status == 'Unpaid') {
                    $conditions += array('requests.paid_to_provider' => '0', 'requests.payment_status' => '1');
                }
            }
        }

        $this->paginate = [
            'contain' => ['Provider', 'Payments'],
            'maxLimit' => REC0RDS_LIMIT,
            'conditions' => $conditions,
            'order' => ['modified' => 'DESC']
        ];
        $requestData = $this->paginate($requestTable->find())->toArray();

        $this->set('requestData', $requestData);
        $this->set('start_date', $start_date);
        $this->set('end_date', $end_date);
        $this->set('payment_status', $payment_status);
        $this->set('name_keyword', $name_keyword);
//        $this->set('providerAccountData', $providerAccountData);
    }

    public function viewInvoice($id = null) {
        $this->viewBuilder()->setLayout('website_layout');
        $userTable = TableRegistry::get('users');
        $request_id = $userTable->decrypt($id);
        $ProviderPaymentsDetails = TableRegistry::get('provider_payments_details');
        $ProviderPayments = TableRegistry::get('provider_payments');
        $requestsTable = TableRegistry::get('requests');
        if (!empty($id)) {
            $requestData = $requestsTable->findRequestDataByID($request_id);
            //find provider payment data
            $paymentData = $ProviderPayments->findDataByIdRequest($request_id);
            $this->set('requestData', $requestData);
            $this->set('paymentData', $paymentData);
        }
    }

    public function makeSinglePayment($id = null) {
        $userTable = TableRegistry::get('users');
        $adminSettingsTable = TableRegistry::get('admin_settings');
        $userSession = $this->request->session()->read('LoginUser');
        $ProviderPaymentsDetails = TableRegistry::get('provider_payments_details');
        $ProviderPayments = TableRegistry::get('provider_payments');
        $requestsTable = TableRegistry::get('requests');
        if ($this->request->is('post')) {
            $post_data = $this->request->getData();
            if (isset($post_data['request_id']) && !empty($post_data['request_id'])) {
                $providerData = $ProviderPaymentsDetails->getProviderAccId($post_data['provider_id']);
                $acc_id = $providerData['stripe_custom_account_id'];
                $default_currency = $providerData['default_currency'];
                $fees = $post_data['provider_fees'] * 100;  // to change from cent to doller

                \Stripe\Stripe::setApiKey("sk_test_OAYRwtiKanB9quptS09wRN09");

                $Transfer = \Stripe\Transfer::create(
                                array(
                                    "amount" => $fees,
                                    "currency" => 'usd',
                                    "destination" => $acc_id
                                )
                );
//                 
                $Transfer = json_decode(json_encode($Transfer), true);

                $request_id = $post_data['request_id'];
                $provider_id = $post_data['provider_id'];
                $provider_fees = $post_data['provider_fees'];

                if (!empty($Transfer['id'])) {
                    $ProviderPaymentRow = $ProviderPayments->newEntity();
                    $ProviderPaymentRow->request_id = $request_id;
                    $ProviderPaymentRow->provider_id = $provider_id;
                    $ProviderPaymentRow->provider_fees = $provider_fees;
                    $ProviderPaymentRow->transaction_id = $Transfer['id'];
                    $ProviderPaymentRow->payment_status = 1;
                    $ProviderPayments->save($ProviderPaymentRow);

                    $requestRow = $requestsTable->get($request_id);
                    $requestRow->paid_to_provider = 1;
                    $res = $requestsTable->save($requestRow);

                    if ($res) {
                        $arrJson['status'] = 'success';
                        $arrJson['message'] = 'Payment Status updated successfully';
                    } else {
                        $arrJson['status'] = 'error';
                        $arrJson['message'] = 'Payment status updatedion failed';
                    }
                }
                echo json_encode($arrJson);
                exit();
            }
        }
    }

    /* @author Sneha G   
      @params request_id,provider_id,amount
      @return stripe bulk payment for multiple requests
     */

    public function makeBulkPayment($id = null) {
        $userTable = TableRegistry::get('users');
        $adminSettingsTable = TableRegistry::get('admin_settings');
        $userSession = $this->request->session()->read('LoginUser');
        $ProviderPaymentsDetails = TableRegistry::get('provider_payments_details');
        $ProviderPayments = TableRegistry::get('provider_payments');
        $requestsTable = TableRegistry::get('requests');
        $arrJson = $errorList = $requestIDsArr = array();
        if ($this->request->is('post')) {
            $Data = $this->request->getData();
            $Data = $Data['data'];
            foreach ($Data as $post_data) {
                //find provider name
                $providerData = $userTable->findProviderByID($post_data['provider_id']);
                $requestData = $requestsTable->findRequestDataByID($post_data['request_id']);
                $providerName = $providerData['first_name'] . ' ' . $providerData['first_name'];
                if (isset($post_data['request_id']) && !empty($post_data['request_id'])) {
                    $providerData = $ProviderPaymentsDetails->getProviderAccId($post_data['provider_id']);
                    $acc_id = $providerData['stripe_custom_account_id'];
                    $default_currency = $providerData['default_currency'];
                    $fees = $post_data['provider_fees'] * 100;  // to change from cent to doller

                    \Stripe\Stripe::setApiKey("sk_test_OAYRwtiKanB9quptS09wRN09");

//                    $tokenArr =   \Stripe\Token::create(array(
//                          "card" => array(
//                            "number" => "4242424242424242",
//                            "exp_month" => 1,
//                            "exp_year" => 2019,
//                            "cvc" => "314"
//                          )
//                        ));
//                    $tokenArr = json_decode(json_encode($tokenArr), true);
//                    $token =  $tokenArr['id'];
//                    $charge =  \Stripe\Charge::create(array(
//                        "amount" => 2000000,
//                        "currency" => "usd",
//                        "source" => "tok_bypassPending", // obtained with Stripe.js
//                        "description" => "Charge for anthony.moore@example.com"
//                      ));
//                    
//                    $check_balnace = \Stripe\Balance::retrieve();
//                    $balanceArr = $check_balnace->__toArray(true);
//                    pr($balanceArr); 
//                    die('test');
//                    $available_amount = $balanceArr['available']['0']['amount'];
//                    if($available_amount < $fees){
//                            $arrJson['status'] = 'error';
//                            $arrJson['message'] = 'You dont have sufficient funds to do this transfer.';
//                            echo json_encode($arrJson);
//                            die();
//                    }
                    $Transfer = \Stripe\Transfer::create(
                                    array(
                                        "amount" => $fees,
                                        "currency" => 'usd',
                                        "destination" => $acc_id
                                    )
                    );
//                 
                    $Transfer = json_decode(json_encode($Transfer), true);

                    $request_id = $post_data['request_id'];
                    $provider_id = $post_data['provider_id'];
                    $provider_fees = $post_data['provider_fees'];

                    if (!empty($Transfer['id'])) {
                        $ProviderPaymentRow = $ProviderPayments->newEntity();
                        $ProviderPaymentRow->request_id = $request_id;
                        $ProviderPaymentRow->provider_id = $provider_id;
                        $ProviderPaymentRow->provider_fees = $provider_fees;
                        $ProviderPaymentRow->transaction_id = $Transfer['id'];
                        $ProviderPaymentRow->payment_status = 1;
                        $ProviderPayments->save($ProviderPaymentRow);
                        $requestRow = $requestsTable->get($request_id);
                        $requestRow->paid_to_provider = 1;
                        $res = $requestsTable->save($requestRow);
                        if ($res) {
                            array_push($requestIDsArr, $requestData['request_id']);
                            $arrJson['status'] = 'success';
                            $arrJson['message'] = '';
                        } else {
                            $arrJson['status'] = 'error';
                            $arrJson['message'] = 'Payment status updatedion failed';
                        }
                    } else {
                        array_push($errorList, array('error' => 'Transaction failed for request number ' . $requestData['request_id']));
                        $arrJson['error'] = $errorList;
                    }
                } else {
                    
                }
            }
        }
        if (!empty($requestIDsArr)) {
            $arrStr = implode(',', $requestIDsArr);
            $str = "Payments for request numbers " . $arrStr . " has paid successfully";
            $arrJson['message'] = $str;
        }

        echo json_encode($arrJson);
        exit();
    }

    /* @author Sneha G   
      @params id
      @return
     */

    public function allOpenRequests() {
        $this->viewBuilder()->setLayout('website_layout');
        $requestTable = TableRegistry::get('requests');
        $conditions = [];
        $conditions += ['requests.is_deleted' => 0];
        $conditions += ['requests.request_status IN' => [0, 1, 5]];
        if ($this->request->is('post')) {
            $post_data = $this->request->getData();
            $name_keyword = $post_data['by_name'];
            $id_keyword = $post_data['by_id'];
            $start_date = $post_data['by_start_date'];
            $end_date = $post_data['by_end_date'];

            if (isset($name_keyword) && $name_keyword != '') {
                $conditions += array(
                    "OR" => array(
                        'requests.first_name LIKE' => '%' . $name_keyword . '%',
                        'requests.last_name LIKE' => '%' . $name_keyword . '%',
                        'Provider.first_name LIKE' => '%' . $name_keyword . '%',
                        'Provider.last_name LIKE' => '%' . $name_keyword . '%',
                    ),
                );
            }
            if (isset($id_keyword) && $id_keyword != '') {
                $conditions += array(
                    "OR" => array(
                        'Matters.matter_no' => $id_keyword,
                        'requests.request_id' => $id_keyword
                    ),
                );
            }
            if (isset($start_date) && $start_date != '') {
                $conditions += array('requests.date_of_request >=' => date('Y-m-d', strtotime($start_date)));
            }
            if (isset($end_date) && $end_date != '') {
                $conditions += array('requests.date_of_request <=' => date('Y-m-d', strtotime($end_date)));
            }
        }


        $this->paginate = [
            'contain' => ['Provider', 'Clients', 'Matters'],
            'maxLimit' => REC0RDS_LIMIT,
            'conditions' => $conditions,
            'order' => ['id' => 'DESC']
        ];
        $requestData = $this->paginate($requestTable->find())->toArray();
        $this->set('requestData', $requestData);
    }

    public function adminForgetPassword($param = null) {
        $this->viewBuilder()->setLayout('admin_layout');
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
                $this->Common->sendEmail($userData['id'], 'Forget Password', $this->request->data['email'], 'adminforgetpassword', $emailData = ['first_name' => $userData['first_name'], 'last_name' => $userData['last_name'], 'hashCode' => $hashCode]);
                $this->Flash->success('Check your e-mail to reset your password.', ['params' => ['class' => 'alert alert-success']]);
                return $this->redirect(['controller' => 'Admins', 'action' => 'adminLogin']);
            } else {
                $this->Flash->error('The e-mail address you have entered does not exists.', ['params' => ['class' => 'alert alert-danger']]);
            }
        }
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
        return $this->redirect(['controller' => 'Admins', 'action' => 'adminLogin']);
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    /*  @author Sneha G    
      @params $token
      @return no
     */

    public function adminResetPassword($token = null) {
        $this->viewBuilder()->setLayout('admin_layout');
        $userTable = TableRegistry::get('users');
        $userData = $userTable->findUserBytokenID($token);
            
        if (empty($userData['id'])){
            $this->Flash->error('This link has been expired.Please try again.', ['params' => ['class' => 'alert alert-danger']]);
            return $this->redirect(['controller' => 'Admins', 'action' => 'adminLogin']);
        }
        if ($this->request->is('post')) {
            
                $userData = $userTable->findUserBytokenID($this->request->data['token']);
                $user = $userTable->get($userData['id']);
                $user->reset_password_flag = 0;
                $user = $userTable->patchEntity($user, $this->request->data);
                if ($userTable->save($user)) {
                    $this->Flash->success('Password has been updated successfully.', ['params' => ['class' => 'alert alert-success']]);
                    return $this->redirect(['controller' => 'Admins', 'action' => 'adminLogin']);
                } else {
                    $this->Flash->error('Entered old password does not match.Please try again.', ['params' => ['class' => 'alert alert-danger']]);
                }
            }
        $this->set(compact('user'));
        $this->set('token', $token);   
        $this->set('_serialize', ['user']);
    }

}
