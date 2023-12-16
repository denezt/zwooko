<?php
exec("uuid", $_result);
$uuid = $_result[0];

include("controller/AccountInfo.php");
$accountInfo = new AccountInfo();
$username = $accountInfo->getUsername();
?>
<div class="ticket-container">
	<form method="get" action="controller/save_ticket.php">
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
  			<input name="username" type="text" class="form-control" placeholder="Username" aria-label="Recipient's username" aria-describedby="basic-addon2" value=<?php echo $username; ?> readonly>
		</div>

		<!-- Summary -->
		<div class="input-group mb-3">
  			<span class="input-group-text" id="basic-addon2">Summary:</span>
  			<input name="summary" type="text" class="form-control" placeholder="Summary" aria-label="Task Summary" aria-describedby="basic-addon2">
		</div>

		<!-- Task Type -->
		<div class="mb-3">
			<!-- label for="basic-url" class="form-label">Task Parameters:</label -->
 			<div class="input-group">
        	       	 	<span class="input-group-text">Type:</span>
				<select name="task_type" class="form-select" aria-label="Default select example">
  					<option selected>Open this select menu</option>
					<?php include("task_options.php"); ?>
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
                                        <option selected>Open this select menu</option>
                                        <?php include("task_priorities.php"); ?>
                                </select>
                        </div>
                        <div class="form-text" id="basic-addon4">Select Priority</div>
                </div>
		<!-- Task Comments -->
		<div class="input-group">
			<span class="input-group-text">Task Comment</span>
			<textarea name="task_comment" class="form-control" aria-label="Comment"></textarea>
		</div>
		<div class="col-auto">
			<button type="submit" class="btn btn-primary mb-3">Save</button>
		</div>
	</form>
</div>
