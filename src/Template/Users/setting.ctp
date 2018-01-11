<?php 
//pr($userData);
//exit('in card detail;s');
if($userData['is_client_matter_preference'] == 1){
    $checked='checked';
}else{
    $checked='';
}
?>
<style>
    .datepicker-custom{
        margin-bottom: 15px;
    }
    .check-margin{
        margin-left:3px;
    }
</style>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Settings
    </h1>
    <ol class="breadcrumb">
        <li>
            <?php
           
                echo $this->Html->link('Dashboard<i class="fa fa-dashboard"></i> ',['controller' => 'Requestors', 'action' => 'requestorsDashboard', '_full' => true],['class'=>'','escape'=>false]);
                ?>
        </li>
        <li class="active">Settings</li>
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
                    <h3 class="box-title">Set Record fee limit for requests</h3>
                </div>
                <!-- /.box-header -->
                <div role="alert" class="alert alert-success alert-dismissible fade in" style="display:none;" id="sucMsgDiv">
                    <button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button>
                    <span class="sucmsgdiv"></span> 
                </div>
                <div role="alert" class="alert alert-danger alert-dismissible fade in" style="display:none;" id="failMsgDiv">
                    <button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button>
                    <span class="failmsgdiv"></span> 
                </div>
                <!-- form start -->
             <?= $this->Form->create('user', array('class'=>'form-horizontal ui-form', 'id' => 'set_threshold_value')) ?>

                <div class="box-body">
                    <div class="form-group">
                        <label for="" class="col-sm-3 control-label required-label">Enter Value</label>

                        <div class="col-sm-3">
                     <?= $this->Form->control('threshold', ['class' => 'form-control', 'id'=>'threshold', 'required'=>'required', 'placeholder'=>'Enter value', 'label'=>false,'type'=>'text','maxlength'=>10,'autocomplete'=>'off','value'=>(!empty($userData['threshold']))?$userData['threshold']:'']) ?>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                <?php echo $this->Html->link('Cancel',['controller' => 'Requestors', 'action' => 'requestorsDashboard', '_full' => true],['class'=>'btn btn-default']);?>  
                    <!--<button type="submit" class="btn btn-default">Cancel</button>-->
                <?php // $this->Form->button(__('Submit'), ['class' => 'btn btn-info pull-right','id'=>'setting_submit']); ?>        
                    <button type="button" class="btn btn-info pull-right" id="setting_submit">Submit</button>
                </div>
                <!-- /.box-footer -->
             <?= $this->Form->end() ?><!-- end form- threshold value -->
            </div>

            <!-- /.box -->
        </div>

        <!-- ./col -->
    </div>

    <!--settings for client matter starts-->
    <div class="row">

        <!-- ./col -->       
        <!-- ./col -->
        <div class="col-md-12">
            <!-- Horizontal Form -->
            <div class="box ">
                <div class="box-header ">
                    <h3 class="box-title">Show client and matter data in requests</h3>
                </div>
                <!-- /.box-header -->
                <div role="alert" class="alert alert-success alert-dismissible fade in" style="display:none;" id="sucMsgDiv2">
                    <button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button>
                    <span class="sucmsgdiv2"></span> 
                </div>
                <div role="alert" class="alert alert-danger alert-dismissible fade in" style="display:none;" id="failMsgDiv2">
                    <button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button>
                    <span class="failmsgdiv2"></span> 
                </div>
                <!-- form start -->
             <?= $this->Form->create('ClientMatter', array('class'=>'form-horizontal ui-form', 'id' => 'is_client_matter_display')) ?>

                <div class="box-body">
                    <div class="form-group">
                        <div class="row">
                            <label for="" class="col-sm-4 control-label">Want to add Client and matter data in request?</label>
                            <div class="col-sm-4">
                                <?= $this->Form->control('is_client_matter_preference', ['class' => 'check-margin','type' => 'checkbox','id'=>'is_client_matter_preference','checked'=>$checked,'label'=>false,'div'=>false]) ?>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                <?php echo $this->Html->link('Cancel',['controller' => 'Requestors', 'action' => 'requestorsDashboard', '_full' => true],['class'=>'btn btn-default']);?>  
                    <button type="button" class="btn btn-info pull-right" id="client_matter">Submit</button>
                </div>
                <!-- /.box-footer -->
             <?= $this->Form->end() ?><!-- end form- threshold value -->
            </div>

            <!-- /.box -->
        </div>

        <!-- ./col -->
    </div>
    <!--end-->

    <!--for card settings starts-->
    <div class="row">

        <!-- ./col -->       
        <!-- ./col -->
        <div class="col-md-12">
            <!-- Horizontal Form -->
            <div class="box ">
                <div class="box-header ">
                    <h3 class="box-title">Settings for credit card</h3>
                </div>
                <!-- /.box-header -->
                <div role="alert" class="alert alert-success alert-dismissible fade in" style="display:none;" id="sucMsgDiv1">
                    <button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button>
                    <span class="sucmsgdiv1"></span> 
                </div>
                <div role="alert" class="alert alert-danger alert-dismissible fade in" style="display:none;" id="failMsgDiv1">
                    <button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button>
                    <span class="failmsgdiv1"></span> 
                </div>
                <!-- form start -->

                <div class="box-body form-horizontal">
                    <?= $this->Form->create('cc_settings', array('class'=>'form-horizontal ui-form', 'id' => 'set_default_cc')) ?>
                     <?php 
                     if(!empty($cardPreferenceDetails)){
                     $showDefault = count($cardPreferenceDetails) > 1 ? "" : 'hidden';
                     foreach ($cardPreferenceDetails as $card){
//                      pr($card);
                      ?>
                    <div class="row" style="margin: 10px;">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="credit_card" class="col-sm-6 control-label">Credit Card No. :</label>
                                <div class="col-sm-6">
                                <?= $this->Form->control('credit_card_no', ['class' => 'form-control','type' => 'text','id'=>'credit_card_no', 'required'=>'required', 'label'=>false,'div'=>false,'maxlength'=>16,'data-stripe'=>"number",'value'=>'**** **** **** '.$card['cc_no'],'readonly'=>'readonly']) ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="credit_card" class="col-sm-6 control-label">Card Holder Name :</label>
                                <div class="col-sm-6">
                                <?= $this->Form->control('credit_card_no', ['class' => 'form-control','type' => 'text','id'=>'', 'required'=>'required', 'label'=>false,'div'=>false,'maxlength'=>16,'value'=>$card['name_on_card'],'readonly'=>'readonly']) ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-6 control-label" for="expirationMonth">Expiration Date:</label>
                                <div class="col-sm-6">
                                    <div class="row">
                                        <div class="col-xs-6">
                                        <?= $this->Form->control('credit_card_no', ['class' => 'form-control','type' => 'text','id'=>'', 'required'=>'required', 'label'=>false,'div'=>false,'maxlength'=>16,'value'=>$card['exp_month'],'readonly'=>'readonly']) ?>
                                        </div>
                                        <div class="col-xs-6">
                                        <?= $this->Form->control('credit_card_no', ['class' => 'form-control','type' => 'text','id'=>'', 'required'=>'required', 'label'=>false,'div'=>false,'maxlength'=>16,'value'=>$card['exp_year'],'readonly'=>'readonly']) ?>
                                        </div>
                                    </div>    
                                </div>
                            </div>
                            <div class="form-group  <?php echo $showDefault; ?>">
                                <label for="inputEmail3" class="col-sm-6 control-label">Set this credit card as default:</label>

                                <div class="col-sm-5">                           
                            <?php  
                            if($card['default_card']=='Y'){
                                $active= 'checked';
                            }else{
                                $active= '';
                            }
                              echo $this->Form->radio(
                                        'cc_set_default',
                                        [
                                            ['value' => $card['id'],'label'=>false,'text' => false,'checked'=>$active],
                                            
                                        ]
                                    );?>
                                    <div for="cc_set_default" class="error"></div> 
                                </div>

                            </div>

                        </div>
                    </div>
                    <hr>

                  <?php }
                     
                     ?>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                <?php echo $this->Html->link('Cancel',['controller' => 'Requestors', 'action' => 'requestorsDashboard', '_full' => true],['class'=>'btn btn-default']);?>  
                    <!--<button type="submit" class="btn btn-default">Cancel</button>-->
                <?php // $this->Form->button(__('Submit'), ['class' => 'btn btn-info pull-right','id'=>'setting_submit']); ?>        
                    <button type="button" class="btn btn-info pull-right" id="cc_setting_submit">Submit</button>
                </div>
                <!-- /.box-footer -->
                <?php 
                }else{
                        echo 'No Saved Credits Cards';
                     }
                echo $this->Form->end(); ?><!-- end form-CC settings -->
            </div>

            <!-- /.box -->
        </div>

        <!-- ./col -->
    </div>
