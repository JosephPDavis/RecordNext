<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class  ProviderPaymentsDetailsTable extends Table
{

	public function initialize(array $config){
            parent::initialize($config);   
            
        }
        
        public function CheckStepOne($ProId) {
            $details = $this->find('all', array(
                    'conditions' => array(
                        'provider_id ' => $ProId
                    )
                ))->first();
            return !empty($details) ? True : False;
        }
	
        function getProviderAccId($id) {
        return $this->find('all', array('conditions' => array('provider_id' => $id,  'status' => 1)))->first();
        
        }
    
}