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
    </head>        
    <body>
        <?php if ($accountInfo->getSessionState()): ?>
        <div class="container-fluid">
            <div class="shadow-sm p-3 mb-5 bg-body-tertiary rounded">
                <ul class="list-group">
                <?php
                    echo '<li class="list-group-item list-group-item-danger">Do you want to delete task?</li>';  
                    echo '<li class="list-group-item list-group-item-danger">Task Name: ' . $taskInfo->getTaskName() . '</li>';  
                ?>
                </ul>
            </div>
            <form method="get" action="controller/confirm_new_status.php">
                <input type="hidden" name="task_id" value="<?php echo $task_id; ?>">
                <button type="submit" class="btn btn-danger">Delete Task</button>
            </form>
        </div>
        <?php endif; ?>
    </body>        
</html>

