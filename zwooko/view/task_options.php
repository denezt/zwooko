<?php

function getTaskOption($dbo){
	$sql = "SELECT * FROM task_type";
    echo "Loading, mySQL statement " . $sql . "<br/>";
    $query_result = $dbo->prepare($sql);
    $query_result->execute();
    return $query_result->fetchAll();
}

?>
