<?php ?>

<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>RecordNext</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!--<link rel="stylesheet" href="css/bootstrap.min.css">-->
  <?php echo $this->Html->css('bootstrap.min'); ?>
        <!-- Font Awesome -->
        <link rel="stylesheet" href="/fonts/font-awesome/css/font-awesome.min.css">
        <?php // echo $this->Html->s('font/font-awesome.min'); ?>
        <!--<link rel="stylesheet" href="css/font-awesome.min.css">-->

        <!-- Theme style -->
        <?php echo $this->Html->css('AdminLTE.min'); ?>
        <?php echo $this->Html->css('/plugins/datetimepicker/jquery.datetimepicker'); ?>
        <!--<link rel="stylesheet" href="css/AdminLTE.min.css">-->
        <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
              page. However, you can choose any other skin. Make sure you
              apply the skin class to the body tag so the changes take effect. -->
        <?php echo $this->Html->css('skins/skin-blue.min'); ?>
        <!--<link rel="stylesheet" href="css/skins/skin-blue.min.css">-->
        <?php echo $this->Html->css('style'); ?>
        <?php echo $this->Html->css('datepicker'); ?>
        <!--<link rel="stylesheet" href="css/style.css">-->
        <!-- jQuery 3 -->
        <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>-->
        <?php echo $this->Html->script('jquery.min'); ?>
        <?php // echo $this->Html->script('jquery-1.11.1.min'); ?>
        <?php //echo $this->Html->css('custom'); ?>
        
        <?php echo $this->Html->script('jquery.validate'); ?>
        <?php echo $this->Html->script('dev_custom'); ?>
        
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <!-- Google Font -->
        <link rel="stylesheet"
              href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
        <link type="text/css" rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/themes/smoothness/jquery-ui.css"  />
        <script>
            var SITE_URL = '<?php echo SITE_URL; ?>';
        </script>
    </head>
    <!--
    BODY TAG OPTIONS:
    =================
    Apply one or more of the following classes to get the
    desired effect
    |---------------------------------------------------------|
    | SKINS         | skin-blue                               |
    |               | skin-black                              |
    |               | skin-purple                             |
    |               | skin-yellow                             |
    |               | skin-red                                |
    |               | skin-green                              |
    |---------------------------------------------------------|
    |LAYOUT OPTIONS | fixed                                   |
    |               | layout-boxed                            |
    |               | layout-top-nav                          |
    |               | sidebar-collapse                        |
    |               | sidebar-mini                            |
    |---------------------------------------------------------|
    -->
    <body class="hold-transition skin-blue sidebar-mini">
        <div id="loddingImage">
           <?php echo $this->Html->image('/img/loader.gif', ['class'=>"user-image"]); ?>
	</div>
        <div class="wrapper">

            <!--Insert Main Header -->
<?php echo $this->element('website_header'); ?>
            <!-- Left side column. contains the logo and sidebar -->
          <?php echo $this->element('side_bar'); ?>

            <!-- Content Wrapper. Contains page content -->
            <!--include header-->
            <div class="content-wrapper" style="min-height: 235px;">
                <?= $this->Flash->render() ?>
                <!--include contents-->
<?= $this->fetch('content') ?>
            </div>

            <!--include footer-->


            
            <!-- /.control-sidebar -->
            <!-- Add the sidebar's background. This div must be placed
            immediately after the control sidebar -->
            <div class="control-sidebar-bg"></div>
            
        </div>
        <!-- ./wrapper -->
<!--Insert Main Footer -->
<?php echo $this->element('website_footer'); ?>

        <!-- REQUIRED JS SCRIPTS -->
<?php
//script for session timeout on idle screen
         echo $this->Html->script('jquery-ui/jquery-ui');
         echo $this->Html->script('storeJs/dist/store.legacy.min');
         echo $this->Html->script('jquery-idleTimeout/jquery-idleTimeout');
         echo $this->Html->script('jquery.idletimer');
?>
<!--<script src="js/jquery.min.js"></script>-->
        <!-- Bootstrap 3.3.7 -->
        <?php echo $this->Html->script('bootstrap.min'); ?>
        <?php echo $this->Html->script('bootstrap-datepicker'); ?>
        <?php echo $this->Html->script('jquery.mask'); ?>
        <?php echo $this->Html->script('jquery.mask.min'); ?>
        <!--<script src="js/bootstrap.min.js"></script>-->
        <!-- AdminLTE App -->
        <?php echo $this->Html->script('/plugins/datetimepicker/jquery.datetimepicker'); ?>
         <?php echo $this->Html->script('bootbox.min'); ?>
        
        <?php echo $this->Html->script('adminlte.min'); ?>
        <!--<script src="js/adminlte.min.js"></script>-->

        <!-- Optionally, you can add Slimscroll and FastClick plugins.
             Both of these plugins are recommended to enhance the
             user experience. -->
    </body>
</html>