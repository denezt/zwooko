<?php function loadLoginWidget(){ ?>
	<h1>User Login Access:</h1>
	<div class="page-header">Restricted Access <span class="glyphicon glyphicon-lock"></span>:</div>
		<form class="form-horizontal" action="../controller/confirm_user.php" method="post" role="form">
			<div class="form-group">
				<label class="control-label col-sm-2" for="name">Username:</label>
				<div class="col-sm-10">
					<input name="name" type="text" class="form-control" id="name" placeholder="Enter Username" required>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2" for="pwd">Password:</label>
				<div class="col-sm-10">
					<input name="password" type="password" class="form-control" id="pwd" placeholder="Enter password" required>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<div class="checkbox">
						<label><input type="checkbox"> Remember me</label>
					</div>
				</div>
			</div>
			<div class="form-group">
				<!-- <div class="col-sm-offset-2 col-sm-10">
					<button type="submit" class="btn btn-default">Submit</button>
				</div> -->
				<div class="col-auto">
					<button type="submit" class="btn btn-primary mb-3">Login</button>
				</div>
			</div>
	</div>
<?php }

?>
