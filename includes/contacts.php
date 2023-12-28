<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'head.php' ?>
    <title>Contact Us | GTS Tours</title>
</head>
<body class="contactsPage">
    <?php $page='Contact'; include 'navbar.php' ?>
    <div class="main-contacts">
        <p class="contact-info">
            <?php
                $contacts = fopen("../txt/contacts.txt", "r");
                while(($line=fgets($contacts))!==false)
                {
                    echo $line;
                    echo "<br/>";
                }
                fclose($contacts);
            ?>
        </p>
    </div>

    <footer class="footerContainer">
        <div class="container-fluid">
            <a class="footerImage" href="../index.php">
                <img src="../img/Spartan_Marketplace_Icon.svg" alt="Spartan_Marketplace_Logo" style="width:15em;"> 
            </a>
        </div>
        <div class="footerContentContainer">
            <div class="locationContainer">
                <h4 class="locationText">Head Quarters</h4>
                <p class="locations">San Jose</p>
                <p class="locations">San Francisco</p>
            </div>
            <div class="footerContacts">
                <h4 class="contactsText">Contact Us</h4>
                <p class="emailId">spartanmarketplace272@gmail.com</p>
                <p class="phnNo">(925)733-9906</p>
            </div>
        </div>
    </footer>
</body>