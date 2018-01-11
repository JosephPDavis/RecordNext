<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class ProvidersTable extends Table
{
    public function initialize(array $config){
        parent::initialize($config);      
//        $this->setTable('Users');  
//        $this->belongsTo('RequestorUser',['className'=>'Users'])->setForeignKey('requestor_id');
//        $this->belongsTo('Requests',['className'=>'Users'])->setForeignKey('provider_id');
    }
    
}