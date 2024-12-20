<?php
session_start();
include("../model/database.php");
include("AccountInfo.php");
include("UuidManager.php");
include("LogManager.php");

$uuidMgr = new UuidManager();
$uuidMgr->generateUUID();
$uuid = $uuidMgr->getUUID();
$dbo = new DataBaseConnector();
$logManager = new LogManager();
$accountInfo = new AccountInfo();
$user_id = $accountInfo->getId();
$user_name = $accountInfo->getUsername();
$message = "User " . $user_name . " Logged out";
$logTypeId = $logManager->getLogType($dbo, "info");
// $logManager->addLogEntry($dbo, $user_id, $uuid, $message, $logTypeId);
$_SESSION = array();
session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Logout Screen</title>
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../assets/favicon.ico" />
    <!-- Core theme CSS (includes Bootstrap) -->
    <link href="../view/css/styles.css" rel="stylesheet" />
    <link href="../view/css/zwooko.css" rel="stylesheet" />
    <script>
      function changePage(){
        location.replace("../view/login.php");
      }
      function redirectPage(){
	console.log("Redirecting, page");
        setTimeout(changePage,1500);
      }
    </script>
    <style>
	.container {
		margin-top: 5%;
	}
	.frame {
		border: 0.5px dashed red;
	}
    </style>
</head>
<body onload="redirectPage();">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-9">
				<center>
					<h3><?php echo "Bye ". $user_name; ?></h3>
				</center>
	    		</div>
		</div>
		<div class="row justify-content-center">
			<div class="col-9">
				<center>
	                		<a href="../">Click here if not redirected...</a>
				</center>
	    		</div>
		</div>
	</div>
</body>
</html>
