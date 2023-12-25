<?php
include("../model/configuration.php");
include("../controller/LoginWidget.php");
include("../controller/AccountInfo.php");
$accountInfo = new AccountInfo();
$username = $accountInfo->getUsername();

?>
<!DOCTYPE html>
<head>
    <title><?php echo $config["app"]["name"]; ?> | Login </title>
    <link href="css/styles.css" rel="stylesheet" />
	<link href="css/zwooko.css" rel="stylesheet" />
    <style>
	body {
		background-image: url("../images/zwooko_logo_0002.png");
		background-size: cover; /* This will ensure that the image covers the whole area */
		background-repeat: no-repeat; /* This will prevent the image from repeating */
		background-position: center center; /* This will center the image */
	}
	#login-container {
		margin-top: 10%;
		margin-left: 10%;
		margin-right: 10%;
  		height: 100vh; /* Adjust as needed */
		width: 90%;
	}
    </style>
</head>
<body>
	<?php if (empty($username)) { ?>
	<div id="login-container">
		<?php loadLoginWidget(); ?>
	</div>
	<?php } else { ?>
		<div class="card">
			<div class="card-body">
				<?php echo "Welcome Back: <b>". ucfirst($username) ."</b><br/>"; ?>
			</div>
		</div>
		<center>
			<a class="btn btn-primary" href="../" role="button">Navigate to Main</a>
		</center>
	<?php } ?>
</body>
</html>
