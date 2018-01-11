<?php ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>HEALTHCARE Agency</title>
<link rel="shortcut icon" type="image/x-icon" href="favicon.png" />
<!--<link href="css/master.css" rel="stylesheet">-->
<?php echo $this->Html->css('master'); ?>
<?php echo $this->Html->css('/plugins/iview/css/iview'); ?>
<?php echo $this->Html->css('style_sdn'); ?>
<?php echo $this->Html->css('dev_style'); ?>
<!--<link rel="stylesheet" href="plugins/iview/css/iview.css" type='text/css' media='all' />-->
<?php echo $this->Html->css('/plugins/iview/css/skin/style'); ?>

<!--<link rel="stylesheet" href="plugins/iview/css/skin/style.css" type='text/css' media='all' />-->
<?php echo $this->Html->script('jquery-1.11.1.min'); ?>
<!--<script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>-->
<?php echo $this->Html->script('jquery-migrate-1.2.1'); ?>
<!--<script src= "js/jquery-migrate-1.2.1.js" ></script>-->
<?php echo $this->Html->script('jquery-ui.min'); ?>
<!--<script src="js/jquery-ui.min.js"></script>-->
<?php echo $this->Html->script('bootstrap-3.1.1.min'); ?>
<!--<script src="js/bootstrap-3.1.1.min.js"></script>-->
<?php echo $this->Html->script('modernizr.custom'); ?>
<!--<script src="js/modernizr.custom.js"></script>-->
<?php echo $this->Html->script('jquery.validate'); ?>
<?php echo $this->Html->script('dev_custom'); ?>
<script>
            var SITE_URL = '<?php echo SITE_URL; ?>';
</script>
</head>
<body>
<div class="layout-theme animated-css"  data-header="sticky" data-header-top="200"  > 
<!--include header-->
<?php echo $this->element('header'); ?>
<!--include contents-->
<?= $this->Flash->render('positive') ?>
<?= $this->fetch('content') ?>
<!--include footer-->
<?php echo $this->element('footer'); ?>
</div>
<!-- end layout-theme --> 
<span class="scroll-top bg-color_second"> <i class="fa fa-angle-up"> </i></span> 

<!--HOME SLIDER--> 
<?php echo $this->Html->script('/plugins/iview/js/iview'); ?>
<!--<script src="plugins/iview/js/iview.js"></script>--> 
<?php echo $this->Html->script('plugins/rendro-easy-pie-chart/dist/jquery.easypiechart.min'); ?>
  <!--<script src="plugins/rendro-easy-pie-chart/dist/jquery.easypiechart.min.js"></script>-->

<!-- SCRIPTS --> 
<?php echo $this->Html->script('/plugins/isotope/jquery.isotope.min'); ?>
<?php echo $this->Html->script('waypoints.min'); ?>
<?php echo $this->Html->script('/plugins/bxslider/jquery.bxslider.min'); ?>
<?php echo $this->Html->script('/plugins/prettyphoto/js/jquery.prettyPhoto'); ?>
<?php echo $this->Html->script('/plugins/datetimepicker/jquery.datetimepicker'); ?>
<?php echo $this->Html->script('/plugins/jelect/jquery.jelect'); ?>
<?php echo $this->Html->script('/plugins/nouislider/jquery.nouislider.all.min'); ?>
<?php echo $this->Html->script('/plugins/loader/js/classie'); ?>
<?php echo $this->Html->script('/plugins/loader/js/pathLoader'); ?>
<?php echo $this->Html->script('/plugins/loader/js/main'); ?>
<?php echo $this->Html->script('classie'); ?>
<?php echo $this->Html->script('cssua.min'); ?>
<?php echo $this->Html->script('wow.min'); ?>
<?php echo $this->Html->script('custom'); ?>
<!--<script type="text/javascript" src="plugins/isotope/jquery.isotope.min.js"></script> 
<script src="js/waypoints.min.js"></script> 
<script src="plugins/bxslider/jquery.bxslider.min.js"></script> 
<script src="plugins/prettyphoto/js/jquery.prettyPhoto.js"></script> -->
<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script> 
<!--<script src="plugins/datetimepicker/jquery.datetimepicker.js"></script> 
<script src="plugins/jelect/jquery.jelect.js"></script> 
<script src="plugins/nouislider/jquery.nouislider.all.min.js"></script> -->

<!-- Loader --> 
<!--<script src="plugins/loader/js/classie.js"></script> 
<script src="plugins/loader/js/pathLoader.js"></script> 
<script src="plugins/loader/js/main.js"></script> 
<script src="js/classie.js"></script> 
THEME 
<script src="js/cssua.min.js"></script> 
<script src="js/wow.min.js"></script> 
<script src="js/custom.js"></script>-->
</body>
</html>
