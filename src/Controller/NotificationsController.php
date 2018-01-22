<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * Author:Sneha G
 */

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
use Stripe\Stripe;

class NotificationsController extends AppController {

    public function initialize() {
        parent::initialize();
        $this->loadComponent('Stripe');
    }

    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
        $userSession = $this->request->session()->read('LoginUser');
        $action = $this->request->action;
        $controller = $this->request->controller;
//        $this->checkUserSession();
    }

    public function requestNotification($param = null) {
        $userSession = $this->request->session()->read('LoginUser');
//        pr($userSession);
        $notificationsTable = TableRegistry::get('notifications');
        $usersTable = TableRegistry::get('users');
        $requestTable = TableRegistry::get('requests');
        $userData = $usersTable->findUserByID($userSession['id']);
        $arrResponse = array();
        $savedRequestIds = array();
        $notificationDom = '';
        $notificationData = $notificationsTable->getNotificationByID($userSession['id']);
        if (!empty($notificationData)) {
            foreach ($notificationData as $key => $val) {
                //get request_id from request table
                $requestData = $requestTable->findRequestDataByID($val['request_id']);
                //make array of requests id
                array_push($savedRequestIds, $val['id']);
//                $pro = new ProvidersController();
                $request_status = $this->getStatusByID($val['request_status']);
                $haystack = array('{REQUEST_ID}', '{REQUEST_STATUS}');
                $replace = array($requestData['request_id'], $request_status);
                $message = str_replace($haystack, $replace, $val['Message']['message']);
                $Notid = $usersTable->encrypt($val['request_id']);
                if($userSession['role_id'] ==1){
                    $notificationDom .= "<li class='word-wrap'><a href='/admins/viewRequest/$Notid'>";
                }elseif($userSession['role_id'] ==2){
                    $notificationDom .= "<li class='word-wrap'><a href='/providers/viewRequest/$Notid'>";
                }elseif($userSession['role_id'] ==3){
                    $notificationDom .= "<li class='word-wrap'><a href='/requestors/viewRequest/$Notid'>";
                }
//                $notificationDom .= "<li class='word-wrap'><a href='/requestors/viewRequest/$Notid'>";
                $notificationDom .= '<i class="fa fa-dot-circle-o text-aqua"></i>';
                $notificationDom .= $message;
                $notificationDom .= '</a></li>';
                //update is_sent status of the records
                $query = $notificationsTable->query();
                $update = $query->update()
                        ->set(['is_sent' => 1])
                        ->where(['id' => $val['id']])
                        ->execute();
            }
            $arrResponse['status'] = 'success';
            $arrResponse['count'] = count($notificationData);
            $arrResponse['response'] = $notificationDom;
            $arrResponse['request_ids'] = $savedRequestIds;
        } else {
            $arrResponse['status'] = 'no records found';
            $arrResponse['count'] = '';
        }

        echo json_encode($arrResponse);
        exit();
    }

    public function readNotification($param = null) {
        $this->autoRender = false;
        $userSession = $this->request->session()->read('LoginUser');
        $notificationsTable = TableRegistry::get('notifications');
        $usersTable = TableRegistry::get('users');
        $requestTable = TableRegistry::get('requests');
        $userData = $usersTable->findUserByID($userSession['id']);
        $arrResponse = array();
        $notificationIds = array();
        $explodeIds = array();
        $notificationData = $notificationsTable->getNotificationByID($userSession['id']);
        if (!empty($this->request->data)) {
            $notificationIds = $this->request->data['ids'];
            $notificationIdsArr = explode(',', $notificationIds);
             $query = $notificationsTable->query();
//            foreach ($notificationIds as $id){
//            $notificationsRow = $notificationsTable->get($id);
//            $notificationsRow->status = 1;
//            $notificationsTable->save($notificationsRow);
//            $update = true;
//            }
                    
            $update = $query->update()
                    ->set(['status' => 1])
                    ->where(['id IN' => $notificationIdsArr])
                    ->execute();
            if ($update) {
                $arrResponse['status'] = 'success';
            } else {
                $arrResponse['status'] = 'no records found';
            }

            echo json_encode($arrResponse);
            exit();
        }
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

}
