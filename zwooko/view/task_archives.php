<?php 
session_start();
$logged_in = $_SESSION["logged_in"];

include("model/database.php");
include("controller/TaskQueue.php");

$dbo = new DataBaseConnector();
$taskQueue = new TaskQueue($logged_in);
$tableData = $taskQueue->getArchiveData($dbo);
echo $taskQueue->runTaskQueue($tableData);

?>
<!DOCTYPE html>
<html>
	<head>
		<style>
			#dashboard-table {
				border: 1px solid lightgray;
				width: 80%;
			}
			.task-type {
				border-radius: 1px 0 3px 4px;
			}
		</style>
	</head>
</html>