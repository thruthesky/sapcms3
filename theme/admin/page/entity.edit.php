<?php
	
?>
<section class='content'>
	<div class="box box-primary">
		<div class="box-header with-border">
		  <h3 class="box-title">Entity [ <?php echo $name ?> ] edit ID [ <?php echo $entity->get('id') ?> ]</h3>
		</div><!-- /.box-header -->
		<!-- form start -->
		<form class='form-horizontal' role="form" action="/entity/<?php echo $name; ?>/edit/submit">
			<input type='hidden' name='id' value='<?php echo $entity->get('id'); ?>'>
			<div class='box-body'>
				<?php foreach( $fields as $field ) { 
					$field_name = $field->name;
					
					if( $field_name == 'id' || $field_name == 'created' || $field_name == 'updated' || $field_name == 'password' ) continue;
					
					$value = $entity->get( $field_name );
					
					if( $field_name == 'password' ) $type = 'password';
					else if( $field_name == 'email' ) $type = 'email';
					else $type = "text";
				?>
				<div class="form-group">
				  <label class='col-sm-2'><?php echo $field_name ?></label>
				  <div class='col-sm-10'>
					<?php if( $field_name == 'content' ) {?>
					<textarea style='height:200px;resize:none;' name='content' class="form-control">
						<?php echo $value; ?>
					</textarea>
					<?php } else { ?>
					<input class='form-control' type="<?php echo $type; ?>" name='<?php echo $field_name; ?>' class="form-control" placeholder="Input <?php echo $field_name ?>" value=<?php echo $value ?>>
					<?php } ?>
				  </div>
				</div>
				<?php } ?>
			</div>
			<div class="box-footer">
				<a href="/entity/<?php echo $name; ?>/list" class="btn btn-default">Cancel</a>
				<button type="submit" class="btn btn-primary pull-right">Submit</button>
			</div>
		</form>
	</div>
</section>