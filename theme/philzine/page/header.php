<?php
	
?>

<div class='top clearfix'>
	<div class='top-inner'>
		<img class='header-button home' src="/theme/philzine/img/home.png"/>
		<div class='logo'>LOGO</div>
		<img class='header-button menu' src="/theme/philzine/img/menu.png"/>
	</div>
</div>
<div class='bottom'>
	<div class='bottom-inner'>
		<ul class='main-menu'>
			<li class='item'><a <?php if( $_SERVER['REQUEST_URI'] == '/' ) echo "class='selected'"; ?> href="/">Home</a></li><li class='item'>
			<a href='#'>Menu 1</a></li><li class='item'>
			<a href='#'>Menu 2</a></li><li class='item'>
			<a href='#'>Menu 3</a></li><li class='item'>
			<a href='#'>Menu 4</a></li>
		</ul>
	</div>
</div>
