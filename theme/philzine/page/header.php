<?php
$ci = & get_instance();

$post_configs = post_config()->loadAll();

//$post_configs = ['front', 'news', 'info', 'travel', 'photo', 'forum', 'buyandsell'];
$data = $ci->data;

if( !empty( $data['config'] ) ) {
	$current_config = $data['config']->get('name');
}
else $current_config = null;
?>
<div class='container-fluid top'>
	<ul class="container nav nav-inline text-xs-center">
	  <li class="nav-item pull-xs-left">
		<a class='nav-link' href='/'><img class='header-button home' src="/theme/philzine/img/home.png"/></a>
	  </li>
	  <li class="nav-item logo">
		<a class="nav-link" href="#">Logo</a>
	  </li>
	  <li class="nav-item pull-xs-right">
		<span class="nav-link slide-menu-button"><img class='header-button menu' src="/theme/philzine/img/menu.png"/></span>
	  </li>
	</ul>
</div>
<?php if( $data['model'] != 'user' ){ ?>
<div class='container-fluid bottom'>
	<nav class="container nav nav-inline">
	  <a class="nav-link<?php if( $_SERVER['REQUEST_URI'] == '/' ) echo " active"; ?>" href="/">Home</a>
	  <?php foreach( $post_configs as $pc ) { ?>
		<a class="nav-link<?php if( $current_config == $pc->get('name') ) echo " active"; ?>" href="/<?php echo $pc->get('name'); ?>/list"><?php echo $pc->get('name'); ?></a>
	  <?php } ?>
	</nav>
</div>
<?php } ?>
