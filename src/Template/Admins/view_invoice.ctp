<?php ?>
<!-- Content Header (Page header) -->
<script src="https://code.jquery.com/jquery-1.12.3.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/0.9.0rc1/jspdf.min.js"></script>
<style>
    h3
    {
        border:1px solid black;
    }
    #printInvoiceDiv, #printInvoiceDiv * {
        visibility: visible;
    }
    #printInvoiceDiv {
        /*position: fixed;*/
        width: 100%;
        height: 100%;
        left: 0;
        top: 0;

    }
</style>
<section class="content-header">
    <h1>
        View Request Detail
         <!--<small>Optional description</small>-->
    </h1>
    <ol class="breadcrumb">
        <li>
                <?php echo $this->Html->link('Dashboard <i class="fa fa-dashboard"></i>',['controller' => 'Admins', 'action' => 'dashboard', '_full' => true],['class'=>'','escape' => false]);?>
        </li>
        <li class="active">View Invoice</li>
    </ol>
</section>    
<section class="content container-fluid">
    <!-- Small boxes (Start box) -->
    <div class="row">
        <div class="col-xs-12">
            <?php // echo $this->Session->flash(); ?>
            <div class="box box-primary">

                <div id="printDiv">
                    <div class="box-header with-border">
                        <h3 class="box-title">Invoice Information</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <div class="box-body box-profile">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="col-sm-12">

                                    <h4>Request Information</h4>
                                    <hr>
                                <?php  $provider_data = $this->Common->getProviderData($requestData['provider_id']);
                                $requestor_data = $this->Common->getRequesterData($requestData['requestor_id']);
                                       $matter_data = $this->Common->getMatterData($requestData['matter_id']);
                                       $getClientData = $this->Common->getClientData($requestData['client_id']);
                                       $request_status = $this->Common->getStatusByID($requestData['request_status']);
