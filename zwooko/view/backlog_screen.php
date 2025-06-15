<?php
session_start();
$logged_in = $_SESSION["logged_in"];

include("../model/database.php");
include("../controller/TaskBacklog.php");

if ($logged_in) {
    $dbo = new DataBaseConnector();
    $taskBacklog = new TaskBacklog($logged_in);
    $tableData = $taskBacklog->getBacklogData($dbo);
    echo $taskBacklog->runTaskBacklog($tableData);
}

?>
