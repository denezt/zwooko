<?php
session_start();
// $_SESSION["logged_in"] = "true";
$logged_in = $_SESSION["logged_in"];
if ("true" == $logged_in){
	include("add_ticket.php");
} 

?>
<html>
	<head>
		<style>
			.ticket-container {
				width: 80%;
			}
			.task-type {
				border-radius: 1px 0 3px 4px;
			}
		</style>
	</head>
	<body>
		<?php
		if ($logged_in != "true"):
			echo "<a href='view/login.php'>Login</a>";
		endif;
		?>
	</body>
</html>
