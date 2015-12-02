<?php
$files = $o->getFiles();
if ( empty($files) ) return;
?>
<div class="files" no="<?php echo $o->get('id')?>">
</div>
<script>
    var m = '';
    <?php foreach ( $files as $file ) { ?>
    m += get_display_file('<?php echo $file->get('url')?>', '<?php echo $file->get('id')?>', false);
    <?php } ?>
    if ( m ) {
        var id = <?php echo $o->get('id')?>;
        $(".files[no='"+id+"']").html(m);
    }
</script>