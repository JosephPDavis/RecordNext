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

class PaymentsTable extends Table
{

	public function initialize(array $config){
        parent::initialize($config);      
        $this->setTable('payments');        
    }
//     public function validationDefault(Validator $validator)
//    {     
//        return $validator
//            ->notEmpty('full_name', 'Full name is required.')
//            ->notEmpty('message', 'Message is required.')           
//            ->add('email', 'validFormat', [
//                'rule' => 'email',
//                'message' => 'E-mail must be valid'
//            ]
//            );
//    }
    
    public function getCardDataByReqID($id) {
        if($id == null) {return;}
        return $this->find('all', array('conditions' => array('request_id' => $id)))->first();
    }
    
}