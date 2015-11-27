<?php
$ci = & get_instance();
$data = $ci->data;
widget_css();
widget_js();
?>


<h1>Inbox Messages</h1>

<?php widget('message_list_menu_default')?>


<div class='search-label'>
    Showing <?php echo ( $data['offset'] + 1 ); ?> - <?php echo ( $data['offset'] + 10 ); ?> of <?php echo $data['total_rows']?>
</div>



<span>FROM</span>
<span>TITLE</span>
<span>DELETE</span>

<div class="message-list">
<?php
$messages = $data['messages'];
foreach( $messages as $message ){
    $user = user()->load( $message->get('id_from') );
    $username = $user->get('username');
    $stamp = $message->get('checked');
    if ( $stamp ) $checked = date( 'M d, Y H:i', $stamp );
    else $checked = "Not Viewed";
    ?>
    <div class="row" no="<?php echo $message->get('id')?>">
        <span><?php echo $username; ?></span>
        <span class="title"><?php echo $message->get('title'); ?></span>
        <a class='delete message'>Delete</a>
    </div>

    <?php
}
?>
</div>






<?php widget('navigator_default', [
    'base_url' => "/message/$data[type]",
    'per_page'=> $data['per_page'],
    'total_rows' => $data['total_rows'],
] )?>



