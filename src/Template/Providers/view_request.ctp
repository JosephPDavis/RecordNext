<?php
//pr($data);
?>
<!-- Content Header (Page header) -->

<style>
    .progress_sucess{background: none!important;}
    .progress:first-child{background: none;box-shadow:none;}
    .progress:last-child{background: none;box-shadow:none;}
    .upper-txt{position: absolute !important;bottom:50px;left: 0px;}
    
      .rotated-circle-outer {
    position: absolute;
    left: 100px;
    top: 28px;
}
      .rotated-circle-outer-2 {
    position: absolute;
    left: 600px;
    top: 28px;
}
    .curved-line {
        width: 69px;
        height: 10px;
         background: #f1f1f1;
        transform: rotate(123deg);
    }
    .circle-section-outer {
        left: 40px;
        top: -69px;
    }
    .straight-line {
        transform: none;
        position: absolute;
        left: 70px;
        top: -42px !important;
    }
    .upper-circle {
        left: 118px;
        top: -61px;
    }
    .rotated-circle-outer-bottom {
        top: 170px;
    left: 200px;
    }
    .rotated-circle-outer-bottom-2 {
        top: 170px;
    left: 600px;
    }
    .curved-line-bottom {
        transform: rotate(-120deg);
        position: relative;
        top: -80px;
        left: 6px;
    }
    .proBarIcon{
        background-color: #ddd;
    }

    div[data-update='4']>span:hover,div[data-update='6']>span:hover {
        background-color: #ff0000;
    }
    .progress-bar{
        width: 18%;
    }
    .progress-bar-denied {
        background-color: #ff0000;
    }

    .progress-bar-denied-icon {
        background-color: #ff0000;
    }

    .progress-bar-success {
        background-color: #5cb85c;
    }    

    .feesInput  .input.text { 
        display: inline-block;
    }
    .feesInput  input {
        padding: 0 5px;
        height: auto;width: 50px;margin: 0 20px;
    } 
    .proBarName {
        color: #333333;
        display: block;
        line-height: 12px;
        position: initial;
        text-align: center;
        width:100px;
        margin-left: -33px;
        margin-top: 15px;
    }
    .progress.proBar {
        margin-bottom: 60px;
        margin-top: 60px;
    }

    .form-pricing {
        background: #ffffff;
        padding: 20px;
        border-radius: 4px;
    }

    .price-form {
        background: #ffffff;
        margin-bottom: 10px;
        padding: 20px;
        border: 1px solid #eeeeee;
        min-height: 420px;
        border-radius: 4px;
        /*-moz-box-shadow:    0 5px 5px 0 #ccc;
          -webkit-box-shadow: 0 5px 5px 0 #ccc;
          box-shadow:         0 5px 5px 0 #ccc;*/
    }

    .form-group {
        margin-bottom: 0;
    }

    .form-group span.price {
        font-weight: 200;
        display: inline-block;
        color: #7f8c8d;
        font-size: 14px;
    }

    .help-text {
        display: block;
        margin-top: -10px;
        margin-bottom: 10px;
        color: #737373;
        /*position: absolute;*/
        /*margin-left: 20px;*/
        font-weight: 200;
        /*text-align: right;*/
        width: 188px;
    }

    .price-form label {
        font-weight: 200;
        font-size: 21px;
    }

    img.payment {
        display: block;
        margin-left: auto;
        margin-right: auto
    }

    .ui-slider-range-min {
        background: #2980b9;
    }

    .active-month,
    .active-term {
        background: #3276b1;
    }

    /* HR */

    hr.style {
        margin-top: 0;
        border: 0;
        border-bottom: 1px dashed #ccc;
        background: #999;
    }
    .request-fee-blk{
        display: none;
    }
    .reasonDiv{
        display: none;
    }
    .response_span_success,#Records_span,#provider_response_span{
        color : #337ab7;
    }
    .response_span_denied{
        color : #ff0000;
    }
    .lead{
     font-size: 16px;   
    }
    #ProFeesChangeDiv{
        display: none;
    }
    .thresholdError{
        display: none;
    }
</style>

<section class="content-header">
    <h1>
        View Request Detail
         <!--<small>Optional description</small>-->
    </h1>
    <ol class="breadcrumb">
        <li>
            <?php echo $this->Html->link('Dashboard <i class="fa fa-dashboard"></i>', ['controller' => 'Providers', 'action' => 'providersDashboard', '_full' => true], ['class' => '', 'escape' => false]); ?>
            <!--<a href="#"><i class="fa fa-dashboard"></i> Dashboard</a>-->
        </li>
        <li class="active">View Request Detail</li>
    </ol>
