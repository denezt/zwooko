<?php
session_start();
$logged_in = $_SESSION["logged_in"];

include("../model/database.php");
include("../controller/TaskQueue.php");

if ($logged_in) {
    $dbo = new DataBaseConnector();
    $taskQueue = new TaskQueue($logged_in);
    $tableData = $taskQueue->getArchiveData($dbo);
    echo $taskQueue->runTaskQueue($tableData);
}


?>
