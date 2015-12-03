<div class="login-box">
  <!-- general form elements -->
  <div class="box box-danger">
	<div class="box-header with-border">
	  <h3 class="box-title">Admin Login</h3>
	</div><!-- /.box-header -->
	<!-- form start -->
	<form role="form" action="/user/login/submit">
		<div class='box-body'>
			<div class="form-group has-feedback">
			  <label for="exampleInputPassword1">Username</label>
			  <input type="text" name='username' class="form-control" id="exampleInputPassword1" placeholder="Input email address">
			  <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
			</div>
			<div class="form-group has-feedback">
			  <label for="exampleInputPassword1">Password</label>
			  <input type="password" name='password' class="form-control" id="exampleInputPassword1" placeholder="Input password">
			  <span class="glyphicon glyphicon-lock form-control-feedback"></span>
			</div>
		</div>
		<div class="box-footer">
			<button type="submit" class="btn btn-danger">Submit</button>
		</div>
	</form>
	</div>
</div>