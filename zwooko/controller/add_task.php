<?php
include("../model/database.php");
include("../controller/AccountInfo.php");
$dbo = new DataBaseConnector();
$accountInfo = new AccountInfo();

$user_id = $accountInfo->getId();
$asset = $_POST["product"];
$id = $_POST["id"];
$type = $_POST["type"];
$name = $_POST["name"];
$description = $_POST["description"];
$status_id = $_POST["status_id"];

// task_id=7a432584-856e-4882-871f-d529ebf704f1&username=denezt&product=1&status=1&summary=&task_type=1&task_priority=1&task_comment=
try {
    $query = "insert into task ";
    $query .= "(`name`,`type_id`,`uuid`,`description`,`status_id`,`asset_id`,`user_id`) ";
    $query .= "values (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $dbo->prepare($sql);
    $stmt->execute([$summary, $type_id, $task_id, $task_comment, $status_id, $asset_id, $user_id]);

} catch (PDOException $ex) {
    // echo "Error: ". $ex->getMessage() . "<br />";
    die("Problem accessing database!");
}

?>
<!DOCTYPE html>
<html>
  <head>
    <script>
      function changePage(){
        location.replace("../view/task.php");
      }
      function redirectPage(){
        setTimeout(changePage,1500);
      }
    </script>
  <title>Creating Session: [<?php echo mt_rand(); ?>]</title>
  </head>
  <body onload="redirectPage();">
    <center>
      <?php echo $message_out; ?>
    </center>
  </body>
</html>
