<?php
$data = [];

	$images = data()->rows("model='post' AND id_entity <> 0 LIMIT 1");
	if( !empty( $images[0] ) ){
		$data['images'] = data()->load( $images[0]['id'] );	
		$data['fake_image'] = "<img src='/theme/philzine/img/fake_front_carousel.png' style='width:100%;max-height:250px;opacity:0;z-index:-1;'/>";//temp
		widget( "post_image_hover_type", $data );
}
else{
	echo "<h1>No image for top_image carousel</h1>";
}
?>







<?php
	$posts = post_data()->rows("id_user <> 0 LIMIT 5");	
	widget("post_bullet_list", $posts);
?>










<?php
	$images = data()->rows("model='post' AND id_entity <> 0 LIMIT 3");
	if( count( $images ) >= 3 ){
		foreach( $images as $image ){
			$items['images'][] = data()->load( $image['id'] );		
		}						
?>

<div class='row third'>
	<div class="col-sm-6">
		<?php 			
			$data['images'] = $items['images'][0];
			$data['fake_image'] = "<img src='/theme/philzine/img/fake_square_image.png' style='width:100%;max-height:160px;opacity:0;z-index:-1;'/>";//temp
			widget( "post_image_hover_type", $data );

			$data['images'] = $items['images'][1];
			$data['fake_image'] = "<img src='/theme/philzine/img/fake_square_image.png' style='width:100%;max-height:160px;opacity:0;z-index:-1;'/>";//temp
			widget( "post_image_hover_type", $data );
		?>
    </div>
	<div class="col-sm-6">
		<?php
			$data['images'] = $items['images'][2];
			$data['fake_image'] = "<img src='/theme/philzine/img/fake_third_right.png' style='width:100%;max-height:240px;opacity:0;z-index:-1;'/>";//temp
			widget( "post_image_bottom_text", $data );
		?>
	</div>
</div>

<?php 
	}
else{
	echo "<h1>No image for this field</h1>";
}
?>





<?php
	$posts = post_data()->rows("id_user <> 0 LIMIT 3");	
?>
<div class='row fourth'>
	<div class="col-sm-6">
		<?php
			widget("post_list_with_bottom_border", $posts)
		?>
	</div>
	<div class="col-sm-6">
		<?php
			widget("post_list_with_bottom_border", $posts)
		?>
	</div>
</div>








<?php
	$images = data()->rows("model='post' AND id_entity <> 0 LIMIT 4");
	foreach( $images as $image ){
		$items['images'][] = data()->load( $image['id'] );		
	}
?>

<div class='row fifth'>
	<div class="col-sm-6">
		<?php
			$data['images'] = [];			
			$data['images'][] = $items['images'][0];
			$data['images'][] = $items['images'][1];
			widget("post_left_media", $data);
		?>
	</div>
	<div class="col-sm-6">
		<?php
			$data['images'] = [];			
			$data['images'][] = $items['images'][2];
			$data['images'][] = $items['images'][3];
			widget("post_left_media", $data);
		?>
	</div>
</div>










<?php
	$images = data()->rows("model='post' AND id_entity <> 0 LIMIT 4");	
?>


<div class='row sixth'>
	<?php foreach( $images as $image ) { 
		$im = data()->load( $image['id'] );
	?>
	<div class="col-sm-3">
		<?php
			$data['images'] = $im;
			$data['fake_image'] = "<img src='/theme/philzine/img/fake_square_image.png' style='width:100%;max-height:160px;opacity:0;z-index:-1;'/>";//temp			
			widget( "post_image_bottom_text", $data );
		?>
	</div>
	<?php } ?>
</div>