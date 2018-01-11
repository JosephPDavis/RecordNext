<?php ?>

<div class="ui-title-page bg_title bg_transparent">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h1>Registration</h1>
                <div class="ui-subtitle-page">As Provider</div>
            </div>
        </div>
    </div>
</div><!-- end ui-title-page -->
<?= $this->Flash->render() ?>
<main class="main-content">
    <section class="section loginInfo">
        <div class="container">

<?= $this->Form->create('User', array('class'=>'form-appointment ui-form', 'id' => 'provider_register')) ?>
            <!--<form class="form-appointment ui-form" action="/provider/providersDashboard/" novalidate>-->
                <div class="row">
                    <div class="col-md-5 col-md-offset-1">
                        <div class="input-group">
                            <?= $this->Form->control('first_name', ['class' => '', 'id'=>'first_name', 'required'=>'required', 'placeholder'=>'Enter First Name', 'label'=>false,'tabindex'=>1]) ?>
                            <!--<input type="text" placeholder="First Name">-->
                        </div>
                        <div class="input-group">
                            <?= $this->Form->control('email', ['class' => '', 'id'=>'email', 'required'=>'required', 'placeholder'=>'Enter Email', 'label'=>false,'tabindex'=>1]) ?>
                            <!--<input type="text" placeholder="Email Address">-->
                        </div>
<!--                        <div class="input-group">
                            <input class="datetimepicker" type="text" placeholder="Date Of Birth">
                            <i class="icon icon-calendar"></i>
                        </div>-->
                        <div class="input-group">
                            <?= $this->Form->control('password', ['class' => '','type' => 'password', 'id'=>'password', 'required'=>'required', 'placeholder'=>'Enter Password', 'label'=>false,'tabindex'=>1]) ?>
                            <!--<input type="password" placeholder="Password">-->
                        </div>
                        <?php $providerType=[
                            1=>'Doctor',
                            2=>'Hospitals'
                        ];?>
                        <div role="select" class="jelect">
                                                    <?= $this->Form->control('last_name', ['class' => 'jelect', 'type' => 'select', 'options' => $providerType ,'id'=>'provider_type', 'required'=>'required', 'empty'=>'Select Provider Type', 'label'=>false]) ?>

                        </div>

                    </div>
                    <div class="col-md-5">
                        <div class="input-group">
                            <?= $this->Form->control('last_name', ['class' => '', 'id'=>'last_name', 'required'=>'required', 'placeholder'=>'Enter Last Name', 'label'=>false,'tabindex'=>2]) ?>
                            <!--<input type="text" placeholder="Last Name">-->
                        </div>
                        <div class="input-group">
                            <?= $this->Form->control('phone', ['class' => '', 'id'=>'phone', 'required'=>'required', 'placeholder'=>'Enter Phone Number', 'label'=>false]) ?>
                            <!--<input type="tel" placeholder="Phone #">-->
                        </div>
                        <div class="input-group">
                            <?= $this->Form->control('confirm_password', ['class' => '','type' => 'password', 'id'=>'password', 'required'=>'required', 'placeholder'=>'Enter Confirm Password', 'label'=>false]) ?>
                            <!--<input type="password" placeholder="Confirm Password">-->
                        </div>
                        
                        <!--              <div role="select" class="jelect">
                                        <input id="jelect" name="tool" value="0" data-text="imagemin" type="text" class="jelect-input">
                                        <div tabindex="0" role="button" class="jelect-current">Select your Gender</div>
                                        <ul class="jelect-options">
                                          <li data-val='0' tabindex="0" role="option" class="jelect-option jelect-option_state_active">Male</li>
                                          <li data-val='1' tabindex="0" role="option" class="jelect-option">Female</li>
                                        </ul>
                                      </div>-->
                    </div>
                </div><!-- end row -->
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <!--              <div class="input-group">
                                        <input type="text" placeholder="Subject  /  Brief Description">
                                      </div>-->
                        <div class="input-group">
                            <?= $this->Form->textarea('notes',['id'=>'desc','placeholder'=>'Brief Description','rows' => '6']); ?>
                            <!--<textarea id="comment-text" placeholder="Subject  /  Brief Description" name="comment" required rows="6"></textarea>-->
                        </div>
                        <?= $this->Form->button(__('Registration'), ['class' => 'btn bg-color_primary']); ?>
                        <!--<button class="btn bg-color_primary" type="submit">Registration</button>-->
                    </div>
                </div><!-- end row -->
            <?= $this->Form->end() ?><!-- end form-appointment -->
        </div><!-- end container -->
    </section><!-- end section -->


</main><!-- end main-content -->