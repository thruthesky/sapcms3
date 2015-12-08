<div class='daily-front-page monday'>
	<div class='grid3'>
		<div class='a'>
		<?php
			$data = [];
			
			$images = data()->rows("model='post' AND id_entity <> 0 LIMIT 1");	
			if( !empty( $images ) ){
				foreach( $images as $image ){
					$data['images'][] = data()->load( $image['id'] );		
				}
						
				widget( "philzine_hover_image_with_title", $data ); 
			}
			else{
		?>
			<h1>Empty Data</h1>
		<?php	
			}
		?>
		</div>
		<div class='b'>
			<?php widget( "philzine_hover_image_with_title", $data );  ?>
		</div>
		<div class='c'>
			<?php widget( "philzine_hover_image_with_title", $data );  ?>
		</div>
	</div>
</div>