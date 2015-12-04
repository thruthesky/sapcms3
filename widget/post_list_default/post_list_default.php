<?php
$forumName = post_config()->getCurrent()->get('name');
widget_css();
widget_js();
widget_js('post_list_endless');

?>

<?php echo js('/etc/js/jquery.form/jquery.form.min');?>

<h1 class="forum-title" name="<?php echo $forumName?>"><?php echo $forumName?></h1>

<?php widget('post_menu_default')?>

<?php widget('post_edit_default')?>

<div class="post-list">
    <?php
    foreach($o['list'] as $post) {
        widget('post_list_template_post', $post);
        $comments = $post->getComments();
        foreach ( $comments as $comment ) {
            widget('post_list_template_post', $comment);
        }
    }
    ?>
</div>