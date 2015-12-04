<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_controller extends MY_Controller {

    function adminPage(){
		$data = [];
	
		$stamp_today = strtotime("today");
		$today_query = "created > $stamp_today";
		
		$data['user_count'] = user()->count("$today_query");
		$data['message_count'] = message()->count("$today_query");
		$data['data_count'] = data()->count("$today_query");
		$data['post_data_count'] = post_data()->count("$today_query");
	
		$this->render([
            'page'=>'front',
            'theme' => 'admin',
			'data' => $data,
		]);
	}
	
	function tableData(){
		// DB table to use
		$entity_type = in("entity_type");
		$table = $entity_type()->getTable();

		// Table's primary key
		$primaryKey = 'id';

		// Array of database columns which should be read and sent back to DataTables.
		// The `db` parameter represents the column name in the database, while the `dt`
		// parameter represents the DataTables column identifier. In this case simple
		// indexes
		$columns = array(
			array( 'db' => 'id',         'dt' => 0 ),
			array( 'db' => 'created',  'dt' => 1 ),
			array( 'db' => 'updated',    'dt' => 2 ),
		);

		// SQL server connection information
		$sql_details = array(
			'user' => 'root',
			'pass' => '7777',
			'db'   => 'ci3',
			'host' => 'localhost'
		);
	
		require( 'theme/admin/scripts/ssp.class.php' );
		
		echo json_encode(
			SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns )
		);
	}
}
