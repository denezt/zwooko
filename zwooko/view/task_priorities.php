<?php

function getTaskPriority($dbo){
	$sql = "SELECT * FROM task_priority";
    $query_result = $dbo->prepare($sql);
    $query_result->execute();
    return $query_result->fetchAll();
}

?>
