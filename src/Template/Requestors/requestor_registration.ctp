<?php ?>

<style>
    .ui-form .input-group {
    overflow: inherit;
}
   .toolTipInfo{ position: absolute; top: 10px; right: 8px; z-index: 22;} 
    
</style>
<?php ?>

<div class="ui-title-page bg_title bg_transparent">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h1>Registration</h1>
                <div class="ui-subtitle-page">As Requestor</div>
            </div>
        </div>
    </div>
</div><!-- end ui-title-page -->
<?= $this->Flash->render() ?>
<main class="main-content">
    <section class="section loginInfo">
        <div class="container">
   <?= $this->Form->create($user, array('class'=>'form-appointment ui-form', 'id' => 'requester_register','name'=>'User','novalidate'=>true)) ?>

                <div class="row">
                    <div class="col-md-5 col-md-offset-1">
                        <div class="input-group">
                            <?= $this->Form->control('first_name', ['class' => '', 'id'=>'first_name', 'required'=>'required', 'placeholder'=>'Enter First Name', 'label'=>false,'maxlength'=>30,'tabindex'=>1]) ?>
                        </div>
                        <div class="input-group">
                              <?= $this->Form->control('email', ['class' => '', 'id'=>'email', 'required'=>'required', 'placeholder'=>'Enter Email', 'label'=>false,'maxlength'=>30,'tabindex'=>3]) ?>
                        </div>
                        <div class="input-group">
                            <span id="password_info" class="toolTipInfo" data-toggle="tooltip" title="Password must contain atleast 1 Alphabet, 1 Number and 1 Special Character(eg.$@!%*#?&)."> 
                                <i class="fa fa-question-circle editIcon " aria-hidden="true"></i>
                        </span>
                             <?= $this->Form->control('password', ['class' => '','type' => 'password', 'id'=>'password', 'required'=>'required', 'placeholder'=>'Enter Password', 'label'=>false,'maxlength'=>30,'tabindex'=>5]) ?>
                        </div>
                           
                         <?php $requesterType=[
                            1=>'Lawyers',
                            2=>'Insurance Company'
                        ];?>
                         <div role="select" class="jelect"  tabindex="7">
                            <input id="jelect" name="type" value="0" data-text="imagemin" type="select" class="jelect-input" tabindex="7">
                            <div role="button" class="jelect-current">Requestor Type</div>
                            <ul class="jelect-options">
                                <li data-val='1' role="option" class="jelect-option jelect-option_state_active">Lawyers </li>
                                <li data-val='2' role="option" class="jelect-option">Insurance Company</li>
                            </ul>
                        </div> 
                        <div class="input-group">
                            <?= $this->Form->control('street_address', ['class' => '','type' => 'text', 'id'=>'street_address', 'required'=>'required', 'placeholder'=>'Enter Street Address', 'label'=>false,'maxlength'=>30,'tabindex'=>9]) ?>
                        </div>
                        <div role="select" class="jelect" tabindex="11">
                            <input id="jelect" name="country_id" value="0" data-text="imagemin" type="select" class="jelect-input jelect_country" tabindex="7">
                            <div role="button" id='getStates' class="jelect-current">United States</div>
                            <ul class="jelect-options">
                                 <?php foreach($countryList as $key =>$val){
                                     $cl = ''; $cl = $key == '0' ? 'jelect-option_state_active' : ''; 
                                    ?>
                                <li data-val='<?php echo $key; ?>'  role="option" class="jelect-option <?php echo $cl; ?>"><?php echo $val;?></li>
                              <?php  }?>
                                <!--<li data-val='2' role="option" class="jelect-option">Insurance Company</li>-->
                            </ul>
                        </div>
                         
                    </div>
                    <div class="col-md-5">
                        <div class="input-group">
                          <?= $this->Form->control('last_name', ['class' => '', 'id'=>'last_name', 'required'=>'required', 'placeholder'=>'Enter Last Name', 'label'=>false,'maxlength'=>30,'tabindex'=>2]) ?>
                        </div>
                        <div class="input-group">
                            <?= $this->Form->control('phone', ['class' => '', 'id'=>'phone', 'required'=>'required', 'placeholder'=>'Enter Phone Number', 'label'=>false,'maxlength'=>15,'tabindex'=>4]) ?>
                        </div>
                        <div class="input-group">
                            <?= $this->Form->control('confirm_password', ['class' => '','type' => 'password', 'id'=>'confirm_password', 'required'=>'required', 'placeholder'=>'Enter Confirm Password', 'label'=>false,'maxlength'=>30,'tabindex'=>6]) ?>
                        </div>
                        <div class="input-group">
                            <?= $this->Form->control('city', ['class' => '','type' => 'text', 'id'=>'city', 'required'=>'required', 'placeholder'=>'Enter City', 'label'=>false,'maxlength'=>20,'tabindex'=>8]) ?>
                        </div>
                         
                        <div role="select" class="jelect"  tabindex="11">
                            <input id="jelect" name="state" value="3919" data-text="imagemin" type="select" class="jelect-input" tabindex="7">
                             
                            <div role="button" class="jelect-current stateName">Alabama</div>
                            <ul class="jelect-options statesUl">
                                <?php foreach($stateList as $key =>$val){
                                     $cl = ''; $cl = $key == '3919' ? 'jelect-option_state_active' : ''; 
                                    ?>
                                <li data-val='<?php echo $key; ?>'   role="option" class="jelect-option <?php echo $cl; ?>"><?php echo $val;?></li>
                              <?php  }?>
                             
                            </ul>
                        </div>
                        <div class="input-group">
                            <?= $this->Form->control('zip_code', ['class' => '','type' => 'text', 'id'=>'zip_code', 'required'=>'required', 'placeholder'=>'Enter Zip Code', 'label'=>false,'maxlength'=>20,'tabindex'=>12]) ?>
                        </div>
                    </div>
                </div><!-- end row -->
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <!--              <div class="input-group">
                                        <input type="text" placeholder="Subject  /  Brief Description">
                                      </div>-->
                        <div class="input-group">
                            <?= $this->Form->textarea('description',['id'=>'desc','placeholder'=>'Brief Description','rows' => '6','maxlength'=>200,'tabindex'=>12]); ?>
                        </div>
                        <?php //echo $this->Html->link('Register',['controller' => 'Requestors', 'action' => 'requestorsDashboard', '_full' => true],['class'=>'btn bg-color_primary']);?>
                         <?= $this->Form->button(__('Registration'), ['class' => 'btn bg-color_primary']); ?>
                        <!--<button class="btn bg-color_primary" type="submit">Registration</button>-->
                    </div>
                </div><!-- end row -->  
                <?= $this->Form->end() ?><!-- end form-appointment -->
        </div><!-- end container -->
    </section><!-- end section -->


