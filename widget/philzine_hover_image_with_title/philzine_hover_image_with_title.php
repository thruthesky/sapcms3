<?php
widget_css();

$images = $o['images'];
foreach( $images as $image ){		
	$post = post_data()->load( $image->get('id_entity') );

	$url = $image->get("url");
	$content = $post->get("content");
?>

	<div class='philzine-hover-image-with-title'>
		<div class='inner'>
			<img src='<?php echo $url; ?>'/>
			<div class='content'><?php echo $content; ?></div>
		</div>
	</div>


<?php
}
?>