<section class="content-header">
  <h1>
	Entity
	<small>All</small>
  </h1>
  <ol class="breadcrumb">
	<li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
	<li class="active">Entity List</li>
  </ol>
</section>
 <section class="content">
<div class="box box-default color-palette-box">
	<div class="box-header with-border">
	  <h3 class="box-title"><i class="fa fa-tag"></i> Choose the entity that you want to edit.</h3>
	</div>
	<div class="box-body">
<?php

$temp_count = 0;
$temp_icons = ['fa-gear','fa-file','fa-envelope','fa-gear','fa-file-text','fa-user'];
$temp_color = ['red','yellow','green','red','blue','blue'];
foreach ( $entities as $name ) {
    /*echo "Meta Entity : <a href='/entity/$name/list'>$name</a>";
	echo "<hr>";
*/
    $numrows = $name()->countAll();
	
    
	?>
	
	<div class="col-md-3 col-sm-6 col-xs-12">
	  <a href="/entity/<?php echo $name ?>/list" class="info-box bg-<?php echo $temp_color[$temp_count]; ?>">
		<span class="info-box-icon"><i class="fa <?php echo $temp_icons[$temp_count] ?>"></i></span>
		<div class="info-box-content">
		  <span class="info-box-text"><?php echo $name; ?></span>
		  <span class="info-box-number"><?php echo $numrows ?></span>
		</div><!-- /.info-box-content -->
	  </a><!-- /.info-box -->
	</div><!-- /.col -->
<?php
	$temp_count ++;
}
?>
	</div><!--/box-body-->
</div><!--/box-->
</section>