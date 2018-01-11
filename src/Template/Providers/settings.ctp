<?php

$id = $this->request->session()->read('LoginUser')['id'];
$userData = $this->Common->getProviderData($id);
$countryID = $userData['country_id'];
$countryData = $this->Common->getCountryData($countryID);
$ISO2 = $countryData['ISO2'];
//pr($ProvidersAdditionalData);
?>
<style>
    .datepicker-custom{
        margin-bottom: 15px;
    }
    .errorSpan {
        /*  background-color: #f2dede;
          border-color: #ebccd1;*/
        color: #a94442;
        margin-bottom:20px;

    }
    .text-center{
        text-align: center;
    }
    @media (min-width:768px) {
        .datepicker{
            width: 18%;
        }
    }
</style>
<section class="content-header">
    <h1>
        Settings
    </h1>
    <ol class="breadcrumb">
        <li>
            <?php
            $roleId = $this->request->session()->read('LoginUser')['role_id'];
            if ($roleId == 2) {
                echo $this->Html->link('Dashboard<i class="fa fa-dashboard"></i> ', ['controller' => 'Providers', 'action' => 'providersDashboard', '_full' => true], ['class' => '', 'escape' => false]);
            } else {
                echo $this->Html->link('Dashboard<i class="fa fa-dashboard"></i> ', ['controller' => 'Requestors', 'action' => 'requestorsDashboard', '_full' => true], ['class' => '', 'escape' => false]);
            }
            ?>
            <!--<a href="#"><i class="fa fa-dashboard"></i> Level</a>-->
        </li>
        <li class="active">Settings</li>
    </ol>
