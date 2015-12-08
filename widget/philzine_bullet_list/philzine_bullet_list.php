<?php
	widget_css();
	$posts = $o;
?>
<div class='philzine-bullet-list'>
	<div class='top-title'>TITLE</div>
	<?php foreach( $posts as $post ){ ?>
		<div class='content'><?php echo trim( strip_tags( $post['content'] ) ) ?></div>
	<?php } ?>
</div>
