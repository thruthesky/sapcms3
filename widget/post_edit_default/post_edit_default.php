<?php
widget_css();
$ci = & get_instance();
$post_config = post_config()->getCurrent();


$post_config_name = $post_config->get('name');
$subject = '';
$content = '';
if ( isset($ci->data['post']) ) {
    $post = $ci->data['post'];
    $subject = $post->get('subject');
    $content = $post->get('content');
}

?>
<?php echo js('/etc/js/jquery.form/jquery.form.min');?>
<?php echo js('/etc/js/post.file');?>
<div class="post-edit clearfix">
    <form class="ajax-upload" action="<?php echo base_url("$post_config_name/edit/ajax/submit")?>" enctype="multipart/form-data" method="post" accept-charset="utf-8">
        <?php if ( isset($post) ) { ?>
            <input type="hidden" name="id" value="<?php echo $post->get('id')?>">
        <?php } ?>
        <input type="hidden" name="data_id" value="">
        <input type="hidden" name="model" value="post">
        <input type="hidden" name="category" value="upload">
        <div class="subject"><input type="text" name="subject" value="<?php echo set_value('subject', $subject)?>"></div>
        <div class="content"><textarea name="content"><?php echo set_value('content', $content)?></textarea></div>
        <div class="file"><input type="file" name="file" onchange='onFileChange(this);'></div>
        <div class="submit"><input type="submit"></div>
    </form>
</div>
<div class="files"></div>


<script>
    function callback_ajax_upload($form, re) {
        if ( re.code < 0 ) {
            alert(re.message);
        }
        else {
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
    <?php
        if ( isset($ci->data['files']) ) {
            $files = $ci->data['files'];
            foreach( $files as $file ) {
                $url = $file->get('url');
                $id = $file->get('id');
                echo "display_file('$url', $id);\n";
            }
        }
    ?>
</script>
