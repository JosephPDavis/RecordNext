<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Utility\Security;
use Cake\Event\Event;
use Cake\ORM\Query;
use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\Rule\IsUnique;
use Cake\ORM\RulesChecker;

class UsersTable extends Table {

    public $encryptedFields = [
        'first_name',
        'last_name',
        'full_name',
        'email',
        'phone',
        'city',
        'state',
        'country',
        'zip_code',
        'street_address',
        'company_name',
        'department',
        'about_company'
    ];
    public $mkey = "dk0583@mca!jr0193@cs!kp0391@it!B";
    public function initialize(array $config) {
        parent::initialize($config);
        $this->setTable('users');
        /* $this->setDisplayField('id');
          $this->setPrimaryKey('id');
          $this->addBehavior('Timestamp'); */
//         $this->belongsTo('Countrys',['className'=>'Countries'])->setForeignKey('country');
        $this->belongsTo('Country', [
            'className' => 'Countries',
            'foreignKey' => 'country_id',
            'propertyName' => 'Country']);

    }

    public function validationDefault(Validator $validator) {

        $validator->notEmpty('first_name', 'First Name is required.')
                ->notEmpty('last_name', 'Last Name is required.')
                ->notEmpty('role', 'Please select a Role')
                ->notEmpty('phone', 'Phone Number is required')
                ->notEmpty('street_address', 'Address is required')
//                ->notEmpty('description', 'Description is required')
                ->notEmpty('type', 'Requestor Type is required')
                ->notEmpty('email', 'Email is required.')
                /* ->add('email', [
                  'unique' => [
                  'message'   => 'Email already registered',
                  'rule'      => 'validateUnique'
                  ]
                  ]) */->add('email'/* , 'validFormat', [
                          'rule' => 'email',
                          'message' => 'E-mail must be valid'
                          ] */, 'email', [
                    'rule' => [$this, 'isUnique'],
                    'message' => __('Email already registered')
                        ]
                )
                ->add('role', 'inList', [
                    'rule' => ['inList', ['admin', 'author']],
                    'message' => 'Please enter a valid role'
                ])
                ->add(
                        'password', [
                    'minLength' => [
                        'rule' => ['minLength', 8],
                        'message' => 'Password must contain at least 8 character'
                       
                    ],
                          
                        ]
                )
                //->requirePresence('password', 'create', 'Password must be required!')
                //->notEmpty('password', 'Password must be required!')
                ->notEmpty('confirm_password', 'Password must be required!', 'create')
                ->notEmpty('confirm_password', 'Confirm password must be required!')
                ->add(
                        'confirm_password', 'custom', [
                    'rule' => function ($value, $context) {
                        if (isset($context['data']['password']) && $value == $context['data']['password']) {
                            return true;
                        }
                        return false;
                    },
                    'message' => 'Sorry, password and confirm password does not matched'
                        ]
                )
                ->add('current_password', 'custom', [
                    'rule' => function($value, $context) {
                        $user = $this->get($context['data']['id']);
                        if ($user) {
                            if ((new DefaultPasswordHasher)->check($value, $user->password)) {
                                return true;
                            }
                        }
                        return false;
                    },
                    'message' => 'The old password does not match the current password!',
                ])
                ->notEmpty('current_password')
//                ->add('password', [
//                    'match' => [
//                        'rule' => ['compareWith', 'confirm_password'],
//                        'message' => 'The passwords does not match!',
//                    ]
//                ])
               // ->notEmpty('password')
                ->add('confirm_password', [
                    'length' => [
                        'rule' => ['minLength', 8],
                        'message' => 'The password have to be at least 8 characters!',
                    ]
                ])
                ->add('confirm_password', [
                    'match' => [
                        'rule' => ['compareWith', 'password'],
                        'message' => 'The passwords does not match!',
                    ]
                ])
                ->notEmpty('confirm_password');
        return $validator;
    }

    /* @auther Mahalaxmi    
      @params $email
      @return true or false
     */

    function isUnique($email) {
        $user = $this->find('all')->where(['email' => $email,])->first();
        if ($user) {
            return false;
        }
        return true;
    }

    /* @auther Mahalaxmi    
      @params $validator
      @return $validator
     */

    public function validationOnlyCheck(Validator $validator) {
        $validator = $this->validationDefault($validator);
        $validator->remove('email', 'email');
        return $validator;
    }

    /* @auther Mahalaxmi    
      @params $event, $entity, $options
      @return true
     */

//    public function beforeSave($event, $entity, $options) {
//        foreach ($this->encryptedFields as $fieldName) {
//            if ($entity->has($fieldName)) {
//                $fieldNames = $this->encrypt(strtolower($entity->get($fieldName)));
//                $entity->set($fieldName, $fieldNames);
//            }
//        }
//        return true;
//    }

