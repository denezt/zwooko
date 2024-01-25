<?php
include("controller/AccountInfo.php");
$accountInfo = new AccountInfo();
echo "Project Settings";
?>

<div class="ticket-container">
	<form method="get" action="controller/save_settings.php">
		<div class="container text-center">
			<!-- Start First Row -->
			<div class="row">
				<div class="col">
					<!-- User ID Information -->
					<!-- div class="input-group mb-3" style="visibility: hidden;" -->
					<div class="input-group mb-3">
						<span class="input-group-text" id="basic-addon1">Project Name: </span>
						<input name="project_name" type="text" class="form-control" placeholder="Task ID" aria-label="TaskId"
						aria-describedby="basic-addon1" value="">
					</div>
				</div>
			</div>
        </div>
    </form>
</div>    