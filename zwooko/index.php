<?php
session_start();
$logged_in = $_SESSION["logged_in"];
$page_name = "home";
include("controller/PageInfo.php");
include("controller/Router.php");
include("controller/SidebarNavigator.php");
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
    <script src="js/project_frontend.js"></script>
</head>
<body id="app-logo">
    <div class="d-flex terminal-bg" id="wrapper">
        <!-- Sidebar -->
        <div class="border-end bg-white terminal-bg" id="sidebar-wrapper">
            <div id="app-logo" class="sidebar-heading border-bottom">
                <a id="app-logo" href="/?route=dashboard" ><?php echo $config["app"]["name"]; ?></a>
            </div>
            <div id="app-logo" class="list-group list-group-flush">
                <?php
                if ($logged_in == true){
                    // Add new elements to Side Navigation Bar
                    $arrList = [
                        "?route=dashboard" => "Dashboard",
                        "?route=tasks" => "Task Management",
                        "?route=queue" => "Queue",
                        "?route=backlog" => "Backlog",
                        "?route=archives" => "Recently Archived",
                        "?route=search_archives" => "Search Archives",
                        "?route=project_settings" => "Project Settings",
                        "?route=profile" => "Profile",
                        "controller/logout_user.php" => "Log Out",
                    ];
                    $activate_route = strtolower($route);
		            $route_request = "?route=" . $activate_route;

                    // Remove the activate page from list
                    // $arrList = array_diff($arrList, [$arrList[$route_request]]);
                    $sbNavMain = new SidebarNavigator($arrList);
                    $sbNavMain->displayNavData($activate_route);
                } else {
                    $arrList = [ "view/login.php" => "Login" ];
                    $activate_route = "login";
                    $sbNavLogin = new SidebarNavigator($arrList);
                    $sbNavLogin->displayNavData($activate_route);
                }
                ?>
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
