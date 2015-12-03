<section class="content-header">
  <h1>
	Admin
	<small>Front Page</small>
  </h1>
  <ol class="breadcrumb">	
	<li class="active">Home</li>
  </ol>
</section>

<section class="content">
	<?php 		
		$user_id = login('username');		
		if( $user_id != 'root' ) { 		
		if( !empty( $user_id ) ) $admin_alert_text = "You are not an Admin. Please leave this page.";
		else $admin_alert_text = "This is the Admin Page. If you are not the admin please leave this page.";
	?>
	<div class="alert alert-danger">
		<h4><i class="icon fa fa-ban"></i> Alert!</h4>
		<?php echo $admin_alert_text; ?>
	</div>	
	<?php } else{ ?>
		 <div class="box box-default color-palette-box">
            <div class="box-header with-border">
              <h3 class="box-title"><i class="fa fa-tag"></i> Welcome to Admin Page!</h3>
            </div>
            <div class="box-body">
				Welcome Admin!
			</div>	
		</div>
	<?php } ?>
	
	<?php if( empty( $user_id ) ){ ?>
		<?php widget('login_admin'); ?>
	<?php }?>
</section>