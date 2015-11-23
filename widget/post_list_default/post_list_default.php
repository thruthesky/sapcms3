<h1><?php echo $config->get('name')?></h1>

<a href="<?php echo url_post_edit($config)?>">Write</a>



<?php foreach($this->data['list'] as $post) { ?>

    <div><a href="<?php echo url_post_view($post)?>"><?php echo $post->get('subject')?></a></div>

<?php } ?>
