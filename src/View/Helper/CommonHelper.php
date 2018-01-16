<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MycipherHelper
 *
 * @author snehag
 */

namespace App\View\Helper;

use Cake\View\Helper;
use Cake\ORM\TableRegistry;

class CommonHelper extends Helper {

    public function encrypt($string) {
        $users = TableRegistry::get('Users');
        return $users->encrypt($string);
    }

    public function decrypt($string) {
        $users = TableRegistry::get('Users');
        return $users->decrypt($string);
    }

    public function cleanString($string) {
        $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
        $string = preg_replace('/[^A-Za-z0-9.\-]/', '', $string); // Removes special chars.
        $string = preg_replace('/-+/', '-', $string); // Replaces multiple hyphens with single one.
        return str_replace('-', ' ', $string);
    }

    public function getProviderData($id = null) {
        $data = array();
        $proTable = TableRegistry::get('users');
        $data = $proTable->find('all', array(
                    'conditions' => array('id' => $id,'role_id'=>2)
                ))->first();
        if (!empty($data)) {
            return $data->toArray();
        } else {
            return array();
        }
    }

    /* @author Sneha G   
      @params name
      @return id and name
     */

    public function getRequesterData($id = null) {
        $data = array();
        $proTable = TableRegistry::get('users');
        $data = $proTable->find('all', array(
                    'conditions' => array('id' => $id,'role_id'=>3)
                ))->first();
        if (!empty($data)) {
            return $data->toArray();
        } else {
            return array();
        }
    }

    /* @author Sneha G   
      @params id
      @return name
     */

    public function getDeptData($id = null) {
        $data = array();
        $deptTable = TableRegistry::get('departments');
        $data = $deptTable->find('all', array(
                    'conditions' => array('id' => $id),
                    'fields' => array('name'),
                ))->first();

        if (!empty($data)) {
            return $data->toArray();
        } else {
            return array();
        }
    }

    /* @author Sneha G   
      @params id
      @return name
     */

    public function getClientData($id = null) {
        $data = array();
        $clientTable = TableRegistry::get('clients');
        $data = $clientTable->find('all', array(
                    'conditions' => array('id' => $id),
                    'fields' => array('client_number', 'client_name'),
                ))->first();
//        pr($data);
        if (!empty($data)) {
            return $data->toArray();
        } else {
            return array();
        }
    }

    /* @author Sneha G   
      @params id
      @return name
     */

    public function getRecordType($id = null) {
        switch ($id) {
            case "1":
                return "Medical";

                break;

            case "2":
                return "Billing";

                break;

            case "3":
                return "Both (Medical and Billing Records)";

                break;

            default:
                "NA";
                break;
        }
    }

    /* @author Sneha G   
      @params id
      @return id and name
     */

    public function getMatterData($id = null) {
        $data = array();
        $matterTable = TableRegistry::get('matters');
        $data = $matterTable->find('all', array(
                    'conditions' => array('id' => $id),
                ))->first();
//        pr($data);
        if (!empty($data)) {
            return $data->toArray();
        } else {
            return array();
        }
    }

    /* @author Sneha G   
      @params user_id
      @return count of pending requests whose status id 1,2
     */

    public function getCountPendingReq($userId) {
        $data = array();
        $requestsTable = TableRegistry::get('requests');
        $data = $requestsTable->find('all', array(
            'conditions' => array(
                'request_status IN' => array(0,1),
                'is_deleted' => 0,
                'provider_id' => $userId,
            ),
        ));
        if (!empty($data)) {
            return count($data->toArray());
        } else {
            return array();
        }
    }

    public function checkIsset($keysArr, $valueArr) {
        
        foreach ($keysArr as $key){
            $valueArr[$key] =  isset($valueArr[$key]) || !empty($valueArr[$key]) ? $valueArr[$key] : 'NA';
        }
        return $valueArr;
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
      @params id
      @return provider account from provider_payment_details table
     */
    function getProviderAccId($id) {
        $data = array();
        $providerPaymentsDetails = TableRegistry::get('provider_payments_details');
        return $providerPaymentsDetails->find('all', array('conditions' => array('provider_id' => $id,  'status' => 1)))->first();
    }
    
    /* @author Sneha G   
      @params country id
      @return row for that id
     */
    function getCountryData($id) {
        $data = array();
        $countriesTable = TableRegistry::get('countries');
        return $countriesTable->find('all', array('conditions' => array('id' => $id)))->first();
    }
}
