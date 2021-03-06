<?php
	if( empty( $collapsedTab ) ) $collapsedTab = null;
	if( empty( $name ) ) $name = null;
?>
<section class="sidebar">
	<ul class="sidebar-menu">
		<li class="header">Admin Navigation</li>
		<li>
		  <a href="/admin">
			<i class="fa fa-home"></i> <span>Admin Home</span></i>
		  </a>
		</li>
		<li class="treeview<?php if( $collapsedTab == 'entity' ) echo ' active'; ?>">
		  <a href="/entity/list">
			<i class="fa fa-list"></i> <span>Entity List</span> <i class="fa fa-angle-left pull-right"></i>
		  </a>
		  <ul class="treeview-menu">
			<li <?php if( $name == 'all' ) echo "class='active'" ?>><a href="/entity/list"><i class="fa fa-long-arrow-right"></i>All</a></li>
			<li <?php if( $name == 'config' ) echo "class='active'" ?>><a href="/entity/config/list"><i class="fa fa-long-arrow-right"></i>Config</a></li>
			<li <?php if( $name == 'data' ) echo "class='active'" ?>><a href="/entity/data/list"><i class="fa fa-long-arrow-right"></i>Data</a></li>
			<li <?php if( $name == 'message' ) echo "class='active'" ?>><a href="/entity/message/list"><i class="fa fa-long-arrow-right"></i>Message</a></li>
			<li <?php if( $name == 'post_config' ) echo "class='active'" ?>><a href="/entity/post_config/list"><i class="fa fa-long-arrow-right"></i>Post Config</a></li>
			<li <?php if( $name == 'post_data' ) echo "class='active'" ?>><a href="/entity/post_data/list"><i class="fa fa-long-arrow-right"></i>Post Data</a></li>
			<li <?php if( $name == 'user' ) echo "class='active'" ?>><a href="/entity/user/list"><i class="fa fa-long-arrow-right"></i>User</a></li>
		  </ul>
		</li>
	</ul>
</section>