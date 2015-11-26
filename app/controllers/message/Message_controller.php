<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Message_controller extends MY_Controller
{
	public function collection($offset=0){
		$per_page = 10;

		$o = [
				'offset' => $offset,
				'limit' =>  $per_page,
				//'where' => $where,
		];
		
		$login_id = login();
		if( !empty( $login_id ) ){
			$o['where'] = "id_to = $login_id";
			$messages = message()->search($o);
			$total_rows = message()->searchCount($o);
		}
		else{
			$messages = null;
			$total_rows = 0;
		}
		
		
		$this->load->library('pagination');
		$config['base_url'] = 'http://sapcms3.org/message/collection';
		$config['first_link'] = "<<";
		$config['last_link'] = ">>";
		$config['total_rows'] = $total_rows;
		$config['per_page'] = $per_page;
		$this->pagination->initialize($config);
		$page_navigator = $this->pagination->create_links();		

		$data = [
				'page' => 'message.list',
				'messages' => $messages,
				'total_row' => $total_rows,
				'per_page' => $per_page,
				'offset' => $offset,
				//'keyword' => $k,
				//'filter_by' => $filter_by,
				'page_navigator' => $page_navigator,
		];

		$this->render( $data );
	}
	
	public function write($id=null){
		$data = [
				'page' => 'message.write',
		];
	
		$this->render( $data );
	}
	
	public function writeSubmit($id=null){	
		$title = in('title');
		$content = in('content');
		
		if( function_exists( 'login' ) ){
			$my_id = login('id');
			$username = in('username');
			//get id
		}
		else {
			$my_id = 1;
			$other_id = 0;
			
		}
		
		
		$data = [
				'page' => 'message.write',
		];
	
		$this->render( $data );
	}
}