<?php

// Load the Database Object code
include("model/database.php");
$dbo = new DataBaseConnector();
// Task ID as UUID
$uuid = $_GET["task_uid"];

include("controller/TaskInfo.php");
$taskInfo = new TaskInfo($uuid);
$taskInfo->extractTaskTableData($dbo);
$taskTableData = $taskInfo->getTaskTableData();

// Create the PDO
// Load the AccountInfo Object code
include("controller/AccountInfo.php");
$accountInfo = new AccountInfo();
$username = $accountInfo->getUsername();

?>
<?php if ($uuid): ?>
<div class="ticket-container">
    <form method="get" action="controller/modify_ticket.php">
        <!-- User ID Information -->
        <!-- div class="input-group mb-3" style="visibility: hidden;" -->
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Task ID: </span>
            <input name="task_id" type="text" class="form-control" placeholder="Task ID" aria-label="TaskId"
            aria-describedby="basic-addon1" value=<?php echo $uuid;?> readonly>
        </div>
        <!-- Username -->
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon2">Name:</span>
            <input name="username" type="text" class="form-control" placeholder="Username" aria-label="Recipient's username" 
            aria-describedby="basic-addon2" value=<?php echo $username; ?> readonly>
        </div>

        <!-- Status -->
        <div class="mb-3">
            <div class="input-group">
                <span class="input-group-text">Status:</span>
                <select name="status" class="form-select" aria-label="Default select example">
                <?php
                    include("task_status.php");
                    $currentStatus = $taskInfo->getTaskStatusId();
                    $task_status = getTaskStatus($dbo);
                    $row_limit = count($task_status);
                    for ($row = 0; $row < $row_limit; $row++) {
                        $selected = ($task_status[$row][0] == $currentStatus) ? "selected" : " ";
                        echo "<option value='". $task_status[$row][0] ."' $selected>". $task_status[$row][1] ."</option>\n";
                    }
                ?>
                </select>

            </div>
            <div class="form-text" id="basic-addon4">Select Task Status</div>
        </div>		
    
        <!-- Summary -->
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon2">Summary:</span>
            <input name="summary" type="text" class="form-control" placeholder="Summary" aria-label="Task Summary" 
            aria-describedby="basic-addon2" value="<?php echo $taskInfo->getTaskName(); ?>" >
        </div>

        <!-- Task Type -->
        <div class="mb-3">
            <div class="input-group">
                
            <span class="input-group-text">Type:</span>
                <select name="task_type" class="form-select" aria-label="Default select example">
                    <?php
                    // Get the current type
                    $currentType = $taskInfo->getTaskTypeId();
                    include("task_options.php");
                    $task_options = getTaskOption($dbo);
                    $row_limit = count($task_options);
                    for ($row = 0; $row < $row_limit; $row++) {
                        $selected = ($task_options[$row][0] == $currentType) ? "selected" : " ";
                        echo "<option value='". $task_options[$row][0] ."' $selected>". $task_options[$row][1] ."</option>\n";
                    }
                    ?>
                </select>
            </div>
            <div class="form-text" id="basic-addon4">Select Task Type</div>
        </div>

            <!-- Task Priority -->
                <div class="mb-3">
                        <!-- label for="basic-url" class="form-label">Task Parameters:</label -->
                        <div class="input-group">
                                <span class="input-group-text">Priority:</span>
                                <select name="task_priority" class="form-select" aria-label="Default select example">
                                        <?php 
                                        include("task_priorities.php");
                                        $task_priority = getTaskPriority($dbo);										
                                        $row_limit = count($task_priority);
                                        for ($row = 0; $row < $row_limit; $row++) {
                                            $selected = ($task_priority[$row][0] == 1) ? "selected" : " ";											
                                            echo "<option value='". $task_priority[$row][0] ."'>". $task_priority[$row][1] ."</option>\n";
                                        }
                                        ?>
                                </select>
                        </div>
                        <div class="form-text" id="basic-addon4">Select Priority</div>
                </div>
        <!-- Task Comments -->
        <div class="input-group">
            <span class="input-group-text">Task Comment</span>
            <textarea name="task_comment" class="form-control" aria-label="Comment"><?php echo $taskInfo->getTaskDescription(); ?></textarea>
        </div>
        <div id="task-confirm-btn" class="col-auto">
            <button type="submit" class="btn btn-primary mb-3">Save</button>
        </div>
    </form>
</div>
<?php 
else: 
    echo "<a href='login.php'></a>";
endif; 
?>