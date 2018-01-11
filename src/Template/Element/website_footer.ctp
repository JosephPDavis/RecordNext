<?php
$userSession = $this->request->session()->read('LoginUser');
?>

<!-- Main Footer -->
<footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">

    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; <?php echo date("Y");;?> <?php echo $this->Html->link('RecordNext',['controller' => 'Pages', 'action' => 'home', '_full' => true]);?>.</strong> All rights reserved.
</footer>
<!--by Sneha G for session timeout in activity-->
<script>
 
 jQuery(document).ready(function () {
    var isLogged = '<?php echo $userSession['id'];?>' ;
    if (isLogged) {
      $(document).idleTimeout({
        redirectUrl: SITE_URL +"users/logout",   
        idleTimeLimit: 900,           // 'No activity' time limit in seconds. 1200 = 20 Minutes, now in 15 mins
        idleCheckHeartbeat: 60,       // Frequency to check for idle timeouts in seconds
        customCallback: false,       // set to false for no customCallback
        activityEvents: 'click keypress scroll wheel mousewheel mousemove', // separate each event with a space
        enableDialog: true,           // set to false for logout without warning dialog
        dialogDisplayLimit: 30,       // 20 seconds for testing. Time to display the warning dialog before logout (and optional callback) in seconds. 180 = 3 Minutes
        dialogTitle: 'Session Expiration Warning', // also displays on browser title bar
        dialogText: 'Because you have been inactive, your session is about to expire.',
        dialogTimeRemaining: 'Time remaining',
        dialogStayLoggedInButton: 'Stay Logged In',
        dialogLogOutNowButton: 'Log Out Now',
        errorAlertMessage: 'Please disable "Private Mode", or upgrade to a modern browser. Or perhaps a dependent file missing. Please see: https://github.com/marcuswestin/store.js',
        sessionKeepAliveTimer: 300,   // ping the server at this interval in seconds. 600 = 10 Minutes. Set to false to disable pings
        sessionKeepAliveUrl: SITE_URL +'app/keepAlive', // set URL to ping - does not apply if sessionKeepAliveTimer: false
        serverResponseEquals: 'OK',
      });
 
    }
    
    });
</script>