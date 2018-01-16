<?php
$userSession = $this->request->session()->read('LoginUser');
//pr($userSession);
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
        View All Pending Requests
        <!--<small>Optional description</small>-->
    </h1>
    <ol class="breadcrumb">
        <li>
             <?php echo $this->Html->link('Dashboard <i class="fa fa-dashboard"></i>',['controller' => 'Provider', 'action' => 'providersDashboard', '_full' => true],['class'=>'','escape' => false]);?>
            <!--<a href="#"><i class="fa fa-dashboard"></i> Level</a>-->
        </li>
        <li class="active">Search Requests</li>
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
                            <span class="help-block pull-left spn100 label-search">By name</span>
                        </div>
                        <div class="col-md-2">  
                            <?php echo $this->Form->input('by_id',array('label' => false,'div' => false,'value'=>$id_keyword ,'placeholder'=>"Search" , 'class' => 'form-control pull-right', 'type'=>'text','maxlength'=>15));?>  
                            <!--<input name="table_search" class="form-control pull-right" placeholder="Search" type="text">-->
                            <span class="help-block pull-left spn100 label-search">By matter id, request id </span>
                        </div><!--
                        -->       
                        <div class="col-md-3">                
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <?php echo $this->Form->input('by_start_date',array('label' => false,'div' => false,'value'=>$start_date ,'placeholder'=>"Search" , 'class' => 'form-control pull-right field-disable-colr','id'=>"start_datepicker",'readonly'=>'readonly'));?>  
                                <!--<input type="text" class="form-control pull-right" id="datepicker">-->

                            </div>
                            <span class="help-block label-search">search by date</span>
                        </div>
                            <div class="col-md-2">                
                                <?php 
                                $dateDateRange = ['>'=>'> Greater than','<'=>'< Less than','>='=>'>=Greater than equal to','<='=>'<= Less than equal to'];
                                echo $this->Form->input('by_date_range',array('label' => false,'type'=>'select','options'=>$dateDateRange,'div' => false,'value'=>$date_range ,'empty'=>"Select date range" , 'class' => 'form-control pull-right','id'=>"date_range"));?>  

                            <span class="help-block pull-left spn100 label-search">Select the date range</span>
                            </div>
                        <div class="col-md-3">     
                            <?php echo $this->Form->button('<i class="fa fa-search"></i> Search', array('div' => false, 'class'=>'btn btn-info','type'=>'submit'),array('escape' => false)); ?>
                            <!--<button type="submit" class="btn btn-info "><i class="fa fa-search"></i> Search</button>-->              
                        </div>
<!--                        <div class="col-md-2">                
                            <?php // echo $this->Html->link('Add/Create Request',['controller' => 'Requestors', 'action' => 'selectProvider', '_full' => true],['class'=>'btn btn-info']);?>             
                        </div>-->
                    </div>
                </div>
                <?php echo $this->Form->end(); ?>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-bordered  table-striped">
                            <tr>
                                <!--<th width="7%"><?php // echo $this->Paginator->sort('Request.id', 'Sr No #'); ?></th>-->
                                <th><?php echo $this->Paginator->sort('request_id', 'Request#'); ?></th>
                                <th>Requester Name </th>
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
                                   $provider_data = $this->Common->getRequesterData($req['requestor_id']);
                                   if(!empty($provider_data)){
                                   }else{
                                       $provider_data='';
                                   }
//                                  pr($req['requestor_id']);
                                   $created = date('M d, Y', strtotime($req['date_of_request']));
                                   ?>
                            <tr>
                                <!--<td><?php // echo $srno; ?></td>-->
                                <td onclick="viewDetails('<?php echo $this->Common->encrypt($req['id']);?>');"><?php echo $req['request_id']; ?></td> 
                                <td onclick="viewDetails('<?php echo $this->Common->encrypt($req['id']);?>');"><?php echo (!empty($provider_data['first_name']))?$provider_data['first_name']:'NA'.' '.(!empty($provider_data['last_name']))?$provider_data['last_name']:'NA'; ?></td> 
                                <td onclick="viewDetails('<?php echo $this->Common->encrypt($req['id']);?>');"><?php echo $clientName; ?></td>
                                <td onclick="viewDetails('<?php echo $this->Common->encrypt($req['id']);?>');"><?php echo $matterNumber; ?></td>
                                <td onclick="viewDetails('<?php echo $this->Common->encrypt($req['id']);?>');"><?php echo $req['first_name'].' '.$req['last_name']; ?></td> 
                                <td onclick="viewDetails('<?php echo $this->Common->encrypt($req['id']);?>');"><?php echo '$ '.$req['threshold']; ?></td>
                                <td onclick="viewDetails('<?php echo $this->Common->encrypt($req['id']);?>');"><?php echo $created; ?></td>
                                <td>
                                    <!--<a href="#" class="editIcon"><i class="fa  fa-edit" title="edit"></i></a>-->                 
                                    <?php echo $this->Html->link('View Request',['controller' => 'Providers', 'action' => 'viewRequest', $this->Common->encrypt($req['id']),'_full' => true],['class'=>'label label-warning','escape'=>false]);?>&nbsp;              
                                    <!--<a href="#"  class="editIcon"><i class="fa fa-eye" title="View Request"></i></a>-->
                                   <?php echo $this->Html->link('View HIPAA Authorization Form','img/hippa/original/'.$req['upload_hippa'],['class'=>'label label-info','escape'=>false,'target' => '_blank']);?>             
                                    <!--<a href="#"  class="replyIcon "><i class="fa  fa-mail-reply" title="Reply Provider"></i></a>--> 
                                    <!--<a href="#"  class="downloadIcon"><i class="fa fa-cloud-download" title="Download HIPPA Form"></i></a>-->
                                    <!--<a href="#"  class="deleteIcon"><i class="fa fa-close" title="Close Request"></i></a>-->

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
        $('#start_datepicker').datepicker({
           format: 'mm/dd/yyyy',
        });
        $('#end_datepicker').datepicker({
           format: 'mm/dd/yyyy',
        });
    });
    /*
     * to redirect on view details by clicking on row
 * Comment
 */
function viewDetails(request_id) {
//    alert(request_id);
    var url = SITE_URL+'providers/view-request/'+request_id;
    window.location.replace(url);
}
</script>