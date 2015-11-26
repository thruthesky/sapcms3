<?php
$ci = & get_instance();
$data = $ci->data;
widget_css();
?>


<h1>Inbox Messages</h1>

<?php widget('message_list_menu_default')?>


<div class='search-label'>
    Showing <?php echo ( $data['offset'] + 1 ); ?> - <?php echo ( $data['offset'] + 10 ); ?> of <?php echo $data['total_rows']?>
</div>


<table class='list-table' cellpadding=0 cellspacing=0 width='100%'>
    <tr class='header'>
        <td><span>ID FROM</span></td>
        <td><span>ID TO</span></td>
        <td><span>TITLE</span></td>
        <td><span>CONTENT</span></td>
        <td><span>CHECKED</span></td>
        <td><span>VIEW</span></td>
        <td><span>DELETE</span></td>
    </tr>
    <?php
    $messages = $data['messages'];
    foreach( $messages as $message ){
        $user_from_username = user()->load( $message->get('id_from') );
        if( empty( $user_from_username ) ) $user_from_username = "Anonymous";
        else $user_from_username = $user_from_username->get('username');
        $user_to_username = user()->load( $message->get('id_to') );
        if( empty( $user_to_username ) ) $user_to_username = "Anonymous";
        else $user_to_username = $user_to_username->get('username');

        $checked = date( 'M d, Y H:i',$message->get('checked') );
		if( $checked == 0 ) $checked = "Not Viewed";
        ?>
        <tr valign='top'>
            <td><span><?php echo $user_from_username; ?></span></td>
            <td><span><?php echo $user_to_username; ?></span></td>
            <td><span><?php echo $message->get('title'); ?></span></td>
            <td><span><?php echo $message->get('content'); ?></span></td>
            <td><span><?php echo $checked; ?></span></td>
            <td><a href='/message/viewItem/<?php echo $message->get('id') ?>'>View</a></td>
            <td><a href='/message/deleteItem/inbox/<?php echo $data['offset']; ?>/<?php echo $message->get('id') ?>'>Delete</a></td>
        </tr>
        <?php
    }
    ?>
</table>


<?php widget('navigator_default', [
    'base_url' => "/message/$data[type]",
    'per_page'=> $data['per_page'],
    'total_rows' => $data['total_rows'],
] )?>



