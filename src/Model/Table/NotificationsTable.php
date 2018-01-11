<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * Author:Sneha G
 */

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Utility\Security;
use Cake\Event\Event;
use Cake\ORM\Query;
use Cake\Auth\DefaultPasswordHasher;

class NotificationsTable extends Table {

    public function initialize(array $config) {
        parent::initialize($config);
        $this->setTable('notifications');
        
        $this->belongsTo('Message', [
            'className' => 'Messages',
            'foreignKey' => 'message_id',
            'propertyName' => 'Message']);
        
    }
    /* @author Sneha G    
      @params $userId
      @return notification data
     */
    function getNotificationByID($userId) {
        $data = $this->find('all', array('conditions' => array('notifications.reciever_id ' => $userId, 'notifications.status' => 0,'notifications.is_sent'=> 0),'order' => ['notifications.modified' => 'desc']))->contain(['Message']);
        if(!empty($data)){
            return $data->toArray();
        }else{
            return array();
        }
        
    }
}
