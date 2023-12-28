<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'head.php' ?>
    <title>About | Spartan Marketplace</title>
</head>
<body class="aboutPage">
    <?php 
        $page = 'About'; include 'navbar.php' ?>
    <div class="main-about">

        <div class="featured-work">
            <h2 style="color:#fff;text-align:center;margin-bottom:1em">About the Spartan Marketplace<h2>
            <p class="work-info">Our Marketplace is the one where you can find products related to different industries. We are known to provide quality products to the customers by meeting their needs. Currently, our products are from travel industry and Software industry. Travel products include the packages from GTS Tours and Globetrotter companies that take you to places like Australia, USA etc. There are so many attractive packages which you will be tempted to choose from and these are available at a cheaper rates. As said, we also offer Software company products which you find very useful for your needs. The software products from Softsol comapany include products like Bookings, Browser, Code Editor, etc. These tools/products are designed and developed with great features and the performance of these products is exhilarating.</p>
        </div>

        <div class="row container mt-3 mb-5 justify-content-end">
            <div class=" col-3 card mx-3" style="width:250px;background: #154c79;color:#fff">
                <img class="card-img-top" src="../img/Careers_img.svg" alt="Career image" style="width:100%">
                <div class="card-body">
                    <h4 class="card-title">Careers</h4>
                    <p class="card-text">Start a five star career with meaningful opportunities, engaging learning programs, and a rich culture.</p>
                </div>
            </div>
            <div class=" col-3 card mx-3" style="width:250px;background: #154c79;color:#fff">
                <img class="card-img-top" src="../img/Newsroom.svg" alt="Newsroom image" style="width:100%">
                <div class="card-body">
                    <h4 class="card-title">Newsroom</h4>
                    <p class="card-text">News and information about the Spartan Marketplace, our people, and products.</p>
                </div>
            </div>
            <div class=" col-3 card mx-3" style="width:250px;background: #154c79;color:#fff">
                <img class="card-img-top" src="../img/InvestorRelations.svg" alt="InvestorRelations image" style="width:100%">
                <div class="card-body">
                    <h4 class="card-title">Investor Relations</h4>
                    <p class="card-text">Get all the financial information you’re looking for about Spartan Marketplace.</p>
                </div>
            </div>
            <div class=" col-3 card mx-3" style="width:250px;background: #154c79;color:#fff">
                <img class="card-img-top" src="../img/TrustSafety.svg" alt="TrustSafety image" style="width:100%">
                <div class="card-body">
                    <h4 class="card-title">Trust & Safety</h4>
                    <p class="card-text">Learn how Spartan Marketplace works hard to maintain our community's trust, and make the platform helpful for everyone.</p>
                </div>
            </div>
        </div>
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