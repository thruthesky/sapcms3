<?php

?><!doctype html>
<html>
<head>
    <title>ADMIN PAGE</title>
    <?php echo bootstrap_css()?>
    <?php //echo theme_css('base')?>
    <?php //echo theme_css('layout')?>
    <?php //echo theme_css('component')?>
    <?php //echo theme_css('component.header')?>
    <?php //echo theme_css('component.footer')?>
    <?php //echo theme_css('state')?>
    <?php //echo theme_css('theme')?>
    <?php echo jquery()?>
	
	
	
    <?php echo theme_css('alm/bootstrap/css/bootstrap.min')?>
    <?php //echo theme_css('alm/font-awesome.min')?>
    <?php //echo theme_css('alm/ionicons.min')?>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css"><?php // required online script for the icons ?>
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"><?php // required online script for the icons ?>
    <?php echo theme_css('alm/dist/css/AdminLTE.min')?>
    <?php echo theme_css('alm/dist/css/skins/_all-skins.min')?>
    <?php echo theme_css('alm/plugins/iCheck/flat/blue')?>
    <?php echo theme_css('alm/plugins/morris/morris')?>
    <?php echo theme_css('alm/plugins/jvectormap/jquery-jvectormap-1.2.2')?>
    <?php echo theme_css('alm/plugins/datepicker/datepicker3')?>
    <?php echo theme_css('alm/plugins/daterangepicker/daterangepicker-bs3')?>
    <?php echo theme_css('alm/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min')?>

</head>
<body class="skin-black-light sidebar-mini">
<div class="wrapper">
    <div class="main-header">
		<?php include theme_script('header')?>		
	</div>
	<aside class='main-sidebar'>
		<?php include theme_script('left')?>	
	</aside>
    <div class="content-wrapper">
		<?php /*
        <div class="content body">
			<div class="page $model">$path_theme_script</div>
        </div>
		*/?>
		<div class="error"><?php widget('error') ?></div>
		<div class="page <?php echo $model?>"><?php include $path_theme_script ?></div>
    </div>
    <div class="main-footer">
		<div class="footer-inner"><?php include theme_script('footer')?></div>
	</div>
	<aside class="control-sidebar control-sidebar-light">
		<ul class="nav nav-tabs nav-justified control-sidebar-tabs">
		  <li class='active'><a href="#control-sidebar-options-tab" data-toggle="tab"><i class="fa fa-wrench"></i></a></li>
		  <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
		  <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
		</ul>
		<div class="tab-content">          
          <div class="tab-pane active" id="control-sidebar-options-tab">
			Options
		  </div> 
          <div class="tab-pane" id="control-sidebar-home-tab">
			Home
		  </div> 
          <div class="tab-pane" id="control-sidebar-settings-tab">
			Settings
		  </div>
		</div><!--/tab-content-->
    </aside>
	<div class="control-sidebar-bg" style="position: fixed; height: auto;"></div>
</div>
<?php echo bootstrap_js()?>
<?php echo js('/etc/js/common')?>
<?php echo theme_js('default')?>
<script>
	//bug for dropdown...
    $(document).ready(function () {
        $('.dropdown-toggle').dropdown();
    });
</script>
<?php echo theme_js('alm/bootstrap/js/bootstrap.min')?>
<?php //echo theme_js('alm/raphael-min')?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<?php echo theme_js('alm/plugins/morris/morris.min')?>
<?php echo theme_js('alm/plugins/sparkline/jquery.sparkline.min')?>
<?php echo theme_js('alm/plugins/jvectormap/jquery-jvectormap-1.2.2.min')?>
<?php echo theme_js('alm/plugins/jvectormap/jquery-jvectormap-world-mill-en')?>
<?php echo theme_js('alm/plugins/knob/jquery.knob')?>
<?php //echo theme_js('alm/moment.min')?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
<?php echo theme_js('alm/plugins/daterangepicker/daterangepicker')?>
<?php echo theme_js('alm/plugins/datepicker/bootstrap-datepicker')?>
<?php echo theme_js('alm/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min')?>
<?php echo theme_js('alm/plugins/slimScroll/jquery.slimscroll') ?>
<?php echo theme_js('alm/plugins/fastclick/fastclick')?>
<?php echo theme_js('alm/dist/js/app.min')?>

</body>
</html>
