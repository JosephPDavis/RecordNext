<?php

//pr($requestData); exit;
?>
<style>
    .table-bordered > tbody > tr > td, .table-bordered > tfoot > tr > td {
        cursor: pointer;
    }    
    .field-disable-colr{
        background-color: #fff !important;
    }
    .pay-now-btn{
        margin-bottom:8px;
    }
    .dont-show{
        display: none;
    }
</style>
<section class="content-header">
    <h1>
        Requests
<!--        <small>Optional description</small>-->
    </h1>
    <ol class="breadcrumb">
        <li>
             <?php echo $this->Html->link('Dashboard <i class="fa fa-dashboard"></i>',['controller' => 'Admins', 'action' => 'paymentListings', '_full' => true],['class'=>'','escape' => false]);?>
            <!--<a href="#"><i class="fa fa-dashboard"></i> Level</a>-->
        </li>
        <li class="active">Request Listing</li>
    </ol>
</section>
<section class="content container-fluid">
    <!-- Content Header (Page header) -->

    <div class="row">

        <!-- ./col -->       
        <!-- ./col -->
        <div class="col-md-12">
            <div class="box">
                <div class="alert alert-danger ProviderAlert dont-show">
                    <strong>Payment can not process as Provider haven't had submitted his bank details yet.</strong>
                  </div>
                <?php echo $this->Form->create(null, array('id'=>'searchForm')); ?>
                <div class="box-header with-border">
                    <div class="row">
                        <div class="col-md-2"> 
                            <?php echo $this->Form->input('by_name',array('label' => false,'div' => false,'value'=>$name_keyword ,'placeholder'=>"Search" , 'class' => 'form-control pull-right', 'type'=>'text','maxlength'=>15));?>  
                            <!--<input name="table_search" class="form-control pull-right" placeholder="Search" type="text">-->               
                            <span class="help-block pull-left spn100">By name </span>
                        </div>
                        <div class="col-md-2">                
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <?php echo $this->Form->input('by_start_date',array('label' => false,'div' => false,'value'=>$start_date ,'placeholder'=>"Start date" , 'class' => 'form-control pull-right field-disable-colr','id'=>"start_datepicker",'readonly'=>'readonly'));?>  
                                <!--<input type="text" class="form-control pull-right" id="datepicker">-->

                            </div>
                            <span class="help-block">Search by start date</span>
                        </div>

                        <div class="col-md-2">                
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <?php echo $this->Form->input('by_end_date',array('label' => false,'div' => false,'value'=>$end_date ,'placeholder'=>"End date" , 'class' => 'form-control pull-right field-disable-colr','id'=>"end_datepicker",'readonly'=>'readonly'));?>  
                                <!--<input type="text" class="form-control pull-right" id="datepicker">-->

                            </div>
                            <span class="help-block">Search by end date</span>
                        </div>
                        <div class="col-md-2">                
                                <?php 
                                $dateDateRange = ['Paid'=>'Paid','Unpaid'=>'Unpaid'];
                                echo $this->Form->input('payment_status',array('label' => false,'type'=>'select','options'=>$dateDateRange,'div' => false,'value'=>'' ,'empty'=>"Select status" , 'class' => 'form-control pull-right','id'=>"payment_status"));?>  
                            <span class="help-block pull-left spn100">Select the payment status</span>
                        </div>

                        <div class="col-md-2">     
                            <?php echo $this->Form->button('<i class="fa fa-search"></i> Search', array('div' => false, 'class'=>'btn btn-info','type'=>'submit'),array('escape' => false)); ?>
                            <!--<button type="submit" class="btn btn-info "><i class="fa fa-search"></i> Search</button>-->              
                        </div>

                    </div>
                </div>
                <?php echo $this->Form->end(); ?>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-bordered  table-striped">
                            <tr>
                                <!--<th width="7%"><?php // echo $this->Paginator->sort('Request.id', 'Sr No #'); ?></th>-->
                                <th><?php 
                                    echo $this->Form->checkbox('checkAll', [
                                        'value' => 'Y',
                                         'id'=>'checkAll',
                                        'hiddenField' => 'N',
                                ]); ?></th>
                                <th><?php echo $this->Paginator->sort('Request.request_id', 'Request#'); ?></th>
                                <th><?php echo $this->Paginator->sort('Request.provider_id', 'Provider Name'); ?></th>
                                <th><?php echo $this->Paginator->sort('Request.requestor_id', 'Requestor Name'); ?></th>
                                <th><?php echo $this->Paginator->sort('Request.threshold', 'Threshold'); ?></th>
                                <th><?php echo $this->Paginator->sort('Request.ProFees', 'Provider fees'); ?></th>
                                <th><?php echo $this->Paginator->sort('Request.total_cost', 'Received'); ?></th>
                                <th>Payment status</th>
                                <th>Action</th>
                            </tr>
                            <?php 
                            if(!empty($requestData)){
//                            $srno= 1;
                            foreach($requestData as $req){
                                
                                   $provider_data = $this->Common->getProviderData($req['provider_id']);
                                   $requestor_data = $this->Common->getRequesterData($req['requestor_id']);
                                   $created = date('M d, Y', strtotime($req['modified ']));
                                   $request_status = $this->Common->getStatusByID($req['request_status']);
                                   $providerAccountData = $this->Common->getProviderAccId($req['provider_id']);
                                    
                                   ?>
                            <tr>
                                <!--<td><?php // echo $srno; ?></td>-->
                                <td>
                                    
                                <?php 
                                if(empty($providerAccountData)){
                                    
                                }else{
                                  if($req['paid_to_provider'] == 0){
                                    echo $this->Form->checkbox('Select', [
                                        'value' => 'Y',
                                        'hiddenField' => 'N',
                                        'data-reqID'=> $req['id'],
                                        'class'=>'requestChk',
                                        'data-payment'=> $req['ProFees'],
                                        'data-provider_id'=> $req['provider_id'],
                                ]);}else{
                                    echo "&nbsp;";
                                }   
                                }
                                ?>
                                </td> 
                                
                                <td onclick="viewDetails('<?php echo $this->Common->encrypt($req['id']);?>');"><?php echo $req['request_id']; ?></td> 
                                <td><?php echo $provider_data['first_name'].' '.$provider_data['last_name']; ?></td>
                                <td><?php echo $requestor_data['first_name'].' '.$requestor_data['last_name']; ?></td>
                                <td><?php echo $req['threshold']; ?></td> 
                                <td><?php echo $req['ProFees']; ?></td> 
                                <td><?php echo $req['total_cost']; ?></td>
                                <td><?php 
                                            if($req['paid_to_provider'] == 0){ 
                                                if(!empty($providerAccountData)){?>
                                    <a class='label label-warning makePayment' href="javascript:void(0);"  data-reqId="<?php echo $req['id']; ?>" data-ProId="<?php echo $req['provider_id'];?>" data-Profees="<?php echo $req['ProFees']?>" >Unpaid</a>     
                                               <?php }else{ ?>
                                    <a class='label label-danger' href="javascript:void(0);" id="showAlert" data-reqId="<?php echo $req['id']; ?>" data-ProId="<?php echo $req['provider_id'];?>" data-Profees="<?php echo $req['ProFees']?>"  >Unpaid</a>       
                                             <?php  }
                                         }else{ ?>
                                    <a class='label label-success' href="javascript:void(0);">Paid</a>     
                                            <?php } ?>
                                </td>
                                <td><?php echo $this->Html->link('View Invoice',['controller' => 'Admins', 'action' => 'viewInvoice', $this->Common->encrypt($req['id']),'_full' => true],['class'=>'label label-warning','escape'=>false]);?></td>
                            </tr>
                            <?php 
//                            $srno++;
                         
                            }
//                            exit();
                            }else{
                                echo '<tr><td colspan="9">No records found.<td><tr>';
                            }
                            ?>
                        </table>
                        <div class="row">
                        <div class="col-md-6">
                            <span>Total Amount unpaid: <strong id="unpaidProviderCheckAll">0 $</strong></span>
                        </div>    
                        <div class="col-md-6">
                            <button class="btn btn-info pay-now-btn" id="makePaymentBulk">Pay now</button>  
                        </div>
                        </div>
                        <?php if(!empty($requestData)){ ?>
                            <?php echo $this->element('pagination'); ?>
                        <?php } ?>
                    </div></div>

                <!-- /.box-body -->


            </div>


        </div>
    </div>
