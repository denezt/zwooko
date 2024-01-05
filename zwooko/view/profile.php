<?php
include("controller/AccountInfo.php");
$accountInfo = new AccountInfo();
$username = $accountInfo->getUsername();
$userid = $accountInfo->getId();
?>
<!DOCTYPE html>
<html>
    <head>
        <style>
            .div-beautifier {
                padding: 40px;
                border-radius: 10px;
            }
        </style>
    </head>
    <body>
        <div class="div-beautifier shadow-lg col-md-3">
            <div class="text-center border-end">
                <img src="../images/zwooko_logo_0002.png" class="img-fluid avatar-xxl rounded-circle" alt="">
                <h4 class="text-primary font-size-20 mt-3 mb-2">Username: <?php echo $username; ?></h4>
                <h5 class="text-muted font-size-13 mb-0">UserID: <?php echo $userid; ?></h5>
            </div>
        </div><!-- end col -->
    </body>
</html>
