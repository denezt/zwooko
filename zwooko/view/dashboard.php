<?php
session_start();
$logged_in = $_SESSION["logged_in"];
include("./model/database.php");
include("./controller/dashboard_data.php");

?>
<html>
	<head>
		<style>
			#dashboard-table {
				border: 1px solid lightgray;
				width: 80%;
			}
			.task-type {
				border-radius: 1px 0 3px 4px;
			}
		</style>
	</head>
	<body>
		<?php
		if ("true" == $logged_in){
			// Create the Database Object
			$dbo = new DataBaseConnector();
			$taskNameList = getTaskNameList($dbo);
			echo "<table id='dashboard-table' class='table table-striped'>";
			foreach ($taskNameList as &$taskName) {
				$taskId = getTaskTypeId($dbo, $taskName["name"]);
				$taskCount = getTaskCount($dbo, $taskName["name"]);
				echo	"<tr>";
				echo 		"<td>".$taskId."</td>";
				echo 		"<td>".$taskName["name"]."</td>";
				echo 		"<td>".$taskCount."</td>";
				echo 	"</tr>";
			}
			echo "</table>";
		}
		?>
	</body>
</html>
