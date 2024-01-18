<?php
exec("uuidgen", $_result);
$uuid = $_result[0];
// Load the Database Object code
include("model/database.php");
// Create the PDO
$dbo = new DataBaseConnector();

include("controller/Asset.php"); 
$asset = new Asset($dbo);

include("controller/UserManager.php"); 
$userMgr = new UserManager($dbo);

// Load the AccountInfo Object code
include("controller/AccountInfo.php");
$accountInfo = new AccountInfo();
$username = $accountInfo->getUsername();
?>

<div class="ticket-container">
	<form method="get" action="controller/save_ticket.php">
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
			<!-- Start Second Row -->
			<div class="row">
				<div class="col">
					<!-- Summary -->
					<div class="mb-3">
						<div class="input-group mb-3">
							<!-- <span class="input-group-text" id="basic-addon2">Summary:</span> -->
							<input name="summary" type="text" class="form-control" placeholder="Summary" aria-label="Task Summary" aria-describedby="basic-addon2">
						</div>
					</div>
				</div>
			</div>
			<!-- End Second Row -->
			<!-- Start Third Row -->
			<div class="row">
				<div class="col">
					<!-- Task Creator -->
					<div class="input-group mb-3">
						<span class="input-group-text" id="basic-addon2">Creator:</span>
						<input name="username" type="text" class="form-control" placeholder="Username" aria-label="Recipient's username" aria-describedby="basic-addon2" value=<?php echo $username; ?> readonly>
					</div>
				</div>
				<div class="col">
					<!-- Task Assignee -->
					<div class="mb-3">
						<div class="input-group">
							<span class="input-group-text">Assignee:</span>
							<select name="assignee_id" class="form-select" aria-label="Default select example">
							<?php
								foreach ($userMgr->getAllUsers() as $val){
									echo "<option value='". $val['id']. "'>".$val['name']."</option>";
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
								foreach ($asset->getAssetName() as $val){
									echo "<option value='". $val['id']. "'>".$val['name']."</option>";
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
								$task_status = getTaskStatus($dbo);
								$row_limit = count($task_status);
								for ($row = 0; $row < $row_limit; $row++) {
									$selected = ($task_status[$row][0] == 1) ? "selected" : " ";
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
								include("task_options.php");
								$task_options = getTaskOption($dbo);
								$row_limit = count($task_options);
								for ($row = 0; $row < $row_limit; $row++) {
									$selected = ($task_options[$row][0] == 1) ? "selected" : " ";
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
						<textarea name="task_comment" class="form-control" aria-label="Comment"></textarea>
					</div>
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
