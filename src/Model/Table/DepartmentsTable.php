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

class DepartmentsTable extends Table {

    public function validationDefault(Validator $validator) {
        return $validator
                        ->notEmpty('name', 'Department name is required.');
    }

    //   function for finding providers by id
    function findDepartmentByID($id) {
        $departmentData = $this->find('all', array('fields' => array('id', 'name'), 'conditions' => array(
                        'user_id' => $id,
                        'is_deleted' => 0,
                        'status' => 1,
                    ),
                ))->first();
        if (!empty($departmentData)) {
            return $departmentData->toArray();
        } else {
            return array();
        }
    }
    //   function for finding providers by id
    function findAllDepartmentByID($id) {
        $departmentData = $this->find('all', array('fields' => array('id', 'name'), 'conditions' => array(
                        'user_id' => $id,
                        'is_deleted' => 0,
                        'status' => 1,
                    ),
                ));
        if (!empty($departmentData)) {
            return $departmentData->toArray();
        } else {
            return array();
        }
    }
    
    function findAllDepartmentByIDs($id) {
        $departmentData = $this->find('all', array('fields' => array('id', 'name'), 'conditions' => array(
                        'user_id' => $id,
                        'is_deleted' => 0,
                        'status' => 1,
                    ),
                ));
        $departmentDataArr = $departmentData->toArray();
        $row = array();
        
        foreach ($departmentDataArr as $d){
            $row[$d['id']] = $d['name'];
        }
        
        if (!empty($row)) {
            $a = array(0 => "Select Department");
            $row = $a + $row;
            return $row;
        } else {
            return array();
        }
    }

}
