<?php
	widget_css();
	$posts = [];
	if( is_array( $o ) ){
		$posts = $o;
	}
	else{
		$posts[] = $o;
	}
?>

<ul class="list-group list-with-bottom-border-only">
<?php foreach( $posts as $p ){ 
	$content = mb_strcut ( $p['content'], 0, 40 );//temp
	$post_entity = post_data()->load( $p['id'] );
	$comment_count = $post_entity->countComment();
	//needs human timing
	$stamp = $p['created'];
?>
		<li class="list-group-item">
			<a href='#'>
				<?php echo $content; ?>					
			</a>
			<div class='extra-info'><?php echo $comment_count; ?> Comments <?php echo $stamp; ?></div>
		</li>
<?php 
	} 
?>
</ul>