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

class ProvidersController extends AppController {

    public function initialize() {
        parent::initialize();
        $this->loadComponent('Stripe');
    }

    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
        $this->Auth->allow('providerRegistration');
        $userSession = $this->request->session()->read('LoginUser');
        $action = $this->request->action;
        $controller = $this->request->controller;

        $this->checkUserSession();
//        pr($userSession); exit('in prov bf'); 
//        if($userSession['role_id'] != 2){
//            $this->Flash->error("You'are not authorize to access this page!", ['params' => ['class' => 'alert alert-danger']]);
//           return $this->redirect(['controller' => 'Users','action' => 'logout']);
//        }
    }

    /* @auther Mahalaxmi    
      @params no
      @return no
     */

    public function providerRegistration() {
        $this->viewBuilder()->setLayout('default');
        $userTable = TableRegistry::get('users');
        $userSession = $this->request->session()->read('LoginUser');
        $countryTable = TableRegistry::get('countries');
        $countryArr = $countryTable->listCountries();
        foreach ($countryArr as $country) {
            $countryList[$country['id']] = $country['name'];
        }
        $this->set('countryList', $countryList);
        $stateTable = TableRegistry::get('states');
        $stateList = $stateTable->listStateList($id = 0);
        $this->set('stateList', $stateList);
        $Providers = $userTable->newEntity();
        if ($this->request->is('post')) {
            $user = $userTable->patchEntity($Providers, $this->request->getData());
            $userDataForUpdate = $user;
            $user['role_id'] = 2;
            $user['status'] = 0;
//            pr($this->request->data);
//            exit('in line 57');
            if ($userTable->save($user)) {
                $id = $user['id'];
                $hashCode = md5(uniqid(rand(), true));
                $userDataForUpdate = $userTable->get($id);
                $userTable->patchEntity($userDataForUpdate, $this->request->getData());
                $userTable->updateAll(["key_token " => $hashCode], ["id IN " => $id]);
                // $resetUrl = SITE_URL."/users/resetPassword/".$hashCode;
                $this->Common->sendEmail($id, 'Activation Link', $this->request->data['email'], 'activationlink', $emailData = ['first_name' => $userSession['first_name'], 'last_name' => $userSession['last_name'], 'hashCode' => $hashCode]);

                $this->Flash->success('You have registered Successfully, Please check your email for verification link.', ['params' => ['class' => 'alert alert-success']]);
                return $this->redirect(['controller' => 'Users', 'action' => 'login']);
            }
            $this->Flash->error('Unable to add the user.', ['params' => ['class' => 'alert alert-danger']]);
        }
        $this->set('user', $Providers);
    }

    public function providersDashboard() {
        $this->viewBuilder()->setLayout('website_layout');
        $userSession = $this->request->session()->read('LoginUser');
        $user_id = $userSession['id'];
        $data = array();
        $userTable = TableRegistry::get('users');
        $requestTable = TableRegistry::get('requests');
        $data = $requestTable->find('all', array('fields' => array('id', 'request_status', 'provider_id', 'requestor_id', 'request_id'),
                    'conditions' => array('provider_id' => $user_id, 'request_status' => '0,1'), 'limit' => 10, 'order' => ['modified' => 'desc']
                ))->all()->toArray();
        $output = array();
        $index = 1;
        if (!empty($data)) {
            foreach ($data as $notice) {
                $requestorData = $userTable->findRequestorByID($notice['requestor_id']);
                $requestorName = $requestorData['first_name'] . ' ' . $requestorData['last_name'];
                $status = $this->getStatusByID($notice['request_status']);
                $link = SITE_URL . 'providers/view-request/' . $userTable->encrypt($notice['id']);
                array_push($output, "<div class='warningInfo'>$index. You have a new request Request ID <a href='" . $link . "'>#" . $notice['request_id'] . "'</a> by $requestorName </div>");
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

    public function settings($id = null) {
        $this->viewBuilder()->setLayout('website_layout');
        $ProvidersSettings = TableRegistry::get('fees_settings');
        $provider_detailsData = TableRegistry::get('provider_details');
        $countryTable = TableRegistry::get('countries');
        $userTable = TableRegistry::get('users');
        $ProviderPaymentsDetails = TableRegistry::get('provider_payments_details');
        $countryList = $countryTable->getAllCountriesListISO();
        $this->set('countryList', $countryList);
        $userSession = $this->request->session()->read('LoginUser');
        $ProvidersSettingsData = $ProvidersSettings->getPaymentSettings($userSession['id']);
        $IsStripeFirstStepCompleted = $ProviderPaymentsDetails->CheckStepOne($userSession['id']);
        $ProvidersAdditionalData = $provider_detailsData->getDetails($userSession['id']);
//        pr($ProvidersAdditionalData);
        if ($ProvidersSettingsData) {
            $id = $ProvidersSettingsData['id'];
        }
        if ($this->request->is('post')) {
            $post_data = $this->request->getData();
            $ProvidersSettingsRow = $ProvidersSettings->newEntity();
            if (!empty($id)) {
                $ProvidersSettingsRow = $ProvidersSettings->get($id);
            }
            $ProvidersSettingsRow->fees_type = $post_data['paymentType'];
            $ProvidersSettingsRow->amount = $post_data['amount'];
            $ProvidersSettingsRow->provider_id = $post_data['id'];
            if ($ProvidersSettings->save($ProvidersSettingsRow)) {
                $this->Flash->success('Your payment choices are saved sucessfully.', ['params' => ['class' => 'alert alert-success']]);
                return $this->redirect(['controller' => 'Providers', 'action' => 'settings']);
            }
        }
        $this->set('ProvidersSettings', $ProvidersSettings);
        $this->set('IsStripeFirstStepCompleted', $IsStripeFirstStepCompleted);
        $this->set('ProvidersSettingsData', $ProvidersSettingsData);
        $this->set('ProvidersAdditionalData', $ProvidersAdditionalData);
    }

    public function CreateCustomStripeAccountStep1() {
        $userSession = $this->request->session()->read('LoginUser');
        $ProviderPaymentsDetails = TableRegistry::get('provider_payments_details');
        $ProviderDetails = TableRegistry::get('provider_details');
        $userTable = TableRegistry::get('users');
        $post_data = $this->request->getData();
        $user = $userTable->findUserByID($userSession['id']);
        $dob = $post_data['dob'];
        $ssn = $post_data['ssn'];
        $businessTaxId = (!empty($post_data['businessTaxId'])) ? $post_data['businessTaxId'] : '';
        $entityType = $post_data['entityType'];
        $personal_id = $post_data['personal_id_number'];
//        $businessName = $entityType == '1' ? $post_data['businessName'] : "";
        $businessName = (!empty($post_data['businessName'])) ? $post_data['businessName'] : '';
        $account_holder_type = $entityType == '1' ? 'company' : 'individual';
        $dobArr = explode("/", $dob);
        $dobM = $dobArr[0];
        $dobD = $dobArr[1];
        $dobY = $dobArr[2];
        $arrJson = array();
        if ($this->request->is('post')) {
            \Stripe\Stripe::setApiKey("sk_test_OAYRwtiKanB9quptS09wRN09");

            $account = \Stripe\Account::create(
                            array(
                                "country" => $post_data['CountryId'],
                                "type" => 'custom',
                                "legal_entity" => array(
                                    'address' => array(
                                        'city' => $user['city'],
                                        'country' => $post_data['CountryId'],
                                        "line1" => $user['street_address'],
                                        "line2" => $user['street_address'],
                                        "postal_code" => $user['zip_code'],
                                        "state" => $this->getStateNameFromId($user['state'])
                                    ),
                                    'personal_address' => array(
                                        'city' => $user['city'],
                                        'country' => $post_data['CountryId'],
                                        "line1" => $user['street_address'],
                                        "line2" => $user['street_address'],
                                        "postal_code" => $user['zip_code'],
                                        "state" => $this->getStateNameFromId($user['state'])
                                    ),
                                    'business_name' => $businessName,
                                    'business_tax_id' => $businessTaxId,
                                    'dob' => array(
                                        'day' => $dobD,
                                        'month' => $dobM,
                                        'year' => $dobY
                                    ),
                                    'type' => $account_holder_type,
                                    'first_name' => $user['first_name'],
                                    'last_name' => $user['last_name'],
                                    //'personal_id_number' => $post_data['personal_id_number'],
                                    'ssn_last_4' => substr($post_data['ssn'], -4),
                                ),
                                'tos_acceptance' => array(
                                    'date' => time(),
                                    'ip' => $_SERVER['REMOTE_ADDR']
                                ),
                                'external_account' => array(
                                    "object" => "bank_account",
                                    "bank_name" => $post_data['bank_name'],
                                    "country" => "US",
                                    "currency" => "usd",
                                    "account_holder_name" => $post_data['account_holder_name'],
                                    "account_holder_type" => $account_holder_type,
                                    "routing_number" => $post_data['routing_number'],
                                    "account_number" => $post_data['account_number'],
                                )
                            )
            );

            $acct = json_decode(json_encode($account), true);
            $createdAccId = $acct['id'];
            //$trasferGroup  = $acct['transfer_group'];        
            if (isset($createdAccId) && !empty($createdAccId)) {
                $ProviderPaymentsDetailsRow = $ProviderPaymentsDetails->newEntity();
                $ProviderPaymentsDetailsRow->stripe_custom_account_id = $acct['id'];
                $ProviderPaymentsDetailsRow->provider_id = $userSession['id'];
                $ProviderPaymentsDetailsRow->stripe_secret_key = $acct['keys']['secret'];
                $ProviderPaymentsDetailsRow->stripe_publishable_key = $acct['keys']['publishable'];
                $ProviderPaymentsDetailsRow->default_currency = $acct['default_currency'];
                $ProviderPaymentsDetailsRow->url = $acct['external_accounts']['url'];
                $ProviderPaymentsDetailsRow->fingerprint = $acct['external_accounts']['data'][0]['fingerprint'];
                $ProviderPaymentsDetailsRow->country = $acct['country'];
                //$ProviderPaymentsDetailsRow->transfer_group = $trasferGroup; 
                $ProviderPaymentsDetails->save($ProviderPaymentsDetailsRow);

                if (empty($acct['verification']['fields_needed'])) {
                    $charge1 = \Stripe\Charge::create(array(
                                "amount" => 1000,
                                "currency" => "usd",
                                "source" => array(
                                    'object' => "card",
                                    'number' => "4000000000004202",
                                    'exp_month' => 2,
                                    'exp_year' => 2020
                                ),
                                "destination" => $createdAccId
                    ));

                    $charge2 = \Stripe\Charge::create(array(
                                "amount" => 1000,
                                "currency" => "usd",
                                "source" => array(
                                    'object' => "card",
                                    'number' => "4000000000004210",
                                    'exp_month' => 2,
                                    'exp_year' => 2020
                                ),
                                "destination" => $createdAccId
                    ));

                    $account = \Stripe\Account::retrieve($acct['id']);
                    $account->legal_entity->personal_id_number = $personal_id;
                    $res = $account->save();

                    if ($account->save()) {
                        $providerDetail = $ProviderDetails->newEntity();
                         $dob = $post_data['dob'];
                        $providerDetail->dob = date('Y-m-d', strtotime($dob));
                        $providerDetail->provider_id = $userSession['id'];
                        $providerDetail->ext_account_holder_name = $post_data['account_holder_name'];
                        $providerDetail->ssn = $post_data['ssn'];
                        $providerDetail->personal_id_number = $personal_id;
                        $providerDetail->entityType = $account_holder_type;
                        $providerDetail->businessName = $businessName;
                        $providerDetail->business_tax_id = $businessTaxId;
                        $providerDetail->bank_name = $post_data['bank_name'];
                        $providerDetail->ext_account_holder_type = $account_holder_type;
                        $providerDetail->routing_number = $post_data['routing_number'];
                        $providerDetail->account_number = $post_data['account_number'];
                        $providerDetail->country = $post_data['countryHidden'];
                        $ProviderDetails->save($providerDetail);
                        $arrJson['status'] = 'success';
                        $arrJson['message'] = 'Account Created';
                    } else {
                        $arrJson['status'] = 'error';
                        $arrJson['message'] = 'Account verified';
                        $arrJson['data'] = json_decode(json_encode(\Stripe\Account::retrieve($acct['id']), TRUE));
                    }
                } else {
                    $arrJson['status'] = 'error';
                    $arrJson['message'] = 'Additional Fields needed';
                    $arrJson['data'] = json_decode(json_encode(\Stripe\Account::retrieve($acct['id']), TRUE));
                }
            } else {
                $arrJson['status'] = 'error';
                $arrJson['message'] = 'Account creation failed';
                $arrJson['data'] = $account;
            }
        }

        echo json_encode($arrJson);
        die();
    }

    public function viewAllRequests() {
//        echo 1; exit('in pages/dashboard');
        $this->viewBuilder()->setLayout('website_layout');
        $usersTable = TableRegistry::get('users');
        $requestTable = TableRegistry::get('requests');
        $userSession = $this->request->session()->read('LoginUser');
//        pr($userSession);
        $start_date = '';
        $date_range = '';
        $name_keyword = '';
        $id_keyword = '';
        //$conditions = [];
        $conditions = ['requests.provider_id ' => $userSession['id']];
        if ($this->request->is('post')) {
            $post_data = $this->request->getData();
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
//                            'Requestor.first_name LIKE' => '%' . $usersTable->encrypt($name_keyword) . '%',
//                            'Requestor.last_name LIKE' => '%' . $usersTable->encrypt($name_keyword) . '%',
                        'Requestor.first_name LIKE' => '%' . $name_keyword . '%',
                        'Requestor.last_name LIKE' => '%' . $name_keyword . '%',
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
        $this->paginate = [
            'contain' => ['Requestor', 'Clients', 'Matters'],
            'maxLimit' => REC0RDS_LIMIT,
            'conditions' => $conditions,
            'order' => ['id' => 'DESC']
        ];
        $requestData = $this->paginate($requestTable->find())->toArray();
//        pr($requestData); exit('in listing testesfrte');

        $this->set('requestData', $requestData);
        $this->set('start_date', $start_date);
        $this->set('date_range', $date_range);
        $this->set('name_keyword', $name_keyword);
        $this->set('id_keyword', $id_keyword);
    }

    public function viewRequest($id = null) {
//        echo 1; exit('in pages/dashboard');
        $this->viewBuilder()->setLayout('website_layout');
        $userTable = TableRegistry::get('users');
        $adminSettingsTable = TableRegistry::get('admin_settings');
        $ProvidersSettings = TableRegistry::get('fees_settings');
        $userSession = $this->request->session()->read('LoginUser');
        $ProvidersSettingsData = $ProvidersSettings->getPaymentSettings($userSession['id']);
        //get admin share
        $adminFees = $adminSettingsTable->getAdminShare();
        $data = array();
        $id = $userTable->decrypt($id);
        $requestTable = TableRegistry::get('requests');
        $data = $requestTable->find('all', array(
                    'conditions' => array('id' => $id)
                ))->first();

        $this->set('feestype', $ProvidersSettingsData['fees_type']);
        $this->set('fees', $ProvidersSettingsData['amount']);
        $this->set('adminFees', $adminFees['admin_share']);
        $this->set('data', $data);
    }

    /*
     * Ajax function to update the request status, fired from the progress-bar
     */

    public function updateRequestStatus($id = null) {
        $requestsTable = TableRegistry::get('requests');
        $arrJson = array();
        $arrJson['status'] = 'error';
        $arrJson['message'] = 'Request is processed before post';
        if ($this->request->is('post')) {
            $post_data = $this->request->getData();
            $request_id = $post_data['id'];
            $request_status = $post_data['request_status'];
            $requestRow = $requestsTable->get($request_id);
            $requestRow->request_status = $request_status;
             $requestData = $requestsTable->findRequestDataByID($request_id);
            if ($requestsTable->save($requestRow)) {
                if($request_status == 3 ){
                     $this->insertNotifications($userSession['id'],$requestData['requestor_id'], 0, 0, $request_id, 3, 'Threshold exceed', 5);
                }
                $arrJson['status'] = 'success';
                $arrJson['message'] = 'Status updated successfully';
            } else {
                $arrJson['status'] = 'error';
                $arrJson['message'] = 'Status updatedion failed';
            }
        }
        echo json_encode($arrJson);
        die();
    }

    /*
     * Ajax function to update the request status, fired from the progress-bar
     */

    public function savePayment($id = null) {
        $requestsTable = TableRegistry::get('requests');
        $arrJson = array();
        $arrJson['status'] = 'error';
        $arrJson['message'] = 'Request is processed before post';
        if ($this->request->is('post')) {
            $post_data = $this->request->getData();
            $request_id = $post_data['id'];
            $request_status = $post_data['request_status'];
            $requestRow = $requestsTable->get($request_id);
            $requestRow->request_status = $request_status;
            $requestRow->total_cost = $post_data['finalFees'];
            $requestRow->system_fee = $post_data['system_fee'];
            $requestRow->ProFees = $post_data['ProFees'];
            $requestRow->feesType = $post_data['feesType'];
            $requestRow->pages = isset($post_data['pages']) ? $post_data['pages'] : '0';
            if ($requestsTable->save($requestRow)) {
                $arrJson['status'] = 'success';
                $arrJson['message'] = 'Status updated successfully';
            } else {
                $arrJson['status'] = 'error';
                $arrJson['message'] = 'Status updatedion failed';
            }
        }
        echo json_encode($arrJson);
        die();
    }

    /*
     * Ajax function to update the request status, fired from the progress-bar
     */

    public function saveReason($id = null) {
        $requestsTable = TableRegistry::get('requests');
        $arrJson = array();
        $arrJson['status'] = 'error';
        $arrJson['message'] = 'Request is processed before post';
        if ($this->request->is('post')) {
            $post_data = $this->request->getData();
            $request_id = $post_data['id'];
            $request_status = $post_data['request_status'];
            $reason = $post_data['reason'];
            $requestRow = $requestsTable->get($request_id);
            $requestRow->request_status = $request_status;
            $requestRow->reason = $reason;
            if ($requestsTable->save($requestRow)) {
                $arrJson['status'] = 'success';
                $arrJson['message'] = 'Status updated successfully';
            } else {
                $arrJson['status'] = 'error';
                $arrJson['message'] = 'Status updatedion failed';
            }
        }
        echo json_encode($arrJson);
        exit;
    }

    public function saveRequestorDenyReason($id = null) {
        $requestsTable = TableRegistry::get('requests');
        $arrJson = array();
        $arrJson['status'] = 'error';
        $arrJson['message'] = 'Request is processed before post';
        if ($this->request->is('post')) {
            $post_data = $this->request->getData();
            $request_id = $post_data['id'];
            $request_status = $post_data['request_status'];
            $reason = $post_data['reason'];
            $requestRow = $requestsTable->get($request_id);
            $requestRow->request_status = $request_status;
            $requestRow->requestor_deny_reason = $reason;
            if ($requestsTable->save($requestRow)) {
                $arrJson['status'] = 'success';
                $arrJson['message'] = 'Status updated successfully';
            } else {
                $arrJson['status'] = 'error';
                $arrJson['message'] = 'Status updatedion failed';
            }
        }
        echo json_encode($arrJson);
        exit;
    }

    public function completeUpload() {
        $data = array();
        $userSession = $this->request->session()->read('LoginUser');
        $requestsTable = TableRegistry::get('requests');
        $notificationsTable = TableRegistry::get('notifications');
        $post_data = $this->request->getData();
        $request_id = $post_data['request_id'];
        $requestor_id = $post_data['requestor_id'];
        $finalFees = $post_data['finalFees'];
        if (empty($finalFees) || $finalFees == '') {
            $requestData = $requestsTable->findRequestDataByID($request_id);
            $finalFees = $requestData['total_cost'];
        }
        $cardDetailsTable = TableRegistry::get('card_details');
        $paymentTable = TableRegistry::get('payments');
        $fileNames = array();
        $errorSTR = FALSE;
        $errorArr = array();
        $arrJson = array();

        foreach ($post_data as $data) {
            $this->request->data['upload_hippa'] = $data;
            if (!empty($this->request->data['upload_hippa']['name'])) {
                $checkFileType = $this->request->data['upload_hippa']['type'];
                if (!in_array($checkFileType, array("application/pdf", "application/doc", "application/docx", "application/vnd.openxmlformats-officedocument.wordprocessingml.document"))) {
                    $reqResponse = array("status" => 'ERROR', 'message' => 'Please upload proper pdf,doc and docx format.');
                    echo json_encode($reqResponse);
                    exit();
                }
                if (isset($this->request->data['upload_hippa']) && $this->request->data['upload_hippa'] != "") {
                    // Variable declaration
                    $file = $this->request->data['upload_hippa'];
                    $path = "documents/requestor/" . $requestor_id;
                    $folder_name = $request_id;
                    $multiple[] = array('folder_name' => 'thumb', 'height' => '160', 'width' => '140');
                    //check if the requestor's folder exists
                    $dir1 = WWW_ROOT . 'documents/requestor/' . $requestor_id;
                     if (!is_dir($dir1)) {
                        @mkdir($dir1);
                    }
                    @chmod($dir1, 0777);
                    //check if the request folder exists
                    $dir = WWW_ROOT . 'documents/requestor/' . $requestor_id.'/'.$request_id;
                    if (!is_dir($dir)) {
                        @mkdir($dir);
                    }
                    @chmod($dir, 0777);
                    $response = $this->Common->upload_image($file, $path, $folder_name, false, $multiple);

                    $is_image_error = $this->Common->is_image_error($response);

                    if ($response == 'exist_error') {
                        $this->Flash->error($is_image_error, ['params' => ['class' => 'alert alert-danger']]);
                        $errorSTR = TRUE;
                        array_push($errorArr, $is_image_error);
                    } elseif ($response == 'size_mb_error') {
                        $this->Flash->error($is_image_error, ['params' => ['class' => 'alert alert-danger']]);
                        $errorSTR = TRUE;
                        array_push($errorArr, $is_image_error);
                    } elseif ($response == 'type_error') {
                        $this->Flash->error($is_image_error, ['params' => ['class' => 'alert alert-danger']]);
                        $errorSTR = TRUE;
                        array_push($errorArr, $is_image_error);
                    } else {
                        $filename = $response;
                        $this->request->data['upload_hippa'] = $filename;
                        array_push($fileNames, $filename);
                    }
                }
            } else {

                if (isset($this->request->data['upload_hippa']['name'])) {
                    unset($this->request->data['upload_hippa']['name']);
                }
                if (isset($this->request->data['upload_hippa']) && $this->request->data['upload_hippa'] == 'undefined') {
                    unset($this->request->data['upload_hippa']);
                }
            }
        }
        $files = serialize($fileNames);
        $requestRow = $requestsTable->get($request_id);
        $requestRow->request_completion_file_path = $files;
        if ($requestsTable->save($requestRow) && $errorSTR == FALSE) {
            $arrJson['status'] = 'success';
            $arrJson['message'] = 'files uploaded successfully';
            $arrJson['files'] = json_encode($fileNames);
            $CardData = $paymentTable->getCardDataByReqID($request_id);
            $cardId = $CardData['transaction_id'];
            $TransId = $this->stripeDirectCharge($cardId, $finalFees, $request_id);
            if (!empty($TransId)) {
                $query = $paymentTable->query();
                $queryRequest = $requestsTable->query();
                $update = $query->update()
                        ->set(['paid_status' => 'y', 'stripe_transaction_id' => $TransId])
                        ->where(['request_id' => $request_id])
                        ->execute();

                $updateRequest = $queryRequest->update()
                        ->set(['payment_status' => 1, 'request_status' => 5, 'paid_to_admin' => 1])
                        ->where(['id' => $request_id])
                        ->execute();
                //check reuqest_status is 6 to send notification to admin
                $this->insertNotifications($userSession['id'], 1, 0, 0, $request_id, 5, 'Insert Update', 2);

                if ($updateRequest) {
                    $arrJson['status'] = 'success';
                }
            } else {
                $arrJson['status'] = 'transaction failed';
            }
        } else {
            $arrJson['status'] = 'error';
            $arrJson['message'] = $errorArr;
        }
        echo json_encode($arrJson);
        exit();
    }

    private function stripeDirectCharge($cardId, $amount, $request_id) {
        $this->autoRender = false;
        $arrJson = array();
        $cardDetailsTable = TableRegistry::get('card_details');
        $paymentTable = TableRegistry::get('payments');
        $requestsTable = TableRegistry::get('requests');
        $amt = $amount * 100;
        $data = ['amount' => round($amt)];
//        pr($data);
//        pr($cardId);
        //find card details for prefered card
        $response = $this->Stripe->charge($data, $cardId);
        if ($response['status'] == 'success') {
            return $response['response']['id'];
        } else {
            return FALSE;
        }
    }

    public function allPendingRequests() {
//        echo 1; exit('in pages/dashboard');
        $this->viewBuilder()->setLayout('website_layout');
        $usersTable = TableRegistry::get('users');
        $requestTable = TableRegistry::get('requests');
        $userSession = $this->request->session()->read('LoginUser');
//        pr($userSession);
        $start_date = '';
        $date_range = '';
        $name_keyword = '';
        $id_keyword = '';
        //$conditions = [];
        $conditions = ['requests.provider_id ' => $userSession['id']];
        if ($this->request->is('post')) {
            $post_data = $this->request->getData();
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
//                            'Requestor.first_name LIKE' => '%' . $usersTable->encrypt($name_keyword) . '%',
//                            'Requestor.last_name LIKE' => '%' . $usersTable->encrypt($name_keyword) . '%',
                        'Requestor.first_name LIKE' => '%' . $name_keyword . '%',
                        'Requestor.last_name LIKE' => '%' . $name_keyword . '%',
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

        $conditions += array('requests.request_status IN (0,1)', 'requests.is_deleted' => 0, 'requests.provider_id' => $userSession['id']);

        $this->paginate = [
            'contain' => ['Requestor', 'Clients', 'Matters'],
            'maxLimit' => REC0RDS_LIMIT,
            'conditions' => $conditions,
            'order' => ['id' => 'DESC']
        ];
        $requestData = $this->paginate($requestTable->find())->toArray();
//        pr($requestData); exit('in listing testesfrte');

        $this->set('requestData', $requestData);
        $this->set('start_date', $start_date);
        $this->set('date_range', $date_range);
        $this->set('name_keyword', $name_keyword);
        $this->set('id_keyword', $id_keyword);
    }

    public function allPayments() {
//        echo 1; exit('in pages/dashboard');
        $this->viewBuilder()->setLayout('website_layout');
        $usersTable = TableRegistry::get('users');
        $requestTable = TableRegistry::get('requests');
        $userSession = $this->request->session()->read('LoginUser');
//        pr($userSession);
        $start_date = '';
        $end_date = '';
        $name_keyword = '';
        $id_keyword = '';
        //$conditions = [];
        $conditions = ['requests.provider_id ' => $userSession['id']];
        if ($this->request->is('post')) {
            $post_data = $this->request->getData();
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
//                            'Requestor.first_name LIKE' => '%' . $usersTable->encrypt($name_keyword) . '%',
//                            'Requestor.last_name LIKE' => '%' . $usersTable->encrypt($name_keyword) . '%',
                        'Requestor.first_name LIKE' => '%' . $name_keyword . '%',
                        'Requestor.last_name LIKE' => '%' . $name_keyword . '%',
                    ),
                );
            }
            if (isset($id_keyword) && $id_keyword != '') {
                if ($id_keyword == 1) {
                    $conditions += ['requests.paid_to_provider' => 1];
                } else {
                    $conditions += ['requests.paid_to_provider' => 0];
                }
            }
            if (isset($start_date) && $start_date != '') {
                $conditions += array('requests.date_of_request >=' => date('Y-m-d', strtotime($start_date)));
            }
            if (isset($end_date) && $end_date != '') {
                $conditions += array('requests.date_of_request <=' => date('Y-m-d', strtotime($end_date)));
            }
        }
        $this->paginate = [
            'contain' => ['Requestor', 'Clients', 'Matters'],
            'maxLimit' => REC0RDS_LIMIT,
            'conditions' => $conditions,
            'order' => ['id' => 'DESC']
        ];
        $requestData = $this->paginate($requestTable->find())->toArray();
//        pr($requestData); exit('in listing testesfrte');

        $this->set('requestData', $requestData);
        $this->set('start_date', $start_date);
        $this->set('end_date', $end_date);
        $this->set('name_keyword', $name_keyword);
        $this->set('id_keyword', $id_keyword);
    }

    public function insertNotifications($sender_id, $reciever_id, $status, $is_sent, $request_id, $request_status, $notification_type, $message_id) {
        $notificationsTable = TableRegistry::get('notifications');
        $notifications = $notificationsTable->newEntity();
        $notifications->sender_id = $sender_id;
        $notifications->reciever_id = $reciever_id;
        $notifications->status = $status;
        $notifications->is_sent = $is_sent;
        $notifications->request_id = $request_id;
        $notifications->request_status = $request_status;
        $notifications->notification_type = $notification_type;
        $notifications->message_id = $message_id;
        $resultNotification = $notificationsTable->save($notifications);
    }

    public function getStateNameFromId($stateID) {

        $stateTable = TableRegistry::get('states');
        return $stateList = $stateTable->GetStateName($stateID);
    }

}
