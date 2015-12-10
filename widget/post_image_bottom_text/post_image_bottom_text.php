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
<div class="carousel bottom-text-type no-margin-bottom" data-ride="carousel">
	<div class="carousel-inner" role="listbox">	
	<?php 
		$image = $img;
	
		$url = $image->get("url");
		$title = post_data()->load( $image->get('id_entity') )->get('content');			
	?>
	<div class="carousel-item active">
		<a href="#">
			<?php 
			if( empty( $o['fake_image'] ) ) echo "<img src='/theme/philzine/img/fake_third_right.png' style='width:100%;max-height:240px;opacity:0;z-index:-1;'/>";//temp
			else echo $o['fake_image']; 
			?>			
			<img class='carousel-image' src="<?php echo $url; ?>" alt="<?php echo $title; ?>">				
		</a>
	</div>				
	</div>
	<div class="carousel-caption">
		<?php echo $title ?>
	</div>
</div>
<?php } ?>