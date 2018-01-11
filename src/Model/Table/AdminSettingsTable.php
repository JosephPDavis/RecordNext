<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class  AdminSettingsTable extends Table
{

	public function initialize(array $config){
            parent::initialize($config);   
            
        }
        
	public function getAdminShare(){
            $data = $this->find('all', array(
                    'conditions' => array(
                        'id' => 1
                    )
                ))->first();
        return $data;
        }
    
}