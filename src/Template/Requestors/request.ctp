<?php

$userSession = $this->request->session()->read('LoginUser');
$ClientMatterData = $this->Common->getRequesterData($userSession['id']);
echo $this->Html->script('bootcomplete.js-master/jquery.bootcomplete'); 
echo $this->Html->css('/js/bootcomplete.js-master/bootcomplete'); 
//$requestData = $this->request->session()->read('RequestData');

?>

<!-- Content Header (Page header) -->
<style>
    .clientFieldset {
        padding: .35em .625em .75em;
        margin: 0 2px 20px;
        border: 1px solid #ccc;
        background: #fdfdfd;
    }

    .clientFieldset legend {
        display: unset;
        width: auto;
        padding: 0px 10px;
        margin: 0px 0px 0px 70px;
        font-size: 18px;
        line-height: inherit;
        color: #2986E2;
        border: 0;
        border-bottom: 0px solid #e5e5e5;
    } 
    .field-disable-colr{
        background-color: #fff !important;
    }
    @media (min-width:768px) {
        .datepicker{
            width: 18%;
        }
    }
</style>
<section class="content-header">
    <h1>
        Make Request
         <!--<small>Optional description</small>-->
    </h1>
    <ol class="breadcrumb">
        <li>
                <?php echo $this->Html->link('Dashboard <i class="fa fa-dashboard"></i>',['controller' => 'Requestors', 'action' => 'requestorsDashboard', '_full' => true],['class'=>'','escape' => false]);?>
            <!--<a href="#"><i class="fa fa-dashboard"></i> Dashboard</a>-->
        </li>
        <li class="active">request</li>
    </ol>
