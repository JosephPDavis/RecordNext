<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * Tests Controller made by Sneha G
 */

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
use Stripe\Stripe;


class TestsController extends AppController {

    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
        $this->Auth->allow('activationLink');
//        echo 11; pr('hfsjkfg');
       
    }
     public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Stripe');
    }


    public function index() {
        $this->viewBuilder()->setLayout('website_layout');
        $amount=50;
        $this->set('amount');
        $userSession = $this->request->session()->read('LoginUser');
        if ($this->request->is('post')) {
//            pr($this->request->data);  exit('test');
            $token = $this->request->data['stripeToken'];
//            include('Stripe/lib/Stripe.php');
//            include('Stripe/lib/Charge.php');
//            $stripe_obj = new Stripe();
//            Stripe::setApiKey("sk_test_OAYRwtiKanB9quptS09wRN09");
//            $charge = Charge::create(array(
//            "amount" => $amount,
//            "currency" => "usd",
//            "card" => $token,
//            "description" => "Testing Charge."
//            ));
            
//            $stripe_obj->setApiKey("sk_test_OAYRwtiKanB9quptS09wRN09");
            
//            $charge_obj = new Charge();
//           $charge = $charge_obj->create(array(
//              "amount" => 400,
//              "currency" => "usd",
//              "source" => "TOKEN_HERE", // obtained with Stripe.js
//              "description" => "Charge for test@example.com"
//            ));
//
//            debug($charge); exit;
//
             $userEmail = $userSession['email'];
             $data = array('email' => $userEmail, 'source' => $token);
             $customer = $this->Stripe->createCustomer($data);
             $newArr = $customer['response']['sources']['data'][0];
             pr($customer);
             pr($newArr); exit('Customer_data');
             $saveArr=[
                 'customer_id'=>$customer['response'],
                 'customer_id'=>$customer['email'],
             ];
             $data = array('amount' => $amount,'source'  => $token );
             $result = $this->Stripe->charge($data, $customerId);
             
        }  
    }

}

?>
