<?php 
$userSession = $this->request->session()->read('LoginUser');
$pendingRequestCount = $this->Common->getCountPendingReq($userSession['id']);

?>

<!--<div class="content-wrapper">-->
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                      Provider's Dashboard
                        <!--<small>Optional description</small>-->
                    </h1>
<!--                    <ol class="breadcrumb">
                        <li>
                            <a href="#"><i class="fa fa-dashboard"></i> Level</a>
                         <?php echo $this->Html->link('Dashboard <i class="fa fa-dashboard"></i>',['controller' => 'Providers', 'action' => 'providersDashboard', '_full' => true],['class'=>'','escape' => false]);?>
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
                           <?php echo $this->Html->link('<div class="small-box bg-aqua">
                            <div class="inner">
                                <h3>View <br>request</h3>          
                            </div>
                            <div class="icon">
                                <i class="fa fa-list" aria-hidden="true"></i>

                            </div>
                           <div class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></div>

                        </div>',['controller' => 'Providers', 'action' => 'viewAllRequests', '_full' => true],['class'=>'small-box-footer','escape' => false]);?>
                        </div>
                        <!-- ./col -->       
                        <!-- ./col -->
                        <div class="col-lg-4 col-xs-12">
                            <!-- small box -->
                            <?php echo $this->Html->link('<div class="small-box bg-yellow">
                            <div class="inner">
                                <h3>View pending <br>request</h3> 
                            </div>
                            <div class="icon">
                                '.$pendingRequestCount.'

                            </div>
                           <div class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></div>

                        </div>',['controller' => 'Providers', 'action' => 'allPendingRequests', '_full' => true],['class'=>'small-box-footer','escape' => false]);?>
<!--                            <div class="small-box bg-yellow">
                                <div class="inner">
                                    <h3>View pending <br>request</h3>           
                                </div>
                                <div class="icon">
                                    <?php $pendingRequestCount = $this->Common->getCountPendingReq($userSession['id']);
                                    echo $pendingRequestCount;
                                    ?>
                                </div>
                                <?php echo $this->Html->link(' More info <i class="fa fa-arrow-circle-right"></i>',['controller' => 'Providers', 'action' => 'allPendingRequests','_full' => true],['class'=>'small-box-footer','escape' => false]);?>
                            </div>-->
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-4 col-xs-12">
                            <!-- small box -->
                            <?php echo $this->Html->link('<div class="small-box bg-gray">
                            <div class="inner">
                                <h3>View <br>Reports</h3>
                            </div>
                            <div class="icon">
                                 <i class="fa fa-list-ul"></i>
                            </div>
                           <div class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></div>

                        </div>',['controller' => 'Providers', 'action' => 'viewAllRequests', '_full' => true],['class'=>'small-box-footer','escape' => false]);?>
<!--                            <div class="small-box bg-gray">
                                <div class="inner">
                                    <h3>View <br>Reports</h3>


                                </div>
                                <div class="icon">
                                    <i class="fa fa-list-ul"></i>
                                </div>
                                <?php echo $this->Html->link(' More info <i class="fa fa-arrow-circle-right"></i>',['controller' => 'Providers', 'action' => 'allPendingRequests', '_full' => true],['class'=>'small-box-footer','escape' => false]);?>
                                <a href="#" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>-->
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
