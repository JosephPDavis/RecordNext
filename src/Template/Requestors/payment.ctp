<?php

//pr($cardAllCards);
//exit('cardAllCards');
?>

<style>
    .payment-errors {
        /*  background-color: #f2dede;
          border-color: #ebccd1;*/
        color: #a94442;
        margin-bottom:20px;

    }
    .hidden_new_card{
        display: none;
    }
    
    .CCsection{
    border: 1px solid #ccc;
    margin: 10px;
    padding: 20px;
    }
    .ccTitle {
    background: #fff none repeat scroll 0 0;
    margin-left: 15px;
    margin-top: -35px;
    width: 25%;
    font-weight: bold;
    color: #2986e2;
    }
    .form-horizontal .control-label
    {
        padding-top: 0;
    }
    .selectedDiv {
    box-shadow: 0px 0 6px #ccc;
    border: 1px solid red;
    }
</style>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Payment for Request
         <!--<small>Optional description</small>-->
    </h1>
    <ol class="breadcrumb">
        <li>
                <?php echo $this->Html->link('Dashboard <i class="fa fa-dashboard"></i>',['controller' => 'Requestors', 'action' => 'requestorsDashboard', '_full' => true],['class'=>'','escape' => false]);?>
            <!--<a href="#"><i class="fa fa-dashboard"></i> Dashboard</a>-->
        </li>
        <li class="active">Payment</li>
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
                    <h3 class="box-title">Step 3</h3>

                </div>
                <!-- /.box-header -->

                <div class="box-body">
                    <button type="button" class="btn btn-info" id="new_card_btn"> Add New Card</button> 
                     <?php if(!empty($cardAllCards)){ ?>
                    <button type="button" class="btn btn-info" id="show_saved_cards" style="display:none"> Show Saved Cards</button>              
                    <?php }?>
                    <span style="float: right !important;color: black !important;"><strong>Fields marked with <font color="RED">*</font> are mandatory</strong></span>
                    <div class='col-sm-offset-3 col-sm-9  payment-errors'></div>
                   <?= $this->Form->create((isset($requests)?$requests:''), array('class'=>'form-horizontal', 'id' => 'paymentForm','novalidate'=>true,'onsubmit'=>"setFormSubmitting()")) ?>
                    <?php  echo $this->Form->control('form_type', ['class' => 'form-control','type' => 'hidden','id'=>'form_type', 'label'=>false,'value'=>(!empty($cardAllCards)?1:2)]);?>
                    <?php $showRadio = ''; ?>
                    <?php if(!empty($cardAllCards)){ ?>
                    <div id="saved_cards">
                        <?php
                                $count = 1;     
                                foreach ($cardAllCards as $card){?>

                        <?php  echo $this->Form->control('id', ['class' => 'form-control','type' => 'hidden','id'=>'recordID', 'label'=>false,'value'=>$requestData['id']]);?>

                        <?= $this->Form->control('total_cost', ['class' => 'form-control','type' => 'hidden','id'=>'total_cost', 'required'=>'required', 'label'=>false,'placeholder'=>'','div'=>false,'maxlength'=>5,'value'=>(isset($requestData['threshold'])?$requestData['threshold']:'')]) ?>
                         <?php
                         if($count == 1){ 
                             $active= 'checked';
                              $selected = 'selectedDiv';
                         }else if($card['default_card'] == 'Y'){ 
                              $active= 'checked';
                              $selected = 'selectedDiv';
                         }else{
                              $active= '';
                              $selected = '';
                         }
                            ?>
                        <div class="col-md-5 CCsection <?= $selected ?>">
                        <?php if(count($cardAllCards) > 1 ){  
                            $showRadio = "";
                            ?> 
                        <?php }else{
                              $showRadio = "hidden";
                           } ?>
                        
                        <h3 class="ccTitle">Card #<?php echo $count;?></h3>
                        <div class="form-group <?php echo  $showRadio;?>">
                            <label for="inputEmail3" class="col-sm-6 control-label">Proceed to pay</label>
                            <div class="col-sm-6">
                               <?= $this->Form->radio(
                                        'proceed_to_pay',
                                        [
                                            ['value' => $card['id'],'label'=>false,'text' => false,'class' => "selectedCardCls $showRadio",'checked'=>$active,'id'=>$card['id']],
                                            
                                        ]); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="credit_card" class="col-sm-6 control-label required-label">Credit Card No. :</label>

                            <div class="col-sm-6">
                            <?php echo '**** **** **** '.$card['cc_no']; ?>

                            </div>
                        </div>
                                           <div class="form-group">
                                                    <label for="credit_card" class="col-sm-6 control-label required-label">Card Holder Name :</label>
                        
                                                    <div class="col-sm-6">
                                <?php echo $card['name_on_card']; ?> 
                                                    </div>
                                                </div>

                        <div class="form-group">
                            <label class="col-sm-6 control-label required-label" for="expirationMonth">Expiration Date</label>
                            <div class="col-sm-6">
                                <div class="row">
                                    <div class="col-xs-3">
                                     <?php echo $card['exp_month'].'/'.$card['exp_year']; ?>
                                    </div>
                                    <!--                                    <div class="col-xs-3">
                                    <?php // echo$card['exp_year']; ?>
                                                                        </div>-->
                                </div>
                            </div>
                        </div>
<!--                        <div class="form-group cvvDivCls" id="cvvDiv<?php echo $card['id'];?>">
                            <label for="inputEmail3" class="col-sm-2 control-label required-label">CVV</label>

                            <div class="col-sm-2">
                               <?= $this->Form->control('cvv_existing', ['class' => 'form-control required_dyn','type' => 'text','id'=>'cvv', 'label'=>false,'placeholder'=>'Enter cvv','div'=>false,'maxlength'=>3,'data-stripe'=>"cvc"]) ?>
                            </div>
                        </div>-->
                        </div>
                         
                        <?php    
                        $count++;
                        }
                        ?>
                    </div>
                    <?php }?>
                    
                    <div id="new_card" class="hidden_new_card">
                       
                        <?php  echo $this->Form->control('id', ['class' => 'form-control','type' => 'hidden','id'=>'recordID', 'label'=>false,'value'=>$requestData['id']]);?>

                        <?= $this->Form->control('total_cost', ['class' => 'form-control','type' => 'hidden','id'=>'total_cost', 'required'=>'required', 'label'=>false,'placeholder'=>'','div'=>false,'maxlength'=>5,'value'=>(isset($requestData['threshold'])?$requestData['threshold']:'')]) ?>
                       
                        <div class="form-group">
                            <label for="credit_card" class="col-sm-2 control-label required-label">Credit Card No. :</label>

                            <div class="col-sm-5">
                            <?= $this->Form->control('credit_card_no', ['class' => 'form-control blankcls','type' => 'text','id'=>'credit_card_no', 'required'=>'required', 'label'=>false,'placeholder'=>'Enter credit card number','div'=>false,'maxlength'=>16,'data-stripe'=>"number"]) ?>

                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label required-label">Credit Card Holder Name :</label>

                            <div class="col-sm-5">
                               <?= $this->Form->control('holder_name', ['class' => 'form-control blankcls','type' => 'text','id'=>'holder_name', 'required'=>'required', 'label'=>false,'placeholder'=>'Enter name','div'=>false,'maxlength'=>30]) ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label required-label">CVV</label>

                            <div class="col-sm-5">
                               <?= $this->Form->control('cvv', ['class' => 'form-control blankcls','type' => 'text','id'=>'cvv', 'required'=>'required', 'label'=>false,'placeholder'=>'Enter cvv','div'=>false,'maxlength'=>3,'data-stripe'=>"cvc"]) ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label required-label" for="expirationMonth">Expiration Date</label>
                            <div class="col-sm-9">
                                <div class="row">
                                    <div class="col-xs-2">
                                        <select class="form-control blankcls col-sm-3" data-stripe="exp_month" required name="exp_month">
                                            <option>Month</option>
                                            <option value="01">Jan (01)</option>
                                            <option value="02">Feb (02)</option>
                                            <option value="03">Mar (03)</option>
                                            <option value="04">Apr (04)</option>
                                            <option value="05">May (05)</option>
                                            <option value="06">June (06)</option>
                                            <option value="07">July (07)</option>
                                            <option value="08">Aug (08)</option>
                                            <option value="09">Sep (09)</option>
                                            <option value="10">Oct (10)</option>
                                            <option value="11">Nov (11)</option>
                                            <option value="12" selected="">Dec (12)</option>
                                        </select>
                                    </div>
                                    <div class="col-xs-3">
                                        <select class="form-control blankcls" data-stripe="exp_year" name="exp_year">
                                            <option value="17">2017</option>
                                            <option value="18">2018</option>
                                            <option value="19">2019</option>
                                            <option value="20" selected="">2020</option>
                                            <option value="21">2021</option>
                                            <option value="22">2022</option>
                                            <option value="23">2023</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Remember for quick pay next time ?</label>

                            <div class="col-sm-5">
                               <?= $this->Form->control('remember', ['class' => '','type' => 'checkbox','id'=>'remember', 'label'=>false,'div'=>false]) ?>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="box-footer">
                    <?php //$requestID = $this->Common->encrypt($requestData['id']);
                     echo $this->Html->link('Back',['controller' => 'Requestors', 'action' => 'request','?'=>array('providerId'=>$this->Common->encrypt($providerId)), '_full' => true],['class'=>'btn btn-default']);
                       ?>
                        <?= $this->Form->button(__('Submit'), ['class' =>'btn btn-info pull-right submit','type'=>'button','data-toggle'=>'modal','id'=>'payBtn']); ?>
                </div>
                   <?php echo $this->form->end();?>
            </div>

            <!-- /.box -->
        </div>

        <!-- ./col -->
    </div>
    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Request Confirmation</h4>
                </div>
                <div class="modal-body">
                    <p>You're credit card details are validated & request has been place successfully. Once provider confirms and accept the request payment will be deducted from your credit card. You will get regular notifications of request status updates until its completed.</p>
                </div>
                <div class="modal-footer">
                    <!--<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>-->
                <?php echo $this->Html->link('OK',['controller' => 'Requestors', 'action' => 'requestsListing', '_full' => true],['class'=>'btn btn-default']);?>
                    <!--<button type="button" class="btn btn-primary" data-dismiss="modal">Ok</button>-->
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    <script>

