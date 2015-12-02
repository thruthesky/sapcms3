<?php
widget_css();
widget_js();
$current = post_data()->getCurrent();
?>
<?php echo js('/etc/js/jquery.form/jquery.form.min');?>
<?php echo js('/etc/js/file');?>
<script>
    var id = <?php echo $current->get('id')?>;
    var markup = post_comment_form(id);
    document.write(markup);
</script>
<script>
    function callback_ajax_upload($form, re) {
        if ( re.code < 0 ) {
            alert(re.message);
        }
        else {
            var $data_id = $form.find("[name='data_id']");
            $data_id.val( $data_id.val() + ',' + re['record']['id'] );
            display_comment_file($form, re);
        }
    }
    function display_comment_file($form, re) {
        var url = re['record']['url'];
        var id = re['record']['id'];
        var $files = $form.find(".files");
        $files.append("<div class='file' no='"+id+"'><span class='delete'>X</span><img src='"+url+"'></div>");
    }
    function callback_ajax_delete(re) {
        if ( re.code ) return alert("Failed to delete the file");
        $(".file[no='"+re.id+"']").remove();
    }
</script>