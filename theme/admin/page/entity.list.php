<?php 
 //di( date_default_timezone_get() );
 $temp_icons = [
				'config'=>'fa-gear',
				'data'=>'fa-file',
				'message'=>'fa-envelope',
				'post_config'=>'fa-gear',
				'post_data'=>'fa-file-text',
				'user'=>'fa-user'
				];
//di( date("Y-m-d H:i:s", 1449154800 ) );
//di( intval ( date("O") ) * 60 / 100 );

$extra_query = null;
if( !empty( $date_from ) ){
	if( $date_from == 'today' ){
		$date_from = date( "Y-m-d H:i:s", strtotime( "today" ) );
		$date_to = date( "Y-m-d H:i:s", strtotime( $date_from." +1 day" ) - 1 );
		
		$extra_query .= "&date_from=$date_from&date_to=$date_to";
	}
	else{
		if( !empty( $_GET["date_from"]) ){
			$date_from = $_GET["date_from"];
			$extra_query .= "&date_from=$date_from";
		}
		if( !empty( $_GET["date_to"] ) ){
			$date_to = $_GET["date_to"];
			$extra_query .= "&date_to=$date_to";
			
		}
	}
}
?>

<section class="content-header">
  <h1>
	Entity 
	<small><?php echo $name?></small>
  </h1>
  <ol class="breadcrumb">
	<li><a href="/admin"><i class="fa fa-home"></i> Home</a></li>
	<li><a href="/entity/list"/><i class="fa fa-list"></i> Entity List</a></li>
	<li class="active"><i class="fa <?php echo  $temp_icons[$name]; ?>"></i> <?php echo $name?></li>
  </ol>
</section>
<section class="content">
	<div class="box">
		<div class="box-header">
		  <h3 class="box-title">Data TABLE USING AJAX and SSP</h3>
		</div><!-- /.box-header -->
		<?php
			//filter date solution until I know how to use datatables date range filter...
		?>
			<form action="?">
				FROM <input id='min' class='date from' type="date" name="date_from" value='<?php echo $date_from ?>'> - 
				<input id='max' class='date to' type="date" name="date_to" value='<?php echo $date_to ?>'>
				<input type='submit' value="filter date">
			</form>
		
		<div class='box-body'>
			<?php include "/theme/admin/page/entity.table.$name.php" ?>
		</div><!--/.box-body-->
	</div><!--/.box-->
</div><!--/section .content-->
<?php echo theme_css('alm/plugins/datatables/dataTables.bootstrap')?>
<?php echo theme_js('alm/plugins/datatables/jquery.dataTables.min')?>
<?php echo theme_js('alm/plugins/datatables/dataTables.bootstrap.min')?>
<script>
  //var offset = new Date().getTimezoneOffset();
  //alert( offset );//takes in current device timezone  
  $(function () {	
	var php_stamp_from;
	var php_stamp_to;
	var offset = <?php echo -(intval ( date("O") ) * 60 / 100 ) ?>;
	
	var entity_type = $('#entityTableAjax').attr("entity_type");
	var table = $('#entityTableAjax').DataTable( {
		  "processing": true,//just for showing the processing... modal
		  "serverSide": true,
		  "deferRender": true,//see http://datatables.net/release-datatables/examples/ajax/defer_render.html
		  "ajax": {
			url:"http://sapcms3.org/admin/table/data?entity_type="+entity_type+"<?php echo $extra_query; ?>",
		  },
		  "aoColumnDefs": [
				{
				"targets": -2,
				"data": null,
				"defaultContent": "<a href='#' class='edit'>Edit</a>",
				"orderable": false,
				},
				{
				"targets": -1,
				"data": null,
				"defaultContent": "<a href='#' class='delete'>delete</a>",
				"orderable": false,
				}
		  ], 	  
		} );

	$('#entityTableAjax tbody').on( 'click', '.edit', function () {
        var data = table.row( $(this).parents('tr') ).data();        
		url = "/entity/<?php echo $name ?>/edit/"+data[0];		
		$(this).attr("href",url);
    } );
	
	$('#entityTableAjax tbody').on( 'click', '.delete', function () {
        re = confirm("Are you sure you want to delete this entity?");	
		if( re ){
			var data = table.row( $(this).parents('tr') ).data();			
			url = "/entity/<?php echo $name ?>/delete/submit?id="+data[0];
			$(this).attr("href",url);
		}
    } );
	
	
	/*
	$('.date').change( function() {	
		//var $this = $(this );
		//table.columns(0).search(1).draw();
		
		value_from = $("input[name='date_from']").val();
		value_to = $("input[name='date_to']").val();
		time_from = new Date( value_from );
		time_to = new Date( value_to );;
		php_stamp_from = ( time_from.getTime() + offset * 60000 ) / 1000
		php_stamp_to = ( time_to.getTime() + offset * 60000 ) / 1000
		
		table.draw();		
    } );
	
	$('#min').keyup( function() {	
		console.log("uppp");
		table.draw();		
    } );
	*/	
});//$(function()) end
</script>
 