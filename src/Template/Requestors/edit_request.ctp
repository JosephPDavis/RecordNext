<?php ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Make Request
         <!--<small>Optional description</small>-->
    </h1>
    <ol class="breadcrumb">
        <li>
                <?php echo $this->Html->link('Dashboard <i class="fa fa-dashboard"></i>',['controller' => 'Requestors', 'action' => 'requestorsDashboard', '_full' => true],['class'=>'','escape' => false]);?>
            <!--<a href="#"><i class="fa fa-dashboard"></i> Dashboard</a>-->
        </li>
        <li class="active">request</li>
    </ol>
</section>    
<section class="content container-fluid">
    <!--------------------------
    | Your Page Content Here |
    -------------------------->
    <div class="row">

        <!-- ./col -->       
        <!-- ./col -->
        <div class="col-md-12">
            <!-- Horizontal Form -->
            <div class="box ">
                <div class="box-header with-border">
                    <h3 class="box-title">Step 1</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Request # :</label>

                            <div class="col-sm-5">
                                <input class="form-control" id="inputEmail3" placeholder="001" type="email">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Provider :</label>

                            <div class="col-sm-5">
                                <select class="form-control">
                                    <option>option 1</option>
                                    <option>option 2</option>
                                    <option>option 3</option>
                                    <option>option 4</option>
                                    <option>option 5</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label"> Client first name :</label>

                            <div class="col-sm-5">
                                <input class="form-control" id="inputEmail3" placeholder="Enter First Name" type="email">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Client last name :</label>

                            <div class="col-sm-5">
                                <input class="form-control" id="inputEmail3" placeholder="Enter Last Name" type="email">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Client Matter # :</label>

                            <div class="col-sm-5">
                                <input class="form-control" id="inputEmail3" placeholder="Enter matter" type="email">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Start Date :</label>

                            <div class="col-sm-5">
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" id="datepicker">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">End Date :</label>

                            <div class="col-sm-5">
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" id="datepicker">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Date of birth:</label>

                            <div class="col-sm-5">
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" id="datepicker">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Threshold $ :</label>

                            <div class="col-sm-5">
                                <input class="form-control" id="inputEmail3" placeholder="Enter value" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Social Security Number :</label>

                            <div class="col-sm-5">
                                <input class="form-control" id="inputEmail3" placeholder="Enter SSN" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Medical Records/ Billing Records :</label>

                            <div class="col-sm-5">
                                <label class="radio-inline">
                                    <input type="radio" name="optradio"> Medical Record
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="optradio"> Billing Record
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="optradio"> Both
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Upload HIPAA form :</label>

                            <div class="col-sm-5">
                                <input id="exampleInputFile" type="file">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">HIPAA form Date :</label>

                            <div class="col-sm-5">
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" id="datepicker">
                                </div>
                            </div>
                        </div>



                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <?php echo $this->Html->link('Cancel',['controller' => 'Requestors', 'action' => 'requestors_dashboard', '_full' => true],['class'=>'btn btn-default']);?>
                        <!--<button type="button" class="btn btn-default">Cancel</button>-->
                        <?php echo $this->Html->link('Next',['controller' => 'Requestors', 'action' => 'payment', '_full' => true],['class'=>'btn btn-info pull-right']);?>
                        <!--<button type="button" class="btn btn-info pull-right" id="request_btn">Request</button>-->
                    </div>
                    <!-- /.box-footer -->
                </form>
            </div>

            <!-- /.box -->
        </div>

        <!-- ./col -->
    </div>

</section>
<!-- /.content -->

<script>

    jQuery(document).ready(function () {

//$("#request_btn").click(function () {
////        bootbox.alert("Request Sent Successfully! Provider will update you back. "
//                
//                );
//    });

    });
</script>

