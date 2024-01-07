<?php 

class LogManager {

	function __construct(){}

	function addLogEntry($dbo, $user_id, $uuid, $message, $type_id){
		$sql = "INSERT INTO `logging` (`user_id`, `uuid`, `message`, `type_id`) ";
		$sql .= " VALUES (:user_id, :uuid, :message, :type_id)";
  		$stmt = $dbo->prepare($sql);
  		$stmt->execute(array('user_id' => $user_id, 'uuid' => $uuid, 'message' => $message, 'type_id' => $type_id));
	}

	function getLogType($dbo, $type_name){
		$sql = "SELECT `id` FROM `log_type` WHERE `name` = :type_name";
		$stmt = $dbo->prepare($sql);
		$stmt->execute(array('type_name' => $type_name));
		return $stmt->fetchColumn();
	}
}

?>
