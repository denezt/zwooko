<?php

class SaveTicketInfo {

	function __construct(){ }

	function saveInfo($dbo, $user_id, $summary, $task_type, $task_id, $task_comment, $task_status, $asset_id){
		$commentArr = explode(" ",$task_comment);
		echo "Comment Length: ". count($commentArr) . "<br>";
		$task_comment = (count($commentArr) < 2) ? "empty" : $task_comment;
		$sql = "INSERT INTO `task` (`name`, `type_id`, `uuid`, `description`, `status_id`, `asset_id`, `user_id`) VALUES ('".$summary."', $type_id, $task_id, '". $task_comment ."', $status_id, $asset_id, $user_id)";
		echo "Loading, mySQL statement " . $sql . "<br/>";
		$stmt = $dbo->prepare($sql);
		$stmt->execute();
	}

	function getValue(){
		echo "Save Ticket Info";
	}
}


?>
