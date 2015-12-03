<section class="content-header">
  <h1>
	Entity 
	<small><?php echo $name?></small>
  </h1>
  <ol class="breadcrumb">
	<li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
	<li><a href="/entity/list"/>Entity List</a></li>
	<li class="active"><?php echo $name?></li>
  </ol>
</section>
 <section class="content">
   <div class="box">
		<div class="box-header">
		  <h3 class="box-title">Data Table With Full Features</h3>
		</div><!-- /.box-header -->
		<div class='box-body'>
		<table id="example1" class="table table-bordered table-striped">
		<thead>
		  <tr>
			<th>ID</th>
			<th>Created</th>
			<th>Updated</th>
			<th>Edit</th>
			<th>Delete</th>
		  </tr>
		</thead>
<?php
foreach( $list as $entity ) {
    $id = $entity->get('id');
    $created = $entity->get('created');
    $updated = $entity->get('updated');
    echo "
    <tr>
        <td>$id</td>
        <td>$created</td>
        <td>$updated</td>
        <td><a href='/entity/$name/edit/$id'>Edit</a></td>
        <td>Delete</td>
    </tr>
    ";
}

?>
		</table>
<?php
/*
widget('navigator_default', [
    'base_url' => "/entity/$name/list",
    'per_page'=> $per_page,
    'total_rows' => $total_rows,
]);
*/
?>
	</div><!--/.box-body-->
	</div><!--/.box-->
</div><!--/section .content-->
<?php echo theme_css('alm/plugins/datatables/dataTables.bootstrap')?>
<?php echo theme_js('alm/plugins/datatables/jquery.dataTables.min')?>
<?php echo theme_js('alm/plugins/datatables/dataTables.bootstrap.min')?>
<script>
  $(function () {
	$("#example1").DataTable();	
	/*
	$('#example2').DataTable({
	  "paging": true,
	  "lengthChange": false,
	  "searching": false,
	  "ordering": true,
	  "info": true,
	  "autoWidth": false
	});
	*/
  });
</script>
