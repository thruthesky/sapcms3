<script>
location.href='https://philgo.com';
</script>

<h1>Send a Message</h1>
<?php echo form_open('/user/list',['class'=>'message-form'])?>
<h5>ID</h5>
<input type='text' name='receiver'>
<h5>Title</h5>
<input type='text' name='title'>
<h5>Content</h5>
<textarea name='content'></textarea><br>
<input type='submit'>
</form>