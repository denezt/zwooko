<?php

class TaskQueue {
	private $logged_in;
	function __construct($logged_in){
		$this->logged_in = $logged_in;
	}

	function getArchiveData($dbo){
		$sql = "SELECT * FROM task_accomplished limit 10";
		$query_result = $dbo->prepare($sql);
		$query_result->execute();
		return $query_result->fetchAll();
	}

	function getQueueData($dbo){
		$sql = "SELECT * FROM task_queue limit 10";
		$query_result = $dbo->prepare($sql);
		$query_result->execute();
		return $query_result->fetchAll();
	}

	function limitStringLength($inputStr){
		if (strlen($inputStr) > 52){
			$strResult = substr($inputStr, 0, 254) . '...';
		} else {
			$strResult = $inputStr;
		}
		return $strResult;
	}

	function runTaskQueue($tableData){
		if ($this->logged_in == "true"):
			echo  "<table id='dashboard-table' class='table table-striped table-hover'>";
			echo  "<thead>";
			echo    "<tr>";
			echo      "<th scope='col'>ID</th>";
			echo      "<th scope='col'>Task Type</th>";
			echo      "<th scope='col'>Name</th>";
			echo      "<th scope='col'>Product</th>";
			echo      "<th scope='col'>Task Status</th>";
			echo    "</tr>";
			echo  "</thead>";
			echo  "<tbody>";
			if (!empty($tableData)):
				$id = 1;
				foreach ($tableData as $items):
					echo "<tr>";
					echo "<td><a class='no-underline-link' href='?route=update_task&task_uid=".$items['task_uuid']."'>".$id++."</a></td>";
					echo "<td>".$items['task_type']."</td>";
					echo "<td>". $this->limitStringLength($items['task_name']) ."</td>";
					echo "<td>".$items['product_name']."</td>";
					echo "<td><a class='no-underline-link' href='?route=update_task&task_uid=".$items['task_uuid']."'>". $items['status']."</a></td>";
					echo "</tr>";
				endforeach;
			else:
				echo "<tr>";
				for ($i=0; $i < 6; $i++){
					echo "<td style='background-color:lightgray;'><span style='color:gray;'>No Data</span></td>";
				}
				echo "</tr>";
			endif;
			echo "</tbody>";
			echo "</table>";
		endif;
	}

	function scanQueue($queryLimit, $dbo, $current_user){
		// echo "Query Limit: " . $queryLimit;
		$sql = "select * from task_queue where employee = '". $current_user."' limit $queryLimit";
		$tableData = array();
		$item = 0;
		foreach ($dbo->query($sql) as $rs){
			$uuid = $rs["task_uuid"];
			$status = $rs["status"];
			$task_type = $rs["task_type"];
			$asset_name = $rs["product_name"];
			$description = $rs["description"];
			$task_name = $rs["task_name"];
			$tableData[$item++] = array(
				"task_uuid" => $uuid,
				"task_status" => $status,
				"task_name" => $task_name,
				"task_type" => $task_type,
				"asset_name" => $asset_name,
				"description" => $description
			);
		}
		return $tableData;
	}
}

?>