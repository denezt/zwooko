<?php
$debug = false;
include("../model/configuration.php");
include("../model/database.php");
include("AccountInfo.php");
include("UuidManager.php");
include("LogManager.php");


function saveInfo($dbo, $user_id, $summary, $task_type, $task_id, $task_comment, $status_id, $asset_id, $assignee_id, $priority_id, $start_date, $due_date){
  $commentArr = explode(" ",$task_comment);
  $task_comment = (count($commentArr) < 1) ? "empty" : $task_comment;
  $sql = "INSERT INTO `task` (`name`, `type_id`, `uuid`, `description`, `status_id`, `asset_id`, `user_id`,`assignee_id`, `priority_id`,`start_date`,`due_date`) ";
  $sql .= "VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
  $stmt = $dbo->prepare($sql);
  $stmt->execute([$summary, $task_type, $task_id, "$task_comment", $status_id, $asset_id, $user_id, $assignee_id, $priority_id, $start_date, $due_date]);
}

function getUserId($dbo, $username){
  $sql = "SELECT id FROM `user` WHERE name = :username";
  $stmt = $dbo->prepare($sql);
  $stmt->execute(array('username' => $username));
  return $stmt->fetchColumn();
}

$dbo = new DataBaseConnector();
$username = $_POST["username"];
$user_id = getUserId($dbo, $username);
$summary = $_POST["summary"];
$task_type = $_POST["task_type"];
$task_id = $_POST["task_id"];
$task_comment = $_POST["task_comment"];
$task_priority = $_POST["task_priority"];
$status_id = $_POST["status"];
$assignee_id = $_POST["assignee_id"];
$product_id = $_POST["product"];
$start_date = (!empty($_POST["start_date"])) ? $_POST["start_date"] : " ";
$due_date = (!empty($_POST["due_date"])) ? $_POST["due_date"] : " " ;

$uuidMgr = new UuidManager();
$uuidMgr->generateUUID();
$uuid = $uuidMgr->getUUID();
$dbo = new DataBaseConnector();
$logManager = new LogManager();
$accountInfo = new AccountInfo();

// Extract User ID from Database
// Save task to database
saveInfo($dbo, $user_id, $summary, $task_type, $task_id, $task_comment, $status_id, $product_id, $assignee_id, $task_priority, $start_date, $due_date);
$message = "User " . $accountInfo->getUsername() . " Adding new Task";
$logTypeId = $logManager->getLogType($dbo, "info");
$logManager->addLogEntry($dbo, $user_id, $uuid, $message, $logTypeId);


if ($debug){
  echo var_dump($_POST);
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
                        echo "Adding New Task: ". $_POST["summary"];
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
