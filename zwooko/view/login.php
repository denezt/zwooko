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
		background-repeat: no-repeat;
		background-position: center center; /* This will center the image */
	}
	#login-container {
		margin-top: 5%;
		margin-left: 10%;
		margin-right: 10%;
  		height: 100vh; /* Adjust as needed */
		width: 90%;
	}
	.inner-container {
		background: rgba(255, 255, 255, 0.5);;
		margin-top: 15%;
		margin-left: 0%;
		margin-right: 10%;
		border-radius: 10px 10px 10px 10px;
	}
    </style>
</head>
<body>
	<?php if (empty($username)) { ?>
	<div id="login-container">
		<?php loadLoginWidget(); ?>
	</div>
	<?php } else { ?>
		<center>
			<div id="login-container">
				<div class="inner-container">
					<h2 style="color: darkblue;"><?php echo "Welcome Back: <b>". ucfirst($username) ."</b>"; ?></h2>
					<table>
						<tr>
							<td><a class="btn btn-primary" href="/?route=dashboard" role="button">Navigate to Main</a></td>
						</tr>
						<tr>
							<td>Zwooko&trade; <?php echo Date("Y"); ?></td>
						</tr>
					</table>
				</div>
			</div>
		</center>
	<?php } ?>
</body>
</html>
