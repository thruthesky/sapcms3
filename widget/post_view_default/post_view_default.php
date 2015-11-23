<?php
$config = $this->data['config'];
$post = $this->data['post'];
$user = $this->data['user'];
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

Subject: <?php echo $post->get('subject')?>
<hr>
Content: <?php echo $post->get('content')?>
<hr>
