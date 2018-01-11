<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class ProviderDetailsTable extends Table
{
    public function initialize(array $config){
        parent::initialize($config);      

    }
    
    public function getDetails($ProId) {
            $details = $this->find('all', array(
                    'conditions' => array(
                        'provider_id ' => $ProId
                    )
                ))->first();
            return !empty($details) ? $details->toArray() : '';
        }
     

    
}