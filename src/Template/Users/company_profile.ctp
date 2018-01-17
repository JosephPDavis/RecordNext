<?php

//$id=$this->Common->encrypt($userData['id']);
$id=$this->request->session()->read('LoginUser')['id'];
$roleId=$this->request->session()->read('LoginUser')['role_id'];

?>
<style>
    .datepicker-custom{
        margin-bottom: 15px;
    }
    .check-margin{
        margin-left:3px;
    }
</style>
<section class="content-header">
    <h1>
        Profile/Company Details 
    </h1>
    <ol class="breadcrumb">
        <li>
            <?php $roleId=$this->request->session()->read('LoginUser')['role_id'];
            if($roleId == 2){
               echo $this->Html->link('Dashboard<i class="fa fa-dashboard"></i> ',['controller' => 'Providers', 'action' => 'providersDashboard', '_full' => true],['class'=>'','escape'=>false]);
            }else{
               echo $this->Html->link('Dashboard<i class="fa fa-dashboard"></i> ',['controller' => 'Requestors', 'action' => 'requestorsDashboard', '_full' => true],['class'=>'','escape'=>false]); 
            }
            ?>
            <!--<a href="#"><i class="fa fa-dashboard"></i> Level</a>-->
        </li>
        <li class="active">Profile/company</li>
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
                    <h3 class="box-title">Personal Details</h3>
                </div>
                <div class="col-md-12">
                    <div>
                        <div class="col-md-2 pull-right" style="margin-top: 20px;">    
                      <?php echo $this->Html->link('Change Password',['controller' => 'Users', 'action' => 'changePassword', '_full' => true],['class'=>'btn btn-info','escape' => false]);?>
                                  <!--<button type="submit" class="btn btn-info "><i class="fa fa-search"></i> Change Password</button>-->              
                        </div>
                    </div>
               <?php //echo $this->Session->flash(); ?>
                    <!-- <?php// echo $this->Form->create('User', array('url' => array('controller' => 'Users', 'action' => 'companyProfile',$id),'id'=>'companyProfileRegisterForm', 'type' => 'file'));
          ?> -->
          <?=  $this->Form->create($user, array('url' => array('controller' => 'Users', 'action' => 'companyProfile'),'class'=>'form-appointment ui-form', 'id' => 'companyProfileRegisterForm', 'type' => 'file', 'novalidate' => true, 'name' => 'User')) ?>
                    <div class="nav-tabs-custom">
                        <!-- <ul class="nav nav-tabs">
                          <li class="active"><a href="#tab_1" data-toggle="tab">Personal Details  </a></li>
                          <li><a href="#tab_2" data-toggle="tab">Company Details </a></li>
                        </ul> -->
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_1">

                                <div class="form-group">
                                    <div class="row">
                                        <label for="" class="col-sm-3 required-label  control-label">First Name</label>
                                        <div class="col-sm-4">
                  <?php echo $this->Form->input('first_name',array('label' => false,'div' => false,'value'=>$userData['first_name'] , 'class' => 'form-control', 'type'=>'text','maxlength'=>20));?>                 
                                        </div></div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <label for="" class="col-sm-3 required-label control-label">Last Name</label>

                                        <div class="col-sm-4">
                     <?php echo $this->Form->input('last_name',array('label' => false,'div' => false,'value'=>$userData['last_name'] , 'class' => 'form-control', 'type'=>'text','maxlength'=>20));?>              
                                        </div></div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <label for="" class="col-sm-3 required-label control-label">Email Address</label>

                                        <div class="col-sm-4">
                     <?= $this->Form->control('email', ['class' => '', 'id'=>'email', 'required'=>'required', 'placeholder'=>'Enter Email', 'label'=>false,'value'=>$userData['email'],'readonly'=>'readonly', 'class' => 'form-control']) ?>              
                                        </div></div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <label for="" class="col-sm-3 required-label control-label">Street Address  </label>

                                        <div class="col-sm-4">
                   <?php echo $this->Form->input('street_address',array('label' => false,'div' => false,'value'=>$userData['street_address'] , 'class' => 'form-control', 'type'=>'text','maxlength'=>20));?>    
                                        </div></div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <label for="" class="col-sm-3 required-label control-label">City</label>

                                        <div class="col-sm-4">
                   <?php echo $this->Form->input('city',array('label' => false,'div' => false,'value'=>$userData['city'] , 'class' => 'form-control', 'type'=>'text','maxlength'=>20));?>  
                                        </div></div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <label for="" class="col-sm-3 required-label control-label">Country </label>

                                        <div class="col-sm-4">
                   <?php 
                   echo $this->Form->input('country_id',array('label' => false,'div' => false,'options'=>$countryList , 'class' => 'form-control', 'type'=>'select', 'empty'=>'please select country','value'=>$userData['country_id']));?>  
                                        </div></div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <label for="" class="col-sm-3 required-label control-label">State</label>

                                        <div class="col-sm-4">
                  <?php echo $this->Form->input('state',array('label' => false,'div' => false,'value'=>$userData['state'] ,'options'=>$stateList, 'class' => 'form-control', 'type'=>'select','maxlength'=>20));?>  
                                        </div></div>
                                </div>
                                
                                <div class="form-group">
                                    <div class="row">
                                        <label for="" class="col-sm-3 required-label control-label">Zip Code </label>

                                        <div class="col-sm-4">
                   <?php echo $this->Form->input('zip_code',array('label' => false,'div' => false,'value'=>$userData['zip_code'] , 'class' => 'form-control', 'type'=>'text','maxlength'=>15));?>  
                                        </div></div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <label for="" class="col-sm-3 control-label">Phone No </label>

                                        <div class="col-sm-4">
                    <?php echo $this->Form->input('phone',array('label' => false,'div' => false,'value'=>$userData['phone'] , 'class' => 'form-control', 'type'=>'text','maxlength'=>15));?>  
                                        </div></div>
                                </div>
                                
                                
                                <!-- <div class="form-group">
                                 <div class="row">
                                  <label for="" class="col-sm-3 control-label">Fax No </label>
                
                                  <div class="col-sm-4">
                    <?php echo $this->Form->input('fax_number',array('label' => false,'div' => false,'value'=>$userData['fax_number'] , 'class' => 'form-control', 'type'=>'text','maxlength'=>20));?>  
                                  </div></div>
                                </div>   -->
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
                    <?php echo $this->Form->input('company_name',array('label' => false,'div' => false,'value'=>$userData['company_name'] , 'class' => 'form-control', 'type'=>'text','maxlength'=>20));?>       
                                        </div></div>
                                </div>


              <?php if($roleId == 2){?>

                                <div class="form-group">
                                    <div class="row">
                                        <label for="" class="col-sm-3 control-label">Department</label>
                                        <div class="col-sm-4">
                   <?php //$deptArr=array('Department 1','Department 2','Department 3','Department 4','Department 5');
                   echo $this->Form->hidden('hidden_department',array('value'=>(isset($userData['department'])&& isset($userData['department']))?$userData['department']:'','id'=>'hiddenDepartment'));
                  echo $this->Form->input('department',array('label' => false,'div' => false,'value'=>$userData['department'] ,'options'=>array(), 'class' => 'form-control','department'));?> 
                                            <section id="stateloader" class="loader_img_state" style="display:none;"><?php echo $this->Html->image('ajax-loader.gif'); ?></section>

                                            <div class="clearfix"></div>  
                                            <!-- 
                                             <select class="form-control">
                                              <option>Department 1</option>
                                              <option>Department 2</option>
                                              <option>Department 3</option>
                                              <option>Department 4</option>
                                              <option>Department 5</option>
                                            </select> -->
                                        </div>

                                        <a href="javascript:void(0)" class="addDepartment"  data-toggle="modal" data-target="#deptModal"><i class="fa fa-plus-circle" ></i></a>
                                    </div>


                                </div>
                <?php  }?>
                               
                                <div class="form-group">
                                    <div class="row">
                                        <label for="" class="col-sm-3 control-label">About Company </label>

                                        <div class="col-sm-4">
                   <?php echo $this->Form->textarea('about_company',array('label' => false,'div' => false,'value'=>$userData['about_company'] , 'class' => 'form-control','maxlength'=>200));?> 
                                        </div></div>
                                </div>  
                                <div class="box-footer">
                <?php $roleId=$this->request->session()->read('LoginUser')['role_id'];
            if($roleId == 2){
               echo $this->Html->link('Cancel',['controller' => 'Providers', 'action' => 'providersDashboard', '_full' => true],['class'=>'btn btn-default','escape'=>false]);
            }else{
               echo $this->Html->link('Cancel ',['controller' => 'Requestors', 'action' => 'requestorsDashboard', '_full' => true],['class'=>'btn btn-default','escape'=>false]); 
            }
            ?>
                                    <button type="submit" class="btn btn-info pull-right">Submit</button>
                                </div>
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="tab_2">





                                <div class="box-footer">

                                    <button type="submit" class="btn btn-default">Cancel</button>
                <?php echo $this->Form->button('Update', array('div' => false, 'class'=>'btn primary-btn')); ?>
                                </div>

                            </div>
                            <!-- /.tab-pane -->

                        </div>
                        <!-- /.tab-content -->
                    </div>
           <?php echo $this->Form->end(); ?>
          <?php