//        jQuery(document).ready(function () {

        //$("#request_btn").click(function () {
        //        bootbox.alert("Request Sent Successfully! Provider will update you back. "
        //                
        //                );
        //    });

//        });
    </script>
</section>
<!-- /.content -->
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>-->
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script type="text/javascript">
        function afterRefresh() {
            return confirm("Do you really want to refresh?");
        }
        Stripe.setPublishableKey('pk_test_iii5XWKAmJOkeOSPT03x7qft'); //sneha's key
//    Stripe.setPublishableKey('pk_test_gGGKHJ4gvBuN4SlAVfEYki7R'); //client's key
        var setFormSubmitting = function () {
            //$('#payBtn').attr('data-target',"#modal-default");     
            window.onbeforeunload = null;
        };

        jQuery(document).ready(function () {
            jQuery("#paymentForm").validate({
                errorElement: "div",
                highlight: function (element) {
                    $(element).removeClass("error");
                },
                rules: {
                    "credit_card_no": {
                        required: true,
                        number: true
                    },
                    "holder_name": {
                        required: true
                    },
                    "cvv": {
                        required: true,
                        number: true
                    },
                    "exp_month": {
                        required: true
                    },
                    "exp_year": {
                        required: true
                    },
                },
                messages: {
                    "credit_card_no": {
                        required: "Please enter credit card number ."
                    },
                    "holder_name": {
                        required: "Please enter card holder name."
                    },
                    "cvv": {
                        required: "Please enter cvv."
                    },
                    "exp_month": {
                        required: "Please select month."
                    },
                    "exp_year": {
                        required: "Please select year."
                    },
                }
            });
            $('#expiry_date').datepicker({
                format: 'mm/dd/yyyy',
            });
            window.onbeforeunload = afterRefresh;

            //add and remove hidden class to  new card div
            var existing_cards = '<?php echo count($cardAllCards);?>';
            if (existing_cards != 0) {
                $("#new_card").addClass("hidden_new_card");
            } else {
                $("#new_card").removeClass("hidden_new_card");
            }
            //add var card butn
            $('#new_card_btn').click(function () {
                $("#new_card").removeClass("hidden_new_card");
                $("#saved_cards").addClass("hidden_new_card");
                $("#new_card_btn").hide();
                $("#show_saved_cards").show();
                $("#form_type").val('2');
//                $('input[name="proceed_to_pay"]').attr('checked', false);
            });
            $('#show_saved_cards').click(function () {
                $("#new_card_btn").show();
                $("#show_saved_cards").hide();
                $("#new_card").addClass("hidden_new_card");
                $("#saved_cards").removeClass("hidden_new_card");
                $('.blankcls').val('');// to blank the fields of add new card
                $("#form_type").val('1');
            });

            $('.input-group-addon').on('click', function () {
//                alert('fjhasdouil');
                $('#expiry_date').datepicker({
                    format: 'mm/dd/yyyy',
                });
            });
            // to check cvv is filled for existing cvv
//    $('#payBtn').on('click', function(event) {
//
//            // adding rules for inputs with class 'comment'
//            $('input.required_dyn').each(function() {
//                $(this).rules("add", 
//                    {
//                        required: true,
//                        number:true
//                    });
//            });    // prevent default submit action         
//            event.preventDefault();
// });
//var existingcard = '<?php // echo $cardAllCards;?>';
//if(existingcard !=0){
//    $('#new_card_btn').show();
//}else{
//    $('#show_saved_cards').hide();
//$('#new_card_btn').hide();
//}


        });
        $(function () {
            var $form = $('#paymentForm');
            $('#payBtn').click(function (event) {
                // Disable the submit button to prevent repeated clicks:
                $form.find('.submit').prop('disabled', true);
                var amount = "<?php echo (isset($requestData['threshold'])?$requestData['threshold']:'0'); ?>";
//                alert(amount);
                if ($('#form_type').val() == '2') {
                    if ($("#paymentForm").valid()) {
                        // Request a token from Stripe:
                        Stripe.card.createToken($form, stripeResponseHandler);
                    }

                } else if ($('#form_type').val() == '1') {
                    var form_type = $('#form_type').val();
                    paymentExistingCard(amount, form_type);

                }


                // Prevent the form from being submitted:
                return false;
            });
        });

        function stripeResponseHandler(status, response) {
            // Grab the form:
            var $form = $('#paymentForm');
            if (response.error) { // Problem!
//            alert(response.error);
//            console.log(response);
                // Show the errors on the form:
                $('.payment-errors').text(response.error.message);
                $form.find('.submit').prop('disabled', false); // Re-enable submission

            } else { // Token was created!

                // Get the token ID:
                var token = response.id;
                // Insert the token ID into the form so it gets submitted to the server:
//            $form.append($('<input type="hidden" name="stripeToken"/>').val(token));
                $form.append($('<input type="hidden" name="stripeToken"/>').val(token));
                // Submit the form:
                var formData = $('#paymentForm').serialize();
                var url = $('#paymentForm').attr('action');
                if (token != '') {
                    $('#payBtn').prop('disabled', true);
                    $('#loddingImage').show();
                    $.ajax({
                        type: "POST",
                        data: formData,
                        url: url,
                        dataType: 'json',
                        success: function (json) {
                            console.log(json);
                            if (json.status == 'success') {
                                $('#loddingImage').hide();
                                $('#modal-default').modal('show');
                                 window.onbeforeunload = null;
//                                $.unblockUI();
//                                toastr.success('Archive component has been deleted successfully!');
//                                setTimeout(function () {
//                                    location.reload();
//                                }, 200);
                            } else {
                                $.unblockUI();
                                toastr.error('Sorry!! There is problem processing request, Please try again.');
                            }
                        }
                    });
                }



            }
        }
        ;
        $(document).ready(function () {
            $('.selectedCardCls').click(function () {
                if ($(this).val() == $('input[name="proceed_to_pay"]:checked').val()) {
                    $(".cvvDivCls").hide();
                    $("#cvvDiv" + $(this).val()).show();
                    $("#cvvDiv" + $(this).val()).find('input[name="cvv"]').val('');
                }
            });
            if ($('input[name="proceed_to_pay"]:checked').val() != 0) {
                $(".cvvDivCls").hide();
                $("#cvvDiv" + $('input[name="proceed_to_pay"]:checked').val()).show();
            }
        });


        //function direct charge stripe
        function stripeDirectCharge(amount) {
            var cardID = $('input[name="proceed_to_pay"]:checked').val();
            var cvvNo = $("#cvvDiv" + cardID).find('input[name="cvv"]').val();

            $('#loddingImage').show();
            $.ajax({
                type: "POST",
                data: {'cardID': cardID, 'cvvNo': cvvNo, 'amount': amount},
                url: '/requestors/stripeDirectCharge',
                dataType: 'json',
                success: function (json) {
                    console.log(json);
                    if (json.status == 'success') {
                        $('#loddingImage').hide();
                        $('#modal-default').modal('show');
//                                $.unblockUI();
//                                toastr.success('Archive component has been deleted successfully!');
//                                setTimeout(function () {
//                                    location.reload();
//                                }, 200);
                    } else {
                        $.unblockUI();
                        toastr.error('Sorry!! There is problem processing request, Please try again.');
                    }
                }
            });
        }

        /**
         * for existing card data into payment
         */
        function paymentExistingCard(amount, form_type) {
            $('#loddingImage').show();
            $('#payBtn').prop('disabled', true);
            
            var cardID = $('input[name="proceed_to_pay"]:checked').val();
            var cvvNo = $("#cvvDiv" + cardID).find('input[name="cvv"]').val();
            var url = $('#paymentForm').attr('action');
            var amount = amount;
            $.ajax({
                type: "POST",
                data: {'form_type': form_type, 'cardID': cardID, 'cvvNo': cvvNo, 'total_cost': amount},
                url: url,
                dataType: 'json',
                success: function (json) {
                    console.log(json);
                    if (json.status == 'success') {
                        $('#loddingImage').hide();
                        $('#modal-default').modal('show');
                         window.onbeforeunload = null;
//                                $.unblockUI();
//                                toastr.success('Archive component has been deleted successfully!');
//                                setTimeout(function () {
//                                    location.reload();
//                                }, 200);
                    } else {
                        $.unblockUI();
                        toastr.error('Sorry!! There is problem processing request, Please try again.');
                    }
                }
            });
        }
</script>
