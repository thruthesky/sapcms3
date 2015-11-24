<h1><?php echo $config->get('name')?></h1>



<div class="btn-group" role="group" aria-label="...">
    <a class="btn btn-default" href="<?php echo url_post_edit($config)?>">Write</a>
    <a class="btn btn-default" href="<?php echo url_post_list($config)?>">1st Page</a>
    <a class="btn btn-default" href="<?php echo url_post_setting($config)?>">Settings</a>
</div>
<ul class="list-group">

<?php foreach($this->data['list'] as $post) { ?>

    <li class="list-group-item"><a href="<?php echo url_post_view($post)?>"><?php echo $post->get('subject')?></a></li>

<?php } ?>
</ul>
