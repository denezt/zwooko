<?php
session_start();
$logged_in = $_SESSION["logged_in"];
$page_name = "home";
include("model/configuration.php");
include("view/navigator.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title><?php echo $app["name"]; ?> | <?php echo $route[$page_name]["name"];?></title>
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="view/images/favicon.ico" />
    <!-- Core theme CSS (includes Bootstrap) -->
    <link href="view/css/styles.css" rel="stylesheet" />
    <script src="js/frontend.js"></script>
</head>
<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div class="border-end bg-white" id="sidebar-wrapper">
            <div class="sidebar-heading border-bottom bg-light">
                <a href='<?php echo $route["home"]["route"];?>'><?php echo $app["name"];?></a>
            </div>
            <div class="list-group list-group-flush">
                <a class="list-group-item list-group-item-action list-group-item-light p-3" href="#!">Dashboard</a>
                <a class="list-group-item list-group-item-action list-group-item-light p-3" href="#!">Shortcuts</a>
                <a class="list-group-item list-group-item-action list-group-item-light p-3" href="#!">Overview</a>
                <a class="list-group-item list-group-item-action list-group-item-light p-3" href="#!">Events</a>
                <a class="list-group-item list-group-item-action list-group-item-light p-3" href="#!">Profile</a>
                <a class="list-group-item list-group-item-action list-group-item-light p-3" href="#!">Status</a>
            </div>            
        </div>
        <!-- Page content wrapper -->
        <div id="page-content-wrapper">
            <!-- Page content -->
            <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
                <div class="container-fluid">
                    <button class="btn btn-primary" id="sidebarToggle">Toggle Menu</button>                    
                </div>                
            </nav>
            <h1 class="mt-4">Welcome to <?php echo $app["name"];?></h1>
        </div>
    </div>
    <!-- Bootstrap core JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS -->
    <script src="js/scripts.js"></script>
</body>
</html>
