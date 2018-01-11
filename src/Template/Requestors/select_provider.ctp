<?php   echo $this->Html->script('bootcomplete.js-master/jquery.bootcomplete'); 
        echo $this->Html->css('/js/bootcomplete.js-master/bootcomplete'); ?>
<!-- Content Header (Page header) -->
<style type="text/css">
#departmentLabel{
    padding-left: 185px;
    color: RED !important;
    font-weight: bold;
}
.ajax-loader {
  visibility: hidden;
  background-color: rgba(255,255,255,0.7);
  position: absolute;
  z-index: +100 !important;
  width: 100%;
  height:100%;
}

.ajax-loader img {
  position: relative;
  top:50%;
  left:45%;
}
</style>   
<section class="content-header">
    <h1>
        Create Request
         <!--<small>Optional description</small>-->
    </h1>
    <ol class="breadcrumb">
        <li>
                <?php echo $this->Html->link('Dashboard <i class="fa fa-dashboard"></i>',['controller' => 'Requestors', 'action' => 'requestorsDashboard', '_full' => true],['class'=>'','escape' => false]);?>
            <!--<a href="#"><i class="fa fa-dashboard"></i> Dashboard</a>-->
        </li>
        <li class="active">View Request Detail</li>
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
                <div class="box-body box-profile"><span style="float: right !important;color: black !important;"><strong>Fields marked with <font color="RED">*</font> are mandatory</strong></span>
                    <?= $this->Form->create('', array('class'=>'form-appointment ui-form', 'id' => 'selectProviderForm','novalidate'=>true))?><!--  //,'onsubmit'=>"setFormSubmitting()" -->
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label required-label" style="padding-top:10px;text-align:right;"> Select Provider :</label>
                                <div class="col-sm-5">

                                <?= $this->Form->control('provider', ['class' => 'form-control','type' => 'text','id'=>'select_provider', 'label'=>false,'value'=>(isset($requestData['full_name'])?$requestData['full_name']:'')]);?>
                                <?php //$this->Form->control('provider_id', ['class' => 'form-control','type' => 'select', 'options'=>$providerList,'id'=>'select_provider', 'required'=>'required', 'empty'=>'select Provider', 'label'=>false,'value'=>(isset($requestData['provider_id'])?$requestData['provider_id']:'')]) ?>
                               
                                </div>
                                
                                <div class="col-sm-2">
                                    <input type="button" class="btn btn-primary searchProvider" value="Search">
                                </div>
                                
                            </div>
                           
                        </div>
                         
                    </div>
<div id="errorId" style="color: Red;padding-left: 198px;"></div>

                    <!-- <div id="departmentLabel" style="display:none;"></div> -->

                    <div class="row"  style="padding-top: 10px !important;">
                        <div class="col-xs-12">
                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label"> </label>

                                <div class="col-sm-5">
                                <?php  
                                        if(!empty($requestData['department_id'])){
                                            $diplay="blocks";
                                        }else{
                                            $diplay="none";
                                        }
                                echo $this->Form->hidden('hidden_department',array('value'=>(isset($requestData['department_id']) && isset($requestData['department_id']))?$requestData['department_id']:'','id'=>'hiddenDepartment'));

                  echo $this->Form->input('department_id',array('label' => false,'div' => false,'options'=>array(), 'class' => 'form-control','id'=>'department','style'=>"display:$diplay;"));?> 

                                
                                </div>
                            </div>
                        </div>
                    </div>
                    <section class="content container-fluid">
    <!-- Content Header (Page header) -->
    <div class="row">

        <!-- ./col -->       
        <!-- ./col -->
        <div class="col-md-12">
            <div class="box">
                <div class="ajax-loader">
  <img src="/img/Spinner.gif" class="img-responsive" />
</div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive ProviderRow">
                        Search result will appear here...
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>
</section>
                   
                    <div class="col-md-2 pull-right">         
                         
                        <!--<button type="submit" class="btn btn-info "> Process Request</button>-->              
                    </div>
                    <div class="col-md-2 pull-left">

                    </div>
                     <?= $this->Form->end() ?><!-- end form-appointment -->
                </div><!-- /.box-body -->
                
            </div>
        </div><!-- ./col -->
    </div><!-- /.row -->
    <!-- Main row -->
