<?php
$ci = & get_instance();
$data = $ci->data;
widget_css();
widget_js();

if( !empty( $data['reply'] ) ) $username = $data['reply'];
else $username = null;
?>

<?php echo js('/etc/js/jquery.form/jquery.form.min');?>
<?php echo js('/etc/js/file');?>
<div class='send-message'>
	<h1>Send a Message</h1>
	<?php //echo form_open('/message/send/submit',['class'=>'message-form'])?>
	<form class="ajax-upload" action="<?php echo base_url("/message/send/submit")?>" enctype="multipart/form-data" method="post" accept-charset="utf-8">
		<input type="hidden" name="data_id" value="">
		<input type="hidden" name="model" value="message">
		<input type="hidden" name="category" value="upload">
		<h5>ID</h5>
		<input type='text' name='username' value='<?php echo $username; ?>'>
		<h5>Title</h5>
		<input type='text' name='title'>
		<h5>Content</h5>
		<textarea name='content'></textarea><br>
		File: <input type="file" name="file" onchange='onFileChange(this);'><br>
		<div class="files"></div>
		<input type='submit'>
	</form>
</div>

<script>
	function callback_ajax_upload($form, re) {
		if ( re.code < 0 ) {
			alert(re.message);
		}
		else {
			/*var $data_id = $this.find("[name='data_id']");
			$data_id.val( $data_id.val() + ',' + re['record'].id );
			var $obj = $this.find("[name='"+re['record'].form_name+"']");
			if( re['record']['mime'].indexOf('image') != -1 ) $obj.after("<img class='uploaded' src='"+re['record']['url']+"'>");
			else $obj.after("<a class='uploaded' src='"+re['record']['url']+"'>"+re['record']['name']+"</a>");*/
			var $data_id = $form.find("[name='data_id']");
			$data_id.val( $data_id.val() + ',' + re['record']['id'] );
			display_file(re['record']['url'], re['record']['id']);
		}
	}
	
	function display_file(url, id) {
		var $files = $(".files");
		$files.append("<div class='file' no='"+id+"'><span class='delete'>X</span><img src='"+url+"'></div>");
	}
	
	function callback_ajax_delete(re) {
            if ( re.code ) return alert("Failed to delete the file");
            $(".file[no='"+re.id+"']").remove();
        }
</script>