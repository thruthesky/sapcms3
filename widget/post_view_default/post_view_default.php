<?php
$ci = & get_instance();
$config = $ci->data['config'];
$post = $ci->data['post'];
$user = $ci->data['user'];
$name = $config->get('name');
?>
<h2><?php echo $name?></h2>
<a href="<?php echo url_post_list()?>">LIST</a>
<a href="">Vote Good</a>
<a href="">Vote Bad</a>
<a href="">Report</a>
<a href="">Blind</a>
<a href="">Block</a>
<hr>

Writer: <?php echo $user->get('username')?>
<hr>
Subject: <?php echo $post->get('subject')?>
<hr>
Content: <?php echo $post->get('content')?>
<hr>


<?php widget('post_comment_form_default')?>


<?php widget('post_comment_list_default')?>