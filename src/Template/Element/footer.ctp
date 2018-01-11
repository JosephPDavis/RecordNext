<?php ?>

  <footer class="footer">
      <div class="footer__inner" id="contact_us">
      <div class="container">
<!--        <div class="footer__block clearfix">
          <div class="block__wrap pull-left">
            <p class="block__title"><i class="block__icon icon-note"></i>Need a Doctor for Check-up?</p>
            <p class="block__text">JUST MAKE AN APPOINTMENT & YOU’RE DONE!</p>
          </div>
          <a class="block__btn btn bg-color_second pull-right" href="javascript:void(0);">GET AN APPOINTMENT <span class="btn-plus">+</span></a>
        </div>-->
        <div class="row">
          <section class="footer__section col-sm-6">
            <h2 class="footer__title">Contact Form</h2>
            <i class="decor-brand decor-brand_footer"></i>
              <?php echo $this->Form->create('Contacts', array('url' => array('controller' => 'Pages', 'action' => 'contactUs'),'id'=>'contactusForm', 'type' => 'file'));?>
              <div class="form-group">
              <?= $this->Form->input('full_name',array('label' => false,'div' => false, 'class' => 'form-control', 'type'=>'text','placeholder'=>'Full Name','id'=>'full_name'));?>  
              <?= $this->Form->input('email',array('label' => false,'div' => false, 'class' => 'form-control', 'type'=>'text','placeholder'=>'Email address','id'=>'email'));?>  
              <?= $this->Form->input('message',array('label' => false,'div' => false, 'class' => 'form-control', 'type'=>'textarea','placeholder'=>'Message','id'=>'message'));?>  
              <!--   <input class="form-control" type="text" placeholder="Full Name">
                <input class="form-control" type="email" placeholder="Email address">
                <textarea class="form-control" rows="4" placeholder="Message"></textarea> -->
             <!--    <input class="btn bg-color_primary pull-right" type="submit" value="SEND NOW"> -->
              <?= $this->Form->button('SEND NOW', array('div' => false, 'class'=>'btn bg-color_primary pull-right','type'=>'submit')); ?>
              </div>
             <?php echo $this->Form->end(); ?>
          </section>
          <div class="col-sm-6">
            <section class="footer__section">
             
                  
                  <div class="footerLogo"><a href="#" class="logo pull-left"> <img class="logo__img" src="/img/logo_footer.png" height="44" width="270" alt="Logo"> </a></div>
                  <div class="clearfix"></div>
                  <ul class="footerLink">
          <li><?php echo $this->Html->link('HOME',['controller' => 'Pages', 'action' => 'home', '_full' => true]);?>
          <li><a href="<?php echo SITE_URL.'#aboutUs_Id'?>">ABOUT</a></li>
          <li><a href="<?php echo SITE_URL.'#service_id'?>">SERVICES</a></li>
          <li><?php echo $this->Html->link('LOGIN',['controller' => 'Users', 'action' => 'login', '_full' => true]);?></li>
<!--          <li><a href="javascript:void(0);">GALLERY</a></li>
          <li><a href="javascript:void(0);">BLOG</a></li>
          <li><a href="javascript:void(0);">SHOP</a></li>-->
          <li><a href="<?php echo SITE_URL.'#contact_us'?>">CONTACT</a></li>
        </ul>
     
            </section>
          </div>
<!--          <section class="footer__section col-sm-4">
            <h2 class="footer__title">Recent Tweets</h2>
            <i class="decor-brand decor-brand_footer"></i>
            <section class="tweets">
              <h3 class="tweets__title"><i class="footer__icon icon-social-twitter color_primary"></i>@ HealthCare Agency</h3>
              <p class="tweets__text">Sed ipsum posuere nunc libero pellentesque vitae ultrices posuere. Praesent justo dui laoreet dignissim.</p>
              <span class="tweets__time">3 hours ago</span> </section>
            <section class="tweets">
              <h3 class="tweets__title"><i class="footer__icon icon-social-twitter color_primary"></i>@ HealthCare Agency</h3>
              <p class="tweets__text">Sed ipsum posuere nunc libero pellentesque vitae ultrices posuere. Praesent justo dui laoreet dignissim.</p>
              <span class="tweets__time">3 hours ago</span> </section>
            <section class="tweets">
              <h3 class="tweets__title"><i class="footer__icon icon-social-twitter color_primary"></i>@ HealthCare Agency</h3>
              <p class="tweets__text">Sed ipsum posuere nunc libero pellentesque vitae ultrices posuere. Praesent justo dui laoreet dignissim.</p>
              <span class="tweets__time">3 hours ago</span> </section>
          </section>-->
        </div>
        <!-- end row --> 
      </div>
      <!-- end container --> 
    </div>
    <!-- end footer__inner -->
    
<!--    <div class="footer__menu clearfix">
      <div class="container"> <a href="#" class="logo pull-left"> <img class="logo__img" src="/img/logo_footer.png" height="44" width="270" alt="Logo"> </a>
        <ul class="pull-right">
          <li><a href="javascript:void(0);">HOME</a></li>
          <li><a href="javascript:void(0);">ABOUT</a></li>
          <li><a href="javascript:void(0);">SERVICES</a></li>
          <li><?php echo $this->Html->link('LOGIN',['controller' => 'Users', 'action' => 'login', '_full' => true]);?></li>
          <li><a href="javascript:void(0);">GALLERY</a></li>
          <li><a href="javascript:void(0);">BLOG</a></li>
          <li><a href="javascript:void(0);">SHOP</a></li>
          <li><a href="#contact_us">CONTACT</a></li>
        </ul>
      </div>
       end container  
    </div>-->
    <!-- end footer__menu -->
    
    <div class="footer__bottom"> <span class="copyright">© Copyrights 2017 RecordNext</span>
      <ul class="social-links">
        <li><a target="_blank" href="https://www.facebook.com/"><i class="social_icons social_facebook_square"></i></a></li>
        <li class=""><a target="_blank" href="https://twitter.com/"><i class="social_icons social_twitter_square"></i></a></li>
        <li><a target="_blank" href="https://www.google.com/"><i class="social_icons social_googleplus_square"></i></a></li>
        <li><a target="_blank" href="https://www.linkedin.com/"><i class="social_icons social_linkedin_square"></i></a></li>
        <li><a target="_blank" href="https://www.youtube.com/"><i class="social_icons social_youtube_square"></i></a></li>
        <li class="li-last"><a target="_blank" href="https://instagram.com/"><i class="social_icons social_instagram_square"></i></a></li>
      </ul>
    </div>
  </footer>

  <script>
    jQuery(document).ready(function () {
        jQuery("#contactusForm").validate({
            errorElement: "div",
            highlight: function (element) {
                $(element).removeClass("error");
            },
            rules: {
                "full_name": {
                    required: true                 
                },
                 "email": {
                    required: true,
                    email: true
                },
                 "message": {
                    required: true
                }
            },
            messages: {
                "full_name": {
                    required: "Please enter full name"
                },
                "email": {
                    required: "Please enter email",
                    email: "Please enter valid email"
                },
                "message": {
                    required: "Please enter message"
                }
            }
        });
    });
</script>