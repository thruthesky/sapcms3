<?php

?><!doctype html>
<html>
<head>
    <title><?php echo $this->data['title']?></title>
    <?php echo bootstrap_css()?>
    <?php echo theme_css('base')?>
    <?php echo theme_css('layout')?>
    <?php echo theme_css('component')?>
    <?php echo theme_css('component.header')?>
    <?php echo theme_css('component.slide_menu')?>
    <?php echo theme_css('component.footer')?>    
    <?php echo theme_css('component.front')?>
    <?php echo theme_css('state')?>
    <?php echo theme_css('theme')?>
    <?php echo jquery()?>
    <script>
        var base_url = '<?php echo base_url();?>';
    </script>
	
	<?php include '/theme/philzine/philzine.functions.php' ?>
</head>
<body>
<div class="header">
	<?php include theme_script('header') ?>	
</div>
<div class="container">    
	<div class="slide-menu"><?php include 'page/menu.slide.php';?></div>
	<div class="error"><?php widget('error') ?></div>
	<div class="page <?php echo $model?>"><?php include $path_theme_script ?></div>
</div>
<div class="footer"><div class="container"><?php include theme_script('footer') ?></div></div>
<?php echo bootstrap_js()?>
<?php echo js('/etc/js/common')?>
<?php echo theme_js('default')?>
</body>
</html>
