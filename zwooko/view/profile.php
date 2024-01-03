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
            table {
                text-align: right;
            }
        </style>
    </head>
    <body>
        <table>
            <tr>
                <td>ID:</td>
                <td><?php echo $userid; ?></td>
            </tr>    
            <tr>                
                <td>Username: </td>
                <td><?php echo $username; ?></td>
            </tr>           
        </table>
    </body>
</html>
