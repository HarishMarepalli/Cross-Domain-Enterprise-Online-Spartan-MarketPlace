<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'head.php' ?>
    <title>News | Spartan Marketplace</title>
</head>
<body class="newsPage">
    <?php $page='News'; include 'navbar.php' ?>
    <div class="newsContainer">
        <p class="newsText1">Deals started this holiday season!!!</p>
        <p class="newsText2">Go to products page to explore more</p>
        <div class="exploreContainer">
            <a 
                    class="exploreBtn"
                    id="scrollBtn1"
                    href="../includes/products.php"
            >Explore Now</a>
        </div>
    </div>
</body>