</section><!-- /.content -->
     
    <script>    
    function fetchDepartments(providerID){
        var newOptions = '';
         // $("#stateloader").show();
        $.ajax({
            type : "POST",
            url  : "/users/getDepartmentByProviderId",
            data : {'providerId':providerID},
            success: function (sdata) {
              var obj = JSON.parse(sdata);                 
              $.each(obj, function(key, value) {                  
                newOptions = newOptions+'<option value="'+value.id+'">'+value.name+'</option>'; 
            });          
            $('#department').empty().append('<option value="">Select Department</option>');
                  
            if(obj!=''){
              //  $("#departmentLabel").hide();
                $("#department").show();
            }else{
                //$("#departmentLabel").show().html("No Department Available.");
                $("#department").hide();
            } 
            $('#department').append(newOptions);
            var oldStateVal = $('#hiddenDepartment').val();           
            $('#department').val(oldStateVal).attr('selected','selected');
          }         
        });       
    }

    window.onload = function() {                  
       var provId="<?php echo isset($requestData['provider_id'])?$requestData['provider_id']:'';?>";       
    <?php   if(!empty($requestData['department_id'])){?>                    
                $("input[name='provider_id']").val(provId);
                fetchDepartments(provId);
    <?php   }?>                
    }
   // var setFormSubmitting = function(e) { 
     $('#selectProviderForm').submit(function(e) {        
        if($.trim($('#select_provider').val())!=""){           
            $('#errorId').hide();
        }else{
            $("#department").hide();           
            $('#errorId').show().html('Please select provider name.');    
            $("input[name='provider_id']").val("");       
            return false;     
        }           
       // window.onbeforeunload = null;    
    });

    $(document).ready(function() {   
         
        var providerID;   
        
        $('.searchProvider').click(function(event) {
            event.preventDefault();
            var Provider = {
                providerName:$('#select_provider').val(),
            }
            $.ajax({
            type: "POST",
            beforeSend: function(){
            $('.ajax-loader').css("visibility", "visible");
            },
            url: SITE_URL +'requestors/getProviderList',
            dataType: 'json',
            data: Provider,
            cache: false,
            success: function(response){
                response = $.parseJSON(JSON.stringify(response));
                var table_data = "<table class='table table-bordered  table-striped'><th width='8%'>#</th><th width='20%'>First name</th><th width='20%'>Last name</th><th width='20%'>Company name</th><th width='30%'>Street address</th><th width='10%'>City</th><th width='10%'>State</th><th width='10%'>Zip code</th><th width='12%'>Action</th>";
                var count = 1;
                $.each(response, function (i, item) {
                  table_data += '<tr><td>' + item.provider_id + '</td>';
                  table_data += '<td>' + item.first_name + '</td>';
                  table_data += '<td>' + item.last_name + '</td>';
                  table_data += '<td>' + item.company_name + '</td>';
                  table_data += '<td>' + item.street_address + '</td>';
                  table_data += '<td>' + item.city + '</td>';
                  table_data += '<td>' + item.state + '</td>';
                  table_data += '<td>' + item.zip_code + '</td>';
                  table_data += '<td><a href="/requestors/request/?providerId=' + item.id + '" class="btn btn-primary">Select</a></td></tr>';
                  count++;
                });
                
                if(count === 1)
                table_data += '<tr><td colspan="6" align="center">No record found, please try with other search keyword.</td></table>'; 
                else
                table_data += '</table>';

                $(".ProviderRow").html('');
                $(".ProviderRow").html(table_data);

            },
            error: function(){ 
                console.error('Failed to process ajax !');
            },
            complete: function(){
            $('.ajax-loader').css("visibility", "hidden");
            }
          });
         });
        
        
        $( "#select_provider" ).keyup(function() {        
            if($.trim($('#select_provider').val())==''){                    
                $("#department").hide(); 
            }else{
                 $('#errorId').hide();
            }                
        });
        //prevent from press enter key
            $(window).keydown(function(event){
                if(event.keyCode == 13) {
                  event.preventDefault();
                  return false;
                }
              });
    });

    $(document).on('change',"input[name='provider_id']",function() {  
        if($.trim($('#select_provider').val())==''){         
            $("#department").hide(); 
        }else{
            $('#errorId').hide();
            providerID = $(this).val();
            fetchDepartments(providerID);  
        }          
       // window.onbeforeunload = afterRefresh;          
    });  

     

    function afterRefresh(){
      return confirm("Do you really want to refresh?"); 
    }

    
    
    </script>