</section>    
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
                    <h3 class="box-title">Step 2</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                 <?= $this->Form->create((isset($requests)?$requests:''), array('class'=>'form-horizontal','id' => 'requestForm','novalidate'=>true,'type'=>"file",'onsubmit'=>"setFormSubmitting()")) ?>

                <!--  <form class="form-horizontal"> -->
                <div class="box-body"><span style="float: right !important;color: black !important;"><strong>Fields marked with <font color="RED">*</font> are mandatory</strong></span>
                    <div class="form-group">
                        <label  class="col-sm-2 control-label required-label">Request # :</label>

                        <div class="col-sm-5" style="padding-top:7px;">
                                 <?php echo $this->Form->control('request_id', ['class' => 'form-control field-disable-colr','type' => 'hidden','id'=>'request_id', 'label'=>false,'readonly'=>'readonly','value'=>(isset($requestData['request_id'])?$requestData['request_id']:'')]);?>
                                 <?php echo   isset($requestData['request_id'])?$requestData['request_id']:''; ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label  class="col-sm-2 control-label required-label">Provider :</label>

                        <div class="col-sm-5" style="padding-top:7px;">
                                <?php 
                                
                                echo $this->Form->control('provider_id', ['class' => 'form-control','type' => 'hidden','id'=>'provider_id', 'label'=>false,'value'=>(isset($providerData['id'])?$providerData['id']:$providerId)]);
                                echo $this->Form->control('requestor_id', ['class' => 'form-control','type' => 'hidden','id'=>'requestor_id', 'label'=>false,'value'=>$userSession['id']]);
                                echo $this->Form->control('provider_name', ['class' => 'form-control field-disable-colr','type' => 'hidden','id'=>'provider_name', 'required'=>'required', 'label'=>false,'value'=>(isset($fullName)?$fullName:'')]);
                                echo $this->Form->control('id', ['class' => 'form-control','type' => 'hidden','id'=>'recordID', 'label'=>false,'value'=>$id]);
                                echo $this->Form->control('cust_client_id', ['class' => 'form-control','type' => 'hidden','id'=>'cust_client_id', 'label'=>false]);
                                $fullName=$providerData['first_name']." ".$providerData['last_name'];
                                echo isset($fullName)?$fullName:''; ?>
                        </div>
                    </div>
                    <?php  
                         
                        if(!empty($departmentIds)){ ?>
                    <div class="form-group">
                        <label  class="col-sm-2 control-label ">Department Name:</label>
                        <div class="col-sm-5">
                                     <?= $this->Form->select('department_id', $departmentIds, ['class' => 'form-control field-disable-colr','id'=>'department_id', 'label'=>false]) ?>
                        </div>
                    </div>
                        <?php  
                            } 
                            if($ClientMatterData['is_client_matter_preference']==1){
                              $style = 'display:block';  
                            }else{
                                $style = 'display:none';
                            }
                        ?>
                    <fieldset class="clientFieldset" style="<?php echo $style; ?>">
                        <legend>Firm Details :</legend>
                        <div class="form-group">
                            <label  class="col-sm-2 control-label">Client Number :</label>

                            <div class="col-sm-5">
                               <?= $this->Form->control('client_number', ['class' => 'form-control','type' => 'text','id'=>'client_number', 'label'=>false,'autocomplete'=>'off','value'=>(isset($requestData['client_number'])?$requestData['client_number']:''),'maxlength'=>'25']) ?>
                            </div>
                            <span id="client_no_info" class="col-sm-offset-3" data-toggle="tooltip" title="Lorem ipsum dolor sit amet"> 
                                <i class="fa fa-question-circle editIcon " aria-hidden="true"></i>
                            </span>
                        </div>
                        <div class="form-group">
                            <label  class="col-sm-2 control-label">Client Name :</label>

                            <div class="col-sm-5">
                               <?= $this->Form->control('client_name', ['class' => 'form-control','type' => 'text','id'=>'client_name', 'label'=>false,'autocomplete'=>'off','value'=>(isset($requestData['client_name'])?$requestData['client_name']:''),'maxlength'=>'25']) ?>

                            </div>

                        </div>
                        <div class="form-group">
                            <label  class="col-sm-2 control-label">Matter # :</label>

                            <div class="col-sm-5">
                               <?= $this->Form->control('matter_no', ['class' => 'form-control','type' => 'text','id'=>'matter_no', 'label'=>false,'autocomplete'=>'off','value'=>(isset($requestData['matter_no'])?$requestData['matter_no']:'')]) ?>
                            </div>

                        </div>
                        <div class="form-group">
                            <label  class="col-sm-2 control-label"> Matter Name :</label>

                            <div class="col-sm-5">
                               <?= $this->Form->control('matter_name', ['class' => 'form-control','type' => 'text','id'=>'matter_name', 'label'=>false,'autocomplete'=>'off','value'=>(isset($requestData['matter_name'])?$requestData['matter_name']:''),'maxlength'=>'25']) ?>
                            </div>

                        </div>
                    </fieldset>


                    <fieldset class="clientFieldset">
                        <legend>Patient Details :</legend>
                        <div class="form-group">
                            <label  class="col-sm-2 control-label required-label">  First Name :</label>

                            <div class="col-sm-5">
                            <?= $this->Form->control('first_name', ['class' => 'form-control','type' => 'text','id'=>'first_name', 'required'=>'required', 'label'=>false,'placeholder'=>'Enter First Name','autocomplete'=>'off','value'=>(isset($requestData['first_name'])?$requestData['first_name']:'')]) ?>
                                <!-- <input class="form-control" id="inputEmail3" placeholder="Enter First Name" type="email"> -->
                            </div>
                            <span id="client_no_info" class="col-sm-offset-3" data-toggle="tooltip" title="Lorem ipsum dolor sit amet"> 
                                <i class="fa fa-question-circle editIcon " aria-hidden="true"></i>
                            </span>
                        </div>
<!--                        <div class="form-group">
                            <label  class="col-sm-2 control-label required-label"> Last Name :</label>

                            <div class="col-sm-5">
                                 <? //$this->Form->control('last_name', ['class' => 'form-control','type' => 'text','id'=>'last_name','required'=>'required', 'label'=>false,'placeholder'=>'Enter Last Name','autocomplete'=>'new-text','value'=>(isset($requestData['last_name'])?$requestData['last_name']:'')]) ?>
                            </div>
                        </div>-->
                        <div class="form-group">
                            <label  class="col-sm-2 control-label required-label"> Last Name :</label>

                            <div class="col-sm-5">
                                 <?= $this->Form2->control('last_name', ['class' => 'form-control','type' => 'text','id'=>'last_name','required'=>'required', 'label'=>false,'placeholder'=>'Enter Last Name','autocomplete'=>'off','value'=>(isset($requestData['last_name'])?$requestData['last_name']:'')]) ?>
                            </div>
                        </div>
