<?php ?>
<!-- Loader Landing Page -->
<!--  <div id="ip-container" class="ip-container"> 
     initial header 
    <header class="ip-header" >
      <div class="ip-loader">
        <div class="text-center">
          <div class="ip-logo"><img  src="/img/logo.png" height="50" width="294" alt="logo"></div>
        </div>
        <svg class="ip-inner" width="60px" height="60px" viewBox="0 0 80 80">
        <path class="ip-loader-circlebg" d="M40,10C57.351,10,71,23.649,71,40.5S57.351,71,40.5,71 S10,57.351,10,40.5S23.649,10,39.3,10z"/>
        <path id="ip-loader-circle" class="ip-loader-circle" d="M40,10C57.351,10,71,23.649,71,40.5S57.351,71,40.5,71 S10,57.351,10,40.5S23.649,10,40.5,10z"/>
        </svg> </div>
    </header>
  </div>-->
  <!-- Loader end -->
  
<!--  <div class="top-header">
    <div class="container">
      <div class="row">
        <div class="col-sm-5 text-left">
          <ul class="social-links">
            <li><a target="_blank" href="https://www.facebook.com/"><i class="social_icons social_facebook_square"></i></a></li>
            <li class=""><a target="_blank" href="https://twitter.com/"><i class="social_icons social_twitter_square"></i></a></li>
            <li><a target="_blank" href="https://www.google.com/"><i class="social_icons social_googleplus_square"></i></a></li>
            <li><a target="_blank" href="https://www.linkedin.com/"><i class="social_icons social_linkedin_square"></i></a></li>
            <li><a target="_blank" href="https://www.youtube.com/"><i class="social_icons social_youtube_square"></i></a></li>
            <li class="li-last"><a target="_blank" href="https://instagram.com/"><i class="social_icons social_instagram_square"></i></a></li>
          </ul>
        </div>
        <div class="top-header__links col-sm-7">
          <div class="btn-group languages">
            <button type="button" class="btn_languages dropdown-toggle" data-toggle="dropdown"><i class="icon_globe-2"></i>English UK<span class="caret color_primary"></span></button>
            <ul class="dropdown-menu" role="menu">
              <li><a href="javascript:void(0);">English UK1</a></li>
              <li><a href="javascript:void(0);">English UK2</a></li>
            </ul>
          </div>
          <a href="javascript:void(0);">Hospital Timings</a> <a href="javascript:void(0);">Book an Appointment</a> </div>
      </div>
    </div>
  </div>-->
  
  <!-- HEADER -->
  <div class="header">
    <div class="container">
      <div class="header-inner">
        <div class="row">
          <div class="col-md-4 col-xs-12"> <a href="/" class="logo"> <img class="logo__img" src="/img/logo.png" height="50" width="294" alt="Logo"> </a> </div>
          <div class="col-md-8 col-xs-12">
            <div class="header-block"> 
<!--                <span class="header-label">
                    <i class="icon-header icon-call-in color_primary"></i> 
                    <span class="helper"> Call Us <a href="tel:+522 234 56789"><strong>+522 234 56789</strong></a></span>
                </span>-->
                <span class="header-label"> 
                    <i class="fa fa-sign-in icon-header color_primary"></i>
                    <span class="helper"><a href="/users/login"><strong>Log In</strong></a></span>
                </span> 
                <!--<a class="top-cart" href="/"> <i class="icon icon-basket bg-color_primary"></i> Cart Items: 2 <span class="top-cart__price color_second">$250.00</span></a>-->
            </div>
            <form class="hidden-md hidden-lg text-center" id="search-global-mobile" method="get">
              <input type="text" value="" id="search-mobile" name="s" >
              <button type="submit"><i class="icon fa fa-search"></i></button>
            </form>
          </div>
        </div>
      </div>
      <!-- end header-inner--> 
    </div>
    <!-- end container-->
    
    <div class="top-nav ">
      <div class="container">
        <div class="row">
          <div class="col-md-12  col-xs-12">
            <div class="navbar yamm " >
              <div class="navbar-header hidden-md  hidden-lg  hidden-sm ">
                <button type="button" data-toggle="collapse" data-target="#navbar-collapse-1" class="navbar-toggle"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
                <a href="#" class="navbar-brand">Menu</a> </div>
              <div id="navbar-collapse-1" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                  <li class="dropdown"><?php echo $this->Html->link('HOME',['controller' => 'Pages', 'action' => 'home', '_full' => true]);?>
