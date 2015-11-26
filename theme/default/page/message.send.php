<?php
if( !empty( $this->data['error'] ) ){
	$error = $this->data['error'];
	foreach( $error as $e ){
		echo "<h1>$e[code] - $e[message]</h1>";
	}
}
else{
	if( !empty( $this->data['type'] ) ) $type = $this->data['type'];
	else $type = 'inbox';
	widget('message_send_default');
}