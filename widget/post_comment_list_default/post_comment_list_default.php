<?php
widget_css();
widget_js();
$ci = & get_instance();
$comments = $ci->data['comments'];
?>
<div class="post-comment-list">
<?php
foreach ( $comments as $comment ) {
    $user = user($comment->get('id_user'));
    $id = $comment->get('id');
    $username = $user->get('username');
    $content = post_data()->escapeContent($comment->get('content'));
    $depth = $comment->get('depth');
    echo "
        <div class='row' no='$id' depth='$depth'>
        <span class='id'>$id</span>
        <span class='username'>$username</span>
        <div class='content'>$content</div>
        <span class='reply'>Reply...</span>
        </div>
    ";
}
?>
</div>
