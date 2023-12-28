<?php 
    session_start();
    ob_start();
    include_once 'dbconnect.php';
    $_SESSION["last_login_timestamp"] = time();
    $_SESSION["isAdmin"] = false;
    //$_SESSION["isSecure"] = false;
     if (isset($_POST["Login"]) && !empty($_POST["Username"]) && !empty($_POST["Password"]))
     {
        //Admin Login Validation
        /*$userfile = fopen("../txt/admins.txt", "r");
        while(($line=fgets($userfile))!==false)
        {
            $line = rtrim($line,"\r\n");
            $user = explode(",", $line);
            if ($_POST["Username"]==$user[0]  && $_POST["Password"]==$user[1])
            {
                $_SESSION["user"] = $_POST["Username"];
                $_SESSION["isAdmin"] = true;
                //$_SESSION["isSecure"] = true;
                $_SESSION["adminUserName"] = $_SESSION["user"];
                fclose($userfile);
                header("location: securesection.php");
                exit;
            }
        }*/

        //Public user Login Validation
        $sql = "SELECT userName,AES_DECRYPT(passwd, 'secretkey') AS passwd FROM UsersList";
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($result))
        {
            if($_POST["Username"] == $row["userName"] && $_POST["Password"] == $row["passwd"])
            {
                $_SESSION["user"] = $_POST["Username"];
                $_SESSION["isAdmin"] = false;
                header("location: publicsecuresection.php");
                exit;
            }
        }
        header("location: ../index.php?errmsg=0");
        $_SESSION["errmessage"] = "Invalid UserName or Password";
        exit;
     }
    else
    {
        header("location: ../index.php?errmsg=0");
        $_SESSION["errmessage"] = "Invalid UserName or Password";
    }
?>