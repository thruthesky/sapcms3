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
?>
<div class="carousel hover-type top" data-ride="carousel">
	<div class="carousel-inner" role="listbox">	
	<?php 
		$url = $img->get("url");
		$post = post_data()->load( $img->get('id_entity') );
		$title = $post->get('content');		
	?>
	<div class="carousel-item active">
			<?php 
			if( empty( $o['fake_image'] ) ) echo "<img src='/theme/philzine/img/fake_front_carousel.png' style='width:100%;max-height:250px;opacity:0;z-index:-1;'/>";//temp
			else echo $o['fake_image']; 
			?>
			<img class='carousel-image' src="<?php echo $url; ?>" alt="<?php echo $title; ?>">
			<div class="carousel-caption">
				<h3><?php echo $title ?></h3>		
			</div>
		</a>
	</div>
	</div>
</div>
<?php
	}
?>