</section>
<script>
    jQuery(document).ready(function () {
        // global variables 
        var sumArr = [];
        jQuery("#makePaymentBulk").attr("disabled", "disabled");
        jQuery("#checkAll").click(function () {
            jQuery('input:checkbox').not(this).prop('checked', this.checked);
            recalculate();
        });
        jQuery(".requestChk").click(function () {
            recalculate();
        });
        jQuery("#showAlert").click(function () { 
            jQuery(".ProviderAlert").show();
            jQuery(".ProviderAlert").fadeOut(1600,"slow");
            
        });
        function recalculate() {
            var sum = 0;
            var i = 0;
           
            jQuery("input[type=checkbox]:checked:not('#checkAll')").each(function () {
                sumArr[i] = {};
                sum += parseInt($(this).attr("data-payment"));
                sumArr[i]['provider_fees'] = $(this).attr("data-payment");
                sumArr[i]['request_id'] = $(this).attr("data-reqid");
                sumArr[i]['provider_id'] = $(this).attr("data-provider_id");
                i++;
            });
            jQuery("#unpaidProviderCheckAll").html(sum + ' $');
            if(i > 1){
            jQuery("#makePaymentBulk").removeAttr("disabled");                
          }else{
               jQuery("#makePaymentBulk").attr("disabled", "disabled");
          }
        }

        //bulk payment code starts
        jQuery("#makePaymentBulk").click(function () {
            console.log(sumArr);
            $('#loddingImage').show();
            if (sumArr.len > 10) {
                alert('You cannot process more than 10 rows for payment');
                return false;
            }
            var arrMsg = [];
            var j=0;
            $.ajax({
                type: "POST",
                data: {data: sumArr},
                url: '/admins/makeBulkPayment',
                //dataType: 'json',
                success: function (json) {
                    if (json != '') {
                        console.log(json);
                        json = JSON.parse(json);
                        var arrMsg = json.message;
                        $('#loddingImage').hide();
                        bootbox.alert(arrMsg,
                                function () {
                                    window.location.reload();
                                }
                        );
                    } else {

                    }
                },
                error: function (requestObject, error, errorThrown) {
                    alert(error);
                    alert(errorThrown);
                }
            });

        });
        //bulk payment code ends
        $('#start_datepicker').datepicker({
            dateFormat: "dd/mm/yy",
            startDate: new Date('1920-01-01'),
        });
        $('#start_datepicker').on('changeDate', function (ev) {
            $(this).datepicker('hide');
        });

        $('#end_datepicker').datepicker({
            format: 'mm/dd/yyyy',
            startDate: new Date('1920-01-01'),
        });
        $('#end_datepicker').on('changeDate', function (ev) {
            $(this).datepicker('hide');
        });

    });
    /*
     * to redirect on view details by clicking on row
     * Comment
     */
    function viewDetails(request_id) {
//    alert(request_id);
        var url = SITE_URL + 'admins/view-request/' + request_id;
        window.location.replace(url);
    }

    jQuery(".makePayment").click(function () {
        jQuery('#loddingImage').show();
        var request_id = jQuery(this).attr('data-reqid');
        var provider_id = jQuery(this).attr('data-proid');
        var provider_fees = jQuery(this).attr('data-profees');

        var data = {request_id: request_id, provider_id: provider_id, provider_fees: provider_fees}

        $.ajax({
            type: "POST",
            data: data,
            url: '/admins/makeSinglePayment',
            dataType: 'json',
            success: function (json) {
                if (json.status == 'success') {
                    $('#loddingImage').hide();
                    bootbox.alert("The payment to provider have been paid successfully! ",
                            function () {
                                window.location.reload();
                            }
                    );
                } else {

                }
            }
        });

    });
</script>