</section>    
<section class="content container-fluid">
    <!-- Small boxes (Start box) -->
    <div class="row">
        <div class="col-xs-12">
            <?php if($data['request_status'] == 3){?>
            <div class="alert alert-warning">
                <strong>Warning!</strong> This request is currently pending on requestor end due to threshold limit exceeded.
            </div>
            <?php } ?>
            <?php // echo $this->Session->flash();   ?>
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><?php echo 'Request Information'; ?></h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <div class="box-body box-profile">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="col-sm-12">
                                <!--<h3 style="margin-top: 0;">Personal Information</h3>-->
                                <div class="row" style="margin-top: 15px;">
                                    <label class="col-md-2 col-xs-2"> Request Status:</label>
                                    <div class="col-md-10 col-xs-10"> 
                                        <div class="progress proBar">
                                            <input type="hidden" id="request_id" name="request_id" value="<?php echo $data['id']; ?>">
                                            <input type="hidden" id="requestor_id" name="requestor_id" value="<?php echo $data['requestor_id']; ?>">

                                            <div class="progress-bar progress_sucess" data-update="0" id="divSubmitted">
                                                <a href="javascript:void(0);" data-update="0" class="progressUpdate" id="submitted">
                                                    <span class="proBarIcon offBg"><img src="<?php echo SITE_URL; ?>/img/new_icon.png"/>
                                                        <span class="proBarName">New</span>    
                                                    </span>
                                                </a>
                                            </div>
                                             
                                            <div class="progress-bar" data-update="1" id="divprovider_response">
                                                <a href="javascript:void(0);" data-update="1" class="progressUpdate" id="provider_response">
                                                    <span class="proBarIcon offBg"><img src="<?php echo SITE_URL; ?>/img/confirmed_icon.png"/>
                                                        <span class="proBarName">Provider Response</span>    
                                                        <span id="provider_response_span"></span> 
                                                    </span>
                                                </a>   
                                            </div>
                                             
                                            <div class="progress-bar"  data-update="4" id="divinProgress">
                                                <a href="javascript:void(0);" data-update="4" class="progressUpdate" id="inProgress">
                                                    <span class="proBarIcon offBg"><img src="<?php echo SITE_URL; ?>/img/in_progress_icon.png"/>
                                                        <span class="proBarName">In progress</span>    
                                                    </span> 
                                                </a>  
                                            </div>
                                            <div class="progress-bar"  data-update="5" id="divRecords">
                                                <a href="javascript:void(0);" data-update="5" class="progressUpdate" id="Records">
                                                    <span class="proBarIcon offBg"><img src="<?php echo SITE_URL; ?>/img/records_download_icon.png"/>
                                                        <span class="proBarName">Results</span>   
                                                        <span class="proBarName" id="Records_span"></span> 
                                                    </span> 
                                                </a>  
                                            </div>
                                        </div>   
                                    </div>
                                </div>
                               
                                <input type="hidden" name="request_status" id="request_status" value="<?php echo $data['request_status']; ?>">
                                <?php
                                $requestor_data = $this->Common->getRequesterData($data['requestor_id']);
                                $requestor_name = $requestor_data['first_name'] . ' ' . $requestor_data['last_name'];
                                if (!empty($data['matter_id']) && isset($data['matter_id'])) {
                                    $matter_data = $this->Common->getMatterData($data['matter_id']);
                                    if (!empty($matter_data)) {
                                        $matterNumber = $matter_data['matter_no'];
                                        $matterName = $matter_data['matter_name'];
                                    } else {
                                        $matterNumber = "NA";
                                        $matterName = "NA";
                                    }
                                } else {
                                    $matterNumber = "NA";
                                    $matterName = "NA";
                                }
                                if (!empty($data['client_id']) && isset($data['client_id'])) {
                                    $clientData = $this->Common->getClientData($data['client_id']);
                                    if (!empty($clientData)) {
                                        $clientName = $clientData['client_name'];
                                        $clientNumber = $clientData['client_number'];
                                    } else {
                                        $clientName = "NA";
                                        $clientNumber = "NA";
                                    }
                                } else {
                                    $clientName = "NA";
                                    $clientNumber = "NA";
                                }
                                ?>
                                <div class="row"><label class="col-md-2 col-xs-4">Request ID:</label> <span class="col-md-10 col-xs-8"><?php echo $data['request_id']; ?></span></div>
                                <div class="row"><label class="col-md-2 col-xs-4">Requester Name:</label> <span class="col-md-10 col-xs-8"><?php echo $requestor_name; ?></span></div>
                                <?php
                                if (!empty($data['department_id'])) {
                                    $dept_data = $this->Common->getDeptData($data['department_id']);
//                                    pr($dept_data);
//                                     exit;
                                    ?>
                                    <div class="row"><label class="col-md-2 col-xs-4">Department:</label> <span class="col-md-10 col-xs-8"><?php echo isset($dept_data['name']) ? $dept_data['name'] : "NA"; ?></span></div>
                                <?php } ?>
                                <?php
                                $last4digitSSN = substr($data['ssn_no'], -4);
