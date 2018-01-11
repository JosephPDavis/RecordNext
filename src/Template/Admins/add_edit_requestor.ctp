<?php

//$id=$this->Common->encrypt($userData['id']);
//pr($id);
?>
<style>
    .datepicker-custom{
        margin-bottom: 15px;
    }
</style>
<section class="content-header">
    <h1>
        <?php if(!empty($userData)){
            $text ='Edit';
        }else{
            $text ='Add';
        }?>
       <?php echo $text;?> Requester
    </h1>
    <ol class="breadcrumb">
        <li>
            <?php $roleId=$this->request->session()->read('LoginUser')['role_id'];
               echo $this->Html->link('Dashboard<i class="fa fa-dashboard"></i> ',['controller' => 'Admins', 'action' => 'dashboard', '_full' => true],['class'=>'','escape'=>false]); 
            ?>
            <!--<a href="#"><i class="fa fa-dashboard"></i> Level</a>-->
        </li>
        <li class="active"><?php echo $text;?> requester</li>
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
                <div class="box-header with-border">
                    <h3 class="box-title">Requester Details</h3>
                </div>
                <div class="col-md-12">
<!--                    <div>
                        <div class="col-md-2 pull-right" style="margin-top: 20px;">    
                      <?php echo $this->Html->link('Change Password',['controller' => 'Users', 'action' => 'changePassword', '_full' => true],['class'=>'btn btn-info','escape' => false]);?>
                        </div>
                    </div>-->
               <?php //echo $this->Session->flash(); ?>
          <?=  $this->Form->create($user, array('class'=>'form-appointment ui-form', 'id' => 'requestorRegistration', 'type' => 'file', 'novalidate' => true, 'name' => 'User')) ?>
          <?php echo $this->Form->input('id',array('label' => false,'div' => false,'value'=>$id, 'type'=>'hidden'));?>                           
          <div class="nav-tabs-custom">
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_1">
                                <div class="form-group">
                                    <div class="row">
                                        <label for="" class="col-sm-3 required-label  control-label">First Name</label>
                                        <div class="col-sm-4">
                  <?php echo $this->Form->input('first_name',array('label' => false,'div' => false,'class' => 'form-control','value'=>isset($userData['first_name'])?$userData['first_name']:'' ,'type'=>'text','maxlength'=>20));?>                 
                                        </div></div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <label for="" class="col-sm-3 required-label control-label">Last Name</label>

                                        <div class="col-sm-4">
                     <?php echo $this->Form->input('last_name',array('label' => false,'div' => false , 'class' => 'form-control','value'=>isset($userData['last_name'])?$userData['last_name']:'','type'=>'text','maxlength'=>20));?>              
                                        </div></div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <label for="" class="col-sm-3 required-label control-label">Email Address</label>

                                        <div class="col-sm-4">
                     <?php 
                     if(!empty($userData)){
                        echo $this->Form->control('email', ['class' => '', 'id'=>'email', 'required'=>'required', 'placeholder'=>'Enter Email', 'value'=>isset($userData['email'])?$userData['email']:'','label'=>false,'readonly'=>'readonly', 'class' => 'form-control']);
                     }else{
                        echo $this->Form->control('email', ['id'=>'email', 'required'=>'required', 'placeholder'=>'Enter Email', 'label'=>false, 'class' => 'form-control']);
                     }
                      ?>              
                     <?php // $this->Form->control('User.email', ['class' => '', 'id'=>'email', 'required'=>'required', 'placeholder'=>'Enter Email', 'label'=>false,'readonly'=>'readonly', 'class' => 'form-control']); ?>              
                                        </div></div>
                                </div>
                                <?php if(!empty($userData)){
                                    
                                }else {?>
                                <div class="form-group">
                                    <div class="row">
                                        <label for="" class="col-sm-3 required-label control-label">Password</label>

                                        <div class="col-sm-4">
                     <?= $this->Form->control('password', ['type'=>'password','id'=>'password', 'required'=>'required', 'placeholder'=>'Enter password', 'label'=>false, 'class' => 'form-control']) ?>              
                     <?php // $this->Form->control('User.email', ['class' => '', 'id'=>'email', 'required'=>'required', 'placeholder'=>'Enter Email', 'label'=>false,'readonly'=>'readonly', 'class' => 'form-control']); ?>              
                                        </div></div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <label for="" class="col-sm-3 required-label control-label">Confirm Password</label>

                                        <div class="col-sm-4">
                     <?= $this->Form->control('confirm_password', ['type'=>'password', 'id'=>'confirm_password', 'required'=>'required', 'placeholder'=>'Enter confirm password', 'label'=>false, 'class' => 'form-control']) ?>              
                     <?php // $this->Form->control('User.email', ['class' => '', 'id'=>'email', 'required'=>'required', 'placeholder'=>'Enter Email', 'label'=>false,'readonly'=>'readonly', 'class' => 'form-control']); ?>              
                                        </div></div>
                                </div>
                                <?php }?>
                                <div class="form-group">
                                    <div class="row">
                                        <label for="" class="col-sm-3 required-label control-label">Street Address  </label>

                                        <div class="col-sm-4">
                   <?php echo $this->Form->input('street_address',array('label' => false,'div' => false , 'value'=>isset($userData['street_address'])?$userData['street_address']:'', 'class' => 'form-control', 'type'=>'text','maxlength'=>20));?>    
                                        </div></div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <label for="" class="col-sm-3 required-label control-label">City</label>

                                        <div class="col-sm-4">
                   <?php echo $this->Form->input('city',array('label' => false,'div' => false, 'value'=>isset($userData['city'])?$userData['city']:'', 'class' => 'form-control', 'type'=>'text','maxlength'=>20));?>  
                                        </div></div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <label for="" class="col-sm-3 required-label control-label">State</label>

                                        <div class="col-sm-4">
                  <?php echo $this->Form->input('state',array('label' => false,'div' => false, 'value'=>isset($userData['state'])?$userData['state']:'' , 'class' => 'form-control', 'type'=>'text','maxlength'=>20));?>  
                                        </div></div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <label for="" class="col-sm-3 required-label control-label">Country </label>

                                        <div class="col-sm-4">
                   <?php 
                   echo $this->Form->input('country_id',array('label' => false,'div' => false,'options'=>$countryList , 'class' => 'form-control', 'type'=>'select', 'empty'=>'please select country', 'value'=>isset($userData['country_id'])?$userData['country_id']:''));?>  
                                        </div></div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <label for="" class="col-sm-3 required-label control-label">Zip Code </label>

                                        <div class="col-sm-4">
                   <?php echo $this->Form->input('zip_code',array('label' => false,'div' => false,'value'=>isset($userData['zip_code'])?$userData['zip_code']:'' , 'class' => 'form-control', 'type'=>'text','maxlength'=>15));?>  
                                        </div></div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <label for="" class="col-sm-3 control-label required-label">Phone No </label>

                                        <div class="col-sm-4">
                    <?php echo $this->Form->input('phone',array('label' => false,'div' => false, 'value'=>isset($userData['phone'])?$userData['phone']:'','class' => 'form-control', 'type'=>'text','maxlength'=>15));?>  
                                        </div></div>
                                </div>
                                 <div class="form-group">
                                 <div class="row">
                                  <label for="" class="col-sm-3 control-label">Select requester type </label>
                
                                  <div class="col-sm-4">
                    <?php $typeArr =[1=>'Lawyer',2=>'Insurance'];
                    echo $this->Form->input('type',array('label' => false,'type'=>'select','options'=>$typeArr,'empty'=>'Select requestor type','div' => false, 'class' => 'form-control','value'=>isset($userData['type'])?$userData['type']:''));?>  
                                  </div></div>
                                </div>   
                                <hr>  
                                <div class="box-header with-border">
                                    <h3 class="box-title">Company Details</h3>
                                </div>
                                <br>
                                <div class="form-group">
                                    <div class="row">
                                        <label for="" class="col-sm-3 control-label">Company Name
                                        </label>

                                        <div class="col-sm-4">
                    <?php echo $this->Form->input('company_name',array('label' => false,'div' => false, 'class' => 'form-control', 'type'=>'text','maxlength'=>20,'value'=>isset($userData['company_name'])?$userData['company_name']:''));?>       
                                        </div></div>
                                </div>


              <?php // if($roleId == 2){?>

