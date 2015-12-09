<?php
	$images = data()->rows("model='post' AND id_entity <> 0 LIMIT 1");
	if( !empty( $images ) ){
		foreach( $images as $image ){
			$data['images'][] = data()->load( $image['id'] );		
		}						
	}
	
	$active = null;
?>

<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
<?php if( count( $images ) > 1 ) { ?>
  <ol class="carousel-indicators">
	<?php for( $i = 0; $i < count($images); $i ++ ) { 
		if( $i == 0 ) $carousel_active = "class='active'";
		else $carousel_active = null;
	?>
    <li data-target="#carousel-example-generic" data-slide-to="0" <?php echo $carousel_active; ?>></li>
    <?php } ?>
  </ol>
<?php } ?>
  <div class="carousel-inner" role="listbox">
	<?php foreach( $data['images'] as $im ){ 
		$url = $im->get("url");
		$title = post_data()->load( $im->get('id_entity') )->get('content');
		if( empty( $active ) ) $is_active = " active";
		else $is_active = null;
	?>
    <div class="carousel-item<?php echo $is_active; ?>">
      <img style='width:100%;height:500px;' src="<?php echo $url; ?>" alt="<?php echo $title; ?>">
	  <div class="carousel-caption">
		<h3><?php echo $title ?></h3>		
	  </div>
    </div>
	<?php
		$active = true;
		}		
	?>
  </div>
<?php if( count( $images ) > 1 ) { ?>
  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
    <span class="icon-prev" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
    <span class="icon-next" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
<?php } ?>
</div>