//                                pr($last4digits);
                                ?>
                                <h4><strong>Firm Details</strong></h4>

                                <div class="row"><label class="col-md-2 col-xs-4">Client Number:</label> <span class="col-md-10 col-xs-8"><?php echo $clientNumber; ?></span></div>
                                <div class="row"><label class="col-md-2 col-xs-4">Client Name:</label> <span class="col-md-10 col-xs-8"><?php echo $clientName; ?></span></div>
                                <div class="row"><label class="col-md-2 col-xs-4">Matter ID:</label> <span class="col-md-10 col-xs-8"><?php echo $matterNumber; ?></span></div>
                                <div class="row"><label class="col-md-2 col-xs-4">Matter Name:</label> <span class="col-md-10 col-xs-8"><?php echo $matterName; ?></span></div>
                                <h4> <strong>Patient Details</strong></h4>
                                <div class="row"><label class="col-md-2 col-xs-4">First Name:</label> <span class="col-md-10 col-xs-8"><?php echo $data['first_name']; ?></span></div>
                                <div class="row"><label class="col-md-2 col-xs-4">Last Name:</label> <span class="col-md-10 col-xs-8"><?php echo $data['last_name']; ?></span></div>
                                <div class="row"><label class="col-md-2 col-xs-4">Social Security Number:</label> <span class="col-md-10 col-xs-8"><?php echo!empty($last4digitSSN) ? '*****' . $last4digitSSN : "NA"; ?></span></div>
                                <div class="row"><label class="col-md-2 col-xs-4">Date of birth:</label> <span class="col-md-10 col-xs-8"><?php echo date('M d, Y', strtotime($data['dob'])); ?></span></div>
                                <div class="row"><label class="col-md-2 col-xs-4">Start date of request:</label> <span class="col-md-10 col-xs-8"><?php echo date('M d, Y', strtotime($data['rec_start_date'])); ?></span></div>
                                <div class="row"><label class="col-md-2 col-xs-4">End date of request:</label> <span class="col-md-10 col-xs-8"><?php echo date('M d, Y', strtotime($data['rec_end_date'])); ?></span></div>
                                <div class="row"><label class="col-md-2 col-xs-4">Record fee limit $:</label> <span class="col-md-10 col-xs-8"><?php echo $data['threshold']; ?></span></div>   
                                <input type="hidden" id ='threshold' name="threshold" value="<?php echo $data['threshold']; ?>" >
                                <div class="row"><label class="col-md-2 col-xs-4">Records Type:</label> <span class="col-md-10 col-xs-8"><?php echo $this->Common->getRecordType($data['record_type']); ?></span></div>    
                                <div class="row"><label class="col-md-2 col-xs-4">HIPAA Authorization Form:</label> <div class="col-md-10 col-xs-8"> <?php echo $this->html->link('View HIPAA Authorization Form<i class="fa fa-cloud-download" title="View HIPAA Authorization Form"></i> ', 'img/hippa/original/' . $data['upload_hippa'], ['class' => 'downloadIcon', 'escape' => false, 'target' => '_blank']); ?></div></div>
                                <div class="row"><label class="col-md-2 col-xs-4">Date of signature on HIPAA authorization:</label> <div class="col-md-10 col-xs-8"> <?php echo date('M d, Y', strtotime($data['hippa_form_date'])); ?></div></div>  
                                <div class="row"><label class="col-md-2 col-xs-4">Date of Request:</label> <div class="col-md-10 col-xs-8"> <?php echo date('M d, Y', strtotime($data['date_of_request'])); ?></div></div>
                                <div class="row"><label class="col-md-2 col-xs-4">Special Instructions:</label> <span class="col-md-10 col-xs-8"><?php echo (!empty($data['description'])) ? $data['description'] : 'NA'; ?></span></div>
                                <!--uploaded documents-->
                                <?php
                                if (!empty($data['request_completion_file_path'])) {
                                    $newArr = unserialize($data['request_completion_file_path']);
                                    ?>
                                    <div class="row">
                                        <label class="col-md-2 col-xs-4">Uploaded Documents:</label> <div class="col-md-10 col-xs-8"> <?php
                                            foreach ($newArr as $val) {
                                                echo $this->html->link('Requested Docs <i class="fa fa-cloud-download" title="View HIPAA Authorization Form"></i> ', '/documents/requestor/' . $data['requestor_id'] . '/' . $data['id'] . '/' . $val, ['class' => 'downloadIcon', 'escape' => false, 'target' => '_blank']);
                                                echo'<br>';
                                            }
                                            ?>
                                        </div>
                                    </div> 
                                <?php } ?>
                                <?php if ($data['request_status'] != '0') { ?>
                                    <div class="row"><label class="col-md-2 col-xs-4">Request fees $:</label> <span class="col-md-10 col-xs-8 requestFees"><?php echo $data['total_cost']; ?></span></div>
                                <?php } 
                                if($data['requestor_deny_reason'] != ''){
                                ?>                                
                                <div class="row"><label class="col-md-2 col-xs-4">Requestor's reason to deny:</label> <div class="col-md-10 col-xs-8" style="color : #ff0000"> <?php echo $data['requestor_deny_reason'];  ?></div></div>
                                <?php } ?>
                                <?= $this->Form->control('finalFees', ['class' => 'form-control', 'type' => 'hidden', 'id' => 'finalFees', 'label' => false, 'autocomplete' => 'off', 'value' => (isset($data['total_cost']) ? $data['total_cost'] : '')]) ?>
                                <?= $this->Form->control('fees', ['class' => 'form-control', 'type' => 'hidden', 'id' => 'fees', 'label' => false, 'autocomplete' => 'off', 'value' => (isset($fees) ? $fees : '')]) ?>
