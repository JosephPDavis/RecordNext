<?php 
//use Cake\Routing\Router;
use Cake\Utility\Security;
use Cake\Core\Configure;
use Cake\Core\Configure\Engine\PhpConfig;
?>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                    <td>      
                        <table align="center" border="0" cellpadding="0" cellspacing="0" width="600px" id="parent_tbl">
                            <tr>
                                <td>
            <table width="600px" align="center" cellpadding="0" cellspacing="0" id="child_tbl" style=" background:#fff;">
             
                <tr>    
                    <td style=" padding:20px 30px 0 30px">
                        Hello <?php echo $emailData['first_name']." ".$emailData['last_name'];
                           $link = SITE_URL."users/activationLink/".$emailData['hashCode'];?>,<br/>
                              &nbsp;&nbsp;  You have registered successfully click on below link to activate account.<br/>
                        <a href="<?php echo $link ;?>">Click Here</a><br/><br/>             
                        
        <h5>Thank you,</h5>
                    </td>
                </tr>
                
               
            </table>
                                </td>
                            </tr>
                        </table>
                     </td>
                </tr>
            </table>