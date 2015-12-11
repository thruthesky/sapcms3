<?php
	$current_user_id = login();	
?>

<div class="slide-menu-inner">
    <div class="list-group side-menu">
	  <a href="#" class="list-group-item">Menu 1<img class='arrow' src='/theme/philzine/img/side-menu/arrow-right-grey.png'/></a>
	  <a href="#" class="list-group-item">Menu 2<img class='arrow' src='/theme/philzine/img/side-menu/arrow-right-grey.png'/></a>
	  <a href="#" class="list-group-item">Menu 3<img class='arrow' src='/theme/philzine/img/side-menu/arrow-right-grey.png'/></a>
	  <a href="#" class="list-group-item">Menu 4<img class='arrow' src='/theme/philzine/img/side-menu/arrow-right-grey.png'/></a>
	  <a href="#" class="list-group-item">Menu 5<img class='arrow' src='/theme/philzine/img/side-menu/arrow-right-grey.png'/></a>  
	</div>
	<div class='user-info'>
		<div class='diagonal-bg'></div>
		<?php 
			$user_id = login();
			
			if( $user_id == 0 ){
				$user_id = "Anonymous";
				$user_name = "Anonymous";
			}
			else{
				$user_id = login('username');
				$user_name = login('first_name')." ".login('last_name');
			}
			
			$url = "/theme/philzine/img/no_primary_photo.png";
		?>
		<img class='side-profile-image' src='<?php echo $url; ?>'/>
		<div class='name'>
			<b><?php echo $user_id; ?></b><br>
			<?php echo $user_name; ?>
		</div>
	</div>
    <div class="list-group user-menu">
	  <?php if( $current_user_id != 0 ) { ?>
	  <a href="/user/edit" class="list-group-item">My Profile<img class='arrow' src='/theme/philzine/img/side-menu/arrow-right-white.png'/></a>
	  <a href="#" class="list-group-item">Messages<img class='arrow' src='/theme/philzine/img/side-menu/arrow-right-white.png'/></a>
	  <a href="#" class="list-group-item">My Store<img class='arrow' src='/theme/philzine/img/side-menu/arrow-right-white.png'/></a>
	  <a href="#" class="list-group-item">Settings<img class='arrow' src='/theme/philzine/img/side-menu/arrow-right-white.png'/></a>	  
	  <a href="/user/logout" class="list-group-item">Logout<img class='arrow' src='/theme/philzine/img/side-menu/arrow-right-white.png'/></a>  	  
	  <?php } else { ?>
		<a href="/user/login" class="list-group-item">Login<img class='arrow' src='/theme/philzine/img/side-menu/arrow-right-white.png'/></a>  
		<a href="/user/register" class="list-group-item">Register<img class='arrow' src='/theme/philzine/img/side-menu/arrow-right-white.png'/></a>  
	  <?php } ?>
	</div>
	<div class='side-bar-copyright'>
		<ul class="nav nav-inline">
		  <li class="nav-item">
			<a class="nav-link" href="#">Terms & Policies</a>
		  </li>
		  <li class="nav-item">
			<a class="nav-link" href="#">Feedback</a>
		  </li>
		  <li class="nav-item">
			<a class="nav-link" href="#">About</a>
		  </li>
		</ul>
		<div class='copy-right-text'>
			Copyright (C) 2013 ~ 2015 우리에듀.<br>
			All Rights Reserved 
		</div>
	</div>
</div>
