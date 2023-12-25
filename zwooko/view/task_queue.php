<?php 
session_start();
$logged_in = $_SESSION["logged_in"];

include("model/database.php");
include("controller/TaskQueue.php");

function getQueueData($dbo){
	$sql = "SELECT * FROM task_queue limit 10";
    $query_result = $dbo->prepare($sql);
    $query_result->execute();
    return $query_result->fetchAll();
}

$dbo = new DataBaseConnector();
$tableData = getQueueData($dbo);
$taskQueue = new TaskQueue($logged_in);
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