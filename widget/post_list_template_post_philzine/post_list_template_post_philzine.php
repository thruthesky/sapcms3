<?php
widget_css();

$post = $o;

$user = $post->get("id_user");
$user = user()->load( $user );
$user_id = $user->get("username");
$profile_url = "/theme/philzine/img/no_primary_photo.png";

$content = $post->get("content");
$stamp = $post->get("created");

$date = date("M d, Y",$stamp);
$humanTiming = humanTiming($stamp);

$content = nl2br( strip_tags( $post->get("content") ) );

$comment_count = $post->countComment();
?>
<div class="post" no="<?php echo $post->get('id')?>" no-parent="<?php echo $post->get('id_parent')?>" depth='<?php echo $o->get('depth')?>'>
	<div class="btn-group post-menu-philzine-top" role="group">
		<?php if( $post->get("id_user") != login() ){ ?>
			<button type="button" class="btn btn-secondary"><img src='/widget/post_list_template_post_philzine/img/report.png'/></button>
		<?php } else { ?>
			<button type="button" class="btn btn-secondary"><img src='/widget/post_list_template_post_philzine/img/edit.png'/></button>
			<button type="button" class="btn btn-secondary"><img src='/widget/post_list_template_post_philzine/img/delete.png'/></button>
		<?php } ?>
		<span class='menu-separator'></span>
		<button type="button" class="btn btn-secondary"><img src='/widget/post_list_template_post_philzine/img/more.png'/></button>
	</div>
	<div class="media post-info">
	  <a class="media-left" href="#">
		<img class="media-object profile-image" src='<?php echo $profile_url; ?>' alt="Generic placeholder image">
	  </a>
	  <div class="media-body">
		<div class='name'><?php echo $user_id; ?><img class='send-message' src='/widget/post_list_template_post_philzine/img/mail.png'/></div>
		<div class='date'><?php echo $date; ?><span class='separator'>|</span><?php echo $humanTiming; ?></div>
		<div class='location'>Lives in Philippines<span class='separator'>|</span>xx Fans</div>
	  </div>
	</div>
	<div class='content'>
		<?php echo $content; ?>
		<?php widget('post_display_data_default', $post)?>
	</div>
	<nav class="nav nav-inline post-menu-philzine-bottom">
	  <span class="nav-link like"><img src='/widget/post_list_template_post_philzine/img/like.png'/> Like <?php echo $post->get('no_vote_good')?></span>
	  <span class="nav-link reply"><img src='/widget/post_list_template_post_philzine/img/comment.png'/>Comment <?php echo $comment_count; ?></span>	  
	</nav>
</div>