<?php

include("../model/database.php");

/**
* array(6) {
*    ["task_id"]=> string(36) "fbbfcaf4-9923-11ee-82a3-4b0c36b4b128"
*    ["username"]=> string(6) "denezt"
*    ["summary"]=> string(56) "Automate the Mandantensuche Plugin packaging via Jenkins"
*    ["task_type"]=> string(7) "subtask"
*    ["task_priority"]=> string(6) "medium"
*    ["task_comment"]=> string(14) "This is a test"
* }
*/

class SaveTicketInfo {

	function __construct(){

	}

	function saveInfo($dbo, $taskId, $username, $summary, $task_type, $type_priority, $task_comment){
		// (name, type_id, uuid, description, status_id, asset_id, user_id )
		$sql = "INSERT INTO `task` (name, type_id, uuid, description, status_id, asset_id, user_id) ";
		$sql = . " VALUES ($username, $task_type, $taskId, $)"
		$stmt = $pdo->prepare($sql);
        	$stmt->bindValue(':text', $_POST['text']);
        	$stmt->execute();

 		// $stmt = $conn->prepare("SELECT * FROM task where username = :username ");
    		// $stmt->bindParam(':username', $user);
    		// $stmt->execute();
		echo var_dump($dbo->prepare());
	}

}

$saveTicketInfo = new SaveTicketInfo();

$dbo = new DataBaseConnector();
$saveTicketInfo->saveInfo($dbo, null, null,null,null,null,null);


?>
