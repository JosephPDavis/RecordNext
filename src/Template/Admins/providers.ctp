<?php 
?>
<section class="content-header">
    <h1>
        Provider
    </h1>
    <ol class="breadcrumb">
        <li>
             <?php echo $this->Html->link('Dashboard <i class="fa fa-dashboard"></i>',['controller' => 'Admins', 'action' => 'dashboard', '_full' => true],['class'=>'','escape' => false]);?>
        </li>
        <li class="active">Providers Listing</li>
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
                            <span class="help-block pull-left spn100">By full name</span>
                        </div>
                        <div class="col-md-2">  
                            <?php echo $this->Form->input('by_email',array('label' => false,'div' => false, 'placeholder'=>"Search" , 'class' => 'form-control pull-right', 'type'=>'text','maxlength'=>60));?>  
                            <span class="help-block pull-left spn100">By Email</span>
                        </div>
                        <div class="col-md-2">                
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <?php echo $this->Form->input('by_date',array('label' => false,'div' => false,'placeholder'=>"Search" , 'class' => 'form-control pull-right','id'=>"end_datepicker"));?>  

                            </div>
                            <span class="help-block">By date</span>
                        </div>
                        <div class="col-md-2">     
                            <?php echo $this->Form->button('<i class="fa fa-search"></i> Search', array('div' => false, 'class'=>'btn btn-info','type'=>'submit'),array('escape' => false)); ?>              
                        </div>
                        <div class="col-md-2">     
                           <?php echo $this->Html->link('Bulk Import',['controller' => 'Admins', 'action' => 'bulkImport', $this->Common->encrypt(2),'_full' => true],['class'=>'btn btn-info']);?>
                        </div>
                         <div class="col-md-2">                
                            <?php echo $this->Html->link('Add Provider',['controller' => 'Admins', 'action' => 'addEditProvider', '_full' => true],['class'=>'btn btn-info']);?>             
                        </div>
                    </div>
                </div>
                <?php echo $this->Form->end(); ?>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-bordered  table-striped">
                            <tr>
                                <th><?php echo $this->Paginator->sort('id', 'User #'); ?></th>
                                <th><?php echo $this->Paginator->sort('first_name', 'Full Name'); ?></th>
                                <th><?php echo $this->Paginator->sort('email', 'Email'); ?></th>
                                <th><?php echo $this->Paginator->sort('phone', 'Phone'); ?></th>
                                <th><?php echo $this->Paginator->sort('company_name', 'Company Name'); ?></th>
                                <!--<th><?php // echo $this->Paginator->sort('User.department', 'Department'); ?></th>-->
                                <th><?php echo $this->Paginator->sort('created', 'Created Date'); ?></th>
                                <th>Action  </th>
                            </tr>
                            <?php 
                            if(!empty($providers)){
                            foreach($providers as $pvr){
                                   $created = date('M d, Y', strtotime($pvr['created']));
                                   $status = $pvr['status'];
                                   ?>
                            <tr>
                                <td><?php echo $pvr['id']; ?></td> 
                                <td><?php echo $pvr['first_name'].' '.$pvr['last_name']; ?></td><td><?php echo $pvr['email']; ?></td>
                                <td><?php echo $pvr['phone']; ?></td>
                                <td><?php echo $pvr['company_name']; ?></td>
                                <td><?php echo $created; ?></td>
                                <td>
                                    <?php 
                                    echo $this->Html->link('View Requester',['controller' => 'Admins', 'action' => 'addEditProvider',$this->Common->encrypt($pvr['id']),'_full' => true],['class'=>'label label-warning','escape'=>false]);?>  
                                     <?php
                                    if ($status == 1) {
                                      echo $this->Html->link('Active','javascript:void(0)', array('escape' => false,'id' => 'change_status','onclick'=>'setStatus('.$pvr['id'].',this)', 'class' => 'label label-success change_status'));
                                    } else {
                                        echo $this->Html->link('In-active','javascript:void(0)', array('escape' => false, 'id' => 'change_status','onclick'=>'setStatus('.$pvr['id'].',this)','class' => 'label label-default change_status'));
                                    }
                                ?> 
                                <?php echo $this->Html->link('Delete','javascript:void(0)', array('class'=>'label label-danger deleteIcon', 'escape' => false,'id' => 'change_status','data'=>$this->Common->encrypt($pvr['id'])));?>    
                                </td>
                            </tr>
                            <?php 
                            }
                            }else{
                                echo '<tr><td colspan="8">No records found.</td><tr>';
                            }
                            ?>
                        </table>
                        <?php if(!empty($pvruestors)){ ?>
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
                    message: "Are you sure you want to delete this provider?",
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
                            location.href=SITE_URL+'admins/delete/'+id;
                        }
                    }
                 });
        });
        
        
    });
        
      // for active / inactive user
    function setStatus(val1, ele) {
        var id = val1;
        $.ajax({
            url: '/admins/changeStatus/' +id,
            success: function (data) {
                var status = data.status;
                if ($(ele).text() == 'In-active') {
                    $(ele).text('Active');
                    $(ele).addClass('label-success');
                    $(ele).removeClass('label-default');
                } else {
                    $(ele).text('In-active');
                    $(ele).addClass('label-default');
                    $(ele).removeClass('label-success');
                }
            }
        });
    }
</script>