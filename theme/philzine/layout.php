<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags always come first -->
    <meta charset="utf-8">
    <title><?php echo $this->data['title']?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <!-- Bootstrap CSS -->
    <?php echo bootstrap_css()?>
    <?php echo theme_css('base')?>
    <?php echo theme_css('layout')?>
    <?php echo theme_css('component')?>
    <?php echo theme_css('component.header')?>
    <?php echo theme_css('component.slide_menu')?>
    <?php echo theme_css('component.footer')?>
    <?php echo theme_css('component.grid')?>
    <?php echo theme_css('component.front')?>
    <?php echo theme_css('state')?>
    <?php echo theme_css('theme')?>
    <?php echo jquery()?>
    <script>
        var base_url = '<?php echo base_url();?>';
    </script>

</head>
<body>


<div class="layout">
    <div class="header"><div class="header-inner"><?php include theme_script('header') ?></div></div>
    <div class="slide-menu"><?php include 'page/menu.slide.php';?></div>
    <div class="content">
        <div class="content-inner">
            <div class="error"><?php widget('error') ?></div>
            <div class="page <?php echo $model?>"><?php include $path_theme_script ?></div>
        </div>
    </div>
    <div class="footer"><div class="footer-inner"><?php include theme_script('footer') ?></div></div>
</div>


<?php echo bootstrap_js()?>
<?php echo js('/etc/js/common')?>
<?php echo theme_js('default')?>

</body>
</html>