    /* @auther Mahalaxmi    
      @params Event $event, Query $query, \ArrayObject $options
      @return $row for fields which is decrypted
     */

//    public function beforeFind(Event $event, Query $query, \ArrayObject $options) {
//        $query->formatResults(
//                function ($results) {
//            return $results->map(function ($row) {
//                        foreach ($this->encryptedFields as $fieldName) {
//                            if (isset($row[$fieldName])) {
//                                $row[$fieldName] = $this->decrypt($row[$fieldName]);
//                            }
//                        }
//                        return $row;
//                    });
//        }
//        );
//    }

    /* @auther Mahalaxmi    
      @params Event $event, Query $query, \ArrayObject $options
      @return $row for fields which is decrypted
     */

    public function afterFind(Event $event, Query $query, \ArrayObject $options) {
        $query->formatResults(
                function ($results) {
            return $results->map(function ($row) {
                        foreach ($this->encryptedFields as $fieldName) {
                            if (isset($row[$fieldName])) {
                                $row[$fieldName] = $this->decrypt($row[$fieldName]);
                            }
                        }
                        return $row;
                    });
        }
        );
    }

    /* @auther Mahalaxmi    
      @params $str
      @return encrypted string
     */

    function encrypt($str = '') {
        $encStr = strrev(base64_encode($str . $this->mkey));
        return str_replace(array('+', '/', '='), array('-', '_', ''), $encStr);
    }

    /* @auther Mahalaxmi    
      @params $str
      @return decrypted string
     */

    function decrypt($str = '') {
        
        $data = str_replace(array('-', '_'), array('+', '/'), $str);
        $mod4 = strlen($data) % 4;
        if ($mod4) {
            $data .= substr('====', $mod4);
        }
        $decStr = base64_decode(strrev($data));
        return str_replace($this->mkey, '', $decStr);
    }

    /* @auther Mahalaxmi    
      @params $id
      @return $userData
     */

    function findUserByID($id) {
   
        $userData = $this->find('all', array('conditions' => array('users.id' => $id, 'users.is_deleted' => 0, 'users.status' => 1)))->contain(['Country'])->first();
        return $userData;
    }

    /* @auther Mahalaxmi    
      @params $emailId
      @return $userData
     */

    function findUserByEmailID($emailId) {
        $userData = $this->find('all', array('conditions' => array('email' => $emailId, 'is_deleted' => 0, 'status' => 1)))->first();
        if (!empty($userData)) {
            return $userData->toArray();
        } else {
            return;
        }
    }

    /* @auther Mahalaxmi    
      @params $tokenId
      @return $userData
     */

    function findUserBytokenID($tokenId) {
        $userData = $this->find('all', array('conditions' => array('key_token' => $tokenId, 'reset_password_flag' => 1)))->first();
        if (!empty($userData)) {
            return $userData->toArray();
        } else {
            return false;
        }
    }

    /* @auther Mahalaxmi    
      @params $tokenId
      @return $userData
     */

    function findUserBytokenIDForActivate($tokenId) {
        $userData = $this->find('all', array('conditions' => array('key_token' => $tokenId, 'is_deleted' => 0)))->first();
        if (!empty($userData)) {
            return $userData->toArray();
        } else {
            return false;
        }
    }

//   function for finding providers by id
    function findProviderByID($id) {
        $userData = $this->find('all', array('conditions' => array(
                        'id' => $id,
                        'is_deleted' => 0,
                        'status' => 1,
                        'role_id' => 2
                    )
                ))->first();
        if(!empty($userData)){
        return $userData->toArray();
        }else{
             return array();
        }
    }

    //   function for finding requestor 
    function findRequestorByID($id) {
        $userData = $this->find('all', array('conditions' => array(
                        'id' => $id,
//                        'is_deleted' => 0,
                        'status' => 1,
                        'role_id' => 3
                    )
                ))->first();
        if(!empty($userData)){
        return $userData->toArray();
        }else{
            return array();
        }
    }

    //   function for finding providers list
    function listProviders() {
        $userData = $this->find('all', array('conditions' => array(
                'is_deleted' => 0,
                'status' => 1,
                'role_id' => 2
            )
        ));
        return $userData->toArray(); /*

          $query = $this->find('list', [
          'keyField' => 'id',
          'valueField' => 'full_name',
          'conditions' => [
          'is_deleted' => 0,
          'status' => 1,
          'role_id' => 2
          ],
          ]);
          debug($query);
          debug($query->toList());
          exit;
          return  $query->toList(); */
    }

    /* @author Sneha G     
      @params $id
      @return card_preference_id
     */

    function getCardPreference($id) {
        $userData = $this->find('all', array(
                    'conditions' => array(
                        'id' => $id, 'is_deleted' => 0, 'status' => 1
                    ), 'fields' => array(
                        'card_preference_id'
                    )
                ))->first();
        return $userData;
    }

}
