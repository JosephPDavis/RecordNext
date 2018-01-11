<?php

namespace App\Controller;

use Cake\Core\Configure;
use Cake\Network\Exception\ForbiddenException;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
class PagesController extends AppController
{
        
     public function beforeFilter(Event $event)
    {
//         echo 1; exit('in pages');
        parent::beforeFilter($event);
        $this->Auth->allow('home','contactUs');
    }
    
    
    public function home($path = null)
    {
        $this->viewBuilder()->setLayout('default');
//echo 1; exit('in pages');
    }
    public function login(){
     $this->viewBuilder()->setLayout('default');
     
    }
    public function contactUs(){
        //$this->viewBuilder()->setLayout('default');
        $this->autoRender = false;
        $contactTable = TableRegistry::get('contacts');
        $contacts = $contactTable->newEntity();      
        if ($this->request->is('post')) {
            $user = $contactTable->patchEntity($contacts, $this->request->getData());                        
            if ($contactTable->save($user)) {                
                $this->Flash->success('Your message has been sent Successfully.', ['params' => ['class' => 'alert alert-success']]);
                return $this->redirect(['controller' => 'Users','action' => 'login']);
            }
            $this->Flash->error('Unable to send message.', ['params' => ['class' => 'alert alert-danger']]);
        }         
    }    
}
