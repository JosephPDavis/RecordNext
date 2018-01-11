<?php?>



<div class="ui-title-page bg_title bg_transparent">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h1>Forgot Password</h1>
                <div class="ui-subtitle-page">Egestas dolor erat vamus suscip ipsum estduin</div>
            </div>
        </div>
    </div>
</div><!-- end ui-title-page -->
  <?= $this->Flash->render() ?>
<main class="main-content">
    <section class="section loginInfo">
        <div class="container">

<?= $this->Form->create('User', array('class'=>'form-appointment ui-form', 'id' => 'forgetPassword','novalidate'=>true)) ?>
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <div class="input-group">
                            <?= $this->Form->control('email', ['class' => '', 'id'=>'email_id', 'required'=>'required', 'placeholder'=>'Enter Email', 'label'=>false]) ?>
                        <!--<input type="text" placeholder="Email Address">-->
                    </div>
                </div>
                <div class="clearfix"></div>
                
                <div class="col-md-4 col-md-offset-4">
                        <?= $this->Form->button(__('Submit'), ['class' => 'btn bg-color_primary']); ?>
                      <?php echo $this->Html->link('Back to Login',['controller' => 'Users', 'action' => 'login', '_full' => true],['class'=>'btn bg-color_primary pull-right','escape' => false]);?>
                        
                </div>
            </div>



            <!-- end row -->
         <?= $this->Form->end() ?><!-- end form-appointment -->
        </div><!-- end container -->
    </section><!-- end section -->


</main><!-- end main-content -->
<script>
    jQuery(document).ready(function () {

        jQuery("#forgetPassword").validate({
            errorElement: "div",
            highlight: function (element) {
                $(element).removeClass("error");
            },
            rules: {
                "email": {
                    required: true,
                    email: true
                }
            },
            messages: {
                "email": {
                    required: "Please enter email",
                    email: "Please enter valid email"
                }
            }
        });



    });
</script>