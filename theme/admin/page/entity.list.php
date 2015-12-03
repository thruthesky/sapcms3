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
		  <h3 class="box-title">Data Table With Full Features ( ALL DATA LOADED )</h3>
		</div><!-- /.box-header -->
		<div class='box-body'>
		<table id="entityTable" class="table table-bordered table-striped">
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
		   <div class="box">
				<div class="box-header">
				  <h3 class="box-title">Data TABLE USING AJAX and SSP</h3>
				</div><!-- /.box-header -->
				<div class='box-body'>
				<table id="entityTableAjax" class="table table-bordered table-striped" entity_type="<?php echo $name?>">
				<thead>
				  <tr>
					<th>ID</th>
					<th>Created</th>
					<th>Updated</th>
					<th>Edit</th>
					<th>Delete</th>
				  </tr>
				</thead>
				</table>
			</div><!--/.box-body-->
		</div><!--/.box-->
</div><!--/section .content-->
<?php echo theme_css('alm/plugins/datatables/dataTables.bootstrap')?>
<?php echo theme_js('alm/plugins/datatables/jquery.dataTables.min')?>
<?php echo theme_js('alm/plugins/datatables/dataTables.bootstrap.min')?>
<script>
  $(function () {
	$("#entityTable").DataTable();
	
	var entity_type = $('#entityTableAjax').attr("entity_type");
	var table = $('#entityTableAjax').DataTable( {
		  "processing": true,
		  "serverSide": true,
		  "ajax": "http://sapcms3.org/admin/table/data?entity_type="+entity_type,
		  "aoColumnDefs": [
				{   "aTargets": [ 1,2 ],
					"mRender": function ( data, type, full ) {
						if( data != 0 ){
							var dtStart = new Date(parseInt(data+"000"));
							var dtStartWrapper = moment(dtStart);
							return dtStartWrapper.format('MM/DD/YYYY HH:mm');
						}
						else return 0;
					}
				},
				{
				"targets": -2,
				"data": null,
				"defaultContent": "<span class='edit'>Edit</span>",
				"orderable": false,
				},
				{
				"targets": -1,
				"data": null,
				"defaultContent": "<span class='delete'>delete</span>",
				"orderable": false,
				}
		  ],
			/*"columnDefs": [ {
				"targets": -2,
				"data": null,
				"defaultContent": "<span class='edit'>Edit</span>",
				"orderable": false,
				},{
				"targets": -1,
				"data": null,
				"defaultContent": "<span class='delete'>Delete</span>",
				"orderable": false,
				},
			],	*/	  
		} );

	$('#entityTableAjax tbody').on( 'click', '.edit', function () {
        var data = table.row( $(this).parents('tr') ).data();
        //alert( data[0] +"'s created is: "+ data[ 1 ] );
		window.location.href = "/entity/<?php echo $name ?>/edit/"+data[0];		
    } );
	
  });
</script>
 