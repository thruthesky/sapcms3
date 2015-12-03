<a href="/" class='logo'>
<!-- mini logo for sidebar mini 50x50 pixels -->
<span class="logo-mini">AP</span>
<!-- logo for regular state and mobile devices -->
<span class="logo-lg">Admin Page</span>
</a>
<nav class="navbar navbar-static-top" role="navigation">
	<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
	<span class="sr-only">Toggle navigation</span>
	</a>

	
	<div class="navbar-custom-menu">
		<ul class="nav navbar-nav">
			<li><a href="/admin"><i class="fa fa-home"></i></a></li>
			<?php if ( login() ) { ?>
			<li class="dropdown messages-menu">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
				  <i class="fa fa-bell-o"></i>
				  <span class="label label-success">7</span>
				</a>
				<ul class="dropdown-menu">
                  <li class="header">You have 7 Notifications</li>
                  <li>
                    <!-- inner menu: contains the actual data -->
					<ul class="menu" style="overflow: hidden; width: 100%; height: 200px;">
                      <li><a href="#">1</a></li>
					  <li><a href="#">2</a></li>
					  <li><a href="#">3</a></li>
					  <li><a href="#">4</a></li>
					  <li><a href="#">5</a></li>
					  <li><a href="#">6</a></li>
					  <li><a href="#">7</a></li>
                    </ul>					
                  </li>
                  <li class="footer"><a href="#">See All Notificationsg</a></li>
                </ul>			
			  </li>
			  <li class="dropdown">
				  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
				  <ul class="dropdown-menu" role="menu">
					<li><a href="#">Action</a></li>
					<li><a href="#">Another action</a></li>
					<li><a href="#">Something else here</a></li>
					<li class="divider"></li>
					<li><a href="#">Separated link</a></li>
					<li class="divider"></li>
					<li><a href="#">One more separated link</a></li>
				  </ul>
				</li>
			<li class='dropdown user user-menu'>
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					<img class='user-image' src="/tmp/logo.png">					
					<span class="hidden-xs"><?php echo login('username')?></span>					 
				 </a>
				 <ul class='dropdown-menu'>
					<li>More User Info Here</li>
				 </ul>
			</li>
			<?php } ?>

			<?php if ( login() ) { ?>
				<li><a href="/user/logout">Logout</a></li>
			<? } else { ?>
				<li><a href="/user/login">Login</a></li>
			<? } ?>
			<li>
				<a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
			</li>
		</ul>
	</div>
</nav>


<?php
