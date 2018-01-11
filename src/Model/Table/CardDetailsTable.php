<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class CardDetailsTable extends Table
{
    public function initialize(array $config){
        parent::initialize($config);      

    }
    /* @author Sneha G     
      @params $card_preference_id
      @return card details
     */

    function getCardDetails($id) {
        $cardDetails = $this->find('all', array(
                    'conditions' => array(
                        'id' => $id
                    )
                ))->first();
        return $cardDetails;
    }
    /* @author Sneha G     
      @params $userId
      @return all card details of the user
     */

    function getCardAllDetails($userId) {
        $cardDetails = $this->find('all', array(
                    'conditions' => array(
                        'user_id' => $userId
                    )
                ));
        return $cardDetails->toArray();
    }
    /* @author Sneha G     
      @params $cc_no
      @return card details by last 4 digit of credit card
     */

    function getCardDetailByCC_NO($cc_no) {
        $cardDetails = $this->find('all', array(
                    'conditions' => array(
                        'cc_no' => $cc_no
                    )
                ))->first();
        return $cardDetails->toArray();
    }

    
}