<?php
widget_css();
widget_js();

$ci = & get_instance();

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
//<form class='member-register-form' action="$route">
?>
<?php echo validation_errors(); ?>
<div class='form-wrapper'>
	<div class='register-logo'>
		<img src='/theme/philzine/img/member/register.png'/>
		<div class='text'><?php echo $title ?></div>
	</div>
	<?php echo form_open($route,['class'=>'member-register-form']); ?>
		<?php if( empty( $user ) ){ ?>
		<div class="input-group username">		
			<input name="username" type="text" class="form-control" placeholder="Enter username">
			<span class="input-group-addon"><img src='/theme/philzine/img/member/username.png'/></span>
		</div>		
		<div class="input-group password">
			<input name="password"  type="password" class="form-control" placeholder="Enter password">
			<span class="input-group-addon"><img src='/theme/philzine/img/member/password.png'/></span>
		</div>
		<?php } 
		else { ?>
			<input type='hidden' name='id' value='<?php echo $id; ?>'>
			<div class="input-group username text-only">		
				<span class="form-control"><?php echo $username; ?></span>
				<span class="input-group-addon"><img src='/theme/philzine/img/member/username.png'/></span>
			</div>
			<div class="input-group password text-only">		
				<span class="form-control">Change Password?</span>
				<span class="input-group-addon"><img src='/theme/philzine/img/member/password.png'/></span>
			</div>
			<div class="input-group first_name">		
				<input name="first_name" type="text" class="form-control" placeholder="First Name" value="<?php echo $first_name; ?>">
				<span class="input-group-addon"><img src='/theme/philzine/img/member/name.png'/></span>
			</div>
			<div class="input-group middle_name">		
				<input name="middle_name" type="text" class="form-control" placeholder="Middle Name" value="<?php echo $middle_name; ?>">
				<span class="input-group-addon"><img src='/theme/philzine/img/member/name.png'/></span>
			</div>
			<div class="input-group last_name">		
				<input name="last_name" type="text" class="form-control" placeholder="Last Name" value="<?php echo $last_name; ?>">
				<span class="input-group-addon"><img src='/theme/philzine/img/member/name.png'/></span>
			</div>
			<div class="input-group address">		
				<input name="address" type="text" class="form-control" placeholder="Address" value="<?php echo $address; ?>">
				<span class="input-group-addon"><img src='/theme/philzine/img/member/location.png'/></span>
			</div>
		<?php } ?>
		<div class="input-group email">		
			<input name="email" type="text" class="form-control" placeholder="Enter email" value="<?php echo $email; ?>">
			<span class="input-group-addon"><img src='/theme/philzine/img/member/email.png'/></span>
		</div>
		<div class="input-group mobile">
			<input name="mobile"  type="text" class="form-control" placeholder="Enter mobile" value="<?php echo $mobile; ?>">
			<span class="input-group-addon"><img src='/theme/philzine/img/member/mobile.png'/></span>
		</div>
		
		<input type="submit" class="btn btn-primary" value="<?php echo $title; ?>">		
	</form>
</div>