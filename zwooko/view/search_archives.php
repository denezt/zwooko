<?php 
session_start();
$logged_in = $_SESSION["logged_in"];
include("controller/AccountInfo.php");
$accountInfo = new AccountInfo();

include("model/database.php");
include("controller/TaskQueue.php");

$dbo = new DataBaseConnector();
$taskQueue = new TaskQueue($logged_in);

?>
<!DOCTYPE html>
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
            .search-archives {
                width: 80%;
            }
		</style>
	</head>
    <body>
        <?php if ($accountInfo->getSessionState()): ?>
        <div class="search-archives">
            <form method="get" action="/">
                <input type="hidden" name="route" value="search_archives">
                <input name="query" class="form-control form-control-lg" type="text" placeholder="Search term (i.e. Summary, Description or Category)" aria-label=".form-control-lg">
            </form>
        </div>
        <?php
            $term = $_GET["query"];
            // Ensure that the search is not full with empty chars
            $term = (empty($term) == 1) ? "*" : $term;
            $tableData = $taskQueue->searchArchiveData($dbo, $term);
            echo $taskQueue->runTaskQueue($tableData);
            $dbo->close();
        ?>            
        <?php endif; ?>
    </body>
</html>

