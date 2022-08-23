<?php
session_start();
$logged_in = $_SESSION["logged_in"];
$page_name = "home";
include("model/configuration.php");
include("model/routes.php");
include("view/sidebar.php");
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
            <?php
                $sidebar = new SideBar($logged_in);
                $sidebar->getRoutesFromIndex($page_name, $route);
            ?>
        </div>
        <!-- Page content wrapper -->
        <div id="page-content-wrapper">
            <!-- Top navigation -->
            <?php
                $navigator = new Navigator($logged_in);
                $navigator->showNavigatorFromIndex();
            ?>
            <!-- Page content -->
            <div class="container-fluid">
                <h1 class="mt-4">Welcome to <?php echo $app["name"];?></h1>
            </div>
        </div>
    </div>
    <!-- Bootstrap core JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS -->
    <script src="js/scripts.js"></script>
</body>
</html>