<?= $this->Form->control('feesType', ['class' => 'form-control', 'type' => 'hidden', 'id' => 'feesType', 'label' => false, 'autocomplete' => 'off', 'value' => (isset($feestype) ? $feestype : '')]) ?>
                            </div>
                        </div>
                    </div><!-- /.box-body -->
                    <div class="col-md-2 pull-right">                
                        <!--<button type="submit" class="btn btn-info "> Process Request</button>-->              
                    </div>
                    <div class="col-md-2 pull-left">
                        <?php echo $this->Html->link('Back',['controller' => 'Providers', 'action' => 'viewAllRequests', '_full' => true],['class'=>'btn btn-info']);?>
                        <!--<button type="submit" class="btn btn-info "> Cancel Request</button>-->              
                    </div>
                </div>
            </div><!-- ./col -->
        </div><!-- /.row -->
        <!-- Main row -->
</section><!-- /.content -->
 

<div id="ProviderResponseModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Please confirm whether you are accepting or denying the request?</label>
                </div>
                <div class="form-group">
                    <label class="radio-inline">
                        <input type="radio" name="ProviderResponseIn" value="1">Accept
                  </label>
                  <label class="radio-inline">
                    <input type="radio" name="ProviderResponseIn" value="2">Deny
                  </label> 
                    
                </div>
                <div class="reasonDiv">
                    <div class="form-group" >
                        <label for="exampleFormControlTextarea1">Please specify the reason to deny the request?</label>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" id="reason" rows="3"></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="ProviderResponseBtn">Save changes</button>
            </div>
        </div>

    </div>
</div>

<div id="ProviderResultModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Please confirm request's record status.</label>
                </div>
                <div class="form-group">
                    <label class="radio-inline">
                        <input type="radio" name="ProviderResultIn" value="1">Found
                  </label>
                  <label class="radio-inline">
                    <input type="radio" name="ProviderResultIn" value="2">Not Found 
                  </label> 
                    
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="ProviderResultBtn">Save changes</button>
            </div>
        </div>

    </div>
</div>

<div id="ThreasHoldModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">The fees you are  quoting is higher than the threshold fees quoted in Request. Please confirm you wish to proceed.</label>
                </div>
                <div class="form-group">
                    <label class="radio-inline">
                        <input type="radio" name="ThreasHoldIn" value="1">Proceed
                  </label>
                  <label class="radio-inline">
                    <input type="radio" name="ThreasHoldIn" value="2">Change fees
                  </label> 
                </div>
                <div class="form-group" id="ProFeesChangeDiv"> 
                     <div class="form-group">
                    <label for="exampleFormControlTextarea1">Please enter revised fees.</label>
                    </div>
                    <label class="radio-inline">
                        <input type="text" name="ProFeesChange" value="" id="ProFeesChange">
                    </label>
                    
                       <label class="error thresholdError">Revised rate should be less than or equal to threshold value set by requestor.</label>
                    
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="ThreasHoldBtn">Save changes</button>
            </div>
        </div>

    </div>
</div>

