<?php?>



<div class="ui-title-page bg_title bg_transparent">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h1>Reset Password</h1>
                <div class="ui-subtitle-page">Egestas dolor erat vamus suscip ipsum estduin</div>
            </div>
        </div>
    </div>
</div><!-- end ui-title-page -->
  <?= $this->Flash->render() ?>
<main class="main-content">
    <section class="section loginInfo">
        <div class="container">

<?= $this->Form->create('User', array('class'=>'form-appointment ui-form', 'id' => 'reset_login','novalidate'=>true)) ?>
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <div class="input-group">
                            <?= $this->Form->control('password', ['class' => '', 'id'=>'password', 'required'=>'required', 'placeholder'=>'New Password', 'label'=>false,'type'=>'password','maxlength'=>30]) ?>                        
                    </div>
                </div>
                <div class="clearfix"></div>

                <div class="col-md-4 col-md-offset-4">
                    <div class="input-group">
                           <?= $this->Form->control('confirm_password', ['class' => '', 'id'=>'confirm_password', 'required'=>'required', 'placeholder'=>'Confirm Password', 'label'=>false,'type'=>'password','maxlength'=>30]) ?>                     
                    </div>
                </div>
                <div class="clearfix"></div>
                
                <div class="col-md-4 col-md-offset-4">
                        <?= $this->Form->button(__('Submit'), ['class' => 'btn bg-color_primary']); ?>        
                </div>
            </div>
            <!-- end row -->
         <?= $this->Form->end() ?><!-- end form-appointment -->
        </div><!-- end container -->
    </section><!-- end section -->


</main><!-- end main-content -->
<script>
    jQuery(document).ready(function () {

        jQuery("#reset_login").validate({
            errorElement: "div",
            highlight: function (element) {
                $(element).removeClass("error");
            },
            rules: {
                "password": {
                    required: true,
                    password_strength: true
                },
                 "confirm_password": {
                    required: true,
                    equalTo: "#password"
                }
            },
            messages: {
                "password": {
                    required: "Please enter new password"
                    
                },
                "confirm_password": {
                    required: "Please enter confirm password",
                    equalTo: "Confirm password does not matched with password."
                }
            }
        });



    });
</script>