<?php

function getTaskAssetsId($dbo){
	$sql = "SELECT * FROM asset";
    echo "Loading, mySQL statement " . $sql . "<br/>";
    $query_result = $dbo->prepare($sql);
    $query_result->execute();
    return $query_result->fetchAll();
}


?>
