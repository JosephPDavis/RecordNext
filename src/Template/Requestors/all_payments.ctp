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
</style>
<section class="content-header">
    <h1>
        Requests
<!--        <small>Optional description</small>-->
    </h1>
    <ol class="breadcrumb">
        <li>
             <?php echo $this->Html->link('Dashboard <i class="fa fa-dashboard"></i>',['controller' => 'Requestors', 'action' => 'requestorsDashboard', '_full' => true],['class'=>'','escape' => false]);?>
            <!--<a href="#"><i class="fa fa-dashboard"></i> Level</a>-->
        </li>
        <li class="active">Request Payments Listing</li>
    </ol>
</section>
<section class="content container-fluid">
    <!-- Content Header (Page header) -->

    <div class="row">

        <!-- ./col -->       
        <!-- ./col -->
        <div class="col-md-12">
            <div class="box">
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
                                <?php echo $this->Form->input('by_start_date',array('label' => false,'div' => false,'value'=>$start_date ,'placeholder'=>"Search" , 'class' => 'form-control pull-right field-disable-colr','id'=>"start_datepicker",'readonly'=>'readonly'));?>  
                                <!--<input type="text" class="form-control pull-right" id="datepicker">-->

                            </div>
                            <span class="help-block">Search by date</span>
                        </div>
                        <div class="col-md-2">                
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <?php echo $this->Form->input('by_end_date',array('label' => false,'div' => false,'value'=>$end_date ,'placeholder'=>"Search" , 'class' => 'form-control pull-right field-disable-colr','id'=>"end_datepicker",'readonly'=>'readonly'));?>  
                                <!--<input type="text" class="form-control pull-right" id="datepicker">-->

                            </div>
                            <span class="help-block">Search by end date</span>
                        </div>
                        <div class="col-md-2">  
                            <?php 
                            $paymentStatusArr= [1=>'paid',0=>'Un-Paid'];
                            echo $this->Form->input('by_payment_status',array('label' => false,'div' => false,'value'=>$id_keyword ,'placeholder'=>"Search" , 'class' => 'form-control pull-right', 'type'=>'select','options'=>$paymentStatusArr,'div' => false,'empty'=>"Select Payment"));?>  
                            <!--<input name="table_search" class="form-control pull-right" placeholder="Search" type="text">-->
                            <span class="help-block pull-left spn100">By payment status </span>
                        </div><!--
                        -->      
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
                                <th><?php echo $this->Paginator->sort('Request.request_id', 'Request#'); ?></th>
                                <th><?php echo $this->Paginator->sort('Request.Provider_id', 'Provider Name'); ?></th>
                                <th><?php echo $this->Paginator->sort('Request.first_name', 'Full Name'); ?></th>
                                <!--<th><?php echo $this->Paginator->sort('Request.last_name', 'Last name'); ?></th>-->
                                <th><?php echo $this->Paginator->sort('Request.threshold', 'Record fee limit'); ?></th>
                                <th><?php echo $this->Paginator->sort('Request.total_cost', 'Provider Fees'); ?></th>
                                <th><?php echo $this->Paginator->sort('Request.payment_status', 'Payment Status'); ?></th>
                                <th><?php echo $this->Paginator->sort('Request.request_status', 'Status'); ?></th>
                                <th><?php echo $this->Paginator->sort('Request.date_of_request', 'Date'); ?></th>
                                <th>Action  </th>
                            </tr>
                            <?php 
                            if(!empty($requestData)){
//                            $srno= 1;
                            foreach($requestData as $req){
                                   $keysArr = array('client_name','matter_no');
                                   $req = $this->Common->checkIsset($keysArr, $req);
                                   $provider_data = $this->Common->getProviderData($req['provider_id']);
                                   $created = date('M d, Y', strtotime($req['date_of_request']));
                                   $request_status = $this->Common->getStatusByID($req['request_status']);
                                   if($req['payment_status'] == 1){
                                       $paymentStatus = 'Paid';
                                   }else{
                                       $paymentStatus = 'Un-Paid';
                                   }
                                   ?>
                            <tr>
                                <!--<td><?php // echo $srno; ?></td>-->
                                <td onclick="viewDetails('<?php echo $this->Common->encrypt($req['id']);?>');"><?php echo $req['request_id']; ?></td> 
                                <td onclick="viewDetails('<?php echo $this->Common->encrypt($req['id']);?>');"><?php echo $req['Provider']['first_name'].' '.$req['Provider']['last_name']; ?></td> 
                                <td onclick="viewDetails('<?php echo $this->Common->encrypt($req['id']);?>');"><?php echo $req['first_name'].' '.$req['last_name']; ?></td> 
                                <td onclick="viewDetails('<?php echo $this->Common->encrypt($req['id']);?>');"><?php echo '$'.$req['threshold']; ?></td>
                                <td onclick="viewDetails('<?php echo $this->Common->encrypt($req['id']);?>');"><?php echo (!empty($req['total_cost']))?'$'.$req['total_cost']:'NA'; ?></td>
                                <td onclick="viewDetails('<?php echo $this->Common->encrypt($req['id']);?>');"><?php echo $paymentStatus; ?></td>
                                <td onclick="viewDetails('<?php echo $this->Common->encrypt($req['id']);?>');"><?php echo $request_status; ?></td>
                                <td onclick="viewDetails('<?php echo $this->Common->encrypt($req['id']);?>');"><?php echo $created; ?></td>
                                <td>
                                    <!--<a href="#" class="editIcon"><i class="fa  fa-edit" title="edit"></i></a>-->                 
                                    <?php 
                                    echo $this->Html->link('View Request ',['controller' => 'Requestors', 'action' => 'viewRequest',$this->Common->encrypt($req['id']),'_full' => true],['class'=>'label label-warning','escape'=>false]);?>             
                                </td>
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
        //alert('shdjgk');
        $('#start_datepicker').datepicker({
            dateFormat: "dd/mm/yy",
            startDate: new Date('1920-01-01'),
        });

        $('#end_datepicker').datepicker({
            format: 'mm/dd/yyyy',
            startDate: new Date('1920-01-01'),
        });

    });
    /*
     * to redirect on view details by clicking on row
     * Comment
     */
    function viewDetails(request_id) {
//    alert(request_id);
        var url = SITE_URL + 'requestors/view-request/' + request_id;
        window.location.replace(url);
    }
</script>