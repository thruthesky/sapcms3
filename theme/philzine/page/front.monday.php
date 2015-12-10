<?php
	$images = data()->rows("model='post' AND id_entity <> 0 LIMIT 1");
	if( !empty( $images[0] ) ){
		$top_image = data()->load( $images[0]['id'] );
?>

<div class="carousel slide hover-type" data-ride="carousel">
  <div class="carousel-inner" role="listbox">	
	<?php 
		$url = $top_image->get("url");
		$post = post_data()->load( $top_image->get('id_entity') );
		$title = $post->get('content');		
	?>
    <div class="carousel-item active">
		v
			<img src="/theme/philzine/img/fake_front_carousel.png" style='width:100%;opacity:0;z-index:-1;'/>
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
else{
	echo "<h1>No image for top_image carousel</h1>";
}
?>







<?php
	$posts = post_data()->rows("id_user <> 0 LIMIT 5");	
?>
<ul class="list-group bullet-list">
	<?php foreach( $posts as $p ){ 
		$content = mb_strcut ( $p['content'], 0, 40 );//temp
	?>
		<li class="list-group-item">
			<span class='bullet'></span>
			<a href='#'><?php echo $content; ?></a>
		</li>
<?php 
	} 
?>
</ul>









<?php
	$images = data()->rows("model='post' AND id_entity <> 0 LIMIT 3");
	if( count( $images ) >= 3 ){
		foreach( $images as $image ){
			$data['images'][] = data()->load( $image['id'] );		
		}						
?>

<div class='row third'>
	<div class="col-sm-6">
		<div class="carousel slide hover-type" data-ride="carousel">
			<div class="carousel-inner" role="listbox">	
			<?php 
				$image = $data['images'][0];
			
				$url = $image->get("url");
				$title = post_data()->load( $image->get('id_entity') )->get('content');		
			?>
			<div class="carousel-item active">
				<a href="#">
					<img src="/theme/philzine/img/fake_square_image.png" style='width:100%;opacity:0;z-index:-1;'/>
					<img class='carousel-image' src="<?php echo $url; ?>" alt="<?php echo $title; ?>">
					<div class="carousel-caption">
						<h3><?php echo $title ?></h3>		
					</div>
				</a>
			</div>
			</div>
		</div>
		
		<div class="carousel slide hover-type" data-ride="carousel">
			<div class="carousel-inner" role="listbox">	
			<?php 
				$image = $data['images'][1];
			
				$url = $image->get("url");
				$title = post_data()->load( $image->get('id_entity') )->get('content');		
			?>
			<div class="carousel-item active">
				<a href="#">
					<img src="/theme/philzine/img/fake_square_image.png" style='width:100%;opacity:0;z-index:-1;'/>
					<img class='carousel-image' src="<?php echo $url; ?>" alt="<?php echo $title; ?>">
					<div class="carousel-caption">
						<h3><?php echo $title ?></h3>		
					</div>
				</a>
			</div>
			</div>
		</div>
    </div>
	<div class="col-sm-6">
		<div class="carousel slide bottom-text-type no-margin-bottom" data-ride="carousel">
			<div class="carousel-inner" role="listbox">	
			<?php 
				$image = $data['images'][2];
			
				$url = $image->get("url");
				$title = post_data()->load( $image->get('id_entity') )->get('content');			
			?>
			<div class="carousel-item active">
				<a href="#">
					<img src="/theme/philzine/img/fake_third_right.png" style='width:100%;opacity:0;z-index:-1;'/>
					<img class='carousel-image' src="<?php echo $url; ?>" alt="<?php echo $title; ?>">				
				</a>
			</div>				
			</div>
			<div class="carousel-caption">
				<h3><?php echo $title ?></h3>
			</div>
		</div>
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
		<ul class="list-group list-with-bottom-border-only">
		<?php foreach( $posts as $p ){ 
			$content = mb_strcut ( $p['content'], 0, 40 );//temp
		?>
				<li class="list-group-item"><?php echo $content; ?></li>
		<?php 
			} 
		?>
		</ul>
	</div>
	<div class="col-sm-6">
		<ul class="list-group list-with-bottom-border-only">
		<?php foreach( $posts as $p ){ 
			$content = mb_strcut ( $p['content'], 0, 40 );//temp
			?>
				<li class="list-group-item"></span><?php echo $content; ?></li>
		<?php 
			} 
		?>
		</ul>
	</div>
</div>