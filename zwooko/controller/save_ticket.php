<?php
$debug = false;
include("../model/configuration.php");
include("../model/database.php");
include("AccountInfo.php");
include("UuidManager.php");
include("LogManager.php");


function saveInfo($dbo, $user_id, $summary, $task_type, $task_id, $task_comment, $status_id, $asset_id, $assignee_id, $priority_id){
  $commentArr = explode(" ",$task_comment);
  $task_comment = (count($commentArr) < 1) ? "empty" : $task_comment;
  $sql = "INSERT INTO `task` (`name`, `type_id`, `uuid`, `description`, `status_id`, `asset_id`, `user_id`,`assignee_id`, `priority_id`) ";
  $sql .= "VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
  $stmt = $dbo->prepare($sql);
  $stmt->execute([$summary, $task_type, $task_id, "$task_comment", $status_id, $asset_id, $user_id, $assignee_id, $priority_id]);
}

function getUserId($dbo, $username){
  $sql = "SELECT id FROM `user` WHERE name = :username";
  $stmt = $dbo->prepare($sql);
  $stmt->execute(array('username' => $username));
  return $stmt->fetchColumn();
}

$dbo = new DataBaseConnector();
$username = $_GET["username"];
$user_id = getUserId($dbo, $username);
$summary = $_GET["summary"];
$task_type = $_GET["task_type"];
$task_id = $_GET["task_id"];
$task_comment = $_GET["task_comment"];
$task_priority = $_GET["task_priority"];
$status_id = $_GET["status"];
$assignee_id = $_GET["assignee_id"];
$product_id = $_GET["product"];

$uuidMgr = new UuidManager();
$uuidMgr->generateUUID();
$uuid = $uuidMgr->getUUID();
$dbo = new DataBaseConnector();
$logManager = new LogManager();
$accountInfo = new AccountInfo();

// Extract User ID from Database
// Save task to database
saveInfo($dbo, $user_id, $summary, $task_type, $task_id, $task_comment, $status_id, $product_id, $assignee_id, $task_priority);
$message = "User " . $accountInfo->getUsername() . " Adding new Task";
$logTypeId = $logManager->getLogType($dbo, "info");
$logManager->addLogEntry($dbo, $user_id, $uuid, $message, $logTypeId);


if ($debug){
  echo var_dump($_GET);
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
    <script>
      function changePage(){
        location.replace("/?route=tasks");
      }
      function redirectPage(){
        setTimeout(changePage,1500);
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
          <?php 
                if (empty($login_username) || empty($login_password)):
                        echo "<h1>Successfully, Saved...</h1>";
                        echo "Adding New Task: ". $_GET["summary"];
                endif; 
           ?>
        </center>
        <center>
          <?php echo $message_out; ?>
        </center>
      </div>
    </div>
  </body>
</html>
