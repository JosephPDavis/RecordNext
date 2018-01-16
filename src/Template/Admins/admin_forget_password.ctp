<?php ?>


<div class="login-box">
  <div class="login-logo">
    <a href="#"><img src="/img/logo_login.png" alt=""/></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Admin Forget Password</p>
    <p><?= $this->Flash->render() ?></p>
    <?= $this->Form->create('User', array('url' => array('controller' => 'Admins', 'action' => 'adminForgetPassword'),'id'=>'adminforgetPassword', 'type' => 'file'));?>
      <div class="form-group has-feedback">
       <?php echo $this->Form->input('email',array('label' => false,'div' => false, 'class' => 'form-control', 'type'=>'text','palceholder'=>'Please enter email'));?>              
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
         
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
            <?php echo $this->Form->button('submit', array('div' => false, 'class'=>'btn btn-info btn-block','type'=>"submit")); ?>
        </div>
        <!-- /.col -->
      </div>
   <?= $this->Form->end(); ?>
  
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
<script>
jQuery(document).ready(function(){

    jQuery("#adminforgetPassword").validate({

        errorElement: "div",
        highlight: function(element) {
            $(element).removeClass("error");
        },
        rules: {
            "data[User][email]":{
                required: true,
                email: true
            }
            
        },
        messages:{
            "data[User][email]":{
                required: "Please enter email",
                email: "Please enter valid email"
            }
        }
    });


});
</script>