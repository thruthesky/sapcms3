<?php
$config = post_config()->getCurrent();
?>

<div class="btn-group" role="group" aria-label="...">
    <a class="btn btn-default" href="<?php echo url_post_edit($config)?>">Write</a>
    <a class="btn btn-default" href="<?php echo url_post_list($config)?>">1st Page</a>
    <a class="btn btn-default" href="<?php echo url_post_setting($config)?>">Settings</a>
</div>