<!--                                <div class="form-group">
                                    <div class="row">
                                        <label for="" class="col-sm-3 control-label">Department</label>
                                        <div class="col-sm-4">
                   <?php //$deptArr=array('Department 1','Department 2','Department 3','Department 4','Department 5');
//                   echo $this->Form->hidden('hidden_department',array('value'=>(isset($userData['department'])&& isset($userData['department']))?$userData['department']:'','id'=>'hiddenDepartment'));
//                  echo $this->Form->input('department',array('label' => false,'div' => false,'value'=>$userData['department'] ,'options'=>array(), 'class' => 'form-control','department'));?> 
                                            <section id="stateloader" class="loader_img_state" style="display:none;"><?php echo $this->Html->image('ajax-loader.gif'); ?></section>

                                            <div class="clearfix"></div>  
                                             
                                             <select class="form-control">
                                              <option>Department 1</option>
                                              <option>Department 2</option>
                                              <option>Department 3</option>
                                              <option>Department 4</option>
                                              <option>Department 5</option>
                                            </select> 
                                        </div>

                                        <a href="javascript:void(0)" class="addDepartment"  data-toggle="modal" data-target="#deptModal"><i class="fa fa-plus-circle" ></i></a>
                                    </div>


                                </div>-->
                <?php //  }?>
                                <div class="form-group">
                                    <div class="row">
                                        <label for="" class="col-sm-3 control-label">About Company </label>

                                        <div class="col-sm-4">
                   <?php echo $this->Form->textarea('about_company',array('label' => false,'div' => false , 'class' => 'form-control','maxlength'=>200,'value'=>isset($userData['about_company'])?$userData['about_company']:''));?> 
                                        </div></div>
                                </div>  
                                <div class="box-footer">
                    <?php 
                        echo $this->Html->link('Cancel ',['controller' => 'Admins', 'action' => 'requestors', '_full' => true],['class'=>'btn btn-default','escape'=>false]); 
                     ?>
                                    <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-info pull-right','type'=>'submit']) ?>
                                    <!--<button type="submit" class="btn btn-info pull-right">Submit</button>-->
                                </div>
                            </div>
                            <!-- /.tab-pane -->