//                            ?>
                                    <div class="row"><label class="col-md-2 col-xs-4">Request ID:</label> <span class="col-md-10 col-xs-8" id="request_id"><?php echo $requestData['request_id']; ?></span></div>
                                    <div class="row"><label class="col-md-2 col-xs-4">Provider Name:</label> <span class="col-md-10 col-xs-8" id="provider_name"><?php echo $provider_data['first_name'].' '.$provider_data['last_name']; ?></span></div>
                                    <div class="row"><label class="col-md-2 col-xs-4">Requestor Name:</label> <span class="col-md-10 col-xs-8" id="requestor_name"><?php echo $requestor_data['first_name'].' '.$requestor_data['last_name']; ?></span></div>
                                <?php if(!empty($requestData['department_id'])){
                                    $dept_data = $this->Common->getDeptData($requestData['department_id']);
                                    
                                    ?>
                                    <div class="row"><label class="col-md-2 col-xs-4">Department:</label> <span class="col-md-10 col-xs-8" id="dept_name"><?php echo isset($dept_data)?$dept_data['name'] : "NA"; ?></span></div>
                                <?php }?>
                                    <div class="row"><label class="col-md-2 col-xs-4">Date of Request:</label> <div class="col-md-10 col-xs-8" id="date_of_req"> <?php echo date('M d, Y', strtotime($requestData['date_of_request'])); ?></div></div>
                                    <div class="row"><label class="col-md-2 col-xs-4">Records Type:</label> <span class="col-md-10 col-xs-8" id="record_type"><?php echo $this->Common->getRecordType($requestData['record_type']); ?></span></div>        
                                    <div class="row"><label class="col-md-2 col-xs-4">Request Status:</label> <div class="col-md-10 col-xs-8" id="request_status"> <?php echo $request_status; ?></div></div>
                                    <div class="row"><label class="col-md-2 col-xs-4">Record fee limit $:</label> <div class="col-md-10 col-xs-8" id="record_fee"> <?php echo $requestData['threshold']; ?></div></div>
                                    <div class="row"><label class="col-md-2 col-xs-4">System fees $:</label> <div class="col-md-10 col-xs-8" id="system_fee"> <?php echo $requestData['system_fee']; ?></div></div>
                                    <div class="row"><label class="col-md-2 col-xs-4">Provider fees $:</label> <div class="col-md-10 col-xs-8" id="provider_fee"> <?php echo (!empty($requestData['Profees']))?$requestData['Profees']:'NA'; ?></div></div>
                                    <div class="row"><label class="col-md-2 col-xs-4">Total cost charged $:</label> <div class="col-md-10 col-xs-8" id="total_cost"> <?php echo (!empty($requestData['total_cost']))?$requestData['total_cost']:'NA'; ?></div></div>
                                </div>

                            </div><!-- /.box-body -->
                        </div>
                        <hr>
                    <?php if(!empty($paymentData)){?>
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="col-sm-12">
                                    <h4>Payment Information</h4>
                                    <hr>
                                    <div class="row"><label class="col-md-2 col-xs-4"> Provider Fees:</label> <div class="col-md-10 col-xs-8" id="pro_fee"> <?php echo $requestData['provider_fees']; ?></div></div>
                                    <div class="row"><label class="col-md-2 col-xs-4"> Stripe transaction ID:</label> <div class="col-md-10 col-xs-8" id="trasaction_id"> <?php echo $paymentData['transaction_id']; ?></div></div>
                                    <div class="row"><label class="col-md-2 col-xs-4"> Payment Status:</label> <div class="col-md-10 col-xs-8" id="payment_status"> <?php echo $paymentData['payment_status']=='1'?'Paid':'Not Paid'; ?></div></div>
                                    <div class="row"><label class="col-md-2 col-xs-4"> Date of Payment:</label> <div class="col-md-10 col-xs-8" id="date_of_payment"> <?php echo date('M d, Y', strtotime($paymentData['modified'])); ?></div></div>
                                </div>
                            </div>
                        </div>
                  <?php  }?>
                    </div><!-- ./col -->
                </div>
                <div class="box-footer">
                    <div class="col-md-2 pull-left">
                        <?php echo $this->Html->link('Back',['controller' => 'Admins', 'action' => 'paymentListings', '_full' => true],['class'=>'btn btn-info']);?>
                    </div>
                    <div class="col-md-2 pull-right">
                        <button class="btn btn-info" type="button" id="printBtn" onclick="PrintDiv()">Print</button>
                    </div>
                </div>
            </div><!-- /.row -->
            <!-- Main row -->

            <!--print invoice starts-->
            <div id="printInvoiceDiv" style="display: none;">
                <div style="margin:0 auto;width:100%;">
                    <div style="float:left;width:100%;">

                        <div style="float:left;width:100%;">
                            <div style="float:left;width:100%;text-align:center;"><img src="/img/logo.png"> </div>
                        </div>

                        <div style="float:left;width:100%;">
                            <h1 style="font-size:20px;border-bottom:1px solid #eee;padding-bottom:5px;margin:0; text-align:center;padding-top:12px;">Invoice Information</h1>
                            <div style="float:left;width:100%;">
                                <h2 style="font-size:20px;border-bottom:1px solid #eee;padding:10px 0;margin:0;color:#666682;font-weight:normal;">Request Information</h2>
                                <table style="padding:10px 0;display:block;">
                                    <tr>
                                        <td style="font-weight:bold;">Request ID:</td>
                                        <td id="request_id_print"><?php echo $requestData['request_id']; ?></td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight:bold;">Provider Name:</td>
                                        <td id="provider_name_print"><?php echo $provider_data['first_name'].' '.$provider_data['last_name']; ?></td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight:bold;">Requestor Name:</td>
                                        <td id="requestor_name_print"><?php echo $requestor_data['first_name'].' '.$requestor_data['last_name']; ?></td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight:bold;">Date of Request:</td>
                                        <td id="date_of_req_print"><?php echo date('M d, Y', strtotime($requestData['date_of_request'])); ?></td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight:bold;">Record Type:</td>
                                        <td id="rec_type_print"><?php echo $this->Common->getRecordType($requestData['record_type']); ?></td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight:bold;">Request Status:</td>
                                        <td id="req_status_print"><?php echo $request_status; ?></td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight:bold;">Record fee Limit $:</td>
                                        <td id="rec_fee_print"><?php echo $requestData['threshold']; ?></td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight:bold;">System fee $:</td>
                                        <td id="sys_fee_print"> <?php echo $requestData['system_fee']; ?></td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight:bold;">Provider fee $:</td>
                                        <td id="pro_fee_print"><?php echo (!empty($requestData['Profees']))?$requestData['Profees']:'NA'; ?></td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight:bold;margin-right: 40px;display: block;">Total Cost Charged $:</td>
                                        <td id="tot_cost_print"> <?php echo (!empty($requestData['total_cost']))?$requestData['total_cost']:'NA'; ?></td>
                                    </tr>
                                </table>
                            </div>
                            <?php if(!empty($paymentData)){?>
                                <div style="float:left;width:100%;">
                                <h2 style="font-size:20px;border-bottom:1px solid #eee;padding:10px 0;margin:0;color:#666682;font-weight:normal;">Payment Information</h2>
                                <table style="border-bottom:1px solid #eee;display:block;padding:10px 0;">
                                    <tr>
                                        <td style="font-weight:bold;">Provider Fees:</td>
                                        <td prov_fee_print> <?php echo $paymentData['provider_fees']; ?></td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight:bold;margin-right: 40px;display: block;">Stripe Transaction Id:</td>
                                        <td id="stripe_trans_print"> <?php echo $paymentData['transaction_id']; ?></td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight:bold;">Payment Status:</td>
                                        <td><?php echo $paymentData['payment_status']=='1'?'Paid':'Not Paid'; ?></td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight:bold;">Date of Payment:</td>
                                        <td><?php echo date('M d, Y', strtotime($paymentData['modified'])); ?></td>
                                    </tr>

                                </table>
                            </div>
                            <?php }?>
                            


                        </div>

                    </div>
                </div>
            </div>
            </section><!-- /.content -->

            <script>
                jQuery(document).ready(function () {
                    var req_id = $('#request_id').html();
                    var pro_name = $('#provider_name').html();
                    var req_name = $('#requestor_name').text();

                    $('#request_id_print').text(req_id);
                    $('#provider_name_print').text(pro_name);
                    $('#requestor_name_print').html(req_name);


//                    var request_id = '<?php // echo $requestData['request_id'];?>';;
//                    var doc = new jsPDF();
//                    var specialElementHandlers = {
//                        '#editor': function (element, renderer) {
//                            return true;
//                        }
//                    };

//                    $('#printBtn').click(function () {
//                        $('printInvoiceDiv').show();
//                        doc.fromHTML($('#printInvoiceDiv').html(), 15, 15, {
//                            'width': 650,
//                            'elementHandlers': specialElementHandlers
//                        });
//                        doc.save(request_id + '_Invoice.pdf');
//                    });
                });

                function PrintDiv() {
                    var divToPrint = document.getElementById('printInvoiceDiv');
                    var $clonedData = $(divToPrint).clone();
                    $('.pop-up-invoice').modal('hide');
                    var popupWin = window.open('', '_blank', 'width=1100,height=1000');
//        $clonedData.find('#location_id').parent().text($clonedData.find('#location_id').val());
                    popupWin.document.open();
                    popupWin.document.write("<html><link rel='stylesheet' type='text/css' href='/css/frontend/bootstrap.min.css' />\n");
                    popupWin.document.write('<link href="/css/frontend/style.css" media="print" rel="stylesheet" type="text/css" /><body onload="window.print()">' + $clonedData.html() + '</html>');
                    popupWin.document.close();
                }
                // This code is collected but useful, click below to jsfiddle link.
            </script>