<!--                        <div class="form-group">
                            <label class="col-sm-2 control-label">Social Security Number :</label>

                            <div class="col-sm-5">
                                <div class="input-group">
                               <?//$this->Form->control('ssn_no', ['class' => 'form-control','type' => 'password','id'=>'ssn_no', 'label'=>false,'placeholder'=>'Enter SSN','autocomplete'=>'new-password','value'=>(isset($requestData['ssn_no'])?$requestData['ssn_no']:'')]) ?>
                                    <div class="input-group-addon custom_ssn_pwd" id= "show_password">
                                        <span class="glyphicon glyphicon-eye-open"></span>
                                    </div>
                                </div>
                            </div>
                        </div>-->
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Social Security Number :</label>

                            <div class="col-sm-5">
                                <div class="input-group">
                               <?= $this->Form2->control('ssn_no', ['class' => 'form-control','type' => 'text','id'=>'ssn_no', 'label'=>false,'placeholder'=>'Enter SSN','autocomplete'=>'off','value'=>(isset($requestData['ssn_no'])?$requestData['ssn_no']:'')]) ?>
                                    <div class="input-group-addon custom_ssn_pwd" id= "show_password">
                                        <span class="glyphicon glyphicon-eye-open"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label  class="col-sm-2 control-label required-label">Date of birth:</label>

                            <div class="col-sm-5">
                                <div class="input-group date">

                                    <?= $this->Form->control('dob', ['class' => 'form-control pull-right datepicker-custom field-disable-colr', 'id'=>'dob', 'required'=>'required', 'label'=>false,'autocomplete'=>'off','value'=>(!empty($requestData['dob']))?$requestData['dob']:'','readonly'=>'readonly']) ?>
                                    <div class="input-group-addon date_custom_dob">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                </div>
                                <div for="dob" class="error"></div> 
                            </div>
                        </div>
                    </fieldset>
                    <div class="form-group">
                        <label  class="col-sm-2 control-label required-label">Start Date of Records :</label>

                        <div class="col-sm-5">
                            <div class="input-group date">

                                      <?= $this->Form->control('rec_start_date', ['class' => 'form-control pull-right datepicker-custom field-disable-colr', 'id'=>'rec_start_date', 'required'=>'required', 'label'=>false,'autocomplete'=>'off','value'=>(!empty($requestData['rec_start_date']))?$requestData['rec_start_date']:'','readonly'=>'readonly']) ?>
<!--  <input type="text" class="form-control pull-right" id="datepicker"> -->
                                <div class="input-group-addon date_custom_start">
                                    <i class="fa fa-calendar"></i>
                                </div>
                            </div>
                            <div for="rec_start_date" class="error"></div> 
                        </div>
                    </div>
                    <div class="form-group">
                        <label  class="col-sm-2 control-label required-label">End Date of Records :</label>

                        <div class="col-sm-5">
                            <div class="input-group date">

                                     <?= $this->Form->control('rec_end_date', ['class' => 'form-control pull-right field-disable-colr', 'id'=>'rec_end_date', 'required'=>'required','label'=>false,'autocomplete'=>'off','value'=>(!empty($requestData['rec_end_date']))?$requestData['rec_end_date']:'','readonly'=>'readonly']) ?>
