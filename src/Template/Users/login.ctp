<?php ?>

<div class="ui-title-page bg_title bg_transparent">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h1>Login</h1>
                <div class="ui-subtitle-page">Egestas dolor erat vamus suscip ipsum estduin</div>
            </div>
        </div>
    </div>
</div><!-- end ui-title-page -->
  <?= $this->Flash->render() ?>
<main class="main-content">
    <section class="section loginInfo">
        <div class="container">

<?= $this->Form->create('User', array('class'=>'form-appointment ui-form', 'id' => 'login','novalidate'=>true)) ?>
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <div class="input-group">
                            <?= $this->Form->control('email', ['class' => '', 'id'=>'email_id', 'required'=>'required', 'placeholder'=>'Enter Email', 'label'=>false]) ?>
                        <!--<input type="text" placeholder="Email Address">-->
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-md-4 col-md-offset-4">
                    <div class="input-group">
                            <?= $this->Form->control('password', ['class' => '','type' => 'password', 'id'=>'password', 'required'=>'required', 'placeholder'=>'Enter Password', 'label'=>false]) ?>
<!--                            <input type="passowrd" placeholder="Email Password">-->
                    </div>
                </div>

                <div class="clearfix"></div>
                <div class="col-md-4 col-md-offset-4">
                    <input type="checkbox"> Remember Me

                    <div class="pull-right">
	 <?php echo $this->Html->link('Forgot Password?',['controller' => 'Users', 'action' => 'forgotPassword', '_full' => true],['class'=>'']);?>
                    </div>

                </div>
                <div class="clearfix"></div>
                <div class="col-md-4 col-md-offset-4">
                 <?= $this->Form->button('LOGIN', array('div' => false, 'class'=>'btn bg-color_primary','type'=>'submit')); ?>
                        <?php //echo $this->Form->button(__('LOGIN'), ['class' => 'btn bg-color_primary']); ?>
                        <?php // echo $this->Html->link('Login',['controller' => 'requestor', 'action' => 'requestorsDashboard', '_full' => true],['class'=>'btn bg-color_primary']);?>
                    <!--<button class="btn bg-color_primary" type="button">Login </button>-->
                </div>
            </div>



            <!-- end row -->
         <?= $this->Form->end() ?><!-- end form-appointment -->
        </div><!-- end container -->
    </section><!-- end section -->


</main><!-- end main-content -->
<script>
    jQuery(document).ready(function () {

        jQuery("#login").validate({
            errorElement: "div",
            highlight: function (element) {
                $(element).removeClass("error");
            },
            rules: {
                "email": {
                    required: true,
                    email: true
                },
                "password": {
                    required: true
                }
            },
            messages: {
                "email": {
                    required: "Please enter email",
                    email: "Please enter valid email"
                },
                "password": {
                    required: "Please enter password"
                }
            }
        });



    });
</script>