<?php
namespace App\Model\Entity;

use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;

class User extends Entity
{

    // Make all fields mass assignable except for primary key field "id".
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];

    protected function _setPassword($password)
    {
        if (strlen($password) > 0) {
            return (new DefaultPasswordHasher)->hash($password);
        }
    }
    
//    protected $_virtual = ['full_name'];
//
//    protected function _getFullName() {
//        $table = TableRegistry::get($this->source());
//        return  $table->decrypt($this->_properties['first_name']) . ' ' . $table->decrypt($this->_properties['last_name']);
//    }

}
