<?php 
//pr($loggedInUsersId);

?>

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Change Password
      </h1>
      <ol class="breadcrumb">
        <li>
            <?php
            if($userSession['role_id'] ==2){
                echo $this->Html->link('Dashboard<i class="fa fa-dashboard"></i> ',['controller' => 'Providers', 'action' => 'providersDashboard', '_full' => true],['class'=>'','escape'=>false]);
            }elseif($userSession['role_id'] ==3){
                echo $this->Html->link('Dashboard<i class="fa fa-dashboard"></i> ',['controller' => 'Requestors', 'action' => 'requestorsDashboard', '_full' => true],['class'=>'','escape'=>false]);
            }    
                ?>
        </li>
        <li class="active">Change Password</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

      <!--------------------------
        | Your Page Content Here |
        -------------------------->
        <div class="row">
        
        <!-- ./col -->       
        <!-- ./col -->
       <div class="col-md-12">
          <!-- Horizontal Form -->
          <div class="box ">
            <div class="box-header ">
              <h3 class="box-title"></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
             <?= $this->Form->create('User', array('class'=>'form-horizontal ui-form', 'id' => 'change_password')) ?>
          
              <div class="box-body">
                <div class="form-group">
                  <label for="" class="col-sm-3 control-label">Old Password</label>

                  <div class="col-sm-3">
                     <?= $this->Form->control('current_password', ['class' => 'form-control', 'id'=>'current_password', 'required'=>'required', 'placeholder'=>'Old Password', 'label'=>false,'type'=>'password','maxlength'=>30]) ?>
                  </div>
                </div>
                    <div class="form-group">
                  <label for="" class="col-sm-3 control-label">New Password</label>

                  <div class="col-sm-3">
                     <?= $this->Form->control('password', ['class' => 'form-control', 'id'=>'password', 'required'=>'required', 'placeholder'=>'New Password', 'label'=>false,'type'=>'password','maxlength'=>30]) ?>
                  </div>
                </div>
                   <div class="form-group">
                  <label for="" class="col-sm-3 control-label">Confirm  Password</label>

                  <div class="col-sm-3">
                    <?= $this->Form->control('confirm_password', ['class' => 'form-control', 'id'=>'confirm_password', 'required'=>'required', 'placeholder'=>'Confirm Password', 'label'=>false,'type'=>'password','maxlength'=>30]) ?>
                  </div>
                </div>
              
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <?php echo $this->Html->link('Cancel',['controller' => 'Users', 'action' => 'companyProfile',$loggedInUsersId, '_full' => true],['class'=>'btn btn-default']);?>  
                <!--<button type="submit" class="btn btn-default">Cancel</button>-->
                <button type="submit" class="btn btn-info pull-right">Change Password</button>
              </div>
              <!-- /.box-footer -->
             <?= $this->Form->end() ?><!-- end form-change password -->
          </div>
         
          <!-- /.box -->
        </div>
     
        <!-- ./col -->
      </div>

    </section>
    <!-- /.content -->
<script>
    jQuery(document).ready(function () {

        jQuery("#change_password").validate({
            errorElement: "div",
            highlight: function (element) {
                $(element).removeClass("error");
            },
            rules: {
                "current_password": {
                    required: true,
                },
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
                "current_password": {
                    required: "Please enter current password",
                },
                "password": {
                    required: "Please enter password"
                },
                "confirm_password": {
                    required: "Please enter confirm password",
                    equalTo: "Confirm password does not matched with password."
                }
            }
        });
});
</script>