<!--<input type="text" class="form-control pull-right" id="datepicker">-->
                                <div class="input-group-addon date_custom_end">
                                    <i class="fa fa-calendar"></i>
                                </div>
                            </div>
                            <div for="rec_end_date" class="error"></div> 
                        </div>
                    </div>

                    <div class="form-group">
                        <label  class="col-sm-2 control-label required-label">Record fee limit $ :</label>

                        <div class="col-sm-5">
                                <?= $this->Form->control('threshold', ['class' => 'form-control','type' => 'text','id'=>'threshold', 'required'=>'required', 'label'=>false,'placeholder'=>'Enter Value','autocomplete'=>'off','value'=>(isset($requestData['threshold'])?$requestData['threshold']:$defaultThresholdValue)]) ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label  class="col-sm-2 control-label required-label">Records Type:</label>

                        <div class="col-sm-5" style="margin-top:6px;">                           
                            <?php   
                             echo $this->Form->radio(
                                    'record_type',
                                    [
                                        ['value' => '1', 'text' => 'Medical Record','div'=>false,'label'=>false, 'checked'=>(isset($requestData['record_type']) && $requestData['record_type']=='1')?'checked':''],
                                        ['value' => '2', 'text' => 'Billing Record','div'=>false,'label'=>false, 'checked'=>(isset($requestData['record_type']) && $requestData['record_type']=='2')?'checked':''],
                                        ['value' => '3', 'text' => 'Both','div'=>false,'label'=>false, 'checked'=>(isset($requestData['record_type']) && $requestData['record_type']=='3')?'checked':'']
                                    ]
                                ); ?>

                            <div for="record_type" class="error"></div> 
                        </div>

                    </div>
                    <div class="form-group" style="margin-bottom:0px;">
                        <label  class="col-sm-2 control-label required-label">Upload HIPAA authorization form:</label>

                        <div class="col-sm-5" style="margin-top:6px;">
                            <?= $this->Form->control('upload_hippa', ['class' => '','type' => 'file','id'=>'upload_hippa', 'label'=>false,'accept'=>"application/msword,application/pdf,application/vnd.openxmlformats-officedocument.wordprocessingml.document"]) ?>
                            <span><label><?php echo isset($requestData['upload_hippa']) && !empty($requestData['upload_hippa'])?$requestData['upload_hippa']:'';?></label>
                               <!--  <input id="exampleInputFile" type="file"> -->
                        </div>
                        <div  style="color: #666;margin-left: 18.667%;" class="col-sm-5 col-sm-offset-2 pull-left" >Only files with max-size 50M can be uploaded. Files with extension .doc,.pdf will only be accepted.</div>
                        <div id="requestErrorMsg" style="color: RED !important;font-weight: bold !important;clear:both;" class="col-sm-5 col-sm-offset-2 pull-left" ></div>
                    </div>

                    <div class="form-group">
                        <label  class="col-sm-2 control-label required-label">Date of signature on HIPAA authorization :</label>
                        <div class="col-sm-5">
                            <div class="input-group date" style="margin-top:11px;">

                                    <?= $this->Form->control('hippa_form_date', ['class' => 'form-control pull-right field-disable-colr', 'id'=>'hippa_form_date', 'required'=>'required', 'label'=>false,'autocomplete'=>'off','value'=>(!empty($requestData['hippa_form_date']))?$requestData['hippa_form_date']:'','readonly'=>'readonly']) ?>
                                <div class="input-group-addon date_custom_hipaa">
                                    <i class="fa fa-calendar"></i>
                                </div>
                            </div>
                            <div for="hippa_form_date" class="error"></div> 
                        </div>
                    </div>
                    <div class="form-group">
                        <label  class="col-sm-2 control-label">Special Instructions:</label>

                        <div class="col-sm-5">
                                <?= $this->Form->control('description', ['class' => 'form-control','type' => 'textarea','row'=>'5','id'=>'description', 'label'=>false,'placeholder'=>'Please enter any special instructions the provider may need to complete your request','autocomplete'=>'off','value'=>(isset($requestData['description'])?$requestData['description']:'')]) ?>
                        </div>
                    </div>


                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                        <?php 
                        $requestID=(isset($requestData['id']) && !empty($requestData['id'])?$this->Common->encrypt($requestData['id']):'');
                        $providerId=(isset($providerId)  && !empty($providerId)?$this->Common->encrypt($providerId):'');
                        $deptId=(isset($departmentId) && !empty($departmentId)?$this->Common->encrypt($departmentId):'');
                       
                        echo $this->Html->link('Back',['controller' => 'Requestors', 'action' => 'selectProvider',$requestID,'?'=>array('providerId'=>$providerId,'deptId'=>$deptId), '_full' => true],['class'=>'btn btn-default']);?>
                    <!--<button type="button" class="btn btn-default">Cancel</button>-->
                        <?= $this->Form->button(__('Next'), ['class' =>'btn btn-info pull-right','type'=>'submit']); ?>
                    <!-- <?php echo $this->Html->link('Next',['controller' => 'Requestors', 'action' => 'payment', '_full' => true],['class'=>'btn btn-info pull-right']);?> -->
                    <!--<button type="button" class="btn btn-info pull-right" id="request_btn">Request</button>-->
                </div>
                <!-- /.box-footer -->
                 <?= $this->Form->end() ?><!-- end form-request form -->
            </div>

            <!-- /.box -->
        </div>

        <!-- ./col -->
    </div>

