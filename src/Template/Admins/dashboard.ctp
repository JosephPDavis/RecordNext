<?php ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Dashboard
    </h1>
    <?php // echo $this->Html->link('Dashboard <i class="fa fa-dashboard"></i>',['controller' => 'Admins', 'action' => 'dashboard', '_full' => true],['class'=>'','escape' => false]);?>
</section>

<!-- Main content -->
<section class="content container-fluid">
    <!--------------------------
    | Your Page Content Here |
    -------------------------->
    <div class="row">

        <div class="col-lg-3 col-xs-12">
            <!-- small box -->
                           <?php echo $this->Html->link('<div class="small-box bg-aqua">
                            <div class="inner">
                                <h3>All Open<br>Requests</h3>          
                            </div>
                            <div class="icon">
                                <i class="fa fa-list" aria-hidden="true"></i>

                            </div>
                           <div class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></div>

                        </div>',['controller' => 'Admins', 'action' => 'allOpenRequests', '_full' => true],['class'=>'small-box-footer','escape' => false]);?>
        </div>

        <div class="col-lg-3 col-xs-12">
            <!-- small box -->
                           <?php echo $this->Html->link('<div class="small-box bg-yellow">
                            <div class="inner">
                                <h3>View All<br>Requestors</h3>          
                            </div>
                            <div class="icon">
                                <i class="fa fa-user" aria-hidden="true"></i>

                            </div>
                           <div class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></div>

                        </div>',['controller' => 'Admins', 'action' => 'requestors', '_full' => true],['class'=>'small-box-footer','escape' => false]);?>
        </div>

        
         <div class="col-lg-3 col-xs-12">
            <!-- small box -->
                           <?php echo $this->Html->link('<div class="small-box bg-gray">
                            <div class="inner">
                                <h3>View All<br>Requestors</h3>          
                            </div>
                            <div class="icon">
                                <i class="fa fa-user" aria-hidden="true"></i>

                            </div>
                           <div class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></div>

                        </div>',['controller' => 'Admins', 'action' => 'providers', '_full' => true],['class'=>'small-box-footer','escape' => false]);?>
        </div>
        
        <!-- ./col -->
        
        <div class="col-lg-3 col-xs-12">
            <!-- small box -->
                           <?php echo $this->Html->link('<div class="small-box bg-green">
                            <div class="inner">
                                <h3>View All<br>Requests</h3>          
                            </div>
                            <div class="icon">
                                <i class="fa fa-list-alt" aria-hidden="true"></i>

                            </div>
                           <div class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></div>

                        </div>',['controller' => 'Admins', 'action' => 'requests', '_full' => true],['class'=>'small-box-footer','escape' => false]);?>
        </div>
        <!-- ./col -->
    </div>

    <div class="box box-default">
        <div class="box-header with-border">
            <i class="fa fa-warning"></i>
            <h3 class="box-title">Notifications</h3>
        </div>

        <?php 
            foreach ($data as $notice){
                echo $notice;
            }
            ?>
    </div>
</section>
<!-- /.content -->
<!-- /.content-wrapper -->