<div id="PriceModel" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="alert alert-success payUpdatedSuccess" style="display:none" role="alert">
                    <strong>Payment details updated successfully.</strong> 
                </div>
                <div class="alert alert-danger payUpdatedFailure" style="display:none" role="alert">
                    <strong>Payment details update failed.</strong>
                </div>
                <div class="form-group">
                    <div class="row">
                <?php if ($feestype == 1) { ?>
                            <div class="col-sm-12">
                                <div class="price-form">
                                    <label for="exampleFormControlTextarea1" class="control-label">You are going to accept this request. Please confirm your fees for completing this request.</label>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label for="amount_amirol" class="control-label">Provider's fees ($): </label>
                                                <span class="help-text">Amount that you are charging on per page basis</span>
                                            </div>
                                            <div class="col-sm-6">
                                                <input class="price lead" name="providerFees" type="text" id="providerFees" disabled="disabled" style="" value="<?php echo $fees; ?>"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label for="amount_amirol" class="control-label">No of pages: </label>
                                                <span class="help-text">No of pages which will be provided back  to  requestor.</span>
                                            </div>
                                            <div class="col-sm-6">
                                                <input class="price lead" name="noOfPages" type="text" id="noOfPages"  style="" />
                                            </div>
                                        </div>
                                    </div>

                                    <input class="price lead" name="adminPercentage" type="hidden"  data-adminshare = "<?php echo $adminFees; ?>" id="adminPercentage" disabled="disabled" style="" value="<?php echo $adminFees; ?>%" />
                                    <input class="price lead" name="adminFees" type="hidden" id="adminFees" disabled="disabled" style="" value="<?php echo ''; ?>" />

                                    <div style="margin-top:30px"></div>
                                    <hr class="style">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label for="amount_amirol" class="control-label">Total fees ($): </label>
                                                <span class="help-text">Total fees which will be charged to requester.</span>
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="hidden" id="amount_amirol" class="form-control">
                                                <input class="price lead" name="totalFees" type="text" id="totalFees" disabled="disabled" style="" value="" />
                                                <input class="price lead" name="ProFees" type="hidden" id="ProFees" disabled="disabled" style="" value="" />
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                <?php } else { ?>
                            <div class="col-sm-12">
                                <div class="price-form">
                                    <label for="exampleFormControlTextarea1" class="control-label">You are going to accept this request. Please confirm your fees for completing this request.</label>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label for="amount_amirol" class="control-label">Provider's fees ($): </label>
                                                <span class="help-text">Amount that you are charging on flat fees basis</span>
                                            </div>
                                            <div class="col-sm-6">
                                                <input class="price lead" name="providerFees" type="text" id="providerFees" disabled="disabled" style="" value="<?php echo $fees; ?>"/>
                                            </div>
                                        </div>
                                    </div>

                                    <input type="hidden" id="amount_amirol" class="form-control">
                                    <input class="price lead" name="adminPercentage" data-adminshare = "<?php echo $adminFees; ?>"  type="hidden" id="adminPercentage"  disabled="disabled" value="<?php echo $adminFees; ?>%" />
                                    <input class="price lead" name="adminFees" type="hidden" id="adminFees" disabled="disabled" style="" value="<?php echo $adminFees; ?>" />

                                    <div style="margin-top:30px"></div>
                                    <hr class="style">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label for="amount_amirol" class="control-label">Total fees ($): </label>
                                                <span class="help-text">Total fees which will be charged to requester.</span>
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="hidden" id="amount_amirol" class="form-control">
                                                 <input class="price lead" name="ProFees" type="hidden" id="ProFees" disabled="disabled" style="" value="<?php echo $fees; ?>" >
                                                <input class="price lead" name="totalFees" type="text" id="totalFees" disabled="disabled" style="" value="<?php echo $adminFees + $fees; ?>" />
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                <?php } ?>
                        <input type="hidden" id="dataUpdate" name="dataUpdate">
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="form-group">
                        <div class="col-sm-6">
                            <button type="button"  data-dismiss="modal" class="btn btn-secondary btn-lg btn-block">Cancel <span class="glyphicon glyphicon-chevron-right"></span></button>
                        </div>
                        <div class="col-sm-6">
                            <button type="button" id="pay" class="btn btn-primary btn-lg btn-block">Proceed <span class="glyphicon glyphicon-chevron-right"></span></button>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
<div class="modal fade" id="uploadModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Add new file</h4>

            </div>
            <div class="modal-body" id="modal-body">
                <form action ="#" method = "POST" enctype = "multipart/form-data" class = "form-horizontal" name="formData" id="data">
                    <ul>
                        <div class="alert alert-danger" style="display: none;" id="errDiv">
                            <strong>Please</strong> upload files!
                        </div>
                        <div class = "form-group">
                            <label class="control-label col-sm-1" for = "file">File:</label>    
                            <div class="col-sm-9">
                                <input type = "file" name = "file_upload" id = "file_upload" multiple class = "form-control-file">
                            </div>
                            <div class="row">
                                <div class="col-sm-7">
                                    <span>Only files with max-size 50M can be uploaded. Files with extension .doc,.pdf will only be accepted.</span> 
                                </div>
                            </div>
                        </div>

                        <div class = "button">
                            <div class="form-group">
                                <div class="col-sm-offset-1 col-sm-6">
                                    <input type="submit" name = "submit" class="btn btn-primary" value = "Submit" id="file_upload">
                                </div>
                            </div>
                        </div>

                    </ul>
                </form>
                <br/>
                <div class="progress" style="display:none;">
                    <div class="progress-bar bg-success  progress-bar-striped" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%;"></div>
                </div>
                <div id = "result"></div>
            </div>

        </div>
    </div>
