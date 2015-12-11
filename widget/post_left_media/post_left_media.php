<?php
	widget_css();
	$images = [];
	
	if( empty( $o['images'] ) ){
		echo "<h1>Empty Images</h1>";
		return;
	}
	
	if( is_array( $o['images'] ) ){
		$images = $o['images'];
	}
	else{
		$images[] = $o['images'];
	}
	foreach( $images as $img ){
	
	$url = $img->get("url");
	$post_data = post_data()->load( $img->get('id_entity') );
	$title = $post_data->get('title');	
	if( empty( $title ) ) $title = "No Title";
	$content = $post_data->get('content');	
?>
<div class="media">
  <a class="media-left" href="#">
	<img class='media-image' src="<?php echo $url; ?>"/>
  </a>
  <div class="media-body">
	<div class='inner'>
		<h4 class="media-heading"><?php echo $title; ?></h4>
		<?php echo $content; ?>
	</div>
  </div>
</div>
<?php } ?>