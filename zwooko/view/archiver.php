<?php
include("controller/AccountInfo.php");
include("controller/TaskInfo.php");
include("model/database.php");

$task_id = $_GET["task_id"];
$accountInfo = new AccountInfo();
$dbo = new DataBaseConnector();
$taskInfo = new TaskInfo($task_id);
$taskInfo->extractTaskTableData($dbo);

?>
<!DOCTYPE html>
<html>
    <head>
	<link href="css/styles.css" rel="stylesheet" />
	<link href="css/zwooko.css" rel="stylesheet" />
    </head>
    <body>
        <?php if ($accountInfo->getSessionState()): ?>
        <div class="container-fluid">
            <div class="shadow-sm p-3 mb-5 bg-body-tertiary rounded">
                <ul class="list-group">
                <?php
                    echo '<li class="list-group-item list-group-item-secondary">Do you want to archive task?</li>';
                    echo '<li class="list-group-item list-group-item-secondary"><span class="d-inline-block text-truncate" style="max-width: 550px;">Task Name: ' . $taskInfo->getTaskName() . '</span></li>';  
                ?>
                </ul>
            </div>
            <form method="get" action="controller/confirm_new_status.php">
                <input type="hidden" name="task_id" value="<?php echo $task_id; ?>">
                <input type="hidden" name="set_status" value="3">
                <button type="submit" class="btn btn-secondary">Archive Task</button>
            </form>
        </div>
        <?php endif; ?>
    </body>
</html>

