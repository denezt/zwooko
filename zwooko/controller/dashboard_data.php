<?php
include("../model/database.php");
$dbo = new DataBaseConnector();

function getTaskNameList($dbo){
	$sql = "SELECT name FROM `task_type`";
	// echo "Loading, mySQL statement " . $sql . "<br/>";
	$stmt = $dbo->prepare($sql);
	$stmt->execute();
	$results = $stmt->fetchAll();
	return $results;
}

function getTaskTypeId($dbo, $task_name){
	$sql = "SELECT id FROM `task_type` where `name` = ?";
	// echo "Loading, mySQL statement " . $sql . "<br/>";
	$stmt = $dbo->prepare($sql);
 	$stmt->execute([$task_name]);
	return $stmt->fetchColumn();
}

function getTaskCount($dbo, $task_name){
	$sql = "SELECT count(*) FROM `task_queue` where task_type = ?";
	// echo "Loading, mySQL statement " . $sql . "<br/>";
	$stmt = $dbo->prepare($sql);
	$stmt->execute([$task_name]);
	return $stmt->fetchColumn();
}

?>
