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

include("controller/UserManager.php");
$userMgr = new UserManager($dbo);

// Load the AccountInfo Object code
include("controller/AccountInfo.php");
$accountInfo = new AccountInfo();
$username = $accountInfo->getUsername();
$is_logged_in = (!empty($username)) ? true : false;
$is_uuid_present = (!empty($uuid)) ? true : false;

// Form Features
$add_comments = false;

?>
<?php if ($is_uuid_present && $is_logged_in): ?>
<script>
    function checkDate(){
        let start_date = document.getElementById("start_date");
        let due_date = document.getElementById("due_date");		
        // alert(`Value[start_date]: ${start_date.value}, is_nan: ${isNaN(start_date.value)}, typeof: ${typeof(start_date.value)}`);
        // alert(`Value[due_date]: ${due_date.value}, is_nan: ${isNaN(due_date.value)}, typeof: ${typeof(due_date.value)}`);
        // Check if any value is missing
        let dates_available = ((isNaN(start_date.value) == false) || (isNaN(due_date.value) == false)) ? false : true;
        if (dates_available == false){
            let a = (isNaN(start_date.value) == false) ? document.getElementById("start_date").focus() : " ";
            alert("Error: Missing dates!");
        }
        return dates_available;
    }
</script>    
<h5>Update Entry</h5>
<div class="ticket-container">
    <form method="get" onsubmit="return checkDate();" action="controller/modify_ticket.php">
        <div class="container text-center">
            <!-- Start First Row -->
            <div class="row">
                <div class="col">
                    <!-- User ID Information -->
                    <!-- div class="input-group mb-3" style="visibility: hidden;" -->
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Task ID: </span>
                        <input name="task_id" type="text" class="form-control" placeholder="Task ID" aria-label="TaskId"
                            aria-describedby="basic-addon1" value=<?php echo $uuid;?> readonly>
                    </div>
                </div>
            </div>
            <!-- End First Row -->
            <div class="row">
                <div class="col"></div>
            </div>
            <!-- Start Second Row -->
            <div class="row">
                <div class="col">
                    <!-- Summary -->
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon2">Summary:</span>
                        <input name="summary" type="text" class="form-control" placeholder="Summary"
                            aria-label="Task Summary" aria-describedby="basic-addon2"
                            value="<?php echo $taskInfo->getTaskName(); ?>">
                    </div>
                </div>
            </div>
            <!-- End Second Row -->
			<!-- Start New Row A -->
			<div class="row">
				<div class="col">
					<!-- Start Date -->
					<div class="mb-6">
						<div class="input-group mb-3">
							<span class="input-group-text" id="basic-addon2">Start Date:</span>
							<input id="start_date" name="start_date" type="date" class="form-control" aria-label="Start Date" 
                                aria-describedby="basic-addon2" value="<?php  
                                $start_date = $taskInfo->getTaskStartDate(); 
                                $start_date = explode(" ", $start_date);
                                echo $start_date[0];
                                ?>">
						</div>
					</div>
				</div>
				<div class="col">
					<!-- Due Date -->
					<div class="mb-6">
						<div class="input-group mb-3">
							<span class="input-group-text" id="basic-addon2">Due Date:</span>
							<input id="due_date" name="due_date" type="date" class="form-control" aria-label="Due Date" 
                                aria-describedby="basic-addon2" value="<?php 
                                $due_date = $taskInfo->getTaskDueDate(); 
                                $due_date = explode(" ", $due_date);
                                echo $due_date[0];?>">
						</div>
					</div>
				</div>		
			</div>
			<!-- End New Row A -->             
            <!-- Start Third Row -->
            <div class="row">
                <div class="col">
                    <!-- Username -->
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon2">Creator:</span>
                        <input name="username" type="text" class="form-control" placeholder="Username"
                            aria-label="Recipient's username" aria-describedby="basic-addon2"
                            value=<?php echo $username; ?> readonly>
                    </div>
                </div>
                <div class="col">
                    <!-- Task Assignee -->
                    <div class="mb-3">
                        <div class="input-group">
                            <span class="input-group-text">Assignee:</span>
                            <select name="assignee_id" class="form-select" aria-label="Default select example">
                                <?php
                                $currentAssignee = $taskInfo->getTaskAssigneeId();
                                foreach ($userMgr->getAllUsers() as $assignee){
                                    $selected = ($assignee['id'] == $currentAssignee) ? "selected" : " ";
                                    echo "<option value='". $assignee['id']. "' $selected>".$assignee['name']."</option>";
                                }
                            ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Third Row -->

            <!-- Start Fourth Row -->
            <div class="row">
                <div class="col">
                    <!-- Product -->
                    <div class="mb-3">
                        <div class="input-group">
                            <span class="input-group-text">Product:</span>
                            <select name="product" class="form-select" aria-label="Default select example">
                                <?php
                                include("task_assets.php");
                                $currentAsset = $taskInfo->getTaskAssetId();
                                $task_asset = getTaskAssetsId($dbo);
                                $row_limit = count($task_asset);
                                for ($row = 0; $row < $row_limit; $row++) {
                                    $selected = ($task_asset[$row][0] == $currentAsset) ? "selected" : " ";
                                    echo "<option value='". $task_asset[$row][0] ."' $selected>". $task_asset[$row][1] ."</option>\n";
                                }
                            ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col">
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
                    </div>
                </div>
            </div>
            <!-- End Fourth Row -->

            <!-- Start Fifth Row -->
            <div class="row">
                <div class="col">
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
                    </div>
                </div>
                <div class="col">
                    <!-- Task Priority -->
                    <div class="mb-3">
                        <!-- label for="basic-url" class="form-label">Task Parameters:</label -->
                        <div class="input-group">
                            <span class="input-group-text">Priority:</span>
                            <select name="task_priority" class="form-select" aria-label="Default select example">
                                <?php
                                    $currentPriority = $taskInfo->getTaskPriorityId();                           
                                    include("task_priorities.php");
                                    $task_priority = getTaskPriority($dbo);
                                    $row_limit = count($task_priority);
                                    for ($row = 0; $row < $row_limit; $row++) {
                                        echo trim($task_priority[$row][0]);
                                        $selected = ($task_priority[$row][0] == $currentPriority) ? "selected" : " ";
                                        echo "<option value='". $task_priority[$row][0] ."' $selected>". $task_priority[$row][1] ."</option>\n";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Fifth Row -->

            <!-- Start Sixth Row -->
            <div class="row">
                <div class="col">
                    <!-- Task Comments -->
                    <div class="input-group">
                        <span class="input-group-text">Task Comment</span>
                        <textarea name="task_comment" class="form-control"
                            aria-label="Comment"><?php echo $taskInfo->getTaskDescription(); ?></textarea>
                    </div>
                </div>&nbsp;
                <!-- -->
                <div>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Task Comments</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">

                                    <?php
				                    $arrListComments = ['1' => 'My First Comment', '42' => 'The Universal Answer'];
				                    $arrListKeys = array_keys($arrListComments);
				                    foreach ($arrListKeys as $arrKey){ ?>
                                    <?php
                                    $editKey = "?edit_task=".$arrKey;
                                    $removeKey = "?remove_task=".$arrKey;
				                    ?>
                                    <textarea readonly="readonly"><?php echo $arrListComments[$arrKey];?></textarea><br>
                                    <a href=<?php echo $editKey;?>>Edit</a>&nbsp;
                                    <a href=<?php echo $removeKey;?>>Remove</a>
                                    <br />
                                    <?php } ?>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <!-- Button to trigger modal -->
                    <?php if ($add_comments): ?>
                    <button type="button" class="btn btn-primary" id="openModalButton">Open All Comments</button>
                    <?php endif; ?>                    
                </div>
            </div>
            <!-- End Sixth Row -->
            <!-- Start Seventh Row -->
            <div class="row">
                <div class="col">
                    <div id="task-confirm-btn" class="col-auto">
                        <button type="submit" class="btn btn-primary mb-3">Save</button>
                    </div>
                </div>
            </div>
            <!-- End Seventh Row -->
        </div>
    </form>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const myModal = new bootstrap.Modal(document.getElementById('exampleModal'), {
        keyboard: false
    });

    document.getElementById('openModalButton').addEventListener('click', function() {
        myModal.show();
    });
});
</script>


<?php
else:
    echo "<a href='login.php'></a>";
endif;
?>