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

class RequestorsController extends AppController {

    public function initialize() {
        parent::initialize();
        $this->loadComponent('Stripe');
        
    }

    public function beforeFilter(Event $event) {
        $action = $this->request->action;
        $controller = $this->request->controller;
        parent::beforeFilter($event);
        $this->Auth->allow('requestorRegistration');
        $userSession = $this->request->session()->read('LoginUser');
        $this->Auth->allow('getProviderList');

        $this->checkUserSession();
    }

    /* @author Mahalaxmi    
      @params no
      @return no
     */

    public function requestorRegistration() {
        $this->viewBuilder()->setLayout('default');
        $userSession = $this->request->session()->read('LoginUser');
        $userTable = TableRegistry::get('users');
        $Providers = $userTable->newEntity();
        $countryTable = TableRegistry::get('countries');
        $countryArr = $countryTable->listCountries();
        foreach($countryArr as $country){
            $countryList[$country['id']] = $country['name'];
        }
        $this->set('countryList', $countryList);
        
        $stateTable = TableRegistry::get('states');
        $stateList = $stateTable->listStateList($id=0);
        $this->set('stateList', $stateList);
        
        if ($this->request->is('post')) {
            $user = $userTable->patchEntity($Providers, $this->request->getData());
            $userDataForUpdate = $user;
            $user['role_id'] = 3;
            $user['status'] = 0;
            if ($userTable->save($user)) {
                $id = $user['id'];
                $hashCode = md5(uniqid(rand(), true));
                $userDataForUpdate = $userTable->get($id);
                $userTable->patchEntity($userDataForUpdate, $this->request->getData());
                $userTable->updateAll(["key_token " => $hashCode], ["id IN " => $id]);
                $this->Common->sendEmail($id, 'Activation Link', $this->request->data['email'], 'activationlink', $emailData = ['first_name' => $userSession['first_name'], 'last_name' => $userSession['last_name'], 'hashCode' => $hashCode]);
                //make requestor folder in webroot
//                pr(WWW_ROOT);
                $dir = WWW_ROOT . 'documents/requestor/' . $id;
                if (!is_dir($dir)) {
                    @mkdir($dir);
                }
                @chmod($dir, 0777);
                $this->Flash->success('You have registered Successfully, Please check your email for verification link.', ['params' => ['class' => 'alert alert-success']]);
                return $this->redirect(['controller' => 'Users', 'action' => 'login']);
            }
            $this->Flash->error('Unable to add the user.', ['params' => ['class' => 'alert alert-danger']]);
        }
        $this->set('user', $Providers);
    }

    /* @author Mahalaxmi    
      @params user id
      @return provider id and department id(optional)
     */

    public function selectProvider($id = null) {
        $this->viewBuilder()->setLayout('website_layout');
        $userTable = TableRegistry::get('users');
        $id = $userTable->decrypt($id);
        $providerId = isset($this->request->query['providerId']) && !empty($this->request->query['providerId']) ? $this->request->query['providerId'] : '';
        $departmentId = isset($this->request->query['deptId']) && !empty($this->request->query['deptId']) ? $this->request->query['deptId'] : '';

        //read session if exist the destroy
        //read the request page data from session after writing it in session
        $requestDataArr = $this->request->session()->read('RequestData');
        if (!empty($requestDataArr)) {
            $this->request->session()->delete('RequestData');
        }

        if(!empty($providerId)){
        $providerData = $userTable->findProviderByID($providerId);
        $requestData['full_name'] = $providerData['first_name'] . " " . $providerData['last_name'];
        $requestData['provider_id'] = $providerId;
        }
        $requestData['department_id'] = $departmentId;

        $this->set(['requestData' => $requestData]);
        
        if ($this->request->is('post')) {
            if (empty($this->request->data['provider_id'])) {
                $this->request->data['provider_id'] = $providerId;
            }
            if (!empty($this->request->data['provider_id'])) {
//                $this->Flash->success('You have add request Successfully.', ['params' => ['class' => 'alert alert-success']]);   
                if (!empty($id)) {
                    return $this->redirect(['controller' => 'requestors', 'action' => 'request', $userTable->encrypt($id), '?' => array('providerId' => $userTable->encrypt($this->request->data['provider_id']), 'deptId' => (isset($this->request->data['department_id']) ? $userTable->encrypt($this->request->data['department_id']) : ''))]);
                } else {
                    return $this->redirect(['controller' => 'requestors', 'action' => 'request', '?' => array('providerId' => $userTable->encrypt($this->request->data['provider_id']), 'deptId' => (isset($this->request->data['department_id']) ? $userTable->encrypt($this->request->data['department_id']) : ''))]);
                }
            } else {
                $this->Flash->error('Unable to add the request.', ['params' => ['class' => 'alert alert-danger']]);
                // return $this->redirect(['controller' => 'requestors','action' => 'request',$userTable->encrypt($id)]);   
            }
           
        }
    }

    /* @author Mahalaxmi    
      @params request Id
      @return no
     * Modified by Sneha G
     */

