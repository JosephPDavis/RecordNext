<style>
    .skin-blue .sidebar-menu .treeview-menu > li.active > a{
        color: #F26529;
    }
</style>
<?php

$params = $this->request->params;
//pr($params);
$controller = $params['controller'];
$action = $params['action'];
$userSession = $this->request->session()->read('LoginUser');
$loguser= $this->request->session()->read('Auth.User');
$activeAllPayments = '';
$activerequestsListing = '';
$activeUsersetting = '';
$activerequestorsDashboard = '';
$activeselectProvider = '';
$activeAdminpaymentSettings = '';
$activeAdmindashboard = '';
$activeAdminrequestors = '';
$activeAdminproviders = '';
$activeviewAllRequests = '';
$activeViewPayments = '';
$activesettings = '';
$activeprovidersDashboard = '';
$activeprovidersProfile = '';
$active13 = '';
$displayUL = '';
$activeAdminpayment = '';
$activeAllOpenReq = '';
$activeAllRequests = '';
$style = '';
if($controller == 'Requestors' && $action== 'requestsListing'){
    $displayUL = 'menu-open';
   $activerequestsListing= 'active'; 
   $style = 'style="display: block"';
}elseif($controller == 'Requestors' && $action =='selectProvider'){
    $displayUL = 'menu-open';
    $style = 'style="display: block"';
     $activeselectProvider= 'active'; 
}elseif($controller == 'Users' && $action =='setting'){
     $activeUsersetting= 'active'; 
}elseif($controller == 'Requestors' && $action =='requestorsDashboard'){
     $activerequestorsDashboard= 'active'; 
}elseif($controller == 'Admins' && $action =='dashboard'){
     $activeAdmindashboard= 'active'; 
}elseif($controller == 'Admins' && $action =='requestors'){
     $activeAdminrequestors= 'active'; 
}elseif($controller == 'Admins' && $action =='providers'){
     $activeAdminproviders= 'active'; 
}elseif($controller == 'Admins' && $action =='paymentSettings'){
     $activeAdminpaymentSettings= 'active'; 
}elseif($controller == 'Admins' && $action =='paymentListings'){
    $activeAdminpayment = 'active'; 
}elseif($controller == 'Providers' && $action =='providersDashboard'){
     $activeprovidersDashboard= 'active'; 
}elseif($controller == 'Providers' && $action =='viewAllRequests'){
     $activeviewAllRequests= 'active'; 
}elseif($controller == 'Providers' && $action =='ViewPayments'){
     $activeViewPayments= 'active'; 
}elseif($controller == 'Providers' && $action =='settings'){
     $activesettings= 'active'; 
}elseif($controller == 'Requestors' && $action =='allPayments'){
     $activeAllPayments= 'active'; 
}elseif($controller == 'Users' && $action =='companyProfile'){
   $activeprovidersProfile = 'active'; 
}elseif($controller == 'Admins' && $action =='allOpenRequests'){
    $activeAllOpenReq = 'active';
}elseif($controller == 'Admins' && $action =='requests'){
    $activeAllRequests = 'active';
}else{
    $active= ' '; 
}

?>
<style>
    .ul-open{
        display: block;
    }
</style>

<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

<?php if($loguser['role_id'] == 1){ ?>
        <ul class="sidebar-menu" data-widget="tree">

            <!-- Optionally, you can add icons to the links -->
            <li class="<?php echo $activeAdmindashboard;?>">
                            <?php echo $this->Html->link(' <i class="fa fa-tachometer"></i> Dashboard',['controller' => 'Admins', 'action' => 'dashboard', '_full' => true],['class'=>'','escape' => false]);?>
            </li>
            <li class="<?php echo $activeAdminrequestors;?>">
                            <?php echo $this->Html->link(' <i class="fa fa-user-plus"></i> Requester Listing',['controller' => 'Admins', 'action' => 'requestors', '_full' => true],['class'=>'','escape' => false]);?>
            </li>
            <li class="<?php echo $activeAdminproviders;?>">
                            <?php echo $this->Html->link(' <i class="fa fa-user-plus"></i> Provider Listing',['controller' => 'Admins', 'action' => 'providers', '_full' => true],['class'=>'','escape' => false]);?>
            </li>
            <li class="<?php echo $activeAdminpayment;?>">
                            <?php echo $this->Html->link(' <i class="fa fa-money"></i> Payments',['controller' => 'Admins', 'action' => 'paymentListings', '_full' => true],['class'=>'','escape' => false]);?>
            </li>
            <li class="<?php echo $activeAllRequests;?>">
                            <?php echo $this->Html->link(' <i class="fa fa-link"></i> View All Requests ',['controller' => 'Admins', 'action' => 'requests', '_full' => true],['class'=>'','escape' => false]);?>
            </li>
            <li class="<?php echo $activeAllOpenReq;?>">
                            <?php echo $this->Html->link(' <i class="fa fa-list-alt"></i> View All Open Requests ',['controller' => 'Admins', 'action' => 'allOpenRequests', '_full' => true],['class'=>'','escape' => false]);?>
            </li>
            <li class="<?php echo $activeAdminpaymentSettings;?>">
                            <?php echo $this->Html->link(' <i class="fa fa-list-alt"></i> Settings ',['controller' => 'Admins', 'action' => 'paymentSettings', '_full' => true],['class'=>'','escape' => false]);?>
            </li>
            
        </ul> 
<?php } ?>

