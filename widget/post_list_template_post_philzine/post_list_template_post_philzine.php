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

$content = nl2br( strip_tags( $post->get("content") ) );

$comment_count = $post->countComment();

$likes = $post->get('no_vote_good');
if( $likes == 0 ) $likes = null;
?>
<div class="post" no="<?php echo $post->get('id')?>" no-parent="<?php echo $post->get('id_parent')?>" depth='<?php echo $o->get('depth')?>'>
	<div class="btn-group post-menu-philzine-top" role="group">
		<?php if( $post->get("id_user") != login() ){ ?>
			<span type="button" class="btn btn-secondary"><img src='/widget/post_list_template_post_philzine/img/report.png'/></span>
		<?php } else { ?>
			<span type="button" class="btn btn-secondary edit"><img src='/widget/post_list_template_post_philzine/img/edit.png'/></span>
			<span type="button" class="btn btn-secondary delete"><img src='/widget/post_list_template_post_philzine/img/delete.png'/></span>
		<?php } ?>
		<span class='menu-separator'></span>		
				
		<span class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			<img src='/widget/post_list_template_post_philzine/img/more.png'/>
		</span>
		<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu1">
			<span class="dropdown-item">More Menu 1</span>
			<span class="dropdown-item">More Menu 2</span>
		</div>		
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
		<div class='text'><?php echo $content; ?></div>
		<?php widget('post_display_data_default', $post)?>
	</div>
	<nav class="nav nav-inline post-menu-philzine-bottom">
	  <span class="nav-link like"><img src='/widget/post_list_template_post_philzine/img/like.png'/> Like <span class='no'><?php echo $likes ?></span></span>
	  <span class="nav-link reply"><img src='/widget/post_list_template_post_philzine/img/comment.png'/>Comment <?php echo $comment_count; ?></span>	  
	</nav>
	<script>
		//document.writeln( get_post_edit_form_philzine('<?php echo $post_config_name?>', 0, parseInt('<?php echo $post->get('id')?>'), 'comment' ) );
	</script>
	
	<div class="media post-edit-wrapper">
		<a class="media-left" href="#">
			<img class="media-object profile-image comment" src="/theme/philzine/img/no_primary_photo.png" alt="Generic placeholder image">
		</a>
		<div class="media-body">
			<div class="post-edit clearfix">
				<form class="ajax-upload clearfix" action="/<?php echo $post_config_name; ?>/edit/ajax/philzineCommentSubmit" enctype="multipart/form-data" method="post" accept-charset="utf-8">
					<input type="hidden" name="id" value="0">
					<input type="hidden" name="id_parent" value="<?php echo $post->get('id')?>">
					<input type="hidden" name="data_id" value="">
					<input type="hidden" name="model" value="post">
					<input type="hidden" name="category" value="upload">
					<div class="content col-sm-8"><textarea name="content"></textarea></div>
					<div class="file col-sm-2"><div class="img-btn-wrapper"><img class="image-button" src="/widget/post_edit_philzine/img/image.png"/></div><input type="file" name="file" onchange="onFileChange(this);"></div>
					<div class="submit col-sm-2"><input type="submit" value="Post"></div>
				</form>
				<div class="files"></div>
			</div>
		</div>
	</div>
</div>