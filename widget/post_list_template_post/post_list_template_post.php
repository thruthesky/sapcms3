<?php
$post = $o;
?>
<div class="post" no="<?php echo $post->get('id')?>" no-parent="<?php echo $post->get('id_parent')?>" depth='<?php echo $o->get('depth')?>'>
    No.:<?php echo $post->get('id')?>
    <div class="post-menu top btn-group">
        <span class="btn btn-default edit">EDIT</span>
        <span class="btn btn-default delete">DELETE</span>
        <span class="btn btn-default delete">LIKE</span>

        <div class="btn-group" role="group">
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                More
                <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
                <li><a href="#">Report</a></li>
                <li><a href="#">Blind</a></li>
                <li><a href="#">Block</a></li>
            </ul>
        </div>

    </div>
    <div class="author">Author:<?php echo $post->getUser()->get('username')?></div>
    <div class="form-area">
        <div class="subject"><?php echo $post->get('subject')?></div>
        <div class="content"><?php echo nl2br($post->get('content'))?></div>
        <?php widget('post_display_data_default', $post)?>
        <div class="post-menu bottom">
            <span class="reply">Reply</span>
        </div>
    </div>
</div>
