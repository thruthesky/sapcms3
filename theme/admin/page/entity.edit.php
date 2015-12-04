<?php
	
?>
<section class='content'>
	<div class="box box-primary">
		<div class="box-header with-border">
		  <h3 class="box-title">Entity [ <?php echo $name ?> ] edit ID [ <?php echo $entity->get('id') ?> ]</h3>
		</div><!-- /.box-header -->
		<!-- form start -->
		<form class='form-horizontal' role="form" action="/entity/<?php echo $name; ?>/edit/submit">
			<div class='box-body'>
				<?php foreach( $fields as $field ) { 
					$name = $field->name;
					
					if( $name == 'id' ||$name == 'created' || $name == 'updated' || $name == 'password' ) continue;
					
					$value = $entity->get( $name );
				?>
				<div class="form-group">
				  <label class='col-sm-2' for="exampleInputPassword1"><?php echo $name ?></label>
				  <div class='col-sm-10'>
					<input class='form-control' type="text" name='username' class="form-control" id="exampleInputPassword1" placeholder="Input <?php echo $name ?>" value=<?php echo $value ?>>
				  </div>
				</div>
				<?php } ?>
			</div>
			<div class="box-footer">
				<button type="submit" class="btn btn-primary">Submit</button>
			</div>
		</form>
	</div>
</section>