</main><!-- end main-content -->
<script>
    jQuery(document).ready(function() {
        
        $('.jelect_country').on( 'change', function (e) {
                var countryID = this.value; 
                $.ajax({
                type: "POST",
                data: {countryID : countryID},
                url: '/users/getStates',
                //dataType: 'json',
                success: function (json) {
                    if (json != '') {
                       json = JSON.parse(json); 
                       $(".statesUl").empty();
                       var first = false;
                       $.each(json, function (key, value) {  
                           if(first == false){
                           $('.stateName').html(value);
                           first = true;
                       }
                           $(".statesUl").append('<li data-val='+key+' role="option" class="jelect-option">'+value+'</li>');
                        });
                        
                    } else {

                    }
                },
                error: function (requestObject, error, errorThrown) {
                    alert(error);
                    alert(errorThrown);
                }
            });
            });
        // tool tip for client name
        $('[data-toggle="tooltip"]').tooltip();
        
        jQuery("#requester_register").validate({
            errorElement: "div",
            highlight: function(element) {
                $(element).removeClass("error");
            },
            rules: {
                "first_name":{
                    required: true,
                    apostrophe_hyphen_alphanumeric: true
                },
                "last_name":{
                    required: true,
                    apostrophe_hyphen_alphanumeric: true
                },
                "email":{
                    required: true,
                    email: true,
                    remote: {
                        url: "/users/checkUniqueEmail/3",
                        type: "post"
                    }
                } ,
                "password":{
                    required: true,
                    minlength:8,
                    password_strength: true
                },
                "confirm_password": {
                    required: true,
                    equalTo: "#password"
                },
                "phone": {
                    required: true,
                    number:true
                },
                "type": {
                    required: true,
                },
                "street_address": {
                    required: true,
                    apostrophe_hyphen_alphanumeric: true
                },
                "city": {
                    required: true,
                    apostrophe_hyphen_alphanumeric: true
                },
                "state": {
                    required: true,
                    apostrophe_hyphen_alphanumeric: true
                },
                "country_id": {
                    required: true,
                },
                "zip_code": {
                    required: true,
                    numbers:true
                },
                "description": {
                    required:true,
                    apostrophe_hyphen_alphanumeric: true
                },
            },
            messages:{
                "first_name":{
                    required: "Please enter first name."
                },
                "last_name":{
                    required: "Please enter last name."
                },
                "email":{
                    required: "Please enter email.",
                    email: "Please enter valid email.",
                    remote: "Email already exist."
                }
                ,"password":{
                    required:"Please enter password.",
                    minlength:"Minimum length is 8 characters."
                    
                },
                "confirm_password": {
                    required: "Please enter confirm password.",
                    equalTo: "Password does not matched."
                },
                "phone": {
                    required: "Please enter phone number."
                },
                "type": {
                    required: "Please select requester type."
                },
                "street_address": {
                    required: "Please enter street address."
                },
                "city": {
                    required: "Please enter city."
                },
                "state": {
                    required: "Please enter state."
                },
                "country_id": {
                    required: "Please select country."
                },
                "zip_code": {
                    required: "Please enter zip code."
                },
                "description": {
                    required: "Please enter description."
                },
                
            }
        });

    });

</script>
