<?php

$id = $this->request->session()->read('LoginUser')['id'];

?>
<style>
    .datepicker-custom{
        margin-bottom: 15px;
    }
</style>
<section class="content-header">
    <h1>
     Payment Settings
    </h1>
    <ol class="breadcrumb">
        <li>
            <?php $roleId=$this->request->session()->read('LoginUser')['role_id'];
               echo $this->Html->link('Dashboard<i class="fa fa-dashboard"></i> ',['controller' => 'Admins', 'action' => 'dashboard', '_full' => true],['class'=>'','escape'=>false]); 
            
            ?>
            <!--<a href="#"><i class="fa fa-dashboard"></i> Level</a>-->
        </li>
        <li class="active">Payment Settings</li>
    </ol>
</section>

<!-- Main content -->
<?= $this->Flash->render() ?>
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
                    <h3 class="box-title">Payment options</h3>
                </div>
                <div class="col-md-12">

          <?=  $this->Form->create($settings, array('class'=>'form-appointment ui-form', 'id' => 'ProviderSettingsForm', 'type' => 'file', 'novalidate' => true, 'name' => 'User')) ?>
                    <div class="nav-tabs-custom">
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_1">

                                <div class="form-group">
                                    <div class="row">
                                        <label for="" class="col-sm-3 required-label  control-label">Admin Share $</label>
                                        <div class="col-sm-4">
                                                <?php echo $this->Form->input('admin_share',array('label' => false,'div' => false,'value'=>isset($adminSettings['admin_share'])?$adminSettings['admin_share']:'' , 'class' => 'form-control', 'placeholder'=>'Please enter the amount in percentage (%)','required'=>'required','type'=>'text','maxlength'=>20));?>                 
                                                <?php echo $this->Form->input('id',array('label' => false,'div' => false,'value'=>"$id" , 'class' => 'form-control', 'type'=>'hidden'));?>                 
                                                <?php echo $this->Form->input('user_id',array('label' => false,'div' => false,'value'=>"$id" , 'class' => 'form-control', 'type'=>'hidden'));?>                 
                                        </div>
                                    </div>
                                </div>


                                <div class="box-footer">
                <?php $roleId=$this->request->session()->read('LoginUser')['role_id'];
               echo $this->Html->link('Cancel',['controller' => 'Admins', 'action' => 'dashboard', '_full' => true],['class'=>'btn btn-default','escape'=>false]);
            
            ?>
                                    <button type="submit" class="btn btn-info pull-right">Submit</button>
                                </div>
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="tab_2">
                                <div class="box-footer">

                                    <button type="submit" class="btn btn-default">Cancel</button>
                <?php echo $this->Form->button('Update', array('div' => false, 'class'=>'btn primary-btn')); ?>
                                </div>

                            </div>
                            <!-- /.tab-pane -->

                        </div>
                        <!-- /.tab-content -->
                    </div>
           <?php echo $this->Form->end(); ?>


                    <div class="clearfix"></div>
                </div>  <div class="clearfix"></div>
            </div>

            <!-- /.box -->
        </div>

        <!-- ./col -->
    </div>

</section>
<script>
    $(document).ready(function () {
        jQuery("#ProviderSettingsForm").validate({
            errorElement: "div",
            highlight: function (element) {
                $(element).removeClass("error");
            },
            rules: {
                "admin_share": {
                    required: true,
                    customnumeric :true,
                },
            },
            messages: {
                "admin_share": {
                    required: "Please enter admin share in percentage",
                },

            }
        });

    });
</script>