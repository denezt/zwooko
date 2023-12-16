<?php
// http://192.168.68.120/zwooko/controller/save_ticket.php?
// task_id=fac995f6-9920-11ee-956a-fbb1a1ab5989
// username=denezt
// summary=Automate+the+Mandantensuche+Plugin+packaging+via+Jenkins
// task_type=subtask
// task_priority=medium
// task_comment=This+is+a+test

$task_id = $_GET["task_id"];
$username = $_GET["username"];
$summary = $_GET["summary"];
$task_type = $_GET["task_type"];
$task_priority = $_GET["task_priority"];
$task_comment = $_GET["task_comment"];

echo "$task_id" . "<br>";
echo var_dump($_GET) . "<br>";





?>
