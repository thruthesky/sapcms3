<?php
widget_css();
widget_js();
$ci = & get_instance();
$comments = $ci->data['comments'];
?>
<div class="post-comment-list">
    <?php
    foreach ( $comments as $comment ) {
        $user = user($comment->get('id_user'));
        $id = $comment->get('id');
        $username = $user->get('username');
        $content = post_data()->escapeContent($comment->get('content'));
        $depth = $comment->get('depth');
        ?>
        <div class='row' no='<?php echo $id?>' depth='<?php echo $depth?>'>

            <div class="menu top">
                <span class="edit">Edit</span>
            </div>

            <span class='id'><?php echo $id?></span>
            <span class='username'><?php echo $username?></span>

            <div class='content'><?php echo $content?></div>

            <div class="menu bottom">
                <span class='reply'>Reply...</span>
            </div>

            <?php widget('post_display_data_default', $comment)?>
        </div>

        <?php
    }
    ?>
</div>
