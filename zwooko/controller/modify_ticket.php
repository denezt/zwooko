<?php
$debug = false;
include("../model/configuration.php");
include("../model/database.php");
include("AccountInfo.php");
include("UuidManager.php");
include("LogManager.php");

function modifyInfo($dbo, $user_id, $summary, $type_id, $task_comment, $status_id, $asset_id, $assignee_id, $priority_id, $start_date, $due_date, $uuid){
  // Get system time
  $timestamp = time();
  // Convert Unix timestamp to date and time
  $date = date("Y-m-d H:i:s", $timestamp);
  $commentArr = explode(" ", $task_comment);
  $task_comment = (count($commentArr) < 1) ? "empty" : $task_comment;
  $sql = "update `task` set `user_id` = ?, `name` = ?, `type_id` = ?, `description` = ?, `status_id` = ?, `asset_id` = ?, `modified_on` = ?, `assignee_id` = ?, `priority_id` = ?, `start_date` = ?, `due_date` = ? where `uuid` = ?";
  $stmt = $dbo->prepare($sql);
  $stmt->execute([$user_id, $summary, $type_id, $task_comment, $status_id, $asset_id, $date, $assignee_id, $priority_id, $start_date, $due_date, $uuid]);
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
$task_id = $_GET["task_id"];
$task_comment = $_GET["task_comment"];
$status_id = $_GET["status"];
$asset_id = $_GET["product"];
$assignee_id = $_GET["assignee_id"];
$priority_id = $_GET["task_priority"];
$start_date = $_GET["start_date"];
$due_date = $_GET["due_date"];

// Extract User ID from Database
// Save task to database
modifyInfo($dbo, $user_id, $summary, $type_id, $task_comment, $status_id, $asset_id, $assignee_id, $priority_id, $start_date, $due_date, $task_id);

// Create Log Entry
$uuidMgr = new UuidManager();
$uuidMgr->generateUUID();
$log_id = $uuidMgr->getUUID();
$logManager = new LogManager();
$accountInfo = new AccountInfo();
$user_id = $accountInfo->getId();
$message = "User " . $accountInfo->getUsername() . " Modified Task";
$message .= " with the following info $user_id, $summary, $type_id, $task_comment, $status_id, $asset_id, $assignee_id, $priority_id, $start_date, $due_date, $task_id";
$logTypeId = $logManager->getLogType($dbo, "info");
$logManager->addLogEntry($dbo, $user_id, $log_id, $message, $logTypeId);

if ($debug){
  echo var_dump($_GET);
}

?>
<!DOCTYPE html>
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
      location.replace("/?route=update_task&task_uid=<?php echo $task_id;?>");
    }
    function redirectPage(){
      setTimeout(changePage,1500);
    }
  </script>
  <style>
    .message-container {
      border: 0.5px solid lightgray;
      margin-top: 5%;
    }
    .space-10-percent {
      margin-top: 5%;
    }
  </style>
</head>
<body onload="redirectPage();">
  <div class="message-container">
    <div class="space-10-percent"></div>
    <div class="d-flex justify-content-center align-items-center">
      <div class="alert alert-success" role="alert">
        <h4 class="alert-heading">Processing Task Update</h4>
        <p>Successfully modified the Task with the ID: <?php echo $task_id; ?></p>
        <hr>
        <p class="mb-0">
          <?php echo "Task [Summary]: ". $summary; ?>
        </p>
      </div>
    </div>
    <div class="d-flex justify-content-center">
      <div class="text-center">
        <div class="spinner-grow" style="width: 3rem; height: 3rem;" role="status">
          <span class="visually-hidden">Loading...</span>
        </div>
      </div>
    </div>  
  </div>
</body>
</html>