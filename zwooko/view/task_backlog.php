<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes" />
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
		<link rel="stylesheet" href="view/css/styles.css">
		<link rel="stylesheet" href="view/css/zwooko.css">
		<style>
			.queue-progress {
				border: 1px solid lightgray;
				width: 80%;
			}
			.task-type {
				border-radius: 1px 0 3px 4px;
			}
			.loading-message {
				margin-top: 5%;
				color: darkgray;
			}
		</style>
		<script>
			let update_counter = 1;
			let update_progress = 0;
			let timerSet1;
			function changeProgressBar(new_progress){
				let progressBar = document.getElementById("progress-bar");
				if (update_progress < 100){
					progressBar.style.width = `${new_progress}%`;
				}
			}

			function updateProgressBar(){
				if (update_progress <= 100){
					timerSet1 = setInterval(function () {	
						update_progress = update_progress+10;
						changeProgressBar(update_progress);
					}, 100);
				} else {
					clearInterval(timerSet1);
				}
			}

			function loadQueue() {
				var xhttp = new XMLHttpRequest();
				xhttp.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
						document.getElementById("content").innerHTML = this.responseText;
					}
				};
				xhttp.open("GET", "view/backlog_screen.php", true);
				xhttp.send();
			}
			try {
				clearInterval(timerSet2);				
			} catch (error) {
				console.log(error.message);
			}
			timerSet2 = setInterval(function () {	
				loadQueue();
				// console.log(`Updating, Queue: ${update_counter}`);
				update_counter++;
			}, 1500);	
		</script>
	</head>
	<body onload="updateProgressBar();">
		<div class="main-container">
			<div id="content">
				<span class='loading-message'>Loading, Queue...</span>
				<div class="progress queue-progress" role="progressbar" aria-label="Success striped example" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
					<div id="progress-bar" class="progress-bar progress-bar-striped bg-success"></div>
				</div>
			</div>
		</div>
	</body>
</html>