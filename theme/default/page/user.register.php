<h1>User Registration</h1>
<?php echo validation_errors(); ?>
<?php echo form_open('/user/register'); ?>

<h5>Email Address</h5>
<input type="text" name="email" value="<?php echo set_value('email')?>" size="50" />

<h5>Password</h5>
<input type="text" name="password" value="<?php echo set_value('password')?>" size="50" />

<h5>Password Confirm</h5>
<input type="text" name="password_confirm" value="<?php echo set_value('password_confirm')?>" size="50" />

<h5>First Name</h5>
<input type="text" name="first_name" value="<?php echo set_value('first_name')?>" size="50" />

<h5>Middle Name</h5>
<input type="text" name="middle_name" value="<?php echo set_value('middle_name')?>" size="50" />

<h5>Last Name</h5>
<input type="text" name="last_name" value="<?php echo set_value('last_name')?>" size="50" />

<h5>Address</h5>
<input type="text" name="address" value="<?php echo set_value('address')?>" size="50" />




<div><input type="submit" value="Submit" /></div>

</form>
