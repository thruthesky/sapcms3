<?php
	widget_css();
?>
<div class='form-wrapper'>
	<form class='member-login-form' action="/user/login/submit">
		<div class="input-group username">		
			<input name="username" type="text" class="form-control" placeholder="Enter username">
			<span class="input-group-addon"><img src='/theme/philzine/img/member/username.png'/></span>
		</div>
		<div class="input-group password">
			<input name="password"  type="password" class="form-control" placeholder="Enter password">
			<span class="input-group-addon"><img src='/theme/philzine/img/member/password.png'/></span>
		</div>
		
		<input type="submit" class="btn btn-primary" value="Login">
		<a class='forgot-password' href='#'>Forgot Password?</a>
	</form>
</div>