</section>
<!-- /.content -->
<script>
    jQuery(document).ready(function () {

        jQuery("#set_threshold_value").validate({
            errorElement: "div",
            highlight: function (element) {
                $(element).removeClass("error");
            },
            rules: {
                "threshold": {
                    required: true,
                    customnumeric: true,
                    maxlength: 8,
                },
            },
            messages: {
                "threshold": {
                    required: "Please enter threshold value",
                },
            }
        });

        // ajax request for saving threshold data
        $(document).on('click', '#setting_submit', function () {
            if ($("#set_threshold_value").valid()) {
            $('#loddingImage').show();
            var formData = $('#set_threshold_value').serialize();
            console.log(formData);

            $.ajax({
                type: "POST",
                data: formData,
                url: '/users/setting',
                dataType: 'json',
                success: function (json) {
                    console.log(json);
                    if (json.status == 'success') {
                        $('#loddingImage').hide();
                        $('#sucMsgDiv').show('slow');
                        $('.sucmsgdiv').html('Settings have been saved successfully!');
                        setTimeout(function () {
                            $('#sucMsgDiv').fadeOut('slow');
                        },
                                5000);

                    } else {
                        $('#loddingImage').hide();
                        $('#failMsgDiv').show('slow');
                        $('.failmsgdiv').html('Unable to save data, please try again!');
//                                setTimeout(function(){
//                                   $('#failMsgDiv').fadeOut('slow'); }, 
//                               5000);
                    }
                }
            });
        } else {
                return false;
            }
        });


        //Code for client and matter data settings
        jQuery("#is_client_matter_display").validate({
            errorElement: "div",
            highlight: function (element) {
                $(element).removeClass("error");
            },
            rules: {
                "is_client_matter_preference": {
                    required: true,
                },
            },
            messages: {
                "is_client_matter_preference": {
                    required: "Please check if you want to enable client and matter",
                },
            }
        });

           // ajax request for saving threshold data
        $(document).on('click', '#client_matter', function () {
            $('#loddingImage').show();
            var formData = $('#is_client_matter_display').serialize();
            console.log(formData);

            $.ajax({
                type: "POST",
                data: formData,
                url: '/users/isShowClientMatter',
                dataType: 'json',
                success: function (json) {
                    console.log(json);
                    if (json.status == 'success') {
                        $('#loddingImage').hide();
                        $('#sucMsgDiv2').show('slow');
                        $('.sucmsgdiv2').html('Settings have been saved successfully!');
                        setTimeout(function () {
                            $('#sucMsgDiv2').fadeOut('slow');
                        },
                                5000);

                    } else {
                        $('#loddingImage').hide();
                        $('#failMsgDiv2').show('slow');
                        $('.failmsgdiv2').html('Unable to save data, please try again!');
//                                setTimeout(function(){
//                                   $('#failMsgDiv').fadeOut('slow'); }, 
//                               5000);
                    }
                }
            });
        });

        // ajax request for saving threshold data
        $(document).on('click', '#cc_setting_submit', function () {
            $('#loddingImage').show();
//            var formData = $('input[name="cc_set_default:checked"]').val();
            var checkedData = $('input[name="cc_set_default"]:checked').val();
            $.ajax({
                type: "POST",
                data: {'formData': checkedData},
                url: '/users/ccSettings',
                dataType: 'json',
                success: function (res) {
                    console.log(res);
                    var message = res.message;
                    if (res.status == 'success') {
                        $('#loddingImage').hide();
                        $('#sucMsgDiv1').show('slow');
                        $('.sucmsgdiv1').html(message);
                        setTimeout(function () {
                            $('#sucMsgDiv1').fadeOut('slow');
                        }, 5000);
                    } else {
                        $('#loddingImage').hide();
                        $('#failMsgDiv1').show('slow');
                        $('.failmsgdiv1').html(message);
//                                setTimeout(function(){
//                                   $('#failMsgDiv').fadeOut('slow'); }, 
//                               5000);
                    }

                }
            });
        });

    });
</script>