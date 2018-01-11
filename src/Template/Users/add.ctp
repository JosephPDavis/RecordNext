<!-- container section start -->
<section id="container" class="">
	<!--main content start-->
	<section id="main-content">
		<section class="wrapper">            
	      	<!--overview start-->
			<div class="row">
				<div class="col-lg-12">
			        <section class="panel">
			        	<header class="panel-heading">Add New User</header>
			            <div class="panel-body">
							<?= $this->Form->create($user, array('class'=>'form-validate form-horizontal', 'id' => 'register_form')) ?>
							  <div class="form-group ">
							      <label for="first_name" class="control-label col-lg-2">First Name <span class="required">*</span></label>
							      <div class="col-lg-10">
							      	<?= $this->Form->control('first_name', ['class' => 'form-control', 'id'=>'first_name', 'required'=>'required', 'label'=>false]) ?>
							      </div>
							  </div>
							  <div class="form-group ">
							      <label for="last_name" class="control-label col-lg-2">Last Name <span class="required">*</span></label>
							      <div class="col-lg-10">
							      	<?= $this->Form->control('last_name', ['class' => 'form-control', 'id'=>'last_name', 'required'=>'required', 'label'=>false]) ?>
							      </div>
							  </div>
							  <div class="form-group ">
							      <label for="username" class="control-label col-lg-2">Username <span class="required">*</span></label>
							      <div class="col-lg-10">
							      	<?= $this->Form->control('username', ['class' => 'form-control', 'id'=>'username', 'required'=>'required', 'label'=>false]) ?>
							      </div>
							  </div>
							  <div class="form-group ">
							      <label for="email" class="control-label col-lg-2">Email <span class="required">*</span></label>
							      <div class="col-lg-10">
							      	<?= $this->Form->control('email', ['class' => 'form-control', 'id'=>'email', 'required'=>'required', 'label'=>false]) ?>
							      </div>
							  </div>
							  <div class="form-group ">
							      <label for="role" class="control-label col-lg-2">Role <span class="required">*</span></label>
							      <div class="col-lg-10">
							        <?= $this->Form->control('role', [
							            'options' => ['author' => 'Author', '	admin' => 'Admin'], 'class' => 'form-control', 'required'=>'required', 'label'=>false
							        ]) ?>
							      </div>
							  </div>
							  <div class="form-group ">
							      <label for="phone" class="control-label col-lg-2">Phone <span class="required">*</span></label>
							      <div class="col-lg-10">
							        <?= $this->Form->control('phone', ['class' => 'form-control', 'id'=>'phone', 'required'=>'required', 'label'=>false]) ?>
							      </div>
							  </div>
							  <div class="form-group ">
							      <label for="gender" class="control-label col-lg-2">Gender <span class="required">*</span></label>
							      <div class="col-lg-10">
							        <?= $this->Form->radio('gender', ['Male','Female'], ['id'=>'gender', 'required'=>'required', 'label' => ['class' => 'radio-inline']]);
							        ?>
							      </div>
							  </div>
							  <div class="form-group ">
							      <label for="address" class="control-label col-lg-2">Address <span class="required">*</span></label>
							      <div class="col-lg-10">
							        <?= $this->Form->control('address', ['class' => 'form-control', 'id'=>'address', 'required'=>'required', 'label'=>false]) ?>
							      </div>
							  </div>
							  <div class="form-group ">
							      <label for="password" class="control-label col-lg-2">Password <span class="required">*</span></label>
							      <div class="col-lg-10">
							      	<?= $this->Form->control('password', ['class' => 'form-control', 'id'=>'password', 'required'=>'required', 'label'=>false, 'type' => 'password']) ?>
							      </div>
							  </div>
							  <div class="form-group ">
							      <label for="confirm_password" class="control-label col-lg-2">Confirm Password <span class="required">*</span></label>
							      <div class="col-lg-10">
							        <?= $this->Form->control('confirm_password', ['class' => 'form-control', 'id'=>'confirm_password', 'required'=>'required', 'label'=>false, 'type' => 'password']) ?>
							      </div>
							  </div>
							  <div class="form-group">
							      <div class="col-lg-offset-2 col-lg-10">
							      	  <?= $this->Form->button(__('Save'), ['class' => 'btn btn-primary']); ?>
							      </div>
							  </div>
							<?= $this->Form->end() ?>
                        </div>
                    </section>
                </div>
            </div>
        </section>
    </section>
<section>