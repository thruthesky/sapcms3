<?php

?><!doctype html>
<html>
<head>
    <title><?php echo $this->data['title']?></title>
    <?php echo bootstrap_css()?>
    <?php echo theme_css('base')?>
    <?php echo theme_css('layout')?>
    <?php echo theme_css('component')?>
    <?php echo theme_css('state')?>
    <?php echo theme_css('theme')?>
</head>
<body>
<div class="layout">
    <div class="header"><?php include theme_script('header')?></div>
    <div class="content">
        <div class="error"><?php include widget('error') ?></div>
        <div class="left"><?php include theme_script('left')?></div>
        <div class="page"><?php include $this->path_theme_script ?></div>
        <div class="right"><?php include theme_script('right')?></div>
    </div>
    <div class="footer"><?php include theme_script('footer')?></div>
</div>
<?php echo jquery()?>
<?php echo bootstrap_js()?>
<script type="text/javascript" src="/theme/default/js/default.js" ></script>
</body>
</html>
