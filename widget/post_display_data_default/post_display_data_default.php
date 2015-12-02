<?php
widget_css();
$files = $o->getFiles();
if ( empty($files) ) return;
?>
<div class="post-display-data">
    <div class="files">
        <?php
        foreach ( $files as $file ) {
            ?>
            <div class="file" no="<?php echo $file->get('id')?>">
                <img src="<?php echo $file->get('url')?>">
            </div>
            <?php
        }
        ?>
    </div>
</div>