</div>
<script>
    jQuery(document).ready(function () {

        var RS = jQuery("#request_status").val();

        updateProgressBar(RS);

        function updateProgressBar(RS) {
            RS = parseInt(RS);
            var items = jQuery(".progress-bar");
            jQuery(items).find("a").css('pointer-events', 'all');

            jQuery.each(items, function (index, item) {
                if (RS >= jQuery(item).attr("data-update")) {
                    jQuery(item).addClass('progress-bar-success');
                    jQuery(item).find(".proBarIcon").removeClass('offBg');
                    jQuery(item).find(".proBarIcon").addClass('newBg');
                    jQuery(item).find("a").css('pointer-events', 'none');
                }
            });

            switch (RS) {
                case 0:
                    jQuery(items).find("a:not('#provider_response')").css('pointer-events', 'none');
                    break;
                case 1:
                    jQuery(items).find("a:not('#inProgress')").css('pointer-events', 'none');
                    jQuery("#provider_response_span").html('Accepted');
                    break;
                case 2:
                    jQuery(items).find("a").css('pointer-events', 'none');
                    jQuery("#provider_response_span").html('Povider Denied');    
                    jQuery("#provider_response_span").addClass('response_span_denied');  
                    jQuery("#divprovider_response").removeClass('progress-bar-success').addClass('progress-bar-denied');
                    jQuery("#divprovider_response").find(".proBarIcon").addClass('progress-bar-denied').removeClass('progress-bar-success').removeClass('newBg');

                    break;
                case 3:
                    jQuery(items).find("a").css('pointer-events', 'none');
                    jQuery("#provider_response_span").html('Threashold limit exceed');   
                    break;
                case 4:
                    var items = jQuery(".progress-bar");
                    jQuery(items).find("a:not('#Records')").css('pointer-events', 'none');
                    break;
                    
                case 5:
                    var items = jQuery(".progress-bar");
                    jQuery(items).find("a").css('pointer-events', 'none');
                    jQuery("#Records_span").html('Records Available'); 
                    jQuery("#divRecords").addClass('progress-bar-success');
                    jQuery("#divRecords").find(".proBarIcon").addClass('progress-bar-success').addClass('newBg');
                    
                    break;
                    
                case 6:
                    var items = jQuery(".progress-bar");
                    jQuery(items).find("a").css('pointer-events', 'none');
                    jQuery("#Records_span").html('No Records Found'); 
                    break;
                
                case 7:
                    jQuery(items).find("a").css('pointer-events', 'none');
                    jQuery("#provider_response_span").html('Requestor denied');    
                    jQuery("#provider_response_span").addClass('response_span_denied');  
                    jQuery("#divprovider_response").removeClass('progress-bar-success').addClass('progress-bar-denied');
                    jQuery("#divprovider_response").find(".proBarIcon").addClass('progress-bar-denied').removeClass('progress-bar-success').removeClass('newBg');
                    break;

                default:
                   jQuery(items).find("a").css('pointer-events', 'none');
                    break;
            }
        }

        $("input[name$='ProviderResponseIn']").click(function() {
            var ProviderResponseOP = $(this).val();
            if(ProviderResponseOP == 2){ 
                jQuery(".reasonDiv").css('display','block');
                $("#ProviderResponseBtn").attr("id", "saveDenyModel");
            }
             if(ProviderResponseOP == 1){ 
                jQuery(".reasonDiv").css('display','none');
            }
        });  
        
        $("input[name$='ThreasHoldIn']").click(function() {
            var ThreasHoldOP = $(this).val();
            if(ThreasHoldOP == 2){ 
                jQuery("#ProFeesChangeDiv").css('display','block');
            }
            if(ThreasHoldOP == 1){ 
                jQuery("#ProFeesChangeDiv").css('display','none');
            }
        });    
        
        jQuery(document).on('click', "#saveDenyModel", function () {
                var update = 2;
                var reason = jQuery("#reason").val();
                var request_id = jQuery("#request_id").val();
                jQuery.ajax({
                    type: "POST",
                    data: {id: request_id, request_status: update, reason: reason},
                    url: "/providers/saveReason",
                    dataType: 'json',
                    success: function (json) {
                        if (json.status == 'success') {
                            AjaxService(request_id, update);
                            updateProgressBar(update);
                            jQuery("#request_status").val(update);
                            jQuery("#ProviderResponseModal").modal('hide');
                            jQuery("#provider_response_span").html('Denied');    
                            jQuery("#provider_response_span").addClass('response_span_denied');  
                            jQuery("#divprovider_response").removeClass('progress-bar-success').addClass('progress-bar-denied');
                            jQuery("#divprovider_response").find(".proBarIcon").addClass('progress-bar-denied').removeClass('progress-bar-success').removeClass('newBg');
                        }
                    },
                    error: function () {
                        // $('.loading').hide();
                    }
                });
        });

        jQuery(document).on('click', ".progressUpdate", function (e) {
            
            var update = jQuery(this).attr("data-update");
            var request_id = jQuery("#request_id").val();
            if (update == 1) {
                $('#ProviderResponseModal').modal('show');
                $("#dataUpdate").val(update);
            } else if (update == 2) {
                $("#statusName").html("Denied");
                $("#dataUpdate").val(update);
                $('#denyModal').modal('show');
            } else if (update == 5) {
                e.preventDefault();
                $('#ProviderResultModal').modal('show');
            } else {
                AjaxService(request_id, update);
                updateProgressBar(update);
            }
        });

        jQuery(document).on('click', "#saveReason", function () {
            var update = jQuery("#dataUpdate").val();
            var reason = jQuery("#reason").val();
            var request_id = jQuery("#request_id").val();
            $('#loddingImage').show();
            jQuery.ajax({
                type: "POST",
                data: {id: request_id, request_status: update, reason: reason},
                url: "/providers/saveReason",
                dataType: 'json',
                success: function (json) {
                    if (json.status == 'success') {
                         $('#loddingImage').hide();
                        AjaxService(request_id, update);
                        updateProgressBar(update);
                        jQuery("#request_status").val(update);
                        $('#denyModal').modal('hide');
                    }
                },
                error: function () {
                    // $('.loading').hide();
                }
            });

        });
        jQuery(document).on('click', "#ProviderResponseBtn", function () {
            if($("input:radio[name=ProviderResponseIn]:checked").val() == undefined){
                return false;
            }
            if($("input[name$='ProviderResponseIn']").val() == 1){
                jQuery('#ProviderResponseModal').modal('hide');
                jQuery('#PriceModel').modal("show");
            }
        });
        
        jQuery(document).on('click', "#ProviderResultBtn", function () {
            var request_id = jQuery("#request_id").val();
             if($("input:radio[name=ProviderResultIn]:checked").val() == undefined){
                return false;
            }
            if($("input:radio[name=ProviderResultIn]:checked").val() == 1){
                jQuery('#ProviderResultModal').modal('hide');
                jQuery('#uploadModal').modal("show");
            }else if($("input:radio[name=ProviderResultIn]:checked").val() == 2){
                jQuery("#request_status").val(6);
                jQuery("#ProviderResultModal").modal('hide');
                jQuery("#Records_span").html('No Records Found');    
                AjaxService(request_id, 6);
                updateProgressBar(6);
            }
        });
        // Variable to store your files
        var files;

        // Add events
        $('input[type=file]').on('change', prepareUpload);
        $('form').on('submit', uploadFiles);

        // Grab the files and set them to our variable
        function prepareUpload(event)
        {
            files = event.target.files;
        }

        // Catch the form submit and upload the files
        function uploadFiles(event)
        {
            event.stopPropagation(); // Stop stuff happening
            event.preventDefault(); // Totally stop stuff happening

            // START A LOADING SPINNER HERE

            // Create a formdata object and add the files
            var data = new FormData();
            if (files == undefined) {
                $('#errDiv').show();
                return false;
            } else {
                $('#errDiv').hide();
                $('#loddingImage').show();
                $.each(files, function (key, value)
                {
                    data.append(key, value);
                });
            }
            var request_id = jQuery("#request_id").val();
            var requestor_id = jQuery("#requestor_id").val();
            var finalFees = jQuery("#finalFees").val();
            data.append('request_id', request_id);
            data.append('requestor_id', requestor_id);
            data.append('finalFees', finalFees);
            $('.progress').show();
            $.ajax({
                url: '/providers/completeUpload',
                type: 'POST',
                data: data,
                cache: false,
                dataType: 'json',
                processData: false, // Don't process the files
                contentType: false, // Set content type to false as jQuery will tell the server its a query string request
                xhr: function () {
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener("progress", function (evt) {
                        if (evt.lengthComputable) {
                            var percentComplete = evt.loaded / evt.total;
                            percentComplete = parseInt(percentComplete * 100);
                            $('.progress-bar-striped').css('width', percentComplete + "%");
                            $('.progress-bar-striped').html(percentComplete + "%");
                            if (percentComplete === 100) {

                            }
                        }
                    }, false);
                    return xhr;
                },
                success: function (data, textStatus, jqXHR)
                {
                    var json = $.parseJSON(JSON.stringify(data));
                    if (json.status == 'success') {
                        $('#loddingImage').hide();
                        jQuery("#uploadModal").modal("hide");
                        jQuery("#Records_span").html('Records Available');    
                        jQuery("#Records_span").addClass('response_span_success'); 
                        AjaxService(request_id, 5);
                        bootbox.alert("The documents have been uploaded successfully for this request!",
                                function () {
                                    //window.location.reload();
                                }
                        );
                    }else{
                        $('#loddingImage').hide();
                        alert(json.status);
                    }
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    // Handle errors here
                    console.log('ERRORS: ' + textStatus);
                    // STOP LOADING SPINNER
                }
            });
        }

        function AjaxService(request_id, update) {
            data = {id: request_id, request_status: update}
            jQuery.ajax({
                type: "POST",
                data: data,
                url: "/providers/updateRequestStatus",
                dataType: 'json',
                success: function (json) {
                    json = $.parseJSON(JSON.stringify(json));
                    if (json.status == 'success') {
                        jQuery("#request_status").val(update);
                        updateProgressBar(update);
                        //window.location.reload();
                    }
                },
                error: function () {
                    // $('.loading').hide();
                }
            });
        }

        jQuery(document).on("input", "#noOfPages", function () {
            this.value = this.value.replace(/\D/g, '');
        });
        jQuery('#noOfPages').on('input', function (e) {
            var final = 0;
            var pages = parseInt(jQuery('#noOfPages').val());
            if (isNaN(pages) || pages == '') {
                return false;
            }
            var fees = parseInt(jQuery('#providerFees').val());
            var num = pages * fees;
            var adminPercentage = parseInt(jQuery('#adminPercentage').attr('data-adminshare'));
            //final = percentage(num, adminPercentage);
            var totalFees = adminPercentage + num;
            jQuery("#totalFees").attr('value', parseInt(totalFees));
            jQuery("#ProFees").val(num);
            jQuery("#adminFees").val(adminPercentage);
        });

        function percentage(num, per)
        {
            return (num / 100) * per;
        }

        jQuery(document).on('click', "#pay", function () {
            $('#loddingImage').show();
            var threshold = jQuery("#threshold").val();
            var update = 1;
            var request_id = jQuery("#request_id").val();
            var finalFees = parseInt(jQuery("#totalFees").val());
            if(finalFees > threshold){
                jQuery("#PriceModel").modal('hide');
                jQuery("#ThreasHoldModal").modal('show');
                $('#loddingImage').hide();
                return false;
            }
            var ProFees = parseInt(jQuery("#ProFees").val());
            var feesType = jQuery("#feesType").val();
            var system_fee = parseInt(jQuery("#adminFees").val());
            if (feesType == '1') {
                var pages = parseInt(jQuery('#noOfPages').val());
                if (isNaN(pages) || pages == '') {
                    return false;
                }

                data = {id: request_id, request_status: update, finalFees: finalFees, ProFees: ProFees, feesType: feesType, pages: pages, system_fee: system_fee}
            } else {

                data = {id: request_id, request_status: update, finalFees: finalFees, feesType: feesType, ProFees: ProFees, system_fee: system_fee}
            }

            jQuery.ajax({
                type: "POST",
                data: data,
                url: "/providers/savePayment",
                dataType: 'json',
                success: function (json) {
                    json = $.parseJSON(JSON.stringify(json));
                    if (json.status == 'success') {
                        updateProgressBar(update);
                        jQuery("#request_status").val(update);
                        jQuery("#payUpdatedSuccess").show();
                        jQuery(".request-fee-blk").show();
                        jQuery(".requestFees").html(finalFees);
                        jQuery("#provider_response_span").html('Accepted');    
                        jQuery("#provider_response_span").addClass('response_span_success');    
                        setTimeout(function () {
                            $('#loddingImage').hide();
                            $('#PriceModel').modal("hide");
                        }, 3000);
                    } else if (json.status == 'error') {
                        jQuery("#payUpdatedFailure").show();
                    } else {

                    }
                },
                error: function () {
                    // $('.loading').hide();
                }
            });

        });
        
        jQuery(document).on('click', "#ThreasHoldBtn", function () {
            $('#loddingImage').show();
            var threshold = jQuery("#threshold").val();
            var update = 1;
            var request_id = jQuery("#request_id").val();
           
            if($("input:radio[name=ThreasHoldIn]:checked").val() == 2){
                 var finalFees = parseInt(jQuery("#ProFeesChange").val());
                if(finalFees > threshold){
                    jQuery(".thresholdError").show();
                    $('#loddingImage').hide();
                    return false;
                }
                jQuery("#ProFees").val( parseInt(jQuery("#threshold").val() - jQuery("#adminFees").val()));
                var ProFees = parseInt(jQuery("#ProFees").val());
            } else{
                 var finalFees = parseInt(jQuery("#totalFees").val());
                update = 3;
            }
            var ProFees = parseInt(jQuery("#ProFees").val()); 
            var feesType = jQuery("#feesType").val();
            var system_fee = parseInt(jQuery("#adminFees").val());
            if (feesType == '1') {
                var pages = parseInt(jQuery('#noOfPages').val());
                if (isNaN(pages) || pages == '') {
                    return false;
                }

                data = {id: request_id, request_status: update, finalFees: finalFees, ProFees: ProFees, feesType: feesType, pages: pages, system_fee: system_fee}
            } else {

                data = {id: request_id, request_status: update, finalFees: finalFees, feesType: feesType, ProFees: ProFees, system_fee: system_fee}
            }

            jQuery.ajax({
                type: "POST",
                data: data,
                url: "/providers/savePayment",
                dataType: 'json',
                success: function (json) {
                    json = $.parseJSON(JSON.stringify(json));
                    if (json.status == 'success') {
                        updateProgressBar(update);
                        jQuery("#request_status").val(update);
                        jQuery("#payUpdatedSuccess").show();
                        jQuery(".request-fee-blk").show();
                        jQuery(".requestFees").html(finalFees);
                        setTimeout(function () {
                            $('#loddingImage').hide();
                            $('#ThreasHoldModal').modal("hide");
                        }, 3000);
                    } else if (json.status == 'error') {
                        jQuery("#payUpdatedFailure").show();
                    } else {

                    }
                },
                error: function () {
                    // $('.loading').hide();
                }
            });

        });

    });



</script>