<?php
include("../model/database.php");

$asset = $_POST["asset"];
$id = $_POST["id"];
$type = $_POST["type"];
$name = $_POST["name"];
$description = $_POST["description"];
$status_id = $_POST["status_id"];

try {
    $query = "insert into task ";
    $query .= "(`name`,`type_id`,`uuid`,`description`,`status_id`,`asset_id`,`user_id`) ";
    $query .= "values (\"$name\", $type, \"$id\", \"$description\", $status_id, $asset, 1)";
    $dbo->exec($query);
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
