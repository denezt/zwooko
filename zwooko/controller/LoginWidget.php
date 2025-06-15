<?php function loadLoginWidget(){ ?>
<center>
	<div  class='form-panel'>
		<h1 class="form-header">User Login Access:</h1>
		<!-- -->
		<form class="form-horizontal" action="../controller/confirm_user.php" method="post" role="form">
			<div class="page-header"><span class="glyphicon glyphicon-lock" style="font-weight:bold;">Restricted Access</span>:</div>
			<!-- Username Input -->
			<div class="form-group">
				<label class="control-label col-sm-2" for="name">Username:</label>
				<div class="col-sm-10">
					<input name="name" type="text" class="form-control" id="name" placeholder="Enter Username" required>
				</div>
			</div>
			<!-- Password Input -->
			<div class="form-group">
				<label class="control-label col-sm-2" for="pwd">Password:</label>
				<div class="col-sm-10">
					<input name="password" type="password" class="form-control" id="pwd" placeholder="Enter password" required>
				</div>
			</div>
			<!-- Remember Me Checkbox -->
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<div class="checkbox">
						<label><input type="checkbox"> Remember me</label>
					</div>
				</div>
			</div>
			<!-- Login Button -->
			<div class="form-group">
				<div class="col-auto">
					<button type="submit" class="btn btn-primary mb-3">Login</button>
				</div>
			</div>
		</form>
	</div>
</center>
<?php }

?>
