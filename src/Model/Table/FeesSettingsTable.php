<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class  FeesSettingsTable extends Table
{

	public function initialize(array $config){
            parent::initialize($config);   
            
        }
        
	public function getPaymentSettings($id = null){
            $data = $this->find('all', array(
                    'conditions' => array(
                        'provider_id' => $id
                    )
                ))->first();
        return $data;
        }
    
}