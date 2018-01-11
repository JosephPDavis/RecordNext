<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Utility\Security;
use Cake\Event\Event;
use Cake\ORM\Query;
use Cake\Auth\DefaultPasswordHasher;

class RequestsTable extends Table {

    public function initialize(array $config) {
        parent::initialize($config);
        $this->setTable('requests');
//        $this->belongsTo('RequestorUser',['className'=>'Users'])->setForeignKey('requestor_id');

        $this->belongsTo('Provider', [
            'className' => 'Users',
            'foreignKey' => 'provider_id',
            'propertyName' => 'Provider']);

        $this->belongsTo('Requestor', [
            'className' => 'Users',
            'foreignKey' => 'requestor_id',
            'propertyName' => 'Requestor']);

        //client table join
//        $this->hasOne('Clients')
//                ->setForeignKey('client_id')
//                ->setDependent(true);

        $this->belongsTo('Clients',['className'=>'Clients'])->setForeignKey('client_id');
        $this->belongsTo('Matters',['className'=>'Matters'])->setForeignKey('matter_id');
        
        $this->hasOne('Payments')
            ->setName('Payments')
            ->setForeignKey('request_id');   
            
    }

    public function validationDefault(Validator $validator) {
        return $validator
                        ->notEmpty('provider_id', 'Please select provider name.')
                        ->notEmpty('request_id', 'Please enter request number.')
                        //->notEmpty('matter_no', 'Please enter matter number.')        
                        ->notEmpty('first_name', 'Please enter first name.')
                        ->notEmpty('last_name', 'Please enter last name.')
                        ->notEmpty('rec_start_date', 'Please select start date.')
                        ->notEmpty('rec_end_date', 'Please select end date.')
                        ->notEmpty('dob', 'Please select dob date.')
                        ->notEmpty('threshold', 'Please enter thresold.')
                        ->notEmpty('record_type', 'Please select record type.')
                        ->notEmpty('upload_hippa', 'Please upload pdf,doc and docx file only.')
                        //->notEmpty('ssn_no', 'Please enter ssn number.')
                        ->notEmpty('credit_card_no', 'Please enter credit card number.')
                        ->notEmpty('holder_name', 'Please enter holder name.')
                        ->notEmpty('cvv', 'Please enter cvv.')
                        ->notEmpty('expiry_date', 'Please select expiry date.');
    }

    /* @auther Mahalaxmi    
      @params null
      @return lastIncrementedID
     */
    /* @auther Mahalaxmi    
      @params $validator
      @return $validator
     */

    public function validationOnlyCheck(Validator $validator) {
        $validator = $this->validationDefault($validator);
        $validator->remove('upload_hippa', 'Please upload pdf file only.');
        return $validator;
    }

    function findRequestForlastRecord() {
        $requestData = $this->find('all', array('fields' => array('request_id'), 'order' => array('id' => 'DESC')))->first();
        if (empty($requestData)) {
            $autoIncrementedID = "1";
        } else {
            $autoIncrementedID = ($requestData['request_id'] + 1);
            //$autoIncrementedID=str_pad("$autoIncrementedID", 3, "0", STR_PAD_LEFT );
        }
        return $autoIncrementedID;
    }

    /* @auther Mahalaxmi    
      @params $id
      @return $requestData
     */

    function findRequestDataByID($id) {
        return $this->find('all', array('conditions' => array('id' => $id, 'is_deleted' => 0, 'status' => 1)))->first();
    }

    public function afterFind(Event $event, Query $query, \ArrayObject $options) {
//        pr('after find of req'); die;
        $query->formatResults(
                function ($results) {
            return $results->map(function ($row) {
                        foreach ($this->encryptedFields as $fieldName) {
                            if (isset($row[$fieldName])) {
                                $row[$fieldName] = $this->decrypt($row[$fieldName]);
                            }
                        }
                        return $row;
                    });
        }
        );
    }

}
