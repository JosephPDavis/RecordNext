<section class="content-header">
    <h1> Payment for Request</h1>
    <ol class="breadcrumb">
        <li>
            <?php echo $this->Html->link('Dashboard <i class="fa fa-dashboard"></i>',['controller' => 'Requestors', 'action' => 'requestorsDashboard', '_full' => true],['class'=>'','escape' => false]);?>
        </li>
        <li class="active">Here</li>
    </ol>
</section>
<section class="content container-fluid">
    <!--------------------------
    | Your Page Content Here |
    -------------------------->
    <div class="row">
        <div class="col-md-12">
            <div class="box ">
                <div class="box-header with-border">
                    <h3 class="box-title">Step 3</h3>
                </div>
                <div class="box-body">
                   <form action="" class="form-horizontal" method="POST" id="payment-form">
<fieldset>
<div class="form-group">
<label class="col-sm-3 control-label" for="accountNumber">Payment Amount</label>
<div class="col-sm-6">
<input type="text" class="form-control" name="name" value="$1.00" disabled/>
</div>
</div>
<div class="form-group">
<label class="col-sm-3 control-label" for="accountNumber">Card Number</label>
<div class="col-sm-6">
<input type="text" class="form-control" size="20" data-stripe="number" value="4111111111111111" required/>
</div>
</div>
<div class="form-group">
<label class="col-sm-3 control-label" for="expirationMonth">Expiration Date</label>
<div class="col-sm-9">
<div class="row">
    <div class="col-xs-3">
        <select class="form-control col-sm-3" data-stripe="exp_month" required>
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
        <select class="form-control" data-stripe="exp_year">
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
<label class="col-sm-3 control-label" for="cvNumber">Card CVV</label>
<div class="col-sm-3">
<input type="text" class="form-control" data-stripe="cvc" value="123"/>
</div>
<!--<div class="form-group">
    <label class="col-sm-3 control-label" for="cvNumber">test maskin</label>
<div class="col-sm-3">
<input type="text"  id="mask" class="form-control"value=""/>
</div>-->
</div>
<div class="form-group">
<div class="col-sm-offset-3 col-sm-9">
<button type="submit" name="pay" id="pay" class="btn btn-primary">Pay Now</button>
</div>
<?php if(isset($_REQUEST['stripeToken'])){  ?> 
    <div class="col-sm-offset-3 col-sm-9 text-success">Your Payment has been processed successfully.<?= $_REQUEST['stripeToken']; ?></div>
<?php } ?>
    <div class='col-sm-offset-3 col-sm-9  text-danger payment-errors'></div>
</div>
</fieldset>
</form> 
                </div>
            </div>
        </div>
    </div>
</section>
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>-->
 <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script type="text/javascript">
    jQuery(document).ready(function () {
//    $("#mask").inputmask("+99 9999 9999 9999 9999 9999", {placeholder: ' '});
//    $('#mask').mask('AAA-GG-SSSS');
//    $('#mask').inputmask('999-99-9999', {maskedChar:'X', maskedCharsLength:5});
    });
    Stripe.setPublishableKey('pk_test_iii5XWKAmJOkeOSPT03x7qft'); //sneha's key
//    Stripe.setPublishableKey('pk_test_gGGKHJ4gvBuN4SlAVfEYki7R'); //client's key
 
    $(function() {
        var $form = $('#payment-form');
        $form.submit(function(event) {
            // Disable the submit button to prevent repeated clicks:
            $form.find('.submit').prop('disabled', true);
 
            // Request a token from Stripe:
            Stripe.card.createToken($form, stripeResponseHandler);
 
            // Prevent the form from being submitted:
            return false;
        });
    });
 
    function stripeResponseHandler(status, response) {
        // Grab the form:
        var $form = $('#payment-form');
        if (response.error) { // Problem!
 
            // Show the errors on the form:
            $form.find('.payment-errors').text(response.error.message);
            $form.find('.submit').prop('disabled', false); // Re-enable submission
 
        } else { // Token was created!
 
            // Get the token ID:
            var token = response.id;
            // Insert the token ID into the form so it gets submitted to the server:
//            $form.append($('<input type="hidden" name="stripeToken"/>').val(token));
            $form.append($('<input type="hidden" name="stripeToken"/>').val(token));
            
//            alert(response);
 
            // Submit the form:
            $form.get(0).submit();
        }
    };
</script>