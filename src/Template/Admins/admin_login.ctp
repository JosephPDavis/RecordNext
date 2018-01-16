<?php ?>


<div class="login-box">
  <div class="login-logo">
    <a href="#"><img src="img/logo_login.png" alt=""/></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>
    <p><?= $this->Flash->render() ?></p>
    <?= $this->Form->create('Admin', array('url' => array('controller' => 'Admins', 'action' => 'adminLogin'),'id'=>'adminSignin', 'type' => 'file'));?>
      <div class="form-group has-feedback">
       <?php echo $this->Form->input('email',array('label' => false,'div' => false, 'class' => 'form-control', 'type'=>'text'));?>              
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <?php echo $this->Form->input('password',array('label' => false,'div' => false, 'class' => 'form-control', 'type'=>'password'));?>              
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> Remember Me
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
            <?php echo $this->Form->button('Sign In', array('div' => false, 'class'=>'btn btn-info btn-block','type'=>"submit")); ?>
          <!--<button type="submit" class="btn btn-info btn-block ">Sign In</button>-->
        </div>
        <!-- /.col -->
      </div>
   <?= $this->Form->end(); ?>
    <!-- /.social-auth-links -->

    <a href="/admins/adminForgetPassword">Forgot Password ?</a><br>
<!--    <a href="register.html" class="text-center">Register a new membership</a>-->

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
<script>
jQuery(document).ready(function(){

    jQuery("#adminSignin").validate({

        errorElement: "div",
        highlight: function(element) {
            $(element).removeClass("error");
        },
        rules: {
            "data[Admin][email]":{
                required: true,
                email: true
            },
            "data[Admin][password]":{
                required: true
            }
        },
        messages:{
            "data[Admin][email]":{
                required: "Please enter email",
                email: "Please enter valid email"
            },
            "data[Admin][password]":{
                required:"Please enter password"
            }
        }
    });

// (function (global) {

//     if(typeof (global) === "undefined") {
//         throw new Error("window is undefined");
//     }

//     var _hash = "!";
//     var noBackPlease = function () {
//         global.location.href += "#";

//         // making sure we have the fruit available for juice (^__^)
//         global.setTimeout(function () {
//             global.location.href += "!";
//         }, 50);
//     };

//     global.onhashchange = function () {
//         if (global.location.hash !== _hash) {
//             global.location.hash = _hash;
//         }
//     };

//     global.onload = function () {
//         noBackPlease();

//         // disables backspace on page except on input fields and textarea..
//         document.body.onkeydown = function (e) {
//             var elm = e.target.nodeName.toLowerCase();
//             if (e.which === 8 && (elm !== 'input' && elm  !== 'textarea')) {
//                 e.preventDefault();
//             }
//             // stopping event bubbling up the DOM tree..
//             e.stopPropagation();
//         };
//     }

// })(window);

});
</script>