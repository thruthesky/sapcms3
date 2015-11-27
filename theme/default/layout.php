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
    <?php echo theme_css('component.footer')?>
    <?php echo theme_css('state')?>
    <?php echo theme_css('theme')?>
    <?php echo jquery()?>
</head>
<body>
<div class="layout">
    <div class="header"><div class="header-inner"><?php include theme_script('header')?></div></div>
    <div class="content">
        <div class="content-inner">
            <div class="error"><?php widget('error') ?></div>
            <table width='100%' cellpadding="0" cellspacing="0">
                <tr valign="top">
                    <td class='content-left-td' width="220"><div class="left"><?php include theme_script('left')?></div></td>
                    <td><div class="page <?php echo $model?>"><?php include $path_theme_script ?></div></td>
                    <td class='content-right-td' width="160"><div class="right"><?php include theme_script('right')?></div></td>
                </tr>
            </table>
        </div>
    </div>
    <div class="footer"><div class="footer-inner"><?php include theme_script('footer')?></div></div>
</div>
<?php echo bootstrap_js()?>
<?php echo theme_js('default')?>
</body>
</html>
