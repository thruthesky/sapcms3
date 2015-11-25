<?php
$forumName = post_config()->getCurrent()->get('name');
?>
<h1><?php echo $forumName?></h1>

<?php widget('post_menu_default')?>

<ul class="list-group">

<?php foreach($o['list'] as $post) { ?>

    <li class="list-group-item"><a href="<?php echo url_post_view($post)?>"><?php echo $post->get('subject')?></a></li>

<?php } ?>
</ul>


<?php widget('navigator_default', [
    'base_url' => "/$forumName/list",
    'per_page'=> $o['config']->get('per_page'),
    'total_rows' => $o['total_rows'],
] )?>

