<?php
widget_css();

$post_config = post_config()->getCurrent();
$name = $post_config->get('name');
$subject = $post_config->get('subject');
?>
<div class="post-edit">
<div class="page-header">
    <h1><?php echo $subject?> Post Upload</h1>
</div>
    <?php echo form_open_multipart("$name/edit/submit");?>
<input type="text" name="subject" value="<?php echo set_value('')?>"><br>
<textarea name="content"></textarea><br>
<input type="submit">
<?php form_close();?>
</div>