//	echo $this->Form->create($user);
//	echo $this->Form->input('title');
//	echo $this->Form->input('content', ['rows' => '3']);
//	echo $this->Form->input('tags'); 
//	echo $this->Form->input('author');   
//	echo $this->Form->button(__('Save Topic'));
//	echo $this->Form->end();
	?>

                    <!--BOF- Modal Department-->

                    <div class="modal fade" id="deptModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
    <?= $this->Form->create(isset($department)?$department:'', array('class'=>'form-appointment ui-form', 'id' => 'addDepartmentForm','novalidate'=>true, 'type' => 'file')) ?>
                            <!--  <form id="addDepartment" action="javascript:void(0)"> -->
                            <div class="modal-content">
                                <!-- Modal Header -->
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
                    </div>
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
            url: "/users/getDepartment",
            success: function (sdata) {           
                var obj = JSON.parse(sdata);                
                if(jQuery.isEmptyObject(obj)==true){                 
                  $('#department').hide();
                }else{
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
            url: "/users/departmentAdd",
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


        jQuery("#companyProfileRegisterForm").validate({
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
                }
                , "street_address": {
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
                    required: "Please zip code."
                },
            }
        });


$('#country-id').on( 'change', function (e) {
                var countryID = this.value; 
                $.ajax({
                type: "POST",
                data: {countryID : countryID},
                url: '/users/getStates',
                //dataType: 'json',
                success: function (json) {
                    if (json != '') {
                       json = JSON.parse(json); 
                       $("#state").empty();
                       var first = false;
                       $.each(json, function (key, value) {
                           $("#state").append('<option value='+key+'>'+value+'</option>');
                        });

                    } else {

                    }
                },
                error: function (requestObject, error, errorThrown) {
                    alert(error);
                    alert(errorThrown);
                }
    });
            });

    });

</script>