</section>
<!-- Main content -->
<?= $this->Flash->render() ?>
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
                    <h3 class="box-title">Payment Settings</h3>
                </div>
                <div class="col-md-12">

                    <?= $this->Form->create($ProvidersSettings, array('class' => 'form-appointment ui-form', 'id' => 'ProviderSettingsForm', 'type' => 'file', 'novalidate' => true, 'name' => 'User')) ?>
                    <div class="nav-tabs-custom">
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_1">
                                <div class="form-group">
                                    <div class="row">
                                        <label for="" class="col-sm-3 required-label  control-label">Payment Type</label>
                                        <div class="col-sm-4">
                                            <?php
                                            $attributes = array(
                                                'legend' => false,
                                                'value' => $ProvidersSettingsData['fees_type'],
                                                'required' => 'required'
                                            );
                                            echo $this->Form->radio('paymentType', [0 => 'Flat fee', 1 => 'Per page fee'], $attributes);
                                            ?>  
                                            <div class="error" for="paymentType"> </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <label for="" class="col-sm-3 required-label  control-label">Amount $</label>
                                        <div class="col-sm-4">
                                            <?php echo $this->Form->input('amount', array('label' => false, 'div' => false, 'value' => $ProvidersSettingsData['amount'], 'class' => 'form-control', 'required' => 'required', 'type' => 'text', 'maxlength' => 20)); ?>                 
                                            <?php echo $this->Form->input('id', array('label' => false, 'div' => false, 'value' => "$id", 'class' => 'form-control', 'type' => 'hidden')); ?>                 
                                        </div></div>
                                </div>
                                <div class="box-footer">
                                    <?php
                                    $roleId = $this->request->session()->read('LoginUser')['role_id'];
                                    if ($roleId == 2) {
                                        echo $this->Html->link('Cancel', ['controller' => 'Providers', 'action' => 'providersDashboard', '_full' => true], ['class' => 'btn btn-default', 'escape' => false]);
                                    } else {
                                        echo $this->Html->link('Cancel ', ['controller' => 'Requestors', 'action' => 'requestorsDashboard', '_full' => true], ['class' => 'btn btn-default', 'escape' => false]);
                                    }
                                    ?>
                                    <button type="submit" class="btn btn-info pull-right">Submit</button>
                                </div>
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="tab_2">
                                <div class="box-footer">

                                    <button type="submit" class="btn btn-default">Cancel</button>
                                    <?php echo $this->Form->button('Update', array('div' => false, 'class' => 'btn primary-btn')); ?>
                                </div>

                            </div>
                            <!-- /.tab-pane -->

                        </div>
                        <!-- /.tab-content -->
                    </div>
                    <?php echo $this->Form->end(); ?>


                    <div class="clearfix"></div>
                </div>  <div class="clearfix"></div>
            </div>

            <div class="box ">
                <div class="box-header with-border">
                    <h3 class="box-title">Add your bank to receive the payment from admin</h3>
                </div>
                <div class="col-md-12">
                    <div role="alert" class="alert alert-success alert-dismissible fade in" style="display:none;" id="sucMsgDiv2">
                        <button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button>
                        <span class="sucmsgdiv2"></span> 
                    </div>
                    <div role="alert" class="alert alert-danger alert-dismissible fade in" style="display:none;" id="failMsgDiv2">
                        <button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button>
                        <span class="failmsgdiv2"></span> 
                    </div>
                    <?= $this->Form->create($ProvidersSettings, array('class' => 'form-appointment ui-form', 'id' => 'BankDetailsFormStep1', 'novalidate' => true, 'name' => 'User')) ?>
                    <?php echo $this->Form->input('countryHidden', array('value' => (!empty($ISO2)) ? $ISO2 : "", 'type' => 'hidden','id'=>'countryHidden')); ?>
                    <div class="nav-tabs-custom">
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_1">
                                <div class="error">
                                    <div class="row">
                                        <div class="col-sm-12 text-center">
                                            <span id="errorSpan" class="errorSpan">
                                            </span> 
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <label for="" class="col-sm-3 required-label  control-label">Bank name:</label>
                                        <div class="col-sm-4">
                                            <?php echo $this->Form->input('bank_name', array('label' => false, 'div' => false, 'value' => (!empty($ProvidersAdditionalData['bank_name'])) ? $ProvidersAdditionalData['bank_name'] : "", 'class' => 'form-control', 'required' => 'required', 'type' => 'text', 'maxlength' => 20)); ?>                 
                                        </div></div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <label for="" class="col-sm-3 required-label  control-label">Account holder name:</label>
                                        <div class="col-sm-4">
                                            <?php echo $this->Form->input('account_holder_name', array('label' => false, 'div' => false, 'value' => (!empty($ProvidersAdditionalData['ext_account_holder_name'])) ? $ProvidersAdditionalData['ext_account_holder_name'] : "", 'class' => 'form-control', 'required' => 'required', 'type' => 'text', 'maxlength' => 20)); ?>                 
                                        </div></div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <label for="" class="col-sm-3 required-label  control-label">Routing number:</label>
                                        <div class="col-sm-4">
                                            <?php echo $this->Form->input('routing_number', array('label' => false, 'div' => false, 'value' => (!empty($ProvidersAdditionalData['routing_number'])) ? $ProvidersAdditionalData['routing_number'] : "", 'class' => 'form-control', 'required' => 'required', 'type' => 'text', 'maxlength' => 20)); ?>                 
                                        </div></div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <label for="" class="col-sm-3 required-label  control-label">Account number:</label>
                                        <div class="col-sm-4">
                                            <?php echo $this->Form->input('account_number', array('label' => false, 'div' => false, 'value' => (!empty($ProvidersAdditionalData['account_number'])) ? $ProvidersAdditionalData['account_number'] : "", 'class' => 'form-control', 'required' => 'required', 'type' => 'text', 'maxlength' => 20)); ?>                 
                                        </div></div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <label for="" class="col-sm-3 required-label  control-label">Entity type:</label>
                                        <div class="col-sm-4">
                                            <?php
                                            $attributes = array(
                                                'legend' => false,
                                                'value' => !empty($ProvidersAdditionalData['entityType']) ? $ProvidersAdditionalData['entityType'] : "",
                                                'required' => 'required'
                                                
                                            );
                                            echo $this->Form->radio('entityType',[
                                                        ['value' => '0', 'text' => 'Individual','div'=>false,'label'=>false, 'checked'=>(isset($ProvidersAdditionalData['entityType']) && $ProvidersAdditionalData['entityType']=='0')?'checked':''],
                                                        ['value' => '1', 'text' => 'Company','div'=>false,'label'=>false, 'checked'=>(isset($ProvidersAdditionalData['entityType']) && $ProvidersAdditionalData['entityType'])?'checked':''],
                                                ]);
                                            ?>  
                                            <div class="error" for="entityType"> </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group" id="business" style="<?php echo !empty($ProvidersAdditionalData['entityType']) ? 'display:block' :  'display:none'; ?>">
                                    <div class="row">
                                        <label for="" class="col-sm-3 required-label  control-label">Business name:</label>
                                        <div class="col-sm-4">
                                            <?php echo $this->Form->input('businessName', array('label' => false, 'div' => false, 'value' => (!empty($ProvidersAdditionalData['businessName'])) ? $ProvidersAdditionalData['businessName'] : "", 'class' => 'form-control', 'required' => 'required', 'type' => 'text', 'maxlength' => 20)); ?>                 
                                        </div></div>
                                </div>

                                <div class="form-group" id="business_tax" style="<?php echo !empty($ProvidersAdditionalData['business_tax_id']) ? 'display:block' :  'display:none'; ?>">
                                    <div class="row">
                                        <label for="" class="col-sm-3 required-label  control-label">Business tax id:</label>
                                        <div class="col-sm-4">
                                            <?php echo $this->Form->input('business_tax_id', array('label' => false, 'div' => false, 'value' => (!empty($ProvidersAdditionalData['business_tax_id'])) ? $ProvidersAdditionalData['business_tax_id'] : "", 'class' => 'form-control', 'required' => 'required', 'type' => 'text', 'maxlength' => 20)); ?>                 
                                        </div></div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <label  class="col-sm-3 control-label required-label">Date of birth:</label>
                                        <div class="col-sm-4">
                                            <div class="input-group date">
                                      <?php echo $this->Form->input('dob', array('label' => false, 'div' => false, 'value' => (!empty($ProvidersAdditionalData['dob']))?$ProvidersAdditionalData['dob']:'', 'class' => 'form-control datepicker-custom', 'required' => 'required', 'type' => 'text', 'maxlength' => 20)); ?>                 
                                                <div class="input-group-addon date_custom_dob">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                            </div>
                                            <div for="dob" class="error"></div> 
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <label for="" class="col-sm-3 required-label  control-label">SSN:</label>
                                        <div class="col-sm-4">
                                            <?php echo $this->Form->input('ssn', array('label' => false, 'div' => false, 'value' => (!empty($ProvidersAdditionalData['ssn']))?$ProvidersAdditionalData['ssn']:'', 'class' => 'form-control','maxlength'=>9, 'required' => 'required', 'type' => 'text')); ?>                 
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <label for="" class="col-sm-3 required-label  control-label">Personal id number:</label>
                                        <div class="col-sm-4">
                                            <?php echo $this->Form->input('personal_id_number', array('label' => false, 'div' => false, 'value' => (!empty($ProvidersAdditionalData['personal_id_number'])) ? $ProvidersAdditionalData['personal_id_number'] : "", 'class' => 'form-control', 'required' => 'required', 'type' => 'text', 'maxlength' => 20)); ?>                 
                                        </div>
                                    <span id="personal_id_no" class="col-sm-offset-1" data-toggle="tooltip" title="Personal identification number can be your passport, driving liscence number"> 
                                        <i class="fa fa-question-circle editIcon " aria-hidden="true"></i>
                                    </span>
                                    </div>
                                </div>

                                <?php  if(empty($IsStripeFirstStepCompleted)){?>
                                <div class="box-footer" id="accBtnDiv">
                                    <input type="hidden" id="isAccountCreated" value="NO">
                                    <button type="button" id="submitStep1" class="btn btn-info pull-right">Submit</button>
                                </div>
                                 <?php  }else{ ?>
                                <input type="hidden" id="isAccountCreated" value="YES">
                                  <?php } ?>

                            </div>
                        </div>
                        <!-- /.tab-content -->
                    </div>
                    <?php echo $this->Form->end(); ?>
                    <div class="clearfix"></div>
                </div>  <div class="clearfix"></div>
            </div>

            <!-- /.box -->
        </div>

        <!-- ./col -->
    </div>

