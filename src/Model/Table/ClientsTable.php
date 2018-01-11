<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\Rule\IsUnique;

class ClientsTable extends Table
{
    public function initialize(array $config){
        parent::initialize($config);      

    }
    
     /* @auther Sneha  G
      @params 
      @return 
      @comment: uniqness validation for client number
     */
//    public function validationDefault(Validator $validator) {
            // A single field.
//            $rules->add($rules->isUnique(['client_number']));

            // A list of fields
//            $rules->add($rules->isUnique(
//                ['client_number', 'client_name'],
//                'This client number & client name combination has already been used.'
//            ));
//    }
    
    
     /* @author Sneha  G
      @params $client_number
      @return clientdata
     */

    function getclientDataById($client_number=null) {
        $clientData = $this->find('all', array('conditions' => array('client_number' => $client_number,'is_deleted' => 0)))->first();
        if (!empty($clientData)) {
            return $clientData->toArray();
        } else {
            return false;
        }
    }
     /* @author Sneha  G
      @params $userId, $clientNumber
      @return clientdata
     */

    function getclientDataByUserId($userId=null,$clientNumber = null) {
        $clientData = $this->find('all', array('conditions' => array('user_id' => $userId,'client_number'=>$clientNumber,'is_deleted' => 0)))->first();
        if (!empty($clientData)) {
            return $clientData->toArray();
        } else {
            return false;
        }
    }
    
}