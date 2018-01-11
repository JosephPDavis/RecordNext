<?php 
?>

<!--<div class="content-wrapper">-->
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Dashboard
          <!--<small>Optional description</small>-->
    </h1>
<!--    <ol class="breadcrumb">
        <li>
             <?php echo $this->Html->link('Dashboard <i class="fa fa-dashboard"></i>',['controller' => 'Requestors', 'action' => 'requestorsDashboard', '_full' => true],['class'=>'','escape' => false]);?>
            <a href="#"><i class="fa fa-dashboard"></i> Level</a>
        </li>
        <li class="active">Here</li>
    </ol>-->
</section>

<!-- Main content -->
<section class="content container-fluid">

    <!--------------------------
    | Your Page Content Here |
    -------------------------->
    <div class="row">
        <div class="col-lg-4 col-xs-12">
            <!-- small box -->
            <?php echo $this->Html->link(' <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>New request</h3>             
                </div>
                <div class="icon">
                    <i class="fa fa-edit" aria-hidden="true"></i>
                    
                </div>
               <div class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></div>

            </div>',['controller' => 'Requestors', 'action' => 'selectProvider', '_full' => true],['class'=>'small-box-footer','escape' => false]);?>

        </div>
        <!-- ./col -->       
        <!-- ./col -->
        <div class="col-lg-4 col-xs-12">
            <!-- small box -->
            <?php echo $this->Html->link('<div class="small-box bg-yellow">
                <div class="inner">
                    <h3>View all requests</h3>           
                </div>
                <div class="icon">
                    <i class="fa fa-clipboard"></i>
                </div>
                  <div class="small-box-footer"> More info <i class="fa fa-arrow-circle-right"></i></div>             
            </div>',['controller' => 'Requestors', 'action' => 'requestsListing', '_full' => true],['class'=>'small-box-footer','escape' => false]);?>

            
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-xs-12">
            <!-- small box -->
            <?php echo $this->Html->link('<div class="small-box bg-gray">
                <div class="inner">
                    <h3>Clients & Matters</h3>


                </div>
                <div class="icon">
                    <i class="fa fa-users"></i>
                </div>
                   <div class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></div>              
            </div>',['controller' => 'Requestors', 'action' => 'clientMatterListing', '_full' => true],['class'=>'small-box-footer','escape' => false]);?>

        </div>
        <!-- ./col -->
    </div>
    <div class="box box-default">
        <div class="box-header with-border">
            <i class="fa fa-warning"></i>

            <h3 class="box-title">Notifications</h3>
        </div>

        <div class="box-body">
            <?php 
            foreach ($data as $notice){
                echo $notice;
            }
            ?>
             

            <br>
            <!--                <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-default">
                                Modal Box
                            </button>-->

        </div>
    </div>
        
</section>
<!-- /.content -->

<!-- /.content-wrapper -->
