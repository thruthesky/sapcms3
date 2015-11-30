<?php
$ci = & get_instance();
$data = $ci->data;
if( !empty( $data['type'] ) ) $type = $data['type'];
else $type = null;
?>

<div class="btn-group">
    <a class="btn btn-default<?php if( $type=='inbox' ) echo " active";?>" href="/message/inbox">Inbox</a>
    <a class="btn btn-default<?php if( $type=='unread' ) echo " active";?>" href="/message/unread">Unread</a>
    <a class="btn btn-default<?php if( $type=='sent' ) echo " active";?>" href="/message/sent">Sent Box</a>
    <a class="btn btn-default<?php if( $type=='send' ) echo " active";?>" href="/message/send">Send</a>
</div>