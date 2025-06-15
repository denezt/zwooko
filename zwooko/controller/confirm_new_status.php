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

$sessionState = $accountInfo->getSessionState();

if ($sessionState) {
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
} else {
	echo "You not logged in.";
}


?>
<!DOCTYPE html>
<head>
	<link href="../view/css/styles.css" rel="stylesheet" />
	<link href="../view/css/zwooko.css" rel="stylesheet" />
	<script>
		function changePage(){
			location.replace("/?route=queue");
		}
		function redirectPage(){
			console.log("Redirecting, to queue.");
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
	<?php
		if (isset($task_id) == 1){
    			echo "<h1>" . $message . " " . $task_id . "</h1>";
		} else {
			echo "Missing or invalid task was given!<br>";
		}
	?>
	</div>
</body>
</html>
