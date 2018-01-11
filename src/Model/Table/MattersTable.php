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

class MattersTable extends Table
{

	public function initialize(array $config){
        parent::initialize($config);      
//        $this->setTable('matters');
        
        $this->belongsTo('Clients', [ 
        'className' => 'Clients', 
        'foreignKey' => 'client_id', 
        'propertyName' => 'Clients']);
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
    
    
   /* @auther Sneha  G
      @params $matter_no,$client_id
      @return matterdata
     */

    function getMatterDataByClientID($client_id,$matter_no) {
        $matterData = $this->find('all', array('conditions' => array('client_id' => $client_id, 'matter_no'=>$matter_no,'is_deleted' => 0)))->first();
        if (!empty($matterData)) {
            return $matterData->toArray();
        } else {
            return false;
        }
    }
}