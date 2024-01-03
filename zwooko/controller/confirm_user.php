<?php
session_start();
$debug_toggle = $_SESSION["debug_toggle"];
include("../model/database.php");
include("../model/configuration.php");
include("AccountInfo.php");
$username = "";
$password = "";
$login_username = $_POST["name"];
$login_password = $_POST["password"];

$dbo = new DataBaseConnector();
$query = "select * from user where name = ?";
$statement = $dbo->prepare($query);
$statement->execute([$login_username]);

// Fetch all rows as an associative array
$result = $statement->fetchAll(PDO::FETCH_ASSOC);

foreach ($result as $rs){
  $id = $rs["id"];
  $username = $rs["name"];
  $uuid = $rs["uuid"];
  $password = $rs["password"];
  $status_id = $rs["status_id"];
}

$dbo = null;

// Check account credentials
if (($login_username == $username) && (md5($login_password) == $password)) {
  $message_out .= "<span style='color:green;'>User Verified.</span><br/>";
  $message_out .= "<a href='../'>Select This Link to Go to Main Page.</a>";
  // Create a session for the user
  $_SESSION["logged_in"] = "true";
  $accountInfo = new AccountInfo();
  $accountInfo->setSessionVariables($id, $username, $uuid, $status_id);
  switch ($debug_toggle) {
    case 'on':
      $message_out .= "<hr/>";
      $message_out .= "Debug On." . "<br/>";
      $message_out .= "Given User: ". $login_username . "<br/>";
      $message_out .= "Stored User: " . $username . "<br/>";
      $message_out .= "Given Pass: " . $login_password . ' (' . md5($login_password) . ")<br/>";
      $message_out .= "Stored Pass: " . $password . "<br/>";
      break;
    default:
      $message_out = '<div class="alert alert-success" role="alert">
              <h4 class="alert-heading">Access Granted</h4>
                <p>Logging user '. $login_username .' into '. $app["name"].' Application</p>
              <hr>
              <div class="spinner-border text-dark" role="status"></div>
              <p class="mb-0">Private Project Management Application</p>
            </div>';
      break;
  }
} elseif (empty($login_username) || empty($login_password)) {
  // User Login Error
  $message_out = '<div class="alert alert-danger" role="alert">No credentials were found./div><br/>';
  $message_out .= "<a href='../'>Select This Link to Go to Main Page.</a>";
} elseif (empty($username ) && empty($password)) {
  // Application Login Error
  $message_out = '<div class="alert alert-danger" role="alert">Error Occurred when attempting to login!!! Ask your application Administrator for assistance.</div>';
} else {
  $message_out = '<div class="alert alert-danger" role="alert">Unable to Verify credentials.</div>';
  $message_out .= "<a href='../'>Select This Link to Go to Main Page.</a>";
}

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title><?php echo $config["app"]["name"]; ?> | Confirming Access...</title>
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../view/assets/favicon.ico" />
    <!-- Core theme CSS (includes Bootstrap) -->
    <link href="../view/css/styles.css" rel="stylesheet" />
    <link href="../view/css/zwooko.css" rel="stylesheet" />
    <script>
      function changePage(){
        location.replace("/?route=dashboard");
      }
      function redirectPage(){
        setTimeout(changePage, 1500);
      }
    </script>
    <style>
      .main-message {
        margin-top: 5%;
      }
    </style>
  </head>
  <body onload="redirectPage();">
    <div class="main-message">
      <div class="container-sm">
        <center>
          <?php if (empty($login_username) || empty($login_password)): ?>
            <h1>Welcome to <?php echo $app["name"]; ?></h1>
            <?php endif; ?>
          </center>
          <center>
            <?php echo $message_out; ?>
        </center>
      </div>
    </div>
  </body>
</html>
