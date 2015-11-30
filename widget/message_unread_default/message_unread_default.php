<?php
$ci = & get_instance();
$data = $ci->data;
widget_css();
widget_js();
?>


<h1>Unread Messages</h1>

<?php widget('message_list_menu_default')?>


<div class='search-label'>
    Showing <?php echo ( $data['offset'] + 1 ); ?> - <?php echo ( $data['offset'] + 10 ); ?> of <?php echo $data['total_rows']?>
</div>


<ul class="list-group message-list" type='unread'>
<?php
$messages = $data['messages'];
foreach( $messages as $message ){
    $user = user()->load( $message->get('id_from') );
    $username = $user->get('username');
    $stamp = $message->get('checked');
    if ( $stamp ){
		$checked = date( 'M d, Y H:i', $stamp );
		$class = ' viewed';
	}
    else{
		$checked = "Not Viewed";
		$class = '';
	}
    ?>
    <li class="list-group-item<?php echo $class; ?>" no="<?php echo $message->get('id')?>">
		<div class='message-info'>
			<span class='username'><?php echo $username; ?></span>
			<span class="title"><?php echo $message->get('title'); ?></span>
			<span class="checked"><?php echo $checked; ?></span>		
			
			<span class='delete message btn btn-danger'>Delete</span>
			<a class='reply message btn btn-success' href='/message/send?reply=<?php echo $username; ?>'>Reply</a>
		</div>        
    </li>

    <?php
}
?>
</ul>







<?php widget('navigator_default', [
    'base_url' => "/message/$data[type]",
    'per_page'=> $data['per_page'],
    'total_rows' => $data['total_rows'],
] )?>



