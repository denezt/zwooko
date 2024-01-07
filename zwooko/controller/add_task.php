<?php
include("../model/database.php");
include("../controller/AccountInfo.php");
include("../controller/UuidManager.php");
include("../controller/LogManager.php");

$uuidMgr = new UuidManager();
$uuidMgr->generateUUID();
$uuid = $uuidMgr->getUUID();
$dbo = new DataBaseConnector();
$logManager = new LogManager();

$accountInfo = new AccountInfo();
$user_id = $accountInfo->getId();
$asset = $_POST["product"];
$id = $_POST["id"];
$type = $_POST["type"];
$name = $_POST["name"];
$description = $_POST["description"];
$status_id = $_POST["status_id"];

try {
  $query = "insert into task ";
  $query .= "(`name`,`type_id`,`uuid`,`description`,`status_id`,`asset_id`,`user_id`) ";
  $query .= "values (?, ?, ?, ?, ?, ?, ?)";
  $stmt = $dbo->prepare($sql);
  $stmt->execute([$summary, $type_id, $task_id, $task_comment, $status_id, $asset_id, $user_id]);
  $message = "User " . $accountInfo->getUsername() . "Adding new Task";
  $logTypeId = $logManager->getLogType($dbo, "info");
  $logManager->addLogEntry($dbo, $user_id, $uuid, $message, $logTypeId);
} catch (PDOException $ex) {
  // echo "Error: ". $ex->getMessage() . "<br />";
  $logTypeId = $logManager->getLogType($dbo, "error");
  $logManager->addLogEntry($dbo, $user_id, $uuid, $ex->getMessage(), $logTypeId);
  die("Problem accessing database!");
}

?>
<!DOCTYPE html>
<html>
  <head>
    <script>
      function changePage(){
        location.replace("../view/task.php");
      }
      function redirectPage(){
        setTimeout(changePage,1500);
      }
    </script>
  <title>Creating Session: [<?php echo mt_rand(); ?>]</title>
  </head>
  <body onload="redirectPage();">
    <center>
      <?php echo $message_out; ?>
    </center>
  </body>
</html>
