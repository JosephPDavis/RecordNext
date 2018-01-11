<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class ContactsTable extends Table
{
     public function validationDefault(Validator $validator)
    {     
        return $validator
            ->notEmpty('full_name', 'Full name is required.')
            ->notEmpty('message', 'Message is required.')           
            ->add('email', 'validFormat', [
                'rule' => 'email',
                'message' => 'E-mail must be valid'
            ]
            );
    }
}