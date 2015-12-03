<?php
	if( empty( $collapsedTab ) ) $collapsedTab = null;
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
			<li><a href="/entity/list"><i class="fa fa-long-arrow-right"></i>All</a></li>
			<li><a href="/entity/config/list"><i class="fa fa-long-arrow-right"></i>Config</a></li>
			<li><a href="/entity/data/list"><i class="fa fa-long-arrow-right"></i>Data</a></li>
			<li><a href="/entity/message/list"><i class="fa fa-long-arrow-right"></i>Message</a></li>
			<li><a href="/entity/post_config/list"><i class="fa fa-long-arrow-right"></i>Post Config</a></li>
			<li><a href="/entity/post_data/list"><i class="fa fa-long-arrow-right"></i>Post Data</a></li>
			<li><a href="/entity/user/list"><i class="fa fa-long-arrow-right"></i>User</a></li>
		  </ul>
		</li>
	</ul>
</section>