</section>
<script>
    $(document).ready(function () {

        // tool tip for client name
        $('[data-toggle="tooltip"]').tooltip();

        //country from profile
        var country_id = '<?php echo $ISO2; ?>';
        $("#inputGroupSelect01").val(country_id);

        if ($("#isAccountCreated").val() == 'YES') {
            $("#BankDetailsFormStep1 :input").prop("disabled", true);
        }
        $("input[name=entityType]").on("change", function () {
            if ($(this).val() == '1') {
                $("#business").slideDown();
                $("#business_tax").slideDown();
            } else {
                $("#business").slideUp();
                $("#business_tax").slideUp();
            }
        });

        $('#dob').datepicker({
            format: 'mm/dd/yyyy',
            endDate: new Date(),
            startDate: new Date('1920-01-01'),
        });
        $('#dob').on('changeDate', function (ev) {
            $(this).datepicker('hide');
        });

        $(document).on('click', ".date_custom_dob", function () {
            $('#dob').datepicker('show');
        });
        jQuery("#ProviderSettingsForm").validate({
            errorElement: "div",
            highlight: function (element) {
                $(element).removeClass("error");
            },
            rules: {
                "amount": {
                    required: true,
                    number: true
                },
                "paymentType": {
                    required: true,
                },
            },
            messages: {
                "amount": {
                    required: "Please enter amount here",
                    number: "Please enter amount in numbers only"
                },
                "paymentType": {
                    required: "Please select payment type "
                }

            }
        });

        $('#ssn').mask('000-00-0000'); // SSN masking 
        //back account details validation
        jQuery("#BankDetailsFormStep1").validate({
            errorElement: "div",
            highlight: function (element) {
                $(element).removeClass("error");
            },
            rules: {
                "dob": {
                    required: true,
                },
                "ssn": {
                    required: true,
                },
                "entityType": {
                    required: true,
                },
                "personal_id_number": {
                    required: true,
                    maxlength: 9,
                    minlength: 9
                },
                "bank_name": {
                    required: true,
                    maxlength: 30,
                    apostrophe_hyphen_alphanumeric: true
                },
                "account_holder_name": {
                    required: true,
                    maxlength: 30,
                    apostrophe_hyphen_alphanumeric: true
                },
                "routing_number": {
                    required: true,
                    maxlength: 30,
                    apostrophe_hyphen_alphanumeric: true,
                    minlength: 9
                },
                "account_number": {
                    required: true,
                    maxlength: 30,
                    apostrophe_hyphen_alphanumeric: true
                }
            },
            messages: {
                "dob": {
                    required: "Please select the date of birth"

                },
                "ssn": {
                    required: "Please enter SSN "
                },
                "entityType": {
                    required: "Please select entity type "
                },
                "personal_id_number": {
                    required: "Please enter personal identification number"

                },
                "bank_name": {
                    required: "Please enter bank name "
                },
                "account_holder_name": {
                    required: "Please enter account holder name "
                },
                "routing_number": {
                    required: "Please enter routing number"
                },
                "account_number": {
                    required: "Please enter account number"
                },
            }
        });

        jQuery('input[type=radio][name=paymentType]').change(function () {
            jQuery("#amount").val(''); // clear amount
        });

        jQuery('#submitStep1').click(function () {
            if ($("#BankDetailsFormStep1").valid()) {


                $('#loddingImage').show();
                var CountryId = jQuery('#countryHidden').val();
                var dob = jQuery('#dob').val();
                var ssn = jQuery('#ssn').val();
                var entityType = $('input[name=entityType]:checked').val();
                var personal_id_number = jQuery('#personal-id-number').val();
                var account_holder_name = jQuery('#account-holder-name').val();
                var routing_number = jQuery('#routing-number').val();
                var account_number = jQuery('#account-number').val();
                var bank_name = jQuery('#bank-name').val();
                if (entityType == '1') {
                    var businessName = jQuery('#businessname').val();
                    var businessTaxId = jQuery('#business-tax-id').val();
                    var data = {'CountryId': CountryId, dob: dob, ssn: ssn, entityType: entityType, businessName: businessName, businessTaxId: businessTaxId, personal_id_number: personal_id_number, account_holder_name: account_holder_name, routing_number: routing_number, account_number: account_number, bank_name: bank_name}
                } else {
                    var data = {'CountryId': CountryId, dob: dob, ssn: ssn, entityType: entityType, personal_id_number: personal_id_number, account_holder_name: account_holder_name, routing_number: routing_number, account_number: account_number, bank_name: bank_name}
                }

                $.ajax({
                    type: "POST",
                    data: data,
                    url: '/providers/CreateCustomStripeAccountStep1',
                    dataType: 'json',
                    success: function (json) {

                        if (json.status == 'success') {
                            $('#loddingImage').hide();
                            $("#inputGroupSelect01").prop('disabled', 'disabled');
                            $('#sucMsgDiv2').show('slow');
                            $('.sucmsgdiv2').html('Your account has been created successfully!');
                            setTimeout(function () {
                                $('#sucMsgDiv2').fadeOut('slow');
                            },
                                    5000);
                            $('#accBtnDiv').hide();
                        } else {
                            $('#loddingImage').hide();
                            $('#failMsgDiv2').show('slow');
                            $('.failmsgdiv2').html('Unable to save data, please try again!');
                        }
                    },
                    error: function (requestObject, error, errorThrown) {
                        requestObject = $.parseJSON(JSON.stringify(requestObject));
//                        $(requestObject).each(function(){
//                            
//                        });
                        var message = requestObject.responseJSON.message;
                        $('#loddingImage').hide();
                        $('.error').show();
                        $('.errorSpan').text(message);

                    }
                });
            } else {
                return false;
            }
        });




    });
</script>