    public function request($id = null) {
        $this->viewBuilder()->setLayout('website_layout');
        $userSession = $this->request->session()->read('LoginUser');
        $requestTable = TableRegistry::get('requests');
        $userTable = TableRegistry::get('users');
        $departmentTable = TableRegistry::get('departments');
        $matterTable = TableRegistry::get('matters');
        $clientsTable = TableRegistry::get('clients');
        if (isset($id)) {
            $id = $userTable->decrypt($id);
        } else {
            $id = '';
        }
        //code to find and show default threshold value starts
        $userData = $userTable->findUserByID($userSession['id']);
        $defaultThresholdValue = (!empty($userData['threshold'])) ? $userData['threshold'] : '';
        $this->set('defaultThresholdValue', $defaultThresholdValue);
        //ends
        $providerId = isset($this->request->query['providerId']) && !empty($this->request->query['providerId']) ? $userTable->decrypt($this->request->query['providerId']) : '';
        $departmentIds = $departmentTable->findAllDepartmentByIDs($providerId);

        if ($id != '') {
            $requestData = $requestTable->findRequestDataByID($id);
        }
        $providerData = $userTable->findProviderByID($providerId);

        if (empty($id)) {
            $requestData['request_id'] = $requestTable->findRequestForlastRecord();
        } else {
            $matterData = $matterTable->find('all', array('fields' => array('id', 'matter_no', 'matter_name', 'client_id'), 'conditions' => array('status' => 1, 'is_deleted' => 0, 'matter_no' => $requestData['matter_no'])))->first();
            $requestData['matter_id'] = $matterData['id'];
            $requestData['matter_name'] = $matterData['matter_name'];
            $clientData = $clientsTable->find('all', array('fields' => array('id', 'first_name', 'last_name', 'client_name', 'client_number'), 'conditions' => array('status' => 1, 'is_deleted' => 0, 'id' => $requestData['client_id'])))->first();
            $requestData['client_name'] = $clientData['client_name'];
            $requestData['client_number'] = $clientData['client_number'];
        }
        if ($this->request->is('post')) {

            if (!empty($id)) {
                $requests = $requestTable->get($id);
            } else {
                $id = $this->request->data['id'];
                $requests = $requestTable->newEntity();
            }

            if (!empty($this->request->data['upload_hippa']['name'])) {
                $checkFileType = $this->request->data['upload_hippa']['type'];

                // for images---- array('image/jpeg','image/jpg','image/gif','image/png', 'image/bmp') 
                if (!in_array($checkFileType, array("application/pdf", "application/doc", "application/docx", "application/vnd.openxmlformats-officedocument.wordprocessingml.document"))) {
                    $reqResponse = array("status" => 'ERROR', 'message' => 'Please upload proper pdf,doc and docx format.');
                    echo json_encode($reqResponse);
                    exit();
                 }
                if (isset($this->request->data['upload_hippa']) && $this->request->data['upload_hippa'] != "") {
                    // Variable declaration
                    $file = $this->request->data['upload_hippa'];
                    $path = 'img/hippa';
                    $folder_name = 'original';
                    $multiple[] = array('folder_name' => 'thumb', 'height' => '160', 'width' => '140');

                    // Code to upload the imagetest
                    $response = $this->Common->upload_image($file, $path, $folder_name, false, $multiple);
                    // check if filename return or error return
                    $is_image_error = $this->Common->is_image_error($response);

                    if ($response == 'exist_error') {
                        $this->Flash->error($is_image_error, ['params' => ['class' => 'alert alert-danger']]);
                    } elseif ($response == 'size_mb_error') {
                        $this->Flash->error($is_image_error, ['params' => ['class' => 'alert alert-danger']]);
                    } elseif ($response == 'type_error') {
                        $this->Flash->error($is_image_error, ['params' => ['class' => 'alert alert-danger']]);
                    } else {
                        $filename = $response;
                        $this->request->data['upload_hippa'] = $filename;
                    }
                }
            } else {
                // unset($this->request->data['upload_hippa']['name']);
                /* debug($this->request->data);
                  exit; */
                if (isset($this->request->data['upload_hippa']['name'])) {
                    unset($this->request->data['upload_hippa']['name']);
                }
                if (isset($this->request->data['upload_hippa']) && $this->request->data['upload_hippa'] == 'undefined') {
                    unset($this->request->data['upload_hippa']);
                }
}
            $ifClientId = '';
            if (!empty($this->request->data['client_number']) && isset($this->request->data['client_number'])) {
                $clients = $clientsTable->newEntity();
                $clientData = $clientsTable->patchEntity($clients, $this->request->getData());
                //check if the client data exist
                $clData = $clientsTable->getclientDataByUserId($this->request->data['requestor_id'],$this->request->data['client_number']);
                //if client data not exist the add client
                if (empty($clData)) {
                    $clientData->user_id = $this->request->data['requestor_id'];
                    $clientData->client_number = $this->request->data['client_number'];
                    $clientData->client_name = $this->request->data['client_name'];
                    $clientData->first_name = $this->request->data['first_name'];
                    $clientData->last_name = $this->request->data['last_name'];
                    $resultClient = $clientsTable->save($clientData);
//                    $ifClientId = $resultClient;
                    $ifClientId = $clientData->id;
                } else {
                    $ifClientId = $clData['id'];
                }
            }
            $mtData = array();
            $ifMatterId = '';
            if (!empty($this->request->data['matter_no']) && isset($this->request->data['matter_no'])) {
                //check if the matter data exist
                $mtData = $matterTable->getMatterDataByClientID($ifClientId, $this->request->data['matter_no']);
//if matter data not exist the add matter
                if (empty($mtData)) {
//                    $clientId = $clientData['id']; //get last inserted client id
                    $clientId = $ifClientId; //get last inserted client id
                    $matters = $matterTable->newEntity();
                    $matterData = $matterTable->patchEntity($matters, $this->request->data);
                    $matterData->client_id = $clientId;
                    $matterData->matter_name = $this->request->data['matter_name'];
                    $matterData->first_name = $this->request->data['first_name'];
                    $matterData->last_name = $this->request->data['last_name'];
                    $matterData->matter_no = $this->request->data['matter_no'];
                    $matterRes = $matterTable->save($matterData);
//                    $ifMatterId = $matterRes;
                    $ifMatterId = $matterData->id;
                } else {
                    $ifMatterId = $mtData['id'];
                }
            }
            $this->request->data['dob'] = date('Y-m-d', strtotime($this->request->data['dob']));
            $this->request->data['rec_start_date'] = date('Y-m-d', strtotime($this->request->data['rec_start_date']));
            $this->request->data['rec_end_date'] = date('Y-m-d', strtotime($this->request->data['rec_end_date']));
            $this->request->data['hippa_form_date'] = date('Y-m-d', strtotime($this->request->data['hippa_form_date']));

            if (!empty($id)) {
                $requestsData = $requestTable->patchEntity($requests, $this->request->getData(), ['validate' => 'OnlyCheck']);
            } else {
                $requestsData = $requestTable->patchEntity($requests, $this->request->getData());
            }
            $provideDecryptId = $requestsData['provider_id'];
            $requestsData['client_id'] = $ifClientId;
            $requestsData['matter_id'] = $ifMatterId;
            $requestsData['description'] = $this->request->data['description'];
            $requestsData['department_id'] = $this->request->data['department_id'];
            $requestsData['requestor_id'] = $this->request->data['requestor_id'];

            $requestsData['ssn_no'] = isset($this->request->data['ssn_no']) ? $this->request->data['ssn_no'] : "";
            //write data in session
            $this->request->session()->write('RequestData', $requestsData);
            if ($this->request->session()->check('RequestData')) { //check session if exist
                $url = SITE_URL . "requestors/payment/" . $userTable->encrypt($requestsData['id']) . "?providerId=" . (isset($provideDecryptId) ? $userTable->encrypt($provideDecryptId) : null) . "&deptId=" . (isset($this->request->data['department_id']) ? $userTable->encrypt($this->request->data['department_id']) : null);
                $reqResponse = array("status" => 'OK'/* ,'message'=>'THANKS, WE WILL SEND YOU A CONFIRMATION LINK TO ACTIVATE THE HOME SCREEN AFTER VERIFYING YOUR LICENSE. THANK YOU !' */, 'redirectUrl' => $url);
            } else {
                $url = SITE_URL . "requestors/request?providerId=" . (isset($provideDecryptId) ? $userTable->encrypt($provideDecryptId) : null) . "&deptId=" . (isset($this->request->data['department_id']) ? $userTable->encrypt($this->request->data['department_id']) : null);
                $reqResponse = array("status" => 'ERROR', 'message' => 'Unable to add request. !', 'redirectUrl' => $url);
            }
            // $this->Flash->error('Unable to update the request.', ['params' => ['class' => 'alert alert-danger']]);
            $this->set('requests', $requests);
            $this->set('providerId', $provideDecryptId);
        }
        //read the request page data from session after writing it in session
        $requestDataArr = $this->request->session()->read('RequestData');
        if (!empty($requestDataArr)) {
            $requestData = $requestDataArr;
        } else {
//            $requestData = [];
        }
        $this->set(['requestData' => $requestData, 'providerData' => $providerData, 'departmentIds' => $departmentIds, 'id' => $id, 'userSession' => $userSession]);
        if (!empty($reqResponse)) {
            echo json_encode(isset($reqResponse) ? $reqResponse : '');
            exit();
        }
    }
    
    
    /* @author Sneha G    
      @params request Id
      @return transaction id
     * Modified by Sneha G
     */

