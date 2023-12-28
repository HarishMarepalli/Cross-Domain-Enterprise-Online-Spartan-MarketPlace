<?php
    session_start();
    include_once 'includes/dbconnect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'includes/head.php' ?>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/animate.css">
    <title>GTS Tours | Travel With Us</title>
</head>
<body>
    <?php 
        if(isset($_GET["errmsg"]))
        if($_GET["errmsg"] == 0)
        {
            echo "
            <div class='alert alert-danger alert-dismissible fade show'>
            <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
            <strong>Error : </strong> Invalid Username or Password
            </div>
            <script>window.history.replaceState(null, '', '/index.php')</script>
            ";
        }
        else if($_GET["errmsg"] == 1)
        {
            echo "
            <div class='alert alert-info alert-dismissible fade show'>
            <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
            <strong>Info : </strong> Session Expired....Please Login Again
            </div>
            <script>window.history.replaceState(null, '', '/index.php')</script>
            ";
        }
        else if($_GET["errmsg"] == 2)
        {
            echo "
            <div class='alert alert-danger alert-dismissible fade show'>
            <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
            <strong>Error : </strong> Invalid FirstName
            </div>
            <script>window.history.replaceState(null, '', '/index.php')</script>
            ";
        }
        else if($_GET["errmsg"] == 3)
        {
            echo "
            <div class='alert alert-danger alert-dismissible fade show'>
            <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
            <strong>Error : </strong> Invalid LastName
            </div>
            <script>window.history.replaceState(null, '', '/index.php')</script>
            ";
        }
        else if($_GET["errmsg"] == 4)
        {
            echo "
            <div class='alert alert-danger alert-dismissible fade show'>
            <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
            <strong>Error : </strong> Invalid Email ID
            </div>
            <script>window.history.replaceState(null, '', '/index.php')</script>
            ";
        }
        else if($_GET["errmsg"] == 5)
        {
            echo "
            <div class='alert alert-danger alert-dismissible fade show'>
            <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
            <strong>Error : </strong> Invalid Home Phone Number
            </div>
            <script>window.history.replaceState(null, '', '/index.php')</script>
            ";
        }
        else if($_GET["errmsg"] == 6)
        {
            echo "
            <div class='alert alert-danger alert-dismissible fade show'>
            <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
            <strong>Error : </strong> Invalid Cell Phone Number
            </div>
            <script>window.history.replaceState(null, '', '/index.php')</script>
            ";
        }
        else if($_GET["errmsg"] == 7)
        {
            echo "
            <div class='alert alert-danger alert-dismissible fade show'>
            <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
            <strong>Error : </strong> Please fill all fields of the Signup Form in correct manner.
            </div>
            <script>window.history.replaceState(null, '', '/index.php')</script>
            ";
        }
        else if($_GET["errmsg"] == 8)
        {
            echo "
            <div class='alert alert-danger alert-dismissible fade show'>
            <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
            <strong>Error : </strong> User already exists...
            </div>
            <script>window.history.replaceState(null, '', '/index.php')</script>
            ";
        }
    ?>
    <?php $page='Home';
    include 'includes/navbar.php' ?>

    <?php $page='Home'; include 'includes/home.php' ?>
    <?php include 'includes/login.php' ?>
</body>
</html>