</section>
<!-- /.content -->

<script>
    var setFormSubmitting = function()
    {
    window.onbeforeunload = null;
    };
            $(document).ready(function () {
                
                //to prevent autocomplete on page load
                 $('#last_name').val('');
//                 $('#last_name').attr("autocomplete", "off"); 
                 $('#ssn_no').val('');
//                 $('#ssn_no').attr("autocomplete", "false"); 

//ssn type show hide start
    $('#show_password').hover(function functionName() {
//            $(".custom_ssn_pwd").on('click',function(){
    //Change the attribute to text
    $('#ssn_no').attr('type', 'text');
            $('.glyphicon').removeClass('glyphicon-eye-open').addClass('glyphicon-eye-close');
    }, function () {
    //Change the attribute back to password
    $('#ssn_no').attr('type', 'password');
            $('.glyphicon').removeClass('glyphicon-eye-close').addClass('glyphicon-eye-open');
    }
    );
            //ssn type show hide end



// tool tip for client name
            $('[data-toggle="tooltip"]').tooltip();
            //Client number auto complete data fetching...
            var client_name_id;
            $('#client_number').bootcomplete({
    url: SITE_URL + 'requestors/getClientNoList',
            minLength: 1,
            idField:true,
            idFieldName: "client_number_id",
    });
//get client name on change of client number
            $(document).on('change', "input[name='client_number_id']", function() {
    var client_no_id = $(this).val();
            if (client_no_id != ''){
    $.ajax({
    type: "POST",
            data: {'client_number': client_no_id},
            url: "/requestors/getClientName",
            dataType: 'json',
            success: function (json) {
            if (json.status == 'success') {

            var new_data = json.data;
                    $('#client_name').val(new_data.client_name.replace(/"/g, ""));
//                                $('#first_name').val(new_data.first_name.replace(/"/g, ""));
//                                $('#last_name').val(new_data.last_name.replace(/"/g, ""));
            }
            },
            error: function () {
            // $('.loading').hide();
            }
    });
    }
    });
            //Client name auto complete data fetching...
            var client_name_id;
            $('#client_name').bootcomplete({
    url: SITE_URL + 'requestors/getClientList',
            minLength: 1,
            idField:true,
            idFieldName: "client_name_id",
            formParams: {
            'group' : $('input[name=client_number_id]')
            }
    });
            var clientNameID = "<?php echo (isset($requestData['client_name_id'])?$requestData['client_name_id']:'');?>";
            if (clientNameID != ''){
    $('input[name=client_name_id]').val(clientNameID);
    }

    console.log($('input[name=client_number_id]'));
            //matter number auto complete
            $('#matter_no').bootcomplete({
    url: SITE_URL + 'requestors/getMatterList/',
            minLength: 1,
            idField:true,
            idFieldName: "matter_id",
            formParams: {
            'group' : $('input[name=client_number_id]')
            }
    });
            var matterID = "<?php echo (isset($requestData['matter_id'])?$requestData['matter_id']:'');?>";
            if (matterID != ''){
    $('input[name=matter_id]').val(matterID);
    }

    $('#ssn_no').mask('000-00-0000'); // SSN masking 

            $("#requestForm").validate({
             errorElement: "div",
            highlight: function(element) {
            $(element).removeClass("error");
            },
            rules: {
            "request_id":{
            required: true
            },
                    "provider_name":{
                    required: true,
                            apostrophe_hyphen_alphanumeric: true
                    },
                    "client_number":{
                    number: true
                    },
                    "client_name":{
                    number: true
                    },
                    "matter_no":{
                    number: true
                    },
                    "matter_name":{
                    /*required: true,*/
                    apostrophe_hyphen_alphanumeric: true

                    },
                    "client_name":{
                    apostrophe_hyphen_alphanumeric: true
                    },
                    "first_name":{
                    required: true,
                            apostrophe_hyphen_alphanumeric: true
                    },
                    "last_name":{
                    required: true,
                            apostrophe_hyphen_alphanumeric: true
                    },
                    "rec_start_date":{
                    required: true
                    },
                    "rec_end_date":{
                    required: true
                    },
                    "dob":{
                    required: true
                    },
                    "threshold":{
                    required: true,
                            customnumeric :true,
                            maxlength : 8,
                    },
                    /*"ssn_no":{
                     required: true
                     },*/
                    "record_type":{
                    required: true
                    },
                <?php if(empty($id)){ ?>
            "upload_hippa":{
            required: true
            },
                <?php } ?>
            "hippa_form_date":{
            required: true
            },
                    "description":{
                    apostrophe_hyphen_alphanumeric: true
                    },
            },
            messages:{
            "request_id":{
            required: "Please enter request ID."
            },
                    "provider_name":{
                    required:"Please enter provider name."
                    },
//                    "matter_no":{
//                    required: "Please enter matter number."
//                    },
                    /*"matter_name":{
                     required: "Please enter matter name."
                     },*/
//                    "client_name":{
//                    required: "Please enter client name."
//                    },
                    "first_name":{
                    required:"Please enter first name."
                    },
                    "last_name":{
                    required: "Please enter last name."
                    },
                    "rec_start_date":{
                    required: "Please select start date."
                    },
                    "rec_end_date":{
                    required: "Please select end date."
                    },
                    "dob":{
                    required: "Please select dob date."
                    },
                    "threshold":{
                    required: "Please enter threshold.",
                            number : "Please enter number only.",
                            maxlength : "Only 8 digits are allowed",
                    },
                    /*"ssn_no":{
                     required: "Please enter ssn number."
                     },*/
                    "record_type":{
                    required: "Please select record type."
                    },
                <?php if(empty($id)){ ?>
            "upload_hippa":{
            required: "Please upload pdf,doc and docx file only."
            },
                        <?php } ?>
            "hippa_form_date":{
            required: "Please select hippa form date."
            },
            }, showErrors: function(errorMap, errorList) {
    this.defaultShowErrors();
//                        Cufon.refresh();
            //$('#ssn_no').val('');
    },
    });
            $('#rec_start_date').datepicker({
    format: 'mm/dd/yyyy',
            startDate : new Date('1920-01-01'),
    });
            $('#rec_start_date').on('changeDate', function(ev){
    $(this).datepicker('hide');
    });
            $('#rec_end_date').datepicker({
    format: 'mm/dd/yyyy',
            startDate : new Date('1920-01-01'),
    });
            $('#rec_end_date').on('changeDate', function(ev){
    $(this).datepicker('hide');
    });
            $('#dob').datepicker({
    format: 'mm/dd/yyyy',
            endDate : new Date(),
            startDate : new Date('1920-01-01'),
    });
            $('#dob').on('changeDate', function(ev){
    $(this).datepicker('hide');
    });
            $('#hippa_form_date').datepicker({
    format: 'mm/dd/yyyy',
            startDate: '-90d'
    });
            $('#hippa_form_date').on('changeDate', function(ev){
    $(this).datepicker('hide');
    });
            //code for disable/enable on change of start date starts
            $("#rec_end_date").prop('disabled', true);
            $("#hippa_form_date").prop('disabled', true);
            $('#rec_start_date').datepicker().on('hide', function(e){
    $("#rec_end_date").prop('disabled', false);
    });
            $('#rec_end_date').datepicker().on('hide', function(e){
    $("#hippa_form_date").prop('disabled', false);
    });
            //code for disable/enable on change of start date ends

            window.onbeforeunload = afterRefresh;
            $(document).on('change', "input[name='matter_id']", function() {
    if ($.trim($('#matter_no').val()) != ''){
    //    $('#errorId').hide();
    $('#errorIdMt').hide();
            matterId = $(this).val();
            getDataByMatterId(matterId);
    } else{
    $('#first_name').val('');
            $('#last_name').val('');
            $('#matter_name').val('');
    }
    //fetchDepartments(providerID);
    });
            //show date picker on click of calender
            $(document).on('click', ".date_custom_dob", function() {
    $('#dob').datepicker('show');
    });
            $(document).on('click', ".date_custom_start", function() {
    $('#rec_start_date').datepicker('show');
    });
            $(document).on('click', ".date_custom_end", function() {
    $('#rec_end_date').datepicker('show');
    });
            $(document).on('click', ".date_custom_hipaa", function() {
    $('#hippa_form_date').datepicker('show');
    });
            //max date validations for start/end/Hipaa
            $('#rec_start_date').datepicker().on('hide', function(e){
    var date_val = $('#rec_start_date').val();
            var maxDateNew = new Date(date_val);
//            console.log(maxDateNew);
            $('#rec_end_date').datepicker('setStartDate', maxDateNew);
            //            alert(date_val);
            //                $('#end_datepicker').datepicker({
            //                    format: 'mm/dd/yyyy',
            //                    startDate:date_val
            //                 });
    });
//                    $('#rec_end_date').datepicker().on('hide', function(e){
//                    var date_val = $('#rec_end_date').val();
//                    var maxDateNew = new Date(date_val);
//                    console.log(maxDateNew);
//                    $('#hippa_form_date').datepicker('setEndDate', maxDateNew);
//        //            alert(date_val);
//        //                $('#end_datepicker').datepicker({
//        //                    format: 'mm/dd/yyyy',
//        //                    startDate:date_val
//        //                 });
//                   });

    });
            function getDataByMatterId(matterId){
            $.ajax({
            url: "/requestors/getMatterData?matterId=" + matterId,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                    if (data != '') {
//                    $('#first_name').val(data.first_name.replace(/"/g, ""));
//                            $('#last_name').val(data.last_name.replace(/"/g, ""));
                    $('#matter_name').val(data.matter_name.replace(/"/g, ""));
                    } else{
                    $('#matter_name').val('');
                    }
                    },
                    error: function () {
                    // $('.loading').hide();
                    }
            });
            }
    function afterRefresh(){
    return confirm("Do you really want to refresh?");
    }

    $(document).on('submit', '#requestForm', function(event){
    event.preventDefault();
            // $('.loading').show();
            var files = $('#upload_hippa').get(0).files;
            var formDataObjects = new FormData();
            formDataObjects.append("id", $('#recordID').val());
            formDataObjects.append("upload_hippa", files[0]);
            formDataObjects.append("request_id", $('#request_id').val());
            formDataObjects.append("provider_id", $('#provider_id').val());
            formDataObjects.append("department_id", $('#department_id').find(":selected").val());
            formDataObjects.append("requestor_id", $('#requestor_id').val());
            formDataObjects.append("matter_no", $('#matter_no').val());
            formDataObjects.append("matter_name", $('#matter_name').val());
            formDataObjects.append("client_number", $('#client_number').val());
            formDataObjects.append("client_name", $('#client_name').val());
            formDataObjects.append("first_name", $('#first_name').val());
            formDataObjects.append("last_name", $('#last_name').val());
            formDataObjects.append("rec_start_date", $('#rec_start_date').val());
            formDataObjects.append("rec_end_date", $('#rec_end_date').val());
            formDataObjects.append("dob", $('#dob').val());
            formDataObjects.append("threshold", $('#threshold').val());
            formDataObjects.append("ssn_no", $('#ssn_no').val());
            formDataObjects.append("matter_id", $('input[name=matter_id]').val());
            formDataObjects.append("client_name_id", $('input[name=client_name_id]').val());
            formDataObjects.append("record_type", $('input[name=record_type]:checked').val());
            formDataObjects.append("hippa_form_date", $('#hippa_form_date').val());
            formDataObjects.append("description", $('#description').val());
            $.ajax({
            url:'/requestors/request',
                    data:formDataObjects,
                    method:'POST',
                    dataType:'JSON',
                    processData: false,
                    contentType: false,
                    success:function(response){
                    //console.log(response);
                    // $('.loading').hide();
                    if (response.status == 'OK'){
                    location.href = response.redirectUrl;
                    } else if (response.status == 'ERROR'){
                    $('#requestErrorMsg').text(response.message).show().delay(8000).fadeOut();
                    } else if (response.status == 'INVALID'){
                    $('#requestErrorMsg').text(response.message).show().delay(8000).fadeOut();
                    }
                    },
                    error:function(err){
                    // $('.loading').hide();
                    }
            });
    });

</script>