<?php
$post = $o;
?>
<div class="post" no="<?php echo $post->get('id')?>" no-parent="<?php echo $post->get('id_parent')?>" depth='<?php echo $o->get('depth')?>'>
    No.:<?php echo $post->get('id')?>
    <div class="post-menu top btn-group">
        <span class="btn btn-default edit">Edit</span>
        <span class="btn btn-default delete">Delete</span>

        <div class="btn-group" role="group">
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                More
                <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
                <li><span class="report">Report</span></li>
                <li><span class="blind">Blind</span></li>
                <li><span class="block">Block</span></li>
                <li><span class="trash">Trash</span></li>
                <li><span class="move">Move</span></li>
            </ul>
        </div>

    </div>
    <?php if ( ! $post->deleted() ) {?>
    <div class="author">Author:<?php echo $post->getUser()->get('username')?></div>
    <?php } ?>
    <div class="form-area">
        <div class="content"><?php
            if ( $post->deleted() ) echo ln('post deleted');
            else echo nl2br($post->get('content'));
            ?></div>
        <?php widget('post_display_data_default', $post)?>
        <div class="post-menu bottom">
            <span class="like">Like<span class="no"><?php echo $post->get('no_vote_good')?></span></span>
            <span class="dot">*</span>
            <span class="reply">Reply</span>
        </div>
    </div>
</div>
