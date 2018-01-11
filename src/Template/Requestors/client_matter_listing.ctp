<?php 

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
                <?php echo $this->Form->create(null, array('id'=>'searchForm')); ?>
                <div class="box-header with-border">
                    <div class="row">
                        <div class="col-md-3"> 
                            <?php echo $this->Form->input('by_name',array('label' => false,'div' => false,'value'=>$name_keyword ,'placeholder'=>"Search" , 'class' => 'form-control pull-right', 'type'=>'text','maxlength'=>15));?>  
                            <!--<input name="table_search" class="form-control pull-right" placeholder="Search" type="text">-->               
                            <span class="help-block pull-left spn100">By client/matter name </span>
                        </div>
                        <div class="col-md-3">  
                            <?php echo $this->Form->input('by_id',array('label' => false,'div' => false,'value'=>$id_keyword ,'placeholder'=>"Search" , 'class' => 'form-control pull-right', 'type'=>'text','maxlength'=>15));?>  
                            <!--<input name="table_search" class="form-control pull-right" placeholder="Search" type="text">-->
                            <span class="help-block pull-left spn100">By client/matter number </span>
                        </div><!--
                        -->       
                        <div class="col-md-2">     
                            <?php echo $this->Form->button('<i class="fa fa-search"></i> Search', array('div' => false, 'class'=>'btn btn-info','type'=>'submit'),array('escape' => false)); ?>
                            <!--<button type="submit" class="btn btn-info "><i class="fa fa-search"></i> Search</button>-->              
                        </div>
                        <div class="col-md-4 text-right">                
                            <?php echo $this->Html->link('Bulk Import Client/Matter',['controller' => 'Requestors', 'action' => 'clientsMatters', '_full' => true],['class'=>'btn btn-info']);?>             
                        </div>
                    </div>
                </div>
                <?php echo $this->Form->end(); ?>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-bordered  table-striped">
                            <tr>
                                <th><?php echo 'Sr. No.'; ?></th>
                                <th>Client Name</th>
                                <th>Client Number</th>
                                <th>Matter Name</th>
                                <th>Matter Number</th>
                                <th>Date</th>
                            </tr>
                            <?php 
                            if(!empty($requestData)){
                            $srno= 1;
                            foreach($requestData as $req){
                                   $keysArr = array('client_name','matter_no');
                                   $req = $this->Common->checkIsset($keysArr, $req);
                                   $provider_data = $this->Common->getProviderData($req['provider_id']);
                                   $created = date('M d, Y', strtotime($req['Clients']['created']));
                                    
                                   ?>
                            <tr>
                                <td><?php  echo $srno; ?></td>
                                <td><?php echo $req['Clients']['client_name']; ?></td>
                                <td><?php echo $req['Clients']['client_number']; ?></td>
                                <td><?php echo $req['matter_name']; ?></td>
                                <td><?php echo $req['matter_no']; ?></td>
                                <td><?php echo $created; ?></td>
                                
                            </tr>
                            <?php 
                            $srno++;
                         
                            }
//                            exit();
                            }else{
                                echo '<tr><td colspan="6">No records found.<td><tr>';
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
            startDate : new Date('1920-01-01'),
        }); 
        
        $('#end_datepicker').datepicker({
           format: 'mm/dd/yyyy',
           startDate : new Date('1920-01-01'),
        });
        
    });
    /*
     * to redirect on view details by clicking on row
 * Comment
 */
function viewDetails(request_id) {
//    alert(request_id);
    var url = SITE_URL+'requestors/view-request/'+request_id;
    window.location.replace(url);
}
</script>