<!--                            <div class="tab-pane" id="tab_2">

                                <div class="box-footer">

                                    <button type="submit" class="btn btn-default">Cancel</button>
                <?php echo $this->Form->button('Update', array('div' => false, 'class'=>'btn primary-btn')); ?>
                                </div>

                            </div>-->
                            <!-- /.tab-pane -->

                        </div>
                        <!-- /.tab-content -->
                    </div>
           <?php echo $this->Form->end(); ?>
          <?php

	?>

                    <!--BOF- Modal Department-->

<!--                    <div class="modal fade" id="deptModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
    <?= $this->Form->create(isset($department)?$department:'', array('class'=>'form-appointment ui-form', 'id' => 'addDepartmentForm','novalidate'=>true, 'type' => 'file')) ?>
                              <form id="addDepartment" action="javascript:void(0)"> 
                            <div class="modal-content">
                                 Modal Header 
                                <div class="modal-header"><strong>Add Department</strong>
                                    <button type="button" class="close" 
                                            data-dismiss="modal">
                                        <span aria-hidden="true">&times;</span>
                                        <span class="sr-only">Close</span>
                                    </button>
                                </div>            
                                <div class="modal-body">

                                    <div class="form-group">
                                        <div class="row">
                                            <label for="" class="col-sm-3 control-label">Department Name  </label>

                                            <div class="col-sm-4">
                                    <?php
                    echo $this->Form->input('name', array('type' => 'text', 'label' => false, 'id' => 'dept_name', 'div' => false, 'class' => 'form-control','placeholder'=>"Enter department name"));
                ?>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <div class="col-lg-12">
                    <?php echo $this->Form->button('Save', array('div' => false, 'class'=>'btn primary-btn', 'id'=>'saveDept')); ?>
                                    </div>
                                </div>
                            </div>
        <?php echo $this->Form->end(); ?>
                        </div>
                    </div>-->
                    <!--EOF- Modal Department-->
                    <div class="clearfix"></div>
                </div>  <div class="clearfix"></div>
            </div>

            <!-- /.box -->
        </div>

        <!-- ./col -->
    </div>

