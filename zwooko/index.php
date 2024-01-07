<?php
session_start();
$logged_in = $_SESSION["logged_in"];
$page_name = "home";
include("controller/PageInfo.php");
include("controller/Router.php");
include("model/configuration.php");
include("view/navigator.php");

$pageTitle = (ucfirst($_GET["route"])) ? ucfirst($_GET["route"]) : "Main";
$route = (ucfirst($_GET["route"])) ? ucfirst($_GET["route"]) : "Main";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes" />
    <title><?php echo $config["app"]["name"]; ?> | <?php echo $pageTitle; ?></title>
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="view/images/favicon.ico" />
    <!-- Core theme CSS (includes Bootstrap) -->
    <link href="view/css/styles.css" rel="stylesheet" />
    <link href="view/css/zwooko.css" rel="stylesheet" />
    <!-- Bootstrap core JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS -->
    <script src="js/scripts.js"></script>
</head>
<body id="app-logo">
    <div class="d-flex terminal-bg" id="wrapper">
        <!-- Sidebar -->
        <div class="border-end bg-white terminal-bg" id="sidebar-wrapper">
            <div id="app-logo" class="sidebar-heading border-bottom">
                <a id="app-logo" href="/?route=dashboard" ><?php echo $config["app"]["name"]; ?></a>
            </div>
            <div id="app-logo" class="list-group list-group-flush">
                <?php if ($logged_in == true){ ?>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="?route=dashboard">Dashboard</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="?route=tasks">Task Management</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="?route=queue">Queue</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="?route=archives">Recently Archived</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="?route=search_archives">Search Archives</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="?route=profile">Profile</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="controller/logout_user.php">Log Out</a>
                <?php } else { ?>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="view/login.php">Login</a>
                <?php } ?>
	        </div>
        </div>
        <!-- Page content wrapper -->
        <div id="page-content-wrapper">
            <!-- Page content -->
            <nav id="app-logo" class="navbar navbar-expand-lg navbar-light border-bottom">
                <div class="container-fluid">
                    <button class="btn btn-primary" id="sidebarToggle">Toggle Menu</button>
                </div>
            </nav>
            <!-- sidebar route container -->
            <center>
                    <img id="app-logo-img" src=<?php echo $config["app"]["logo"]; ?>><br/>
                    <h5>
                    <?php
                        $_route = explode("_", $route);
                        $_route = implode(" ", $_route);
                        if ($config["app"]["debug"]){
                            echo "Application: " . $_route . "<br/>"; 
                        }
                    ?></h5>
                    <?php if ($logged_in == false){ ?>
                        <button type="button" onClick="openLoginScreen();" class="btn btn-secondary" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Tooltip on top">Log into Server</button>
                    <?php } ?>
                    <?php
                        $currRoute = $_GET["route"];
                        $router = new Router();
                        $route = $router->getRouter($currRoute);
                        include($config["app"][$route]);
                    ?>
            </center>        
        </div>
    </div>
    
</body>
</html>
