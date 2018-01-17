<?php
$userSession = $this->request->session()->read('LoginUser');
?>
<style>
    .navbar-nav>.notifications-menu>.dropdown-menu, .navbar-nav>.messages-menu>.dropdown-menu, .navbar-nav>.tasks-menu>.dropdown-menu {
        width: 435px !important;
        padding: 0 0 0 0;
        margin: 0;
        top: 100%;
    }
    .hide-no-notify{
        display: none;
    }
    .word-wrap{
         word-break: break-all;
         white-space: normal;
    }
</style>
<header class="main-header">

    <!-- Logo -->
     <?php if($userSession['role_id'] == 1){?>
    <a href="/admins/dashboard" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><img src="/img/logo_sm.png" alt=""/></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><img src="/img/logo.png" alt=""/></span>
    </a>
        <?php }elseif($userSession['role_id'] == 2){?>
    <a href="/providers/providersDashboard" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><img src="/img/logo_sm.png" alt=""/></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><img src="/img/logo.png" alt=""/></span>
    </a>
        <?php }elseif($userSession['role_id'] == 3){?>
    <a href="/requestors/requestorsDashboard" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><img src="/img/logo_sm.png" alt=""/></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><img src="/img/logo.png" alt=""/></span>
    </a>
     <?php   }?>


    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">


                <!-- Notifications Menu -->
                <li class="dropdown notifications-menu">
                    <!-- Menu toggle button -->
                    <a href="#" class="dropdown-toggle notifications-custom" data-toggle="dropdown" data-reqattr="">
                        <i class="fa fa-bell-o"></i>
                        <span class="label label-warning count"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header" id="showNotification">You have <span class="notifyCount"> </span> notifications</li>
                        <li class="header hide-no-notify" id="NoNotification">No notifications found</li>
                        <li>
                            <!-- Inner Menu: contains the notifications -->
                            <ul class="menu notification-list">
                                <li><!-- start notification -->
                                </li>
                                <!-- end notification -->
                            </ul>
                        </li>
                    </ul>
                </li>

                <!-- User Account Menu -->
                <li class="dropdown user user-menu">
                    <!-- Menu Toggle Button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                           <?php if($userSession['role_id']==1){?>
                        <span class="hidden-xs"> <?= $userSession['first_name'].' '.$userSession['last_name'];?></span>
           <?php   } else{?>
                        <span class="hidden-xs"> <?= $userSession['first_name'].' '.$userSession['last_name'];?></span>
           <?php }?>
                    </a>
                </li>
                <li class="dropdown">
                    <?php 
                    if($userSession['role_id']== 1){
                    echo $this->Html->link('Sign Out',['controller' => 'Admins', 'action' => 'adminLogout', '_full' => true],['class'=>'']);
                    }else{
                        echo $this->Html->link('Sign Out',['controller' => 'Users', 'action' => 'logout', '_full' => true],['class'=>'']);
                    }
                    ?>
                </li>
            </ul>
        </div>
    </nav>
</header>
<script>
    jQuery(document).ready(function () {

        //code for getting notifications
        load_unseen_notification();
        // load new notifications

        $(document).on('click', '.notifications-custom', function () {
            $('.count').html('');
            var ids = [];
            ids = $('.notifications-custom').attr('data-reqattr');
            //to read notifications
            $.ajax({
                type: "POST",
                data: {'ids': ids},
                url: '/notifications/readNotification',
                dataType: "json",
                success: function (data) {
                    var status = data.status;
                    var response = data.response;
                    var count = data.count;
                    var request_ids = data.request_ids;
                    if (status == 'success') {
//                        $('.notification-list').remove();
//                        load_unseen_notification('yes');
                    } else {
                    }
                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    if (XMLHttpRequest.readyState == 4) {
                        // HTTP error (can be checked by XMLHttpRequest.status and XMLHttpRequest.statusText)
                        alert(textStatus);
                        return false;
                    }
                    else if (XMLHttpRequest.readyState == 0) {
                        // Network error (i.e. connection refused, access denied due to CORS, etc.)
                        alert("Network error: connection refused.");
                        return false;
                    }
                    else {
                        // something weird is happening
                        alert("Something weird is happening");
                        return false;
                    }
                }
            });


        });

        setInterval(function () {

            load_unseen_notification();

        }, 30000);

    });

    /**
     * Load unseen notification
     */
    function load_unseen_notification(parameters) {
        $.ajax({
            type: "POST",
            url: '/notifications/requestNotification',
            dataType: "json",
            success: function (data) {
                var status = data.status;
                var response = data.response;
                var count = data.count;
                var request_ids = data.request_ids;
                if (status == 'success') {
                    $('.count').html(count);
                    $('#NoNotification').addClass('hide-no-notify');
                    $('#showNotification').show();
                    $('.notifyCount').html(count);
                    $('.notifications-custom').attr('data-reqattr', request_ids);
                    //append html of notifications
                    $('.notification-list').each(function () {
                        //this wrapped in jQuery will give us the current .notification-list ul
                        $(this).append(response);
                    });
                } else {
                    $('#showNotification').hide();
                    $('#NoNotification').show();
                    $('.notification-list').remove();
                    $('.count').html('');
                }
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                if (XMLHttpRequest.readyState == 4) {
                    aler('in error');
                    // HTTP error (can be checked by XMLHttpRequest.status and XMLHttpRequest.statusText)
                    alert(textStatus);
                    return false;
                }
                else if (XMLHttpRequest.readyState == 0) {
                    // Network error (i.e. connection refused, access denied due to CORS, etc.)
//                    alert("Network error: connection refused.");
                    return false;
                }
                else {
                    // something weird is happening
//                    alert("Something weird is happening");
                    return false;
                }
            }
        });
    }
</script>
