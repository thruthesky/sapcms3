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
		 <div class='row'>
			<div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-blue">
                <div class="inner">
                  <h3><?php echo $data['user_count'] ?></h3>
                  <p>New Users</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person-add"></i>
                </div>
                <a href="/entity/user/list?date_from=today" class="small-box-footer">
                  More info <i class="fa fa-arrow-circle-right"></i>
                </a>
              </div>
            </div><!-- ./col -->
			<div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                  <h3><?php echo $data['message_count'] ?></h3>
                  <p>New Messages</p>
                </div>
                <div class="icon">
                  <i class="ion ion-ios-email"></i>
                </div>
                <a href="/entity/message/list?date_from=today" class="small-box-footer">
                  More info <i class="fa fa-arrow-circle-right"></i>
                </a>
              </div>
            </div><!-- ./col -->
			<div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                  <h3><?php echo $data['post_data_count'] ?></h3>
                  <p>New Posts</p>
                </div>
                <div class="icon">
                  <i class="ion ion-edit"></i>
                </div>
                <a href="/entity/post_data/list?date_from=today" class="small-box-footer">
                  More info <i class="fa fa-arrow-circle-right"></i>
                </a>
              </div>
            </div><!-- ./col -->
			<div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-red">
                <div class="inner">
                  <h3><?php echo $data['data_count'] ?></h3>
                  <p>New Files</p>
                </div>
                <div class="icon">
                  <i class="ion ion-ios-paper"></i>
                </div>
                <a href="/entity/data/list?date_from=today" class="small-box-footer">
                  More info <i class="fa fa-arrow-circle-right"></i>
                </a>
              </div>
            </div><!-- ./col -->
		</div>
		 <div class="box box-default color-palette-box">
            <div class="box-header with-border">
              <h3 class="box-title"><i class="fa fa-tag"></i> Welcome to Admin Page!</h3>
            </div>
            <div class="box-body">
				Welcome Admin!
			</div>	
		</div>
	<?php } ?>
	
	<?php if( $user_id == 'anonymous' ){ ?>
		<?php widget('login_admin'); ?>
	<?php }?>
</section>