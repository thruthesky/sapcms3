<?php echo form_open('/post/edit/submit') ?>


<input type="text" name="subject" value="<?php echo set_value('')?>"><br>
<textarea name="content"></textarea><br>
<input type="submit">
<?php echo form_close() ?>

