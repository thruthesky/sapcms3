<?php
$forumName = post_config()->getCurrent()->get('name');
widget_css();
widget_js();
widget_js('post_list_endless');

?>

<?php echo js('/etc/js/jquery.form/jquery.form.min');?>

<h1 class="forum-title" name="<?php echo $forumName?>"><?php echo $forumName?></h1>

<?php //widget('post_menu_default')?>

<?php
//change this to post_edit_default to go back to the old design
 widget('post_edit_philzine_main')
 ?>

<div class="post-list">
    <?php
    foreach($o['list'] as $post) {
		if( $post->get('delete') == 'Y' ) continue;
		//change this to post_list_template_post to go back to the old design
        widget('post_list_template_post_philzine', $post);
        $comments = $post->getComments();
		echo "<div class='comment-list'>";
        foreach ( $comments as $comment ) {
			if( $comment->get('delete') == 'Y' ) continue;
            widget('post_list_template_comment_philzine', $comment);
        }
		echo "</div>";
    }
    ?>
</div>