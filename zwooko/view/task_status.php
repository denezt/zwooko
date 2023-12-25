<?php

function getTaskStatus($dbo){
	$sql = "SELECT * FROM task_status";
    echo "Loading, mySQL statement " . $sql . "<br/>";
    $query_result = $dbo->prepare($sql);
    $query_result->execute();
    return $query_result->fetchAll();
}


?>
