<?php

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Core\Configure;
use Cake\Event\Event;
use Cake\Utility\Security;
use Cake\ORM\TableRegistry;
use Cake\I18n\Time;
use Cake\Mailer\Email;


class CommonComponent extends Component {

    /**
     * Components
     *
     * @var array
     */
    public $components = ['Cookie', 'Auth', 'RequestHandler'];

    //private $publicAccess = array('register', 'facebookLogin', 'verifyLoginDetails', 'forgotPassword', 'getRideListsForAllUsers','getDashboardStats');
    //const PUBLIC_SECURITY_KEY = 'bfd8acd8223afc46cc914c48205b45de75a1dbb76d6dff159c8ef7d54baf65bc';

    /**
     * Initialize config data and properties.
     *
     * @param array $config The config data.CommonComponent
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);
        
//        $this->controler = $this->_registry->getController();
    }

    

    public function sendEmail($userId, $subject, $userEmail, $template, $emailData = []) {
        if (empty($template)) {
            return false;
        }
        $email = new Email();
        $email->profile(['transport' => 'gmail']);
        $email->viewVars(compact('userId', 'userEmail', 'emailData'));
        $email->template($template, 'default')
                ->emailFormat('html')
                ->subject($subject)
                ->to($userEmail)
                // ->bcc('paragc@smartdatainc.net')
                ->from('recordnextmrr@gmail.com');
        $email->send();
        return true;
    }

    /**
     * Upload Original Image
     * @author       Mahalaxmi
     * @copyright     smartData Enterprise Inc.
     * @method        image_upload
     * @param         $file, $path, $folder_name, $thumb, $multiple
     * @return        $filename or $err_type
     * @since         version 0.0.1
     * @version       0.0.1 
     */
    public function upload_image($file, $path, $folder_name, $thumb = false, $multiple = array()) {
        // Variable containing File type
        $extType = $file['type'];
        // Variable containing extension in lowercase 
        $ext = strtolower($extType);
        // Condition checking File extension
        //if($ext=='image/jpg' || $ext=='image/png' || $ext=='image/jpeg' || $ext=='image/gif'){     
        if ($ext == 'application/pdf' || $ext == 'application/msword' || $ext == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document') {

            // Condition checking File size
            if ($file['size'] <= 10485760) {

                // Filename 
                $filename = time() . '_' . $file['name'];

                // Folder path
                $folder_url = WWW_ROOT . $path . '/' . $folder_name;

                // Condition checking File exist or not 
                if (!file_exists($folder_url . '/' . $filename)) {

                    // create full filename
                    $full_url = $folder_url . '/' . $filename;

                    // upload the file    
                    //debug($file);

                    $success = move_uploaded_file($file['tmp_name'], $full_url);
                    // debug($success);
                    //exit; 
                    //
                    if ($thumb) {
                        // If multiple folder upload required then pass TRUE as last parameter
                        $this->upload_thumb_image($filename, $path, $folder_name, $multiple);
                    }

                    return $filename;
                } else {
                    return 'exist_error';
                }
            } else {
                return 'size_mb_error';
            }
        } else {
            return 'type_error';
        }
    }

    /**
     * Upload Thumb Image
     * @author       Mahalaxmi Nakade
     * @copyright     smartData Enterprise Inc.
     * @method        upload_thumb_image
     * @param         $filename, $path, $folder_name, $multiple
     * @return        void
     * @since         version 0.0.1
     * @version       0.0.1 
     */
    /* public function upload_thumb_image($filename, $path, $folder_name, $multiple = array()){

      // image path from where pic taken
      $dircover = str_replace(chr(92),chr(47),getcwd()).'/'.$path.'/'.$folder_name.'/'.$filename;
      if(!empty($multiple) && count($multiple)> 0){
      foreach($multiple as $result){
      $this->Easyphpthumbnail-> Thumblocation = str_replace(chr(92),chr(47),getcwd()).'/'.$path.'/'.$result['folder_name'].'/';
      $this->Easyphpthumbnail-> Thumbheight = $result['height'];
      $this->Easyphpthumbnail-> Thumbwidth =  $result['width'];
      $this->Easyphpthumbnail-> Createthumb($dircover,'file');
      }
      }
      }
     */

    /**
     * Handle image errors
     * @author        Anuj Kumar
     * @copyright     smartData Enterprise Inc.
     * @method        is_image_error
     * @param         $image_name
     * @return        error msg
     * @since         version 0.0.1
     * @version       0.0.1 
     */
    public function is_image_error($image_name = null) {
        $errmsg = '';
        switch ($image_name) {
            case 'exist_error':
                $errmsg = 'File already exist.';
                break;

            case 'size_mb_error':
                $errmsg = 'Only mb of file is allowed to upload.';
                break;

            case 'type_error':
                //$errmsg = 'Only JPG, JPEG, PNG & GIF are allowed.';
                $errmsg = 'Only pdf ,doc and docx is allowed.';
                break;
        }
        return $errmsg;
    }

    /**
     * Card Preference Exist
     * @author       Sneha G
     * @copyright     smartData Enterprise Inc.
     * @method        getCardPreference
     * @param         $id (user id)
     * @return        card_preference_id
     */
//    public function getCardPreference($userId) {
//       $userTable = ClassRegistry::get('users');
//        $userData = $userTable->find('first', array(
//            'conditions' => array(
//                'User.id' => $userId)
//                )
//        );
//        return $userData;
//    }

}