<?php if($userSession['role_id'] == 2){?>
        <ul class="sidebar-menu" data-widget="tree">

            <!-- Optionally, you can add icons to the links -->
            <li class="<?php echo $activeprovidersDashboard;?>">
                            <?php echo $this->Html->link(' <i class="fa fa-tachometer"></i> Dashboard',['controller' => 'Providers', 'action' => 'providersDashboard', '_full' => true],['class'=>'','escape' => false]);?>
            </li>
            
            <li class="<?php echo $activeviewAllRequests;?>">
                            <?php echo $this->Html->link(' <i class="fa fa-link"></i>View Requests',['controller' => 'Providers', 'action' => 'viewAllRequests', '_full' => true],['class'=>'','escape' => false]);?>
            </li>
            <li class="<?php echo $activeViewPayments;?>">
                            <?php  echo $this->Html->link('<i class="fa fa-credit-card"></i> Payments ',['controller' => 'Providers', 'action' => 'allPayments', '_full' => true],['class'=>'','escape' => false]);?>
                <!--<a href="#"><i class="fa fa-cogs"></i> <span>Settings</span></a>-->
            </li>
            <li class="<?php echo $activesettings;?>">
                            <?php  echo $this->Html->link('<i class="fa fa-cogs"></i> Settings ',['controller' => 'Providers', 'action' => 'settings', '_full' => true],['class'=>'','escape' => false]);?>
                <!--<a href="#"><i class="fa fa-cogs"></i> <span>Settings</span></a>-->
            </li>
            <li class="<?php echo $activeprovidersProfile;?>">
              <?php echo $this->Html->link(' <i class="fa fa-user"></i> Profile',['controller' => 'Users', 'action' => 'companyProfile', '_full' => true],['class'=>'','escape' => false]);?>
            </li>

 <!--<li><a href="#"><i class="fa fa-link"></i> <span>Requests</span></a></li>-->
            <!--tes ->
         </ul> 
<?php

}
elseif($userSession['role_id']== 3){?>
<ul class="sidebar-menu" data-widget="tree">

            <!-- Optionally, you can add icons to the links -->
            <li class="<?php echo $activerequestorsDashboard;?>">
                            <?php echo $this->Html->link('<i class="fa fa-tachometer"></i> Dashboard',['controller' => 'Requestors', 'action' => 'requestorsDashboard', '_full' => true],['class'=>'','escape' => false]);?>
            </li>
            
            <li class="treeview <?php echo $displayUL;?>">
                <a href="#"><i class="fa fa-clipboard"></i> <span>Requests</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu" <?php echo $style; ?>>
                    <li class="<?php echo $activeselectProvider;?>">
                  <?php 
                  echo $this->Html->link('<i class="fa fa-edit"></i>Create Requests ',['controller' => 'Requestors', 'action' => 'selectProvider', '_full' => true],['class'=>'','escape' => false]);?>
                    </li>
                    <li class="<?php echo $activerequestsListing;?>">
                <?php echo $this->Html->link('<i class="fa fa-list-alt"></i>View All Requests ',['controller' => 'Requestors', 'action' => 'requestsListing', '_full' => true],['class'=>'','escape' => false]);?>
                    </li>
                </ul>
            </li>

            <li class="<?php echo $activeAllPayments;?>">
                            <?php echo $this->Html->link('<i class="fa fa-credit-card"></i> Payments ',['controller' => 'Requestors', 'action' => 'allPayments', '_full' => true],['class'=>'','escape' => false]);?>
                <!--<a href="#"><i class="fa fa-credit-card"></i> <span>Payments</span></a>-->
            </li>
            <li class="<?php echo $activeUsersetting;?>">
                            <?php
                            echo $this->Html->link('<i class="fa fa-cogs"></i> Settings ',['controller' => 'Users', 'action' => 'setting', '_full' => true],['class'=>'','escape' => false]);?>
            </li>
            <li class="<?php echo $activeprovidersProfile;?>">
              <?php echo $this->Html->link(' <i class="fa fa-user"></i> Profile',['controller' => 'Users', 'action' => 'companyProfile', '_full' => true],['class'=>'','escape' => false]);?>
            </li>
        </ul> 
<?php } ?>
        <!-- Sidebar Menu -->

        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>



