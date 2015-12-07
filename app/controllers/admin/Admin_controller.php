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
		$test = in('test');

		// Table's primary key
		$primaryKey = 'id';

		// Array of database columns which should be read and sent back to DataTables.
		// The `db` parameter represents the column name in the database, while the `dt`
		// parameter represents the DataTables column identifier. In this case simple
		// indexes
		$columns = array(
			array( 	'db' => 'id',
					'dt' => 0 
				 ),
			array( 	'db' => 'created',  
					'dt' => 1, 
					'formatter' => function( $d, $row ) {
						if( $d == 0 ) return 0;
						return date( 'M d, Y H:i', $d);										
					}
			),
			array( 	'db' => 'updated',
					'dt' => 2,
					'formatter' => function( $d, $row ) {
						if( $d == 0 ) return 0;
						return date( 'M d, Y H:i', $d);												
					}
				 ),
		);
		
		$additional_columns = self::getAdditionalFields( $entity_type );
		
		$columns = array_merge( $columns, $additional_columns );

		// SQL server connection information
		$sql_details = array(
			'user' => 'root',
			'pass' => '7777',
			'db'   => 'ci3',
			'host' => 'localhost'
		);
	
		require( 'theme/admin/scripts/ssp.class.php' );		
		$date_from = in("date_from");
		$date_to = in("date_to");
		$extra_query = null;
		if( !empty( $date_from ) ){
			$stamp_from = strtotime( $date_from );
			$extra_query .= "created > $stamp_from";
		}
		if( !empty( $date_to ) ){
			$stamp_to = strtotime( $date_to." +1 day" ) - 1;
			if( !empty( $extra_query ) ) $extra_query .= " AND ";
			$extra_query .= "created < $stamp_to";
			
		}		
		
		echo json_encode(
			SSP::complex( $_GET, $sql_details, $table, $primaryKey, $columns, $extra_query )
		);
	}
	
	function getAdditionalFields( $entity_type ){
		$additional_columns = null;
		if( $entity_type == 'user' ){
			$additional_columns = array(
				array( 	'db' => 'username',
						'dt' => 3 
					 ),
				array( 	'db' => 'email',
						'dt' => 4 
					 ),
			);
		}
		else if( $entity_type == 'post_config' ){
			$additional_columns = array(
				array( 	'db' => 'id_user',
						'dt' => 3 
					 ),
				array( 	'db' => 'name',
						'dt' => 4 
					 ),
				array( 	'db' => 'subject',
						'dt' => 5 
					 ),
				array( 	'db' => 'description',
						'dt' => 6 
					 ),
			);
		}
		else if( $entity_type == 'post_data' ){
			$additional_columns = array(
				array( 	'db' => 'id_config',
						'dt' => 3 
					 ),
				array( 	'db' => 'id_user',
						'dt' => 4 
					 ),
				array( 	'db' => 'subject',
						'dt' => 5 
					 ),
				array( 	'db' => 'content',
						'dt' => 6 
					 ),
			);
		}
		else if( $entity_type == 'data' ){
			$additional_columns = array(
				array( 	'db' => 'model',
						'dt' => 3 
					 ),
				array( 	'db' => 'category',
						'dt' => 4 
					 ),
				array( 	'db' => 'form_name',
						'dt' => 5 
					 ),
				array( 	'db' => 'id_entity',
						'dt' => 6 
					 ),
				array( 	'db' => 'id_user',
						'dt' => 7 
					 ),
			);
		}
		else if( $entity_type == 'config' ){
			$additional_columns = array(
				array( 	'db' => 'code',
						'dt' => 3 
					 ),
				array( 	'db' => 'value',
						'dt' => 4 
					 ),
			);
		}
		else if( $entity_type == 'message' ){
			$additional_columns = array(
				array( 	'db' => 'id_from',
						'dt' => 3 
					 ),
				array( 	'db' => 'id_to',
						'dt' => 4 
					 ),
				array( 	'db' => 'title',
						'dt' => 5
					 ),				
			);
		}
		
		
		return $additional_columns;
	}
}
