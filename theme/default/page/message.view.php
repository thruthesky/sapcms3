<?php
if( !empty( $this->data['error'] ) ){
	$error = $this->data['error'];
	foreach( $error as $e ){
		echo "<h1>$e[code] - $e[message]</h1>";
	}
}
else{
	widget('message_view_default');
}
