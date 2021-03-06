<?php
$ci = & get_instance();

widget_css();

$data = $ci->data;

if( !empty( $data['user'] ) ){
	$user = $data['user'];
	$id = $user->get('id');
	$username = $user->get('username');
	$email = $user->get('email');	
	$first_name = $user->get('first_name');
	$middle_name = $user->get('middle_name');
	$last_name = $user->get('last_name');	
	$address = $user->get('address');
	$mobile = $user->get('mobile');
	$route = '/user/editSubmit';
	$title = "Edit Profile";
}
else{
	$username = null;
	$email = null;
	$first_name = null;
	$middle_name = null;
	$last_name = null;
	$address = null;
	$mobile = null;
	$route = '/user/register';
	$title = "User Registration";
}
?>

<h1><?php echo $title; ?></h1>
<?php echo validation_errors(); ?>
<?php echo form_open($route); ?>

<?php if( !empty( $data['keyword'] ) ){ ?><input type='hidden' name='keyword' value='<?php echo $data['keyword']; ?>'><?php } ?>
<?php if( !empty( $data['offset'] ) ){ ?><input type='hidden' name='offset' value='<?php echo $data['offset']; ?>'><?php } ?>



<h5>User Name</h5>
<?php if( empty( $username) ){ ?>
<input type="text" name="username" value="<?php echo set_value('username')?>" size="50" />
<?php } else { ?>
<input type='hidden' name='id' value='<?php echo $id; ?>'>
<div><?php echo $username; ?></div>
<?php } ?>
<h5>Email Address</h5>
<input type="text" name="email" value="<?php echo set_value('email',$email)?>" size="50" />
<?php if( empty( $data['user'] ) ){ //add change pass later ?>
<h5>Password</h5>
<input type="text" name="password" value="<?php echo set_value('password')?>" size="50" />

<h5>Password Confirm</h5>
<input type="text" name="password_confirm" value="<?php echo set_value('password_confirm')?>" size="50" />
<?php } 
else { ?>
<h5>Password</h5>
<div class='change-password'><i>Change Password?</i></div>
<?php
}
?>
<h5>First Name</h5>
<input type="text" name="first_name" value="<?php echo set_value('first_name',$first_name)?>" size="50" />

<h5>Middle Name</h5>
<input type="text" name="middle_name" value="<?php echo set_value('middle_name',$middle_name)?>" size="50" />

<h5>Last Name</h5>
<input type="text" name="last_name" value="<?php echo set_value('last_name',$last_name)?>" size="50" />

<h5>Address</h5>
<input type="text" name="address" value="<?php echo set_value('address',$address)?>" size="50" />

<h5>Mobile</h5>
<input type="text" name="mobile" value="<?php echo set_value('mobile',$mobile)?>" size="50" />

<div><input type="submit" value="Submit" /></div>
<?php
	//needs an easier way for search filters...
	$offset_url = '';
	$cancel_query = '';		
	
	if( !empty( $data['offset'] ) ) $offset_url .= "/".$data['offset'];	
	if( !empty( $data['keyword'] ) ) {
		if( empty( $cancel_query ) ) $cancel_query .= "?";
		else $cancel_query .= "&";
		$cancel_query .= "keyword=".$data['keyword'];
	}
	if( !empty( $data['filter_by'] ) ) {
		if( empty( $cancel_query ) ) $cancel_query .= "?";
		else $cancel_query .= "&";
		$cancel_query .= "filter_by=".$data['filter_by'];
	}
	
	if( !empty( $cancel_query ) ) $cancel_url = "/user/list".$cancel_query;
	else $cancel_url = "/";
?>
<div><a href='<?php echo $cancel_url; ?>' class='cancel'>Cancel</a></div>
</form>