<!--                    <ul role="menu" class="dropdown-menu">
                      <li> <a href="home.html"> Home 1</a> </li>
                      <li> <a href="home-2.html"> Home 2</a> </li>
                    </ul>-->
                  </li>
                  <li class="dropdown"><a href="<?php echo SITE_URL.'#aboutUs_Id'?>">ABOUT</a>
<!--                    <ul role="menu" class="dropdown-menu">
                      <li> <a href="about-1.html"  > about 1</a> </li>
                      <li> <a href="about-2.html"  > about 2</a> </li>
                      <li> <a href="doctors.html"  > doctors</a> </li>
                    </ul>-->
                  </li>
                  <li class="dropdown"><a href="javascript:void(0)"  > SERVICES <b class="caret color_primary"></b> </a>
                    <ul role="menu" class="dropdown-menu">
                      <li>
                          <?php // echo $this->Html->link('Requestor',['controller' => 'Requestor', 'action' => 'requestorRegistration', '_full' => true]);?>
                          <a href="<?php echo SITE_URL.'#service_id'?>"> Requestor</a>
                      </li>
                      <li>
                          <?php // echo $this->Html->link('Provider',['controller' => 'Provider', 'action' => 'providerRegistration', '_full' => true]);?>
                          <a href="<?php echo SITE_URL.'#service_id'?>"> Provider</a> 
                      </li>
                    </ul>
                  </li>
<!--                  <li class="dropdown"><a href="blog-1.html"  >Blog <b class="caret color_primary"></b> </a>
                    <ul role="menu" class="dropdown-menu">
                      <li> <a href="blog-1.html" > Blog </a> </li>
                      <li> <a href="blog-post.html"  > post</a> </li>
                    </ul>
                  </li>-->
<!--                  <li class=" yamm-fw"><a href="shop-main.html"  >Shop <b class="caret color_primary"></b> </a>
                    <ul class="dropdown-menu">
                      <li>
                        <div class="yamm-content">
                          <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                              <h3 class="t1-title">Neurology <i class="decor-brand decor-brand_footer"></i> </h3>
                              <ul>
                                <li><a href="shop-main.html"><i class="fa fa-angle-right"></i>Materials 1</a></li>
                                <li><a href="shop-main.html"><i class="fa fa-angle-right"></i>Materials 2</a></li>
                                <li><a href="shop-main.html"><i class="fa fa-angle-right"></i>Materials 3</a></li>
                              </ul>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                              <h3 class="t1-title">Dental Surgery <i class="decor-brand decor-brand_footer"></i> </h3>
                              <ul>
                                <li><a href="shop-main.html"><i class="fa fa-angle-right"></i>Materials 1</a></li>
                                <li><a href="shop-main.html"><i class="fa fa-angle-right"></i>Materials 2</a></li>
                                <li><a href="shop-main.html"><i class="fa fa-angle-right"></i>Materials 3</a></li>
                              </ul>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                              <h3 class="t1-title">Pregnancy <i class="decor-brand decor-brand_footer"></i> </h3>
                              <ul>
                                <li><a href="shop-main.html"><i class="fa fa-angle-right"></i>Materials 1</a></li>
                                <li><a href="shop-main.html"><i class="fa fa-angle-right"></i>Materials 2</a></li>
                                <li><a href="shop-main.html"><i class="fa fa-angle-right"></i>Materials 3</a></li>
                              </ul>
                            </div>
                          </div>
                        </div>
                      </li>
                    </ul>
                  </li>-->
                  <li><?php echo $this->Html->link('LOGIN',['controller' => 'Users', 'action' => 'login', '_full' => true]);?></li>
                  <li><a href="#contact_us"> CONTACT </a> </li>
                </ul>
<!--                <form id="search-global-menu" class="hidden-xs hidden-sm" method="get">
                  <input type="text" value="" id="search" name="s" >
                  <button type="submit"><i class="icon-magnifier"></i></button>
                </form>-->
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--end top-nav --> 
  </div>
  <!-- HEADER END -->