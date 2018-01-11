<?php ?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>RecordNext | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <?php echo $this->Html->css('bootstrap.min'); ?>
  <!--<link rel="stylesheet" href="css/bootstrap.min.css">-->
  <!-- Font Awesome -->
  <?php echo $this->Html->css('font-awesome.min'); ?>
  <!--<link rel="stylesheet" href="css/font-awesome.min.css">-->

  <!-- Theme style -->
  <?php echo $this->Html->css('AdminLTE.min'); ?>
  <!--<link rel="stylesheet" href="css/AdminLTE.min.css">-->
  <!-- iCheck -->
  <?php echo $this->Html->css('/plugins/iCheck/square/blue'); ?>
  <!--<link rel="stylesheet" href="plugins/iCheck/square/blue.css">-->

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <?php echo $this->Html->css('style'); ?>
  <?php echo $this->Html->script('jquery.min'); ?>
 <!--<link rel="stylesheet" href="css/style.css">-->
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page loginBg">

<?= $this->fetch('content') ?>
<!-- jQuery 3 -->
<!--<script src="js/jquery.min.js"/></script>-->

<!-- Bootstrap 3.3.7 -->
<?php echo $this->Html->script('bootstrap.min'); ?>
<!--<script src="js/bootstrap.min.js"></script>-->
<!-- iCheck -->
<!--<script src="plugins/iCheck/icheck.min.js"></script>-->
<?php echo $this->Html->script('jquery.validate'); ?>
<?php echo $this->Html->script('/plugins/iCheck/icheck.min'); ?>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>
</html>
