<?php

    $name = $config->get('name');
?>
<?php echo form_open("$name/edit/submit") ?>


<input type="text" name="subject" value="<?php echo set_value('')?>"><br>
<textarea name="content"></textarea><br>
<input type="submit">
<?php echo form_close() ?>

