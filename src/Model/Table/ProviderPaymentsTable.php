<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class ProviderPaymentsTable extends Table {

    public function initialize(array $config) {
        parent::initialize($config);
    }

    /* @author Sneha G
      @params $id
      @return Provider payment data by request_id
     */

    function findDataByIdRequest($id) {
        $data = $this->find('all', array('conditions' => array('request_id' => $id)))->first();
        if (!empty($data)) {
            return $data;
        } else {
            return array();
        }
    }

}
