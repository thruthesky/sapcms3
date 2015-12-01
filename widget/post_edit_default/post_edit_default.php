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

    <?php echo js('/etc/js/jquery.form/jquery.form.min');?>
    <?php echo js('/etc/js/file');?>
    <form class="ajax-upload" action="<?php echo base_url("$name/edit/submit")?>" enctype="multipart/form-data" method="post" accept-charset="utf-8">
        <input type="hidden" name="data_id" value="">
        <input type="hidden" name="model" value="post">
        <input type="hidden" name="category" value="upload">
        <input type="text" name="subject" value="<?php echo set_value('')?>"><br>
        <textarea name="content"></textarea><br>
        File: <input type="file" name="file" onchange='onFileChange(this);'><br>
        <input type="submit">
    </form>

    <script>
        function callback_ajax_upload($this, re) {
            if ( re.code < 0 ) {
                alert(re.message);
            }
            else {
                var $data_id = $this.find("[name='data_id']");
                $data_id.val( $data_id.val() + ',' + re['record'].id );
                var $obj = $this.find("[name='"+re['record'].form_name+"']");
                $obj.after("<img class='uploaded' src='"+re['record']['url']+"'>");
            }
        }
    </script>

</div>

