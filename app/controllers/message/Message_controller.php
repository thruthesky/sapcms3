<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Message_controller extends MY_Controller
{
	public function inbox($offset=0){
		$type = 'inbox';
		$where = '';
		$login_id = login();
		if( !empty( $login_id ) ) $where = "id_to = $login_id";
		self::message_list($type,$where,$offset);
	}
	
	public function unread($offset=0){
		$type = 'unread';
		$where = '';
		$login_id = login();
		if( !empty( $login_id ) ) $where = "id_to = $login_id AND checked = 0";
		self::message_list($type,$where,$offset);
	}
	
	public function sent($offset=0){
		$type = 'sent';
		$where = '';
		$login_id = login();
		if( !empty( $login_id ) ) $where = "id_from = $login_id";
		self::message_list($type,$where,$offset);
	}
	
	public function message_list($type='inbox',$where='',$offset=0){
		$per_page = 10;
		$error = [];
		$messages = [];

		$o = [
				'offset' => $offset,
				'limit' =>  $per_page,
				//'where' => $where,
		];
		if( empty( $where ) ) $where = 'id_to = $login_id';
		$login_id = login();
		if( !empty( $login_id ) ){
			$o['where'] = $where;
			$messages = message()->search($o);
			$total_rows = message()->searchCount($o);
		}
		else{
			$error[] = ['code'=>'-1','message'=>'You are not logged in'];
			$total_rows = 0;
		}


		$data = [
				'type' => $type,
				'page' => 'message.list',
				'messages' => $messages,
				'total_rows' => $total_rows,
				'per_page' => $per_page,
				'offset' => $offset,
				'error' => $error,
				//'keyword' => $k,
				//'filter_by' => $filter_by,
				//'page_navigator' => $page_navigator,
		];

		$this->render( $data );
	}
	
	public function send($id=null){
		$reply = in('reply');
	
		$data = [				
				'page' => 'message.send',
				'type' => 'send',
				'reply' => $reply,
		];
	
		$this->render( $data );
	}
	
	public function sendSubmit($id=null){	
		$error = [];
		$title = in('title');
		$content = in('content');
		
		
		$my_id = login('id');
		if( empty( $my_id ) ) $error[] = ['code'=>'-1','message'=>'You are not logged in'];
		$username = in('username');
		$user_to = user()->loadByUsername($username);
		if( empty( $user_to ) ) $error[] = ['code'=>'-11','message'=>"User $username does no exist"];
		
		if( empty( $error ) ){
			$message = message()->create()
						->set('id_to', $user_to->get('id') )
						->set('id_from', $my_id )
						->set('title', $title)
						->set('content', $content)
						->save();
			if ( $data_id = in('data_id') ) {
				$ids = explode(',', $data_id);
				if ( $ids ) {
					foreach ( $ids as $id ) {
						data($id)->updates([
							'id_entity' => $message->get('id'),
							'finish' => 1
						]);
					}
				}
			}
			
			self::sent();			
		}
		else{
			$data = [
				'page' => 'message.send',
				'error' => $error,
			];
			
			$this->render( $data );
		}
	}
	/*
	public function viewItem($id=null){
		$error = [];
		$message = message()->load( $id );
		if( !empty( $message ) ){
			$checked = $message->get('checked');
			if( empty( $checked ) ) $message->set( 'checked', time() )->save();
		}
		else{
			$error[] = ['code'=>'-101','message'=>'Message id [ $id ] does not exist.'];
		}
		
		$data = [
				'page' => 'message.view',
				'error' => $error,
				'message' => $message,
		];
	
		$this->render( $data );
	}
	
	public function deleteItem($type=null,$offset=0,$id=null){
		if( empty( $type ) ) $type = 'inbox';
		$my_id = login();
		$message = message()->load( $id );
		if( !empty( $message ) ){
			if( $message->get('id_to') == $my_id ){
				$message->delete();
			}
			else{
				$error[] = ['code'=>'-111','message'=>'Message id [ $id ] is not yours.You cannot delete it.'];
			}
		}
		else{
			$error[] = ['code'=>'-101','message'=>'Message id [ $id ] does not exist.'];
		}
		
		self::$type( $offset );
	}
	*/
	public function ajaxLoad(){
		$data = [];
		$error = [];
		$id = in('id');
		$type = in('type');
		
		if( empty( $id ) ) $error[] = ['code'=>'-151','message'=>'ID is empty!'];
		$message = message()->load( $id );
		if( empty( $message ) ) $error[] = ['code'=>'-101','message'=>'Message id [ $id ] does not exist.'];
		
		if( !empty( $error ) ) $data['error'] = $error;
		else{
			if( $type != 'sent' ){
				$stamp = $message->get('checked');
				if( ! $stamp ){
					$stamp = time();
					$checked = date( 'M d, Y H:i', $stamp );
					$message->set('checked',$stamp)->save();
					$data['checked'] = $checked;
				}
			}
			$content = self::messageHTMLContent( $message );
			$data['content'] = $content;
			
		}
		echo json_encode($data);
	}
	
	public function ajaxDelete(){
		$data = [];
		$error = [];
		$id = in('id');
		$last_id = in('last_id');
		$type = in('type');
		
		if( empty( $id ) ) $error[] = ['code'=>'-151','message'=>'ID is empty!'];
		$message = message()->load( $id );
		if( empty( $message ) ) $error[] = ['code'=>'-101','message'=>'Message id [ $id ] does not exist.'];
		
		if( !empty( $error ) ) $data['error'] = $error;
		else{
			$added_query = "";
			if( $type == 'inbox' ) $added_query = " AND id_to = ".login();
			else if( $type == 'unread' ) $added_query = " AND id_to = ".login()." AND checked = 0";
			else if( $type == 'sent' ) $added_query = " AND id_from = ".login();
			
			$next_message = message()->row("id>$last_id".$added_query);//returns array
			
			$message->delete();
			
			$data['next_message'] = self::messageHTMLNextMessage( $next_message, $type );
			$data['id'] = $id;
			$data['type'] = $type;
		}
		echo json_encode($data);
	}	
	
	public function messageHTMLContent( $message ){
		$content = $message->get('content');
		$fileHTML = "";
		$files = $message->getFiles();
		if( !empty( $files ) ) $fileHTML = self::filesHTMLContent($files);
		return "<div class='message-content'>$content$fileHTML</div>";
	}
	
	public function filesHTMLContent( $files ){
		$fileHTML = "";
		$imageHTML = "";
		foreach( $files as $file ){
			$id = $file->get('id');
			$mime = $file->get('mime');
			$url = $file->get('url');
			
			if( strpos( $mime, "image"  ) !== false ){
				$imageHTML .=  "<div no='$id' class='photo'><img src='$url'/></div>";
			}
			else{
				$name = $file->get('name');
				$fileHTML .= "<div no='$id' class='file'><a href='$url' download>$name</a></div>";
			}	
		}
		
		return "<div class='file-display'>".$fileHTML.$imageHTML."</div>";
	}
	
	public function messageHTMLNextMessage( $message, $type ){
		$id = $message['id'];
		if( $type == 'sent' ) {
			$user_id = $message['id_to'];
			$reply_text = "Send Message";
		}
		else {
			$user_id = $message['id_from'];
			$reply_text = "Reply";
		}
		$user = user()->load( $user_id );
		$username = $user->get('username');
		$title = $message['title'];
		
		$stamp = $message['checked'];
		if ( $stamp ){
			$checked = date( 'M d, Y H:i', $stamp );
			$class = ' viewed';			
		}
		else{
			$checked = "Not Viewed";
			$class = '';
		}
		
		return	"
				<li class='list-group-item$class' no='$id'>
					<div class='message-info'>
						<span class='username'>$username</span>
						<span class='title'>$title</span>
						<span class='checked'>$checked</span>
						
						<span class='delete message btn btn-danger'>Delete</span>
						<a class='reply message btn btn-success' href='/message/send?reply=$username'>$reply_text</a>
					</div>        
				</li>
				";
		
	}
}