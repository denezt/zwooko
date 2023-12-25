<?php
$debug = true;
include("../model/configuration.php");
include("../model/database.php");

function modifyInfo($dbo, $user_id, $summary, $type_id, $task_comment, $status_id, $asset_id, $uuid){
  $commentArr = explode(" ", $task_comment);
  $task_comment = (count($commentArr) < 2) ? "empty" : $task_comment;
  $sql = "update `task` set `user_id` = ?, `name` = ?, `type_id` = ?, `description` = ?, `status_id` = ?, `asset_id` = ? where `uuid` = ?";
  $stmt = $dbo->prepare($sql);
  $stmt->execute([$user_id, $summary, $type_id, $task_comment, $status_id, $asset_id, $uuid]);
}
  
function getUserId($dbo, $username){
  $sql = "SELECT id FROM `user` WHERE name = ?";
  $stmt = $dbo->prepare($sql);
  $stmt->execute([$username]);
  return $stmt->fetchColumn();
}
    
$dbo = new DataBaseConnector();
$username = $_GET["username"];
$user_id = getUserId($dbo, $username);
$summary = $_GET["summary"];
$type_id = $_GET["task_type"];
$uuid = $_GET["task_id"];
$task_comment = $_GET["task_comment"];
$status_id = $_GET["status"];
    
echo "<h1>Running</h1>";

// Extract User ID from Database
// Save task to database
modifyInfo($dbo, $user_id, $summary, $type_id, $task_comment, $status_id, 1, $uuid);
if ($debug){
  echo var_dump($_GET);
}

?>

<a href="/?route=queue">GO to Queue</a>