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

class CountriesTable extends Table
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
    function listCountries() {
       
          return $this->find('all')->toArray();
    }
     //   function for countries list
    function getCountryIDbyName($name) {
       
        $countryName = $this->find('all', array('conditions' => array('name' => $name)))->first();
        if (!empty($countryName)) {
            return $countryName->toArray();
        } else {
            return;
        }
    }
    
   
      public function getAllCountriesListISO(){

        $arrAllCountriesList = $this->find('all', array(
                        'fields' => array('ISO2', 'name'),
                        'conditions' => array('ISO2 !=' => '--'),
                    )
                );
	return $arrAllCountriesList->toArray();

    }
}