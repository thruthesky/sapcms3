<?php
widget_css();
$ci = & get_instance();
$post_config = post_config()->getCurrent();
$post_config_name = $post_config->get('name');
?>
<script>
    document.writeln( get_post_edit_form('<?php echo $post_config_name?>', 0, 0) );
</script>


<script>
    function callback_ajax_upload($form, re) {
        if ( re.code < 0 ) {
            alert(re.message);
        }
        else {
            var $data_id = $form.find("[name='data_id']");
            $data_id.val( $data_id.val() + ',' + re['record']['id'] );
            var m = get_display_file(re['record']['url'], re['record']['id']);

            $form.parents('.post-edit').find('.files').append(m);
        }
    }
    function callback_ajax_delete(re) {
        if ( re.code ) return alert("Failed to delete the file");
        $(".file[no='"+re.id+"']").remove();
    }
</script>
