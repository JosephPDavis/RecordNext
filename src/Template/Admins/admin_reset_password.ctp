<?php ?>


<div class="login-box">
  <div class="login-logo">
    <a href="#"><img src="/img/logo_login.png" alt=""/></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Reset password here</p>
    <p><?= $this->Flash->render() ?></p>
    <?= $this->Form->create('User', array('url' => array('controller' => 'Admins', 'action' => 'adminResetPassword/'.$token),'id'=>'adminResetPassword'));?>
      <div class="form-group has-feedback">
        <?php echo $this->Form->input('password',array('label' => false,'div' => false, 'class' => 'form-control', 'type'=>'password','palceholder'=>'Please enter password'));?>              
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <?php echo $this->Form->input('confirm_password',array('label' => false,'div' => false, 'class' => 'form-control', 'type'=>'password','palceholder'=>'Please enter confirm password'));?>              
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
    <input type="hidden" name="token" value="<?php echo $token; ?>">
      <div class="row">
        <!-- /.col -->
        <div class="col-xs-4">
            <?php echo $this->Form->button('Reset', array('div' => false, 'class'=>'btn btn-info btn-block','type'=>"submit")); ?>
          <!--<button type="submit" class="btn btn-info btn-block ">Sign In</button>-->
        </div>
        <!-- /.col -->
      </div>
   <?= $this->Form->end(); ?>
    <!-- /.social-auth-links -->

    <a href="/admins/forgetPassword">Forgot Password ?</a><br>
<!--    <a href="register.html" class="text-center">Register a new membership</a>-->

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
<script>
jQuery(document).ready(function(){

    jQuery("#adminResetPassword").validate({

        errorElement: "div",
        highlight: function(element) {
            $(element).removeClass("error");
        },
        rules: {
            "password":{
                required: true,
                minlength: 8,
                password_strength: true
            },
            "confirm_password":{
                required: true,
                equalTo: "#password"
            }
        },
        messages:{
            "password":{
                required: "Please enter email",
            },
            "confirm_password":{
                required:"Please enter confirm password",
                equalTo: "Password does not matched."
            }
        }
    });
 
});
</script>