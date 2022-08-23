<?php
include("../model/database.php");

$asset = $_POST["asset"];
$uuid = $_POST["uuid"];
$type = $_POST["type"];
$name = addslashes($_POST["name"]);
$description = addslashes($_POST["description"]);
$status_id = $_POST["status_id"];


$query = "update task set ";
$query .=  "`status_id` = ". $status_id . ",`asset_id` = $asset ,`type_id` = $type,`name` = '$name',`description` = '$description' where uuid = '$uuid'";

try {
  $dbo->exec($query);
} catch (PDOException $ex) {
  echo "Error: ". $ex->getMessage() . "<br />";
  die("Problem accessing database!");
}

?>
<!DOCTYPE html>
<html>
  <head>
    <script>
      function changePage(){
        location.replace("../view/queue.php");
      }
      function redirectPage(){
        setTimeout(changePage,500);
      }
    </script>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../view/images/favicon.ico" />
    <!-- Core theme CSS (includes Bootstrap) -->
    <link href="../view/css/styles.css" rel="stylesheet" />
    <title>Creating Session: [<?php echo mt_rand(); ?>]</title>
    <style>
      .main-message{
        margin-top:5%;        
      }
    </style>
  </head>
  <body onload="redirectPage();">
    <div class="main-message">
      <div class="container-md">
        <center>
          <div class="alert alert-info" role="alert">Updating, Task Informations</div>
        </center>
      </div>
    </div>
  </body>
</html>    
