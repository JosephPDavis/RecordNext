<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Bulk import provider/requester
         <!--<small>Optional description</small>-->
    </h1>
    <ol class="breadcrumb">
        <li>
                <?php echo $this->Html->link('Dashboard <i class="fa fa-dashboard"></i>',['controller' => 'Requestors', 'action' => 'RequestorsDashboard', '_full' => true],['class'=>'','escape' => false]);?>
            <!--<a href="#"><i class="fa fa-dashboard"></i> Dashboard</a>-->
        </li>
        <li class="active">Clients and Matters Bulk Import</li>
    </ol>
</section>    
<section class="content container-fluid">
    <!-- Small boxes (Start box) -->
    <div class="row">
        <div class="col-xs-12">
            <?php // echo $this->Session->flash(); ?>
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><?php echo 'Step 1'; ?></h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <div class="box-body box-profile">
                    <?= $this->Form->create('', array('class'=>'form-appointment ui-form', 'id' => 'bulkImportForm','novalidate'=>true,'enctype'=>"multipart/form-data"))?><!--  //,'onsubmit'=>"setFormSubmitting()" -->
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="row">
                            <div class="col-sm-6 col-md-6 col-lg-6">
                                <div class="row">
                                    <div class="form-group">
                                        <label for="" class="col-sm-4 control-label required-label" style="padding-top:10px;text-align:right;"> CSV :</label>
                                        <div class="col-sm-8" style="margin-top:6px;">
                                                <?= $this->Form->control('CSV', ['class' => '','type' => 'file','id'=>'CSV', 'label'=>false,'accept'=>"text/csv"]) ?>
                                            <span><label><?php echo isset($requestData['CSV']) && !empty($requestData['CSV'])?$requestData['CSV']:'';?></label></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <label for="" class="col-sm-4 control-label" style="padding-top:10px;text-align:right;"> Sample CSV File :</label>
                                        <div class="col-sm-8" style="margin-top:6px;">
                                                <?php echo $this->Html->link('<i class="fa fa-cloud-download" title="Sample CSV File"></i> ','img/hippa/Client-Matter sample.csv',['class'=>'downloadIcon','escape'=>false,'target' => '_blank']);?>             
                                            <span class="help-block"> Please upload the CSV file in the given sample format only</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-6">

                            </div>
                        </div>
                    </div>



                    <div class="col-sm-4">
                                    <?= $this->Form->button(__('Import'), ['class' =>'btn btn-primary ','type'=>'submit']); ?>
                        <!--<input type="submit" class="btn btn-primary bulkImportCSV" value="Import">-->
                    </div>

                </div>



                     <?= $this->Form->end() ?><!-- end form-appointment -->
                <div class="row">
                    <div class="col-sm-6">
                        <div id="errorDiv">
                         <?php
                         if(!empty($savedDom)){
                             echo $savedDom;
                         }
                       echo "<br>";
                         
                         if(!empty($errDom)){
                             echo $errDom;
                         }
                         ?>
                        </div>

                    </div>
                    <div class="col-sm-6">
                        <div id="errorDiv">
                         <?php
                         if(!empty($matSaveDom)){
                             echo $matSaveDom;
                         }
                       echo "<br>";
                         
                         if(!empty($matErrDom)){
                             echo $matErrDom;
                         }
                         ?>
                        </div>

                    </div>

                </div>



            </div><!-- /.box-body -->

        </div>
    </div><!-- ./col -->
    <!--    </div> /.row -->
    <!-- Main row -->
</section><!-- /.content -->

<script>

    $(document).ready(function () {

        jQuery("#bulkImportForm").validate({
            errorElement: "div",
            highlight: function (element) {
                $(element).removeClass("error");
            },
            rules: {
                "CSV": {
                    required: true,
                }
            },
            messages: {
                "CSV": {
                    required: "Please upload a CSV file",
                }

            }
        });

        setTimeout(function () {
            $('.alert').hide();
            $('#alertMessage').html('');
        }, 15000);

    });


</script>
