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
  <div class="carousel-inner" role="listbox">
	<?php foreach( $data['images'] as $im ){ 
		$url = $im->get("url");
		$title = post_data()->load( $im->get('id_entity') )->get('content');
		if( empty( $active ) ) $is_active = " active";
		else $is_active = null;
	?>
    <div class="carousel-item active">
      <img style='width:100%;' src="<?php echo $url; ?>" alt="<?php echo $title; ?>">
	  <div class="carousel-caption">
		<h3><?php echo $title ?></h3>		
	  </div>
    </div>
	<?php	
		}		
	?>
  </div>
</div>

<ul class="list-group">
  <li class="list-group-item">Cras justo odio</li>
  <li class="list-group-item">Dapibus ac facilisis in</li>
  <li class="list-group-item">Morbi leo risus</li>
  <li class="list-group-item">Porta ac consectetur ac</li>
  <li class="list-group-item">Vestibulum at eros</li>
</ul>