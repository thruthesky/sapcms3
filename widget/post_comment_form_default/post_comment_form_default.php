<?php
widget_css();
$current = post_data()->getCurrent();
?>

<form class="post-comment-form" action="/post/comment/submit" method="post">
    <input type="hidden" name="id_parent" value="<?php echo $current->get('id')?>">
    <textarea name="content" placeholder="Input comment..."></textarea>
    <input type="submit">
</form>
