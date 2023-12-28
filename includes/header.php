<?php
    $timeoutInSec = 600;
        ob_start();
            if (!isset($_SESSION["user"])){
                header("location:../index.php");
                exit;
            }
            else if(isset($_SESSION['user']) && (time() - $_SESSION["last_login_timestamp"] > $timeoutInSec))
            {
                session_unset(); 
                session_destroy();
                header("location:../index.php?errmsg=1");
                exit;
            }
        ?>