    public function payment($id = null) {
        $this->viewBuilder()->setLayout('website_layout');
        $userSession = $this->request->session()->read('LoginUser');
        $requestTable = TableRegistry::get('requests');
        $paymentTable = TableRegistry::get('payments');
        $userTable = TableRegistry::get('users');
        $cardDetailsTable = TableRegistry::get('card_details');
        //$id = $userTable->decrypt($id);
        // read request sesssion
        $requestData = $this->request->session()->read('RequestData');
        //get threshold value from session
        $thresholdValue = $requestData['threshold'];
        $providerId = $userTable->decrypt(isset($this->request->query['providerId']) && !empty($this->request->query['providerId']) ? $this->request->query['providerId'] : '');
        $departmentId = $userTable->decrypt(isset($this->request->query['deptId']) && !empty($this->request->query['deptId']) ? $this->request->query['deptId'] : '');
        $reqResponse = array();
        //find card details 
        $cardAllCards = $cardDetailsTable->getCardAllDetails($userSession['id']);
        $this->set('cardAllCards', $cardAllCards);
        if ($this->request->is('post')) {
//            pr($this->request->data);
//            pr($requestData);
            if (!empty($requestData)) {
                $requests = $requestTable->newEntity();
//                $requestsData = $requestTable->patchEntity($requests, $requestData);
                $requests = $requestData;

                if ($requestTable->save($requests)) {
                    $id = $requests->id;
                    $reqResponse['isRequestSave'] = 'yes';
                } else {
                    $reqResponse['isRequestSave'] = 'no';
                }
            }
            $remember = '';
            $status = '';
            $form_type = $this->request->data['form_type'];
            $userEmail = $userSession['email'];

            if ($form_type == 2) { //new card
                $token = $this->request->data['stripeToken'];
                $cardHolderName = $this->request->data['holder_name'];
                $remember = $this->request->data['remember'];
                $data = array('email' => $userEmail, 'source' => $token);
                $customer = $this->Stripe->createCustomer($data);
//                pr($customer);
                $status = $customer['status'];
                $customer_id = $customer['response']['id'];
                $card_id = $customer['response']['default_source'];
            } else { // existing card
                //find card details for prefered card
                $cardID = $this->request->data['cardID'];
                $cardData = $cardDetailsTable->getCardDetails($cardID);
                $customer_id = $cardData['customer_id'];
            }

            //if card details exist and remember=1 then save card
            if (!empty($remember) && $remember == 1 && !empty($customer_id) && $form_type != 1) {
                $card = $cardDetailsTable->newEntity();
                $card_details = $this->Stripe->retrieveCard($customer_id, $card_id);
                // saved the card details
                if ($card_details['status'] == 'success') {
                    $ccData = $cardDetailsTable->patchEntity($card, $card_details);
                    $ccData->user_id = $userSession['id'];
                    $ccData->customer_id = $customer_id;
                    $ccData->cc_no = $card_details['response']['last4'];
                    $ccData->name_on_card = $cardHolderName;
                    $ccData->exp_month = $card_details['response']['exp_month'];
                    $ccData->exp_year = $card_details['response']['exp_year'];
                    $ccData->created_by = $userSession['id'];
                    $res = $cardDetailsTable->save($ccData);
                    if ($res) {
                        $cardDetailID = $ccData['id']; //get last inserted id
                        //updating card_preference_id in user table
                        $user = $userTable->get($userSession['id']);
                        $user->card_preference_id = $cardDetailID;
                        $resUsr = $userTable->save($user);
                    }
                }
            }
            $payment = $paymentTable->newEntity();
            $paymentData = $paymentTable->patchEntity($payment, $this->request->getData());
            $paymentData->total_cost = $thresholdValue;
            $paymentData->transaction_id = $customer_id;
            $paymentData->request_id = $id;
            $paymentData->created = date('Y-m-d');
            $paymentData->created_by = $userSession['id'];
            $paymentData->paid_status = 'n';

            if ($paymentTable->save($paymentData)) {
                //make requestor folder in webroot
                $dir = WWW_ROOT . 'documents/requestor/' . $userSession['id'] . '/' . $id;
                if (!is_dir($dir)) {
                    @mkdir($dir);
                }
                @chmod($dir, 0777);
                //destroy session after saving data
                $this->request->session()->delete('RequestData');
                $reqResponse = array("status" => 'success', 'message' => 'Request added successfully. !',);
            } else {
                $reqResponse = array("status" => 'error', 'message' => 'Unable to process request. !');
            }

            $this->set('requests', $requests);
            $this->set('status', $status);
        }
        $this->set(['requestData' => $requestData, 'providerId' => $providerId, 'departmentId' => $departmentId, 'requestData' => $requestData]);
        if (!empty($reqResponse)) {
            echo json_encode(isset($reqResponse) ? $reqResponse : '');
            exit();
        }
    }

