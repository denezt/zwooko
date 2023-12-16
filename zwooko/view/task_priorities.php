<?php

$task_priorities = array (
  array(1,"high","High"),
  array(2,"medium","Medium"),
  array(3,"low","Low")
);

echo count($task_priorities) . "\n";
$row_limit = count($task_priorities);

for ($row = 0; $row < $row_limit; $row++) {
	echo "<option value='". $task_priorities[$row][0] ."'>". $task_priorities[$row][2] ."</option>\n";
}

?>
