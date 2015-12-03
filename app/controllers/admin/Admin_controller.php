<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_controller extends MY_Controller {

    function adminPage(){
		$this->render([
            'page'=>'front',
            'theme' => 'admin',
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
