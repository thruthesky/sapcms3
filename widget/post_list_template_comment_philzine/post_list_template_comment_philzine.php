<?php
widget_css();

$post = $o;

$ci = & get_instance();
$post_config = post_config()->getCurrent();
$post_config_name = $post_config->get('name');

$user = $post->get("id_user");
$user = user()->load( $user );
$user_id = $user->get("username");
$profile_url = "/theme/philzine/img/no_primary_photo.png";

$content = $post->get("content");
$stamp = $post->get("created");

$date = date("M d, Y",$stamp);
$humanTiming = humanTiming($stamp)." ago";
if( empty( $humanTiming ) || $humanTiming == '' ) $humanTiming = "Just Now";

$content = nl2br( strip_tags( $post->get("content") ) );

$comment_count = $post->countComment();

$likes = $post->get('no_vote_good');
if( $likes == 0 ) $likes = null;
?>
<div class="post comment" no="<?php echo $post->get('id')?>" no-parent="<?php echo $post->get('id_parent')?>" depth='<?php echo $o->get('depth')?>'>
	<div class="media post-info">
	  <a class="media-left" href="#">
		<img class="media-object profile-image" src='<?php echo $profile_url; ?>' alt="Generic placeholder image">
	  </a>
	  <div class="media-body">
		<div class='name'><?php echo $user_id; ?></div>
		<div class='date'><?php echo $date; ?><span class='separator'>|</span><?php echo $humanTiming; ?></div>
		<div class='content'>
			<div class='text'><?php echo $content; ?></div>
			<?php widget('post_display_data_default', $post)?>
		</div>
	  </div>
	</div>
	
	<nav class="nav nav-inline post-menu-philzine-bottom text-xs-right">
	  <span class="nav-link like"><img src='/widget/post_list_template_comment_philzine/img/comment_like.png'/> Like <span class='no'><?php echo $likes ?></span></span>
	  
		<div class="nav-link dropdown">
			<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<img src='/widget/post_list_template_comment_philzine/img/comment_more.png'/>
			</button>
			<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu1">
				<span class="dropdown-item reply">Reply</span>
				<span class="dropdown-item report">Report</span>
				<span class="dropdown-item delete">Delete</span>
				<span class="dropdown-item edit">edit</span>
			</div>
		</div>
	</nav>
</div>