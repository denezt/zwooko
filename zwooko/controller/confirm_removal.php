<?php
session_start();
$logged_in = $_SESSION["logged_in"];
require("../model/configuration.php");
include("../model/routes.php");
require("../model/database.php");
include("../view/sidebar.php");
include("../view/navigator.php");
require("TaskInfo.php");
$page_name = "Removing Issue";
$next_page = '../view/queue.php';
$taskUuid = $_GET["issue_uuid"];
$taskInfo = new TaskInfo($taskUuid);
$taskInfo->deleteTaskFromTable($dbo);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title><?php echo $app["name"]; ?> | <?php echo $page_name;?></title>
  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="../view/images/favicon.ico" />
  <!-- Core theme CSS (includes Bootstrap) -->
  <link href="../view/css/styles.css" rel="stylesheet" />
  <style>
  #task_id {
    width:100%;
  }
  </style>
  <script>
  function createUUID() {
    return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
      var r = Math.random() * 16 | 0, v = c == 'x' ? r : (r & 0x3 | 0x8);
      return v.toString(16);
    });
  }
  function reloadPage(){
    var timer = setTimeout(function() {
      window.location = '<?php echo $next_page;?>'
    }, 3000);
  }
  </script>
</head>
<body onload="reloadPage();">
  <div class="d-flex" id="wrapper">
    <!-- Sidebar -->
    <div class="border-end bg-white" id="sidebar-wrapper">
      <div class="sidebar-heading border-bottom bg-light">
        <!-- Routing Table -->
        <a href='<?php echo $route["home"]["route"];?>'><?php echo $app["name"];?></a>
      </div>
      <?php
      $sidebar = new SideBar($logged_in);
      $sidebar->getRoutesEmpty($page_name, $no_route);
      ?>
    </div>
    <!-- Page content wrapper -->
    <div id="page-content-wrapper">
      <!-- Top navigation -->
      <?php
      $navigator = new Navigator($logged_in);
      $navigator->showNavigatorFromProfile();
      ?>
      <!-- Page content -->
      <div class="container-fluid">
        <p class="fs-1">Removing Issue</p>
        <?php if ($logged_in == "true"): ?>
          <div class="d-grid gap-2 col-6 mx-auto">
            <?php
            echo "<p class='fs-2'>Confirming Removal: " . $taskUuid . "</div>";
            ?>
          </div>
        <?php else: ?>
          <a href="login.php">User is not logged In</a>
        <?php endif; ?>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Core theme JS -->
  <script src="../js/scripts.js"></script>
</body>
</html>
