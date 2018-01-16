<?php

//pr($requestData); exit;
?>
<section class="content-header">
    <h1>
        Request
    </h1>
    <ol class="breadcrumb">
        <li>
             <?php echo $this->Html->link('Dashboard <i class="fa fa-dashboard"></i>',['controller' => 'Admins', 'action' => 'dashboard', '_full' => true],['class'=>'','escape' => false]);?>
        </li>
        <li class="active">All Open Request Listing</li>
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
                            <?php echo $this->Form->input('by_name',array('label' => false,'div' => false,'placeholder'=>"Search" , 'class' => 'form-control pull-right', 'type'=>'text','maxlength'=>15));?>                 
                            <span class="help-block pull-left spn100">By name</span>
                        </div>
                        <div class="col-md-2">  
                            <?php echo $this->Form->input('by_id',array('label' => false,'div' => false, 'placeholder'=>"Search" , 'class' => 'form-control pull-right', 'type'=>'text','maxlength'=>15));?>  
                            <span class="help-block pull-left spn100 label-search">By matter id, request id </span>
                        </div><!--
                        -->       
                        <div class="col-md-2">                
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <?php echo $this->Form->input('by_start_date',array('label' => false,'div' => false, 'placeholder'=>"Search" , 'class' => 'form-control pull-right','id'=>"start_datepicker"));?> 

                            </div>
                            <span class="help-block label-search">search by start date</span>
                        </div>
                        <div class="col-md-2">                
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <?php echo $this->Form->input('by_end_date',array('label' => false,'div' => false,'placeholder'=>"Search" , 'class' => 'form-control pull-right','id'=>"end_datepicker"));?>  

                            </div>
                            <span class="help-block label-search">search by end date</span>
                        </div>
                        <div class="col-md-2">     
                            <?php echo $this->Form->button('<i class="fa fa-search"></i> Search', array('div' => false, 'class'=>'btn btn-info','type'=>'submit'),array('escape' => false)); ?>              
                        </div>
                    </div>
                </div>
                <?php echo $this->Form->end(); ?>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-bordered  table-striped">
                            <tr>
                                <th><?php echo $this->Paginator->sort('request_id', 'Request#'); ?></th>
                                <th>Provider Name </th>
                                <th>Client Name </th>
                                <th>Matter# </th>
                                <th><?php echo $this->Paginator->sort('first_name', 'Full Name'); ?></th>
                                <th><?php echo $this->Paginator->sort('threshold', 'Record fee limit'); ?></th>
                                <th><?php echo $this->Paginator->sort('date_of_request', 'Date'); ?></th>
                                <th>Action  </th>
                            </tr>
                            <?php 
                            if(!empty($requestData)){
//                            $srno= 1;
                            foreach($requestData as $req){
                                if(!empty($req['matter_id']) && isset($req['matter_id'])){
                                        $matter_data = $this->Common->getMatterData($req['matter_id']);
                                            if(!empty($matter_data)){
                                            $matterNumber = $matter_data['matter_no'];
                                            $matterName = $matter_data['matter_name'];
                                            }else{
                                            $matterNumber = "NA";
                                            $matterName = "NA";
                                        }
                                        
                                        }else{
                                            $matterNumber = "NA";
                                            $matterName = "NA";
                                        }
                                        if (!empty($req['client_id']) && isset($req['client_id'])) {
                                            $clientData = $this->Common->getClientData($req['client_id']);
                                            if(!empty($clientData)){
                                                $clientName = $clientData['client_name'];
                                                $clientNumber = $clientData['client_number'];
                                            }else {
                                            $clientName = "NA";
                                            $clientNumber = "NA";
                                            }
                                        } else {
                                            $clientName = "NA";
                                            $clientNumber = "NA";
                                        }
                                   $provider_data = $this->Common->getProviderData($req['provider_id']);
                                   
                                   $created = date('M d, Y', strtotime($req['date_of_request']));
                                   ?>
                            <tr>
                                <td><?php echo $req['request_id']; ?></td> 
                                <td><?php echo $provider_data['first_name'].' '.$provider_data['last_name']; ?></td> 
                                <td><?php echo $clientName; ?></td>
                                <td><?php echo $matterNumber; ?></td>
                                <td><?php echo $req['first_name'] .' '. $req['last_name']; ?></td> 
                                <td><?php echo '$ '.$req['threshold']; ?></td>
                                <td><?php echo $created; ?></td>
                                <td>
                                    <?php echo $this->Html->link('View Request',['controller' => 'Admins', 'action' => 'viewRequest', $this->Common->encrypt($req['id']),'_full' => true],['class'=>'label label-warning','escape'=>false]);?> &nbsp;           
                                    <?php echo $this->Html->link('Delete','javascript:void(0)', array('class'=>'label label-danger deleteIcon', 'escape' => false,'id' => 'change_status','data'=>$this->Common->encrypt($req['id'])));?>
                                </td>
                            </tr>
                            <?php 
                            }
                            }else{
                                echo '<tr><td colspan="7">No records found.</td><tr>';
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
        $('#start_datepicker').datepicker({
            format: 'mm/dd/yyyy',
        });
        $('#end_datepicker').datepicker({
            format: 'mm/dd/yyyy',
        });


   /**
     * Delete request
     */
        $(document).on('click','.deleteIcon',function(){
            var id = $(this).attr('data');
//            alert(id);
                    bootbox.confirm({
                    message: "Are you sure you want to delete this request?",
                    buttons: {
                        confirm: {
                            label: 'Yes',
                            className: 'btn-success'
                        },
                        cancel: {
                            label: 'No',
                            className: 'btn-danger'
                        }
                    },
                    callback: function (result) {
//                        console.log('This was logged in the callback: ' + result);
                        if(result == true){
                            location.href=SITE_URL+'admins/deleteRequest/'+id;
                        }
                    }
                 });
        });
    });
     
    

    
</script><?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

