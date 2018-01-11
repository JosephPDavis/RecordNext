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

class StatesTable extends Table
{
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
    
    
    
     //   function for countries list
    function listStateList($country_id) {
       
        $query = $this->find('list', [
            'keyField' => 'id',
            'valueField' => 'name',
            'conditions' => ['country_id' => $country_id ]
        ]);
       
        return $query->toArray();
    }
     //   function for countries list
    function getStateIDbyName($name) {
       
        $stateName = $this->find('all', array('conditions' => array('name' => $name)))->first();
        if (!empty($stateName)) {
            return $stateName->toArray();
        } else {
            return;
        }
    }
    
    function GetStateName($stateID) {
    
        $stateName = $this->find('all', array('conditions' => array('id' => $stateID)))->first();
        return $stateName['name']; 
}
    
    
}