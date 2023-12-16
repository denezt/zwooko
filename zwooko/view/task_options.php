<?php

$task_types = array (
  array(1,"simple_task","Task"),
  array(2,"support","Support"),
  array(3,"subtask","Subtask"),
  array(4,"change","Change"),
  array(5,"issue","Issue")
);

echo count($task_types) . "\n";
$row_limit = count($task_types);

for ($row = 0; $row < $row_limit; $row++) {
	echo "<option value='". $task_types[$row][0] ."'>". $task_types[$row][2] ."</option>\n";
}

?>
