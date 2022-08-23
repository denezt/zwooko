<?php 
session_start();
$_SESSION = array();
session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Logout Screen</title>
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Core theme CSS (includes Bootstrap) -->
    <link href="view/css/styles.css" rel="stylesheet" />
    <script>
      function changePage(){
        location.replace("../");
      }
      function redirectPage(){
        setTimeout(changePage,1500);
      }
    </script>
</head>
<body onload="redirectPage();">
    <center>  
        <div id="message">
            <h1>Logging out of Application</h1>
            <div class="d-flex" id="wrapper">    
                <a href="../">Click here if not redirected...</a>
            </div>
        </div>
    </center>
</body>
</html>