    /* @author Sneha G    
      @params No
      @return No
     * Modified by Sneha G
     */
    public function requestorsDashboard() {
        $this->viewBuilder()->setLayout('website_layout');
        $userSession = $this->request->session()->read('LoginUser');
        $user_id = $userSession['id'];
        $data = array();
        $userTable = TableRegistry::get('users');
        $requestTable = TableRegistry::get('requests');
        $data = $requestTable->find('all', array('fields' => array('id', 'request_status', 'provider_id','request_id'),
                    'conditions' => array('requestor_id' => $user_id, 'request_status' != '0'), 'limit' => 10, 'order' => ['modified' => 'desc']
                ))->all()->toArray();
        $output = array();
        $index = 1;
        if (!empty($data)) {
            foreach ($data as $notice) {
                $providerData = $userTable->findProviderByID($notice['provider_id']);
                $providerName = $providerData['first_name'] . ' ' . $providerData['last_name'];
                $status = $this->getStatusByID($notice['request_status']);
                $link = SITE_URL . 'requestors/view-request/' . $userTable->encrypt($notice['id']);
                array_push($output, "<div class='warningInfo'>$index. Your Request <a href='" . $link . "'>#" . $notice['request_id'] . "'</a>s status has been changed to <strong>$status</strong> by $providerName </div>");
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
                        return 'Accepted';
                        break;
                    
                    case 2:
                    return 'Denied';
                        break;
                        
                    case 3:
                     return 'Threshold limit exceed';
                        break;
        
                    case 4:
                    return 'In progress';
                        break;
                    
                    case 5:
                    return 'Records Available';
                        break;
                    
                    case 6:
                    return 'No Records Found';
                        break;
                        
                    case 7:
                    return 'Requestor denied';
                        break;
                    
                    default:
                    return 'NA';
                        break;
                    
        }
    }

    /* @author Sneha G    
      @params no
      @return request listing
     * Modified by Sneha G
     */
    public function requestsListing() {//        echo 1; exit('in pages/dashboard');
        $this->viewBuilder()->setLayout('website_layout');
        $requestTable = TableRegistry::get('requests');
        $userTable = TableRegistry::get('users');
        $userSession = $this->request->session()->read('LoginUser');
//        pr($userSession);
        $start_date = '';
        $date_range = '';
        $name_keyword = '';
        $id_keyword = '';
        $conditions = [];
        if ($this->request->is('post')) {
            $post_data = $this->request->getData();
//            pr($post_data);
            $name_keyword = $post_data['by_name'];
            $id_keyword = $post_data['by_id'];
            $start_date = $post_data['by_start_date'];
            $date_range = $post_data['by_date_range'];
            if (isset($name_keyword) && $name_keyword != '') {
                $conditions += array(
                    "OR" => array(
                        'requests.first_name LIKE' => '%' . $name_keyword . '%',
                        'requests.last_name LIKE' => '%' . $name_keyword . '%',
                        'Clients.client_name LIKE' => '%' . $name_keyword . '%',
//                        'Provider.first_name LIKE' => '%' . $userTable->encrypt($name_keyword) . '%',
//                        'Provider.last_name LIKE' => '%' . $userTable->encrypt($name_keyword) . '%',
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

            if (isset($date_range) && $date_range != '') {
                if ($date_range == '>') {
                    $conditions += array('date(requests.date_of_request) >' => date('Y-m-d', strtotime($start_date)));
                } elseif ($date_range == '<') {
                    $conditions += array('requests.date_of_request <' => date('Y-m-d', strtotime($start_date)));
                } elseif ($date_range == '>=') {
                    $conditions += array('requests.date_of_request >=' => date('Y-m-d', strtotime($start_date)));
                } elseif ($date_range == '<=') {
                    $conditions += array('date(requests.date_of_request) <=' => date('Y-m-d', strtotime($start_date)));
                }
            } elseif (isset($start_date) && $start_date != '') {
                $conditions += array('requests.date_of_request LIKE' => '%' . date('Y-m-d', strtotime($start_date)) . '%');
            }
        }
        $conditions += ['requests.requestor_id' => $userSession['id']];
        
//        pr($conditions);
        $this->paginate = [
            'contain' => ['Provider','Clients','Matters'],
            'maxLimit' => REC0RDS_LIMIT,
            'conditions' => $conditions,
            'order' => ['id' => 'DESC']
        ];
        $requestData = $this->paginate($requestTable->find())->toArray();
//        pr($requestData);
//        exit('in listing');

        $this->set('requestData', $requestData);
        $this->set('start_date', $start_date);
        $this->set('date_range', $date_range);
        $this->set('name_keyword', $name_keyword);
        $this->set('id_keyword', $id_keyword);
    }

    /* @author Sneha G   
      @params id
      @return request details
     */

    public function viewRequest($id = null) {
//        echo 1; exit('in pages/dashboard');
        $this->viewBuilder()->setLayout('website_layout');
        $userTable = TableRegistry::get('users');
        $adminSettingsTable = TableRegistry::get('admin_settings');
        //get admin share
        $adminFees = $adminSettingsTable->getAdminShare();
        $data = array();
        $id = $userTable->decrypt($id);
        $requestTable = TableRegistry::get('requests');
        $data = $requestTable->find('all', array(
                    'conditions' => array('id' => $id)
                ))->first();
        $this->set('data', $data);
        $this->set('adminFees', $adminFees['admin_share']);

    }

   
    /* @author Mahalaxmi    
      @params name
      @return id and name
     */

    public function getProviderList() {
        $this->autoRender = false;
        $arrJson = array();
        $userTable = TableRegistry::get('users');
        //$providerList=$userTable->listProviders();
        $providerName = $this->request->data['providerName'];
//        $providerName = $userTable->encrypt(trim(strtolower($providerName)));
        $providerName = trim(strtolower($providerName));

        // $term = $this->request->query['query'];
        $condition = ['is_deleted' => 0, 'status' => 1, 'role_id' => 2];

        if (isset($providerName) && (!empty($providerName))) {
            $userData = $userTable->find('all', array(
                'fields' => array('id', 'first_name', 'last_name', 'company_name', 'street_address', 'state', 'email', 'city', 'zip_code'),
                'conditions' => array($condition,
                    'OR' => array(
                        'first_name LIKE' => "%$providerName%",
                        'last_name LIKE' => "%$providerName%",
                        'email LIKE' => "%$providerName%"))
            ));

            $userData = $userData->toArray();
            $keysArr = array('first_name', 'last_name', 'company_name', 'street_address', 'state', 'city', 'state', 'zip_code');

            foreach ($userData as $row) {
                $id = $row['id'];
                $row = $this->checkIsset($keysArr, $row);
                $company_name = $row['company_name'];
                $firstName = $row['first_name'];
                $lastName = $row['last_name'];
                $street_address = $row['street_address'];
                $state = $row['state'];
                $city = $row['city'];
                $zip_code = $row['zip_code'];
//                array_push($arrJson, array('id' => $userTable->encrypt($id), 'provider_id' => $id, 'firstName' => $firstName, 'lastName' => $lastName, 'email' => $email, 'phone' => $phone));
                array_push($arrJson, array('id' => $userTable->encrypt($id), 'provider_id' => $id, 'first_name' => $firstName, 'last_name' => $lastName, 'company_name' => $company_name, 'street_address' => $street_address, 'state' => $state, 'city' => $city, 'zip_code' => $zip_code));
            }
        }

        echo json_encode($arrJson);
        exit;
    }

    /* @author Mahalaxmi    
      @params id
      @return id and name
     */

    public function getMatterList($client_id = null) {
        $this->autoRender = false;
        $matterTable = TableRegistry::get('matters');
        $arrJson = array();
        $term = $this->request->query['query'];
        $client_id = $this->request->query['group'];
        $condition = ['is_deleted' => 0, 'status' => 1, 'client_id' => $client_id];
        if ((!empty($term))) {

            $matterData = $matterTable->find('all', array('fields' => array('id', 'matter_no'), 'conditions' => array($condition)))->toArray();

            foreach ($matterData as $row) {
                $id = $row['id'];
                $label = $row['matter_no'];
                $arrJson[] = array('id' => $id, 'label' => $label);
            }
        }
        echo json_encode($arrJson);
        exit;
    }

    /* @author Mahalaxmi    
      @params matter Id
      @return matter name
     */

    public function getMatterData() {
        $this->autoRender = false;
        $matterTable = TableRegistry::get('matters');
        $arrJson = array();
        $matterId = $this->request->query['matterId'];
        if (isset($matterId) && (!empty($matterId))) {
            $matterData = $matterTable->find('all', array('fields' => array('id', 'first_name', 'last_name', 'matter_name'), 'conditions' => array('id' => $matterId)))->first()->toArray();
        }
        echo json_encode($matterData);
        exit;
    }

    /* @author Bhushan Chandel    
      @params name
      @return id and name
     */

    public function getClientList() {
        $this->autoRender = false;
        $arrJson = array();
        $clientTable = TableRegistry::get('clients');
        $userSession = $this->request->session()->read('LoginUser');

        $term = $this->request->query['query'];
        $client_id = $this->request->query['group'];

        $condition = ['is_deleted' => 0, 'status' => 1];
        if (isset($term) && (!empty($term))) {

            $condition['client_name LIKE'] = trim($term) . "%";
            $condition['client_number'] = $term;
            $condition['user_id'] = $userSession['id'];

            $clientData = $clientTable->find('all', array(
                        'fields' => array('id', 'client_name'),
                        'conditions' => array($condition)
                    ))->toArray();
            if (!empty($clientData)) {
                foreach ($clientData as $row) {
                    $id = $row['id'];
                    $client_name = $row['client_name'];
                    $arrJson[] = array('id' => $id, 'label' => $client_name);
                }
            } else {
                $arrJson = array();
            }
        }

        echo json_encode($arrJson);
        exit;
    }

    /* public function stripeDirectCharge() {
      $this->autoRender = false;
      $arrJson = array();
      $cardDetailsTable = TableRegistry::get('card_details');
      $paymentTable = TableRegistry::get('payments');
      if ($this->request->is('ajax')) {
      //            pr($this->request->data);
      $cardId = $this->request->data['cardID'];
      $cvvNo = $this->request->data['cvvNo'];
      $amount = $this->request->data['amount'];
      $amt = $amount * 100;
      $data = ['amount' => round($amt)
      ];
      //find card details for prefered card
      $cardData = $cardDetailsTable->getCardDetails($cardId);
      //            pr($cardData);
      $response = $this->Stripe->charge($data, $cardData['customer_id']);
      //            pr($response);
      //            exit('jdbgjksdgf');
      if ($response['status'] == 'success') {
      $arrJson['status'] = 'success';
      $arrJson['message'] = 'Your payment has been proccessd successfully';
      } else {
      $arrJson['status'] = 'error';
      $arrJson['message'] = 'Your payment failed';
      }
      //         if($response['status']=='success'){
      //             $payment = $paymentTable->newEntity();
      //                $paymentData = $paymentTable->patchEntity($payment, $this->request->getData());
      //                $paymentData->total_cost = $this->request->data['total_cost'];
      //                $paymentData->transaction_id = $customer_id;
      //                $paymentData->request_id = $requestData['id'];
      //                $paymentData->created = date('Y-m-d');
      //                $paymentData->created_by = $userSession['id'];
      //                $paymentData->paid_status = 'n';
      //                // pr($paymentTable);
      //                $paymentTable->save($paymentData);
      //         }
      echo json_encode($arrJson);
      exit;
      }
      }

      /* @author Sneha G
      @params name
      @return id and name
     */

    public function getClientNoList() {
        $this->autoRender = false;
        $arrJson = array();
        $clientTable = TableRegistry::get('clients');
        $userSession = $this->request->session()->read('LoginUser');
        $condition = array();
        $term = $this->request->query['query'];
        $condition['is_deleted'] = 0;
        $condition['status'] = 1;

        if (isset($term) && (!empty($term))) {

            $condition['client_number'] = $term;
            $condition['user_id'] = $userSession['id'];

            $clientData = $clientTable->find('all', array(
                        'fields' => array('id', 'client_number'),
                        'conditions' => array($condition)
                    ))->toArray();

            foreach ($clientData as $row) {
                $id = $row['id'];
                //$client_number = $row['client_number'];
                $client_no = $row['client_number'];
                $arrJson[] = array('id' => $id, 'label' => $client_no);
            }
        }

        echo json_encode($arrJson);
        exit;
    }
/* @author Sneha G    
      @params no
      @return client name
     * Modified by Sneha G
     */
    public function getClientName() {
        $this->autoRender = false;
        $arrJson = array();
        $clientTable = TableRegistry::get('clients');
        $userSession = $this->request->session()->read('LoginUser');
//        pr($this->request->data);
        if (!empty($this->request->data)) {
            $client_number = $this->request->data['client_number'];
            $data = $clientTable->find('all', array(
                        'conditions' => array('id' => $client_number),
                    ))->first();

            if (!empty($data)) {
                $arrJson['data'] = $data;
                $arrJson['status'] = 'success';
            } else {
                $arrJson['status'] = 'error';
            }
        }
        echo json_encode($arrJson);
        exit;
    }

    /* @author Sneha G    
      @params no
      @return client matter number
     * Modified by Sneha G
     */
    public function clientsMatters() {
        $this->viewBuilder()->setLayout('website_layout');
        $userTable = TableRegistry::get('users');
        $clientTable = TableRegistry::get('clients');
        $matterTable = TableRegistry::get('matters');
        $userSession = $this->request->session()->read('LoginUser');
        $saveFlag;
        $existingClient = array();
        $existingMatter = array();
        $savedMatter = array();
        $savedUser = array();
        $isErrorExist = false;
        $isMatterErrorExist = false;
        $clientColumns = array();
        $matterColumns = array();
        if (!empty($this->request->data)) {
            $data = $this->request->data['CSV'];
            if (!empty($data)) {
                $fileName = $data['name'];
                $checkExtensn = explode('.', $fileName);
                if ($checkExtensn[1] == 'csv') { //check file is valid csv
                    $file = $data['tmp_name'];
                    $handle = fopen($file, "r");
                    $i = 0;
                    $flag = true;
                    while (($row = fgetcsv($handle, 1000, ",")) !== FALSE) {

                        if ($row[0] == 'Client Number' && $row[1] == 'Client Name' && $row[2] == 'Matter Number' && $row[3] == 'Matter Name') {
                            continue;
                        }
                        if ($flag) {
                            $flag = false;
                            continue;
                        }
//                        check if client data already exist for loggedIn user
                        $existClientData = $clientTable->getclientDataByUserId($userSession['id'], $row[0]);
                        if (empty($existClientData)) {
                            //array for client table
                            $clientColumns = [
                                'user_id' => $userSession['id'],
                                'client_number' => $row[0],
                                'client_name' => $row[1],
                            ];
                            $clientEnity = $clientTable->newEntity($clientColumns);
                            $saveFlag = $clientTable->save($clientEnity);
                            $clientId = $clientEnity->id;
                            array_push($savedUser, array('userEntity' => $saveFlag));
                        } else { /* don't save* */

                            $isErrorExist = true;
                            $clientId = $existClientData['id'];
                            array_push($existingClient, array('userEntity' => $existClientData));
                        }
                        //check if matter exist for existing userId
                        $existMatterData = $matterTable->getMatterDataByClientID($clientId, $row[2]);
                        if (empty($existMatterData)) {
                            //array for matter table
                            $matterColumns = [
                                'client_id' => $clientId,
                                'matter_no' => $row[2],
                                'matter_name' => $row[3],
                            ];
                            $matterEnity = $matterTable->newEntity($matterColumns);
                            $saveMatterFlag = $matterTable->save($matterEnity);
                            $matterId = $matterEnity->id;
                            array_push($savedMatter, array('matterEntity' => $saveMatterFlag));
                        } else { //don't save
                            $isMatterErrorExist = true;
                            $matterId = $existMatterData['id'];
                            array_push($existingMatter, array('matterEntity' => $existMatterData));
                        }

                        $i++;
                    }
                    if ($isMatterErrorExist == false) {
                        $this->Flash->success('CSV uploaded Successfully.', ['params' => ['class' => 'alert alert-success']]);
                    } else {
                        //for client error starts 
                        $errDom = '';
                        $savedDom = '';
                        $matErrDom = '';
                        $matSaveDom = '';
                        foreach ($existingClient as $index => $errUser) {
                            $clientNumber = $errUser['userEntity']['client_number'];
                            $clientName = $errUser['userEntity']['client_name'];
                            $errDom .="<div>";
                            $errDom .="<ul>";
                            $errDom .="<li class='text-danger'> Client Number " . $clientNumber . " and Client Name " . $clientName;
                            $errDom .=" already exist</li>";
                            $errDom .="</ul>";
                            $errDom .="</div>";
                        }
//                        //for error ends
//                        //for saved user starts
                        if (!empty($savedUser)) {
                            foreach ($savedUser as $index => $errUser) {
                                $clientNumber = $errUser['userEntity']['client_number'];
                                $clientName = $errUser['userEntity']['client_name'];
                                $savedDom .="<div>";
                                $savedDom .="<ul>";
                                $savedDom .="<li class='text-success'> Client Number " . $clientNumber . " and Client Name " . $clientName;
                                $savedDom .=" saved</li>";
                                $savedDom .="</ul>";
                                $savedDom .="</div>";
                            }
                        }
                        //errorfor matter
                        foreach ($existingMatter as $index => $errUser) {
                            $matterNumber = $errUser['matterEntity']['matter_no'];
                            $matterName = $errUser['matterEntity']['matter_name'];
                            $matErrDom .="<div>";
                            $matErrDom .="<ul>";
                            $matErrDom .="<li class='text-danger'> Matter Number " . $matterNumber . " and Matter Name " . $matterName;
                            $matErrDom .=" already exist</li>";
                            $matErrDom .="</ul>";
                            $matErrDom .="</div>";
                        }
//                        //for error ends
//                        //for saved user starts
                        if (!empty($savedMatter)) {
                            foreach ($savedMatter as $index => $errUser) {
                                $matterNumber = $errUser['matterEntity']['matter_no'];
                                $matterName = $errUser['matterEntity']['matter_name'];
                                $matSaveDom .="<div>";
                                $matSaveDom .="<ul>";
                                $matSaveDom .="<li class='text-success'> Matter Number " . $matterNumber . " and Matter Name " . $matterName;
                                $matSaveDom .=" saved</li>";
                                $matSaveDom .="</ul>";
                                $matSaveDom .="</div>";
                            }
                        }
                        $this->Flash->error('Unable to upload the file, please rectify below errors!', ['params' => ['class' => 'alert alert-danger']]);
//                        array_shift($errDom); 
                        $this->set('errDom', $errDom);
                        $this->set('savedDom', $savedDom);
                        $this->set('matSaveDom', $matSaveDom);
                        $this->set('matErrDom', $matErrDom);
                    }
                } else {
                    $this->Flash->error('Invalid file type, please upload CSV file!', ['params' => ['class' => 'alert alert-danger']]);
                }
            } else {
                $this->Flash->error('Please upload CSV file!', ['params' => ['class' => 'alert alert-danger']]);
            }
        }
    }

    public function clientMatterListing() {
        $this->viewBuilder()->setLayout('website_layout');
        $userTable = TableRegistry::get('users');
        $matterTable = TableRegistry::get('matters');
        $userSession = $this->request->session()->read('LoginUser');
//        pr($userSession);
        $start_date = '';
        $date_range = '';
        $name_keyword = '';
        $id_keyword = '';
        $conditions = [];
        if ($this->request->is('post')) {
            $post_data = $this->request->getData();
//            pr($post_data);
            $name_keyword = $post_data['by_name'];
            $id_keyword = $post_data['by_id'];

            if (isset($name_keyword) && $name_keyword != '') {
                $conditions += array(
                    "OR" => array(
                        'matters.matter_name LIKE' => '%' . $name_keyword . '%',
                        'Clients.client_name LIKE' => '%' . $name_keyword . '%',
                    ),
                );
            }
            if (isset($id_keyword) && $id_keyword != '') {
                $conditions += array(
                    "OR" => array(
                        'matters.matter_no' => $id_keyword,
                        'Clients.client_number' => $id_keyword
                    ),
                );
            }
        }
        $conditions += ['Clients.user_id' => $userSession['id']];
        $this->paginate = [
            'contain' => ['Clients'],
            'maxLimit' => REC0RDS_LIMIT,
            'conditions' => $conditions,
            'order' => ['id' => 'DESC']
        ];
        $requestData = $this->paginate($matterTable->find())->toArray();


        $this->set('requestData', $requestData);
        $this->set('name_keyword', $name_keyword);
        $this->set('id_keyword', $id_keyword);
    }
    
    /* @author Sneha G    
      @params no
      @return payment listing
     * Modified by Sneha G
     */
    public function allPayments() {
         $this->viewBuilder()->setLayout('website_layout');
        $requestTable = TableRegistry::get('requests');
        $userTable = TableRegistry::get('users');
        $userSession = $this->request->session()->read('LoginUser');
        $start_date = '';
        $end_date = '';
        $name_keyword = '';
        $id_keyword = '';
        $conditions = [];
        if ($this->request->is('post')) {
            $post_data = $this->request->getData();
//            pr($post_data);
            $name_keyword = $post_data['by_name'];
            $id_keyword = $post_data['by_payment_status'];
            $start_date = $post_data['by_start_date'];
            $end_date = $post_data['by_end_date'];
            if (isset($name_keyword) && $name_keyword != '') {
                $conditions += array(
                    "OR" => array(
                        'requests.first_name LIKE' => '%' . $name_keyword . '%',
                        'requests.last_name LIKE' => '%' . $name_keyword . '%',
                        'Clients.client_name LIKE' => '%' . $name_keyword . '%',
//                        'Provider.first_name LIKE' => '%' . $userTable->encrypt($name_keyword) . '%',
//                        'Provider.last_name LIKE' => '%' . $userTable->encrypt($name_keyword) . '%',
                        'Provider.first_name LIKE' => '%' . $name_keyword . '%',
                        'Provider.last_name LIKE' => '%' . $name_keyword . '%',
                    ),
                );
            }
            if (isset($id_keyword) && $id_keyword != '') {
                if($id_keyword == 1){
                $conditions += ['requests.payment_status'=>1];
                }else{
                $conditions += ['requests.payment_status'=>0];
                }
            }

           if (isset($start_date) && $start_date != '') {
                $conditions += array('requests.date_of_request >=' => date('Y-m-d', strtotime($start_date)));
            }
            if (isset($end_date) && $end_date != '') {
                $conditions += array('requests.date_of_request <=' => date('Y-m-d', strtotime($end_date)));
            }
        }
        $conditions += ['requests.requestor_id' => $userSession['id']];
//        pr($conditions);
        $this->paginate = [
            'contain' => ['Provider','Clients','Matters'],
            'maxLimit' => REC0RDS_LIMIT,
            'conditions' => $conditions,
            'order' => ['id' => 'DESC']
        ];
        $requestData = $this->paginate($requestTable->find())->toArray();

        $this->set('requestData', $requestData);
        $this->set('start_date', $start_date);
        $this->set('end_date', $end_date);
        $this->set('name_keyword', $name_keyword);
        $this->set('id_keyword', $id_keyword);
    }
    
   
    
}
