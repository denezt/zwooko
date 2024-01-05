<?php
include("../model/database.php");
include("TaskInfo.php");
include("AccountInfo.php");


$task_id = $_GET["task_id"];
$set_status = $_GET["set_status"];
$dbo = new DataBaseConnector();
$accountInfo = new AccountInfo();
$taskInfo = new TaskInfo($task_id);


function archiveTask($dbo, $status_id, $uuid){
    // Get system time
    $timestamp = time();
    // Convert Unix timestamp to date and time
    $date = date("Y-m-d H:i:s", $timestamp);
    $sql = "UPDATE `task` SET `status_id` = ?, `modified_on` = ? WHERE `uuid` = ?";
    $stmt = $dbo->prepare($sql);
    $stmt->execute([ $status_id, $date, $uuid]);
}

function deleteTask($dbo, $uuid){
    // Get system time
    $timestamp = time();
    // Convert Unix timestamp to date and time
    $date = date("Y-m-d H:i:s", $timestamp);
    $sql = "DELETE FROM `task` WHERE `uuid` = ?";
    $stmt = $dbo->prepare($sql);
    $stmt->execute([$uuid]);
}

// Archive Task
if ($set_status == 3){
    archiveTask($dbo, $set_status, $task_id);
    $message = "Archiving, Task";
}
// Delete Task
if ($set_status == 0) {
    deleteTask($dbo, $task_id);
    $message = "Removing, Task with ID ${task_id}";
}

?>
<!DOCTYPE html>
<head>
<script>
      function changePage(){
        location.replace("/?route=queue");
      }
      function redirectPage(){
        setTimeout(changePage,1500);
      }
    </script>
</head>
<body onload="redirectPage();">
    <h1><?php echo $message; ?></h1>
</body>
</html>