</section>
<script>
    function fetchDepartments() {
        var newOptions = '';
        // $("#stateloader").show();
        $.ajax({
            type: "POST",
            url: "/admins/getDepartment",
            success: function (sdata) {
                var obj = JSON.parse(sdata);
                if (jQuery.isEmptyObject(obj) == true) {
                    $('#department').hide();
                } else {
                    $('#department').show();
                }
                $.each(obj, function (key, value) {
                    newOptions = newOptions + '<option value="' + key + '">' + value + '</option>';
                });
                $('#department').empty().append('<option value="">Select Department</option>');
                $('#department').append(newOptions);

                var oldStateVal = $('#hiddenDepartment').val();
                $('#department').val(oldStateVal).attr('selected', 'selected');
            }

        });

    }
    $(document).on('submit', '#addDepartmentForm', function (e) {
        e.preventDefault();
        $('.loading').show();
        $.ajax({
            url: "/admins/departmentAdd",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                $('.loading').hide();
                fetchDepartments();
                $('#deptModal').modal('hide');
                if (data != 0) {

                }
            },
            error: function () {
                $('.loading').hide();
            }
        });
    });

    jQuery(document).ready(function () {
  <?php  if(isset($roleId) && $roleId== 2){?>
        fetchDepartments();
  <?php }?>
        $('#uploadImagePharnacistModal').modal('hide');
        jQuery("#addDepartmentForm").validate({
            errorElement: "div",
            highlight: function (element) {
                $(element).removeClass("error");
            },
            rules: {
                "name": {
                    required: true
                }
            },
            messages: {
                "name": {
                    required: "Please enter department name."
                }
            }
        });


        jQuery("#requestorRegistration").validate({
            errorElement: "div",
            highlight: function (element) {
                $(element).removeClass("error");
            },
            rules: {
                "first_name": {
                    required: true,
                    apostrophe_hyphen_alphanumeric: true
                },
                "last_name": {
                    required: true,
                    apostrophe_hyphen_alphanumeric: true
                },
                "email": {
                    required: true,
                    email: true,
                    remote: {
                        url: "/users/checkUniqueEmail/3",
                        type: "post"
                    }
                },
                "password": {
                    required: true,
                    minlength:8,
                    password_strength: true
                },
                "confirm_password": {
                    required: true,
                    equalTo: "#password"
                },
                "street_address": {
                    required: true,
                    apostrophe_hyphen_alphanumeric: true
                },
                "city": {
                    required: true,
                    apostrophe_hyphen_alphanumeric: true
                },
                "state": {
                    required: true,
                    apostrophe_hyphen_alphanumeric: true
                },
                "country_id": {
                    required: true,
                },
                "phone": {
                    required: true,
                    number: true
                },
                "zip_code": {
                    required: true,
                    apostrophe_hyphen_alphanumeric: true
                },
                "company-name": {
                    apostrophe_hyphen_alphanumeric: true
                },
                "about_company": {
                    apostrophe_hyphen_alphanumeric: true,
                    maxlength: 200
                },
            },
            messages: {
                "first_name": {
                    required: "Please enter first name."
                },
                "last_name": {
                    required: "Please enter last name."
                }, 
                "email":{
                    required: "Please enter email.",
                    email: "Please enter valid email.",
                    remote: "Email already exist."
                },
                "password":{
                    required:"Please enter password.",
                    minlength:"Minimum length is 8 characters."
                    
                },
                "confirm_password": {
                    required: "Please enter confirm password.",
                    equalTo: "Password does not matched."
                },
                "street_address": {
                    required: "Please enter street address."
                },
                "city": {
                    required: "Please enter city."
                },
                "state": {
                    required: "Please enter state."
                },
                "country_id": {
                    required: "Please select country."
                },
                "phone": {
                    required: "Please enter phone number."
                },
                "zip_code": {
                    required: "Please enter zip code."
                },
            }
        });



    });

</script>