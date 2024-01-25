<?php
$debug = false;
include("../model/configuration.php");
include("../model/database.php");
include("AccountInfo.php");
include("UuidManager.php");
include("LogManager.php");

function modifyInfo($dbo, $user_id, $summary, $type_id, $task_comment, $status_id, $asset_id, $assignee_id, $uuid){
  // Get system time
  $timestamp = time();
  // Convert Unix timestamp to date and time
  $date = date("Y-m-d H:i:s", $timestamp);
  $commentArr = explode(" ", $task_comment);
  $task_comment = (count($commentArr) < 1) ? "empty" : $task_comment;
  $sql = "update `task` set `user_id` = ?, `name` = ?, `type_id` = ?, `description` = ?, `status_id` = ?, `asset_id` = ?, `modified_on` = ?, `assignee_id` = ? where `uuid` = ?";
  $stmt = $dbo->prepare($sql);
  $stmt->execute([$user_id, $summary, $type_id, $task_comment, $status_id, $asset_id, $date, $assignee_id, $uuid]);
}
  
function getUserId($dbo, $username){
  $sql = "SELECT id FROM `user` WHERE name = ?";
  $stmt = $dbo->prepare($sql);
  $stmt->execute([$username]);
  return $stmt->fetchColumn();
}
    
$dbo = new DataBaseConnector();
$username = $_GET["username"];
$user_id = getUserId($dbo, $username);
$summary = $_GET["summary"];
$type_id = $_GET["task_type"];
$uuid = $_GET["task_id"];
$task_comment = $_GET["task_comment"];
$status_id = $_GET["status"];
$asset_id = $_GET["product"];
$assignee_id = $_GET["assignee_id"];

// Extract User ID from Database
// Save task to database
modifyInfo($dbo, $user_id, $summary, $type_id, $task_comment, $status_id, $asset_id, $assignee_id, $uuid);

// Create Log Entry
$uuidMgr = new UuidManager();
$uuidMgr->generateUUID();
$uuid = $uuidMgr->getUUID();
$logManager = new LogManager();
$accountInfo = new AccountInfo();
$user_id = $accountInfo->getId();
$message = "User " . $accountInfo->getUsername() . " Modified Task";
$logTypeId = $logManager->getLogType($dbo, "info");
$logManager->addLogEntry($dbo, $user_id, $uuid, $message, $logTypeId);


if ($debug){
  echo var_dump($_GET);
}

?>
<!DOCTYPE html>
<head>
<script>
      function changePage(){
        location.replace("/?route=update_task&task_uid=<?php echo $uuid;?>");
      }
      function redirectPage(){
        setTimeout(changePage,1500);
      }
    </script>
</head>
<body onload="redirectPage();">
      <h1>Updating, issue...</h1>
</body>
</html>