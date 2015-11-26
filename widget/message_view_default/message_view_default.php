<?php
$ci = & get_instance();
$data = $ci->data;
widget_css();
if( !empty( $data['message'] ) ){
	$message = $data['message'];

	$user_from_username = user()->load( $message->get('id_from') );
	if( empty( $user_from_username ) ) $user_from_username = "Anonymous";
	else $user_from_username = $user_from_username->get('username');
	$user_to_username = user()->load( $message->get('id_to') );
	if( empty( $user_to_username ) ) $user_to_username = "Anonymous";
	else $user_to_username = $user_to_username->get('username');

	$title = $message->get('title');
	$content = $message->get('content');
?>
	<div class='sender'>Sender: <?php echo $user_from_username; ?></div>
	<div class='receiver'>Receiver: <?php echo $user_to_username; ?></div>
	<div class='title'>Title: <?php echo $title; ?></div>
	<div class='content'>Content:<br><?php echo $content; ?></div>
<?php
}
?>

