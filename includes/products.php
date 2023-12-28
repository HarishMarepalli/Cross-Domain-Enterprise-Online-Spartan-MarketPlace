<?php session_start();  include_once 'dbconnect.php'; include 'topProducts.php'?>
<?php
    if(isset($_POST['save']))
    {
        $productID = intval($_POST['productID']);
        $companyID = $_POST['companyID'];
        $currUser = $_SESSION["user"];
        $givenRating = intval($_POST['rating']);

        /* $sql = "SELECT * FROM Ratings WHERE companyName = '".$companyID."' AND productID =".$productID." AND userName = '".$currUser."'";
        $result = mysqli_query($conn, $sql);
        $rows = mysqli_num_rows($result); */

        $result = $conn->query("SELECT * FROM Ratings WHERE companyName = '".$companyID."' AND productID =".$productID." AND userName = '".$currUser."'");
        $numOfrows = mysqli_num_rows($result);
        $row = $result -> fetch_assoc();

        $prev_rating = 0;
        if($numOfrows != 0)
            $prev_rating = $row['rating'] ;

        if($numOfrows != 0)
        {
            $sql = "UPDATE Ratings SET rating = '".$givenRating."' WHERE productID =".$productID." AND companyName = '".$companyID."' AND userName = '".$currUser."'";
            mysqli_query($conn, $sql);

            $result = $conn->query("SELECT * FROM Products where productId = ".$productID);
            $prod = $result -> fetch_assoc();
            $prc = $prod["productRatingCount"] ;
            $pr = $prod["productRating"] + $givenRating - $prev_rating;
            $pavgrating = $pr / $prc;
            $conn->query("UPDATE Products SET productAvgRating = ".$pavgrating.", productRating = ".$pr." WHERE productId = ".$productID);    
        
        }
        else
        {
            $sql = "INSERT INTO Ratings (userName,productID,companyName,rating) VALUES ('".$currUser."', ".$productID.", '".$companyID."', ".$givenRating.")";
            mysqli_query($conn, $sql);
            $result = $conn->query("SELECT * FROM Products where productId = ".$productID);
            $prod = $result -> fetch_assoc();
            $prc = $prod["productRatingCount"] + 1;
            $pr = $prod["productRating"] + $givenRating;
            $pavgrating = $pr / $prc;
            $conn->query("UPDATE Products SET productAvgRating = ".$pavgrating.", productRatingCount = ".$prc.", productRating = ".$pr." WHERE productId = ".$productID);    
        
        }

        // $conn->close();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'head.php' ?>
    <title>Products | Spartan Marketplace</title>
</head>
<body class="productsPage">
    <?php $page='Products'; include 'navbar.php' ?>
    <?php 
        /* if(isset($_SESSION["isSecure"]))
        {
            if($_SESSION["isSecure"])
            {
                echo "
                    <div class='container mt-6 viewContainer1'>
                        <a class='prev5ViewBtn animate__animated animate__zoomIn animate__delay-1' data-bs-toggle='modal' data-bs-target='#last5PrevModal'>View 5 Previously Visited Products</a>
                        <a class='yourTop5ViewBtn animate__animated animate__zoomIn animate__delay-1' data-bs-toggle='modal' data-bs-target='#yourTop5Modal'>View your Top 5 Viewed Products</a>
                        <a class='globalTop5ViewBtn animate__animated animate__zoomIn animate__delay-1' data-bs-toggle='modal' data-bs-target='#globalTop5Modal'>View Top 5 Globally Viewed Products</a>
                    </div>
                ";
            }
        } */
    ?>

    <div class="sidebar" id="side_nav">
        <div class="header-box"><i class="fa-solid fa-bars"></i></div>
        <div class="sidebarContent sideNavActive">
            <div class="closeBtnContainer">
                <h4 class="filterText">Filter the Products</h4>
                <button class="close-btn"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <ul class="dropdown-menu1 list-unstyled">
                <li class="itemList"><a class="item" data-bs-toggle='modal' data-bs-target='#MostVisMarketModal'>Most Visited in whole Marketplace</a></li>
                <li class="itemList"><a class="item" data-bs-toggle='modal' data-bs-target='#MostVisGTSToursModal'>Most Visited in GTSTours</a></li>
                <li class="itemList"><a class="item" data-bs-toggle='modal' data-bs-target='#MostVisSoftSolModal'>Most Visited in SoftSol</a></li>
                <li class="itemList"><a class="item" data-bs-toggle='modal' data-bs-target='#MostVisGlobetrotterModal'>Most Visited in Globetrotter</a></li>
                <hr class="mx-3">
                <li class="itemList"><a class="item" data-bs-toggle='modal' data-bs-target='#MostRevMarketModal'>Most Reviewed in whole Marketplace</a></li>
                <li class="itemList"><a class="item" data-bs-toggle='modal' data-bs-target='#MostRevGTSToursModal'>Most Reviewed in GTSTours</a></li>
                <li class="itemList"><a class="item" data-bs-toggle='modal' data-bs-target='#MostRevSoftSolModal'>Most Reviewed in SoftSol</a></li>
                <li class="itemList"><a class="item" data-bs-toggle='modal' data-bs-target='#MostRevGlobetrotterModal'>Most Reviewed in Globetrotter</a></li>
                <hr class="mx-3">
                <li class="itemList"><a class="item" data-bs-toggle='modal' data-bs-target='#MostRatMarketModal'>Highly Rated in whole Marketplace</a></li>
                <li class="itemList"><a class="item" data-bs-toggle='modal' data-bs-target='#MostRatGTSToursModal'>Highly Rated in GTSTours</a></li>
                <li class="itemList"><a class="item" data-bs-toggle='modal' data-bs-target='#MostRatSoftSolModal'>Highly Rated in SoftSol</a></li>
                <li class="itemList"><a class="item" data-bs-toggle='modal' data-bs-target='#MostRatGlobetrotterModal'>Highly Rated in Globetrotter</a></li>
            </ul>
        </div>
    </div>
        
    <div class="container mt-6">
        <h1 class="productsIntro">Our Exclusive Products</h1>
        <?php
            $sql = "SELECT * FROM Products";
            $result = $conn->query($sql);
            echo "<div class='row'>\n";
            while($row = $result->fetch_assoc())
            {
                $id = $row["productId"];
                $companyId = $row["productCompany"];
                echo "<div class='col-xl-4 card' id='".$companyId."-".$id."'>\n";
                echo "<img class='card-img-top' style='width:100%' src = ' ../".$row["productImgUrl"]."' alt = '".$row["productName"]."'>\n";
                echo "<div class='card-body'>";
                echo "<h4 class='card-title'>".$row["productName"]."</h4>\n";
                echo "<h4 class='shortDescText'>Short Description:</h4>\n";
                echo "<p class='card-text'>".$row["productShortDesc"]."</p>\n";
                echo "<h4 class='priceText'>Price:</h4>\n";
                echo "<p class='card-text'>$".$row["productPrice"]."</p>\n";
                echo "<h4 class='priceText'>Total Reviews</h4>\n";
                echo "<p class='card-text'>".$row["productReviewCount"]."</p>\n";
                
                if(isset($_SESSION["isSecure"]))
                {
                    if($_SESSION["isSecure"])
                    {
                        echo "<div class='knowMoreBtn' style='justify-content:space-between'>\n";
                    }
                }
                else
                {
                    echo "<div class='knowMoreBtn' style='justify-content:center'>\n";
                }
                $newName = handleSpaces($row["productName"]);
                echo "<a href='$newName.php' class='btn btn-primary'>Know More</a>";
                if(isset($_SESSION["isSecure"]))
                {
                    if($_SESSION["isSecure"])
                    {
                        echo "<a class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#reviewRateModal".$companyId."-".$id."'>Rate/Review</a>";
                    }
                }
                echo "</div>";

                if(isset($_SESSION["isSecure"]))
                {
                    if($_SESSION["isSecure"])
                    {
                        echo "<div class='modal fade' id='reviewRateModal".$companyId."-".$id."'>
                            <div class='modal-dialog modal-dialog-centered'>
                                <div class='modal-content'>

                                <div class='modal-header'>
                                    <h4 class='modal-title'>Rate and Leave a Review</h4>
                                    <button type='button' class='btn-close' data-bs-dismiss='modal'></button>
                                </div>

                                <div class='modal-body'>
                                    <div class='ratingContainer'>
                                        <p class='rateText'>Rate this product</p>\n
                                        <i class='fa fa-star' data-index=".$companyId."-".$id."-1"."></i>
                                        <i class='fa fa-star' data-index=".$companyId."-".$id."-2"."></i>
                                        <i class='fa fa-star' data-index=".$companyId."-".$id."-3"."></i>
                                        <i class='fa fa-star' data-index=".$companyId."-".$id."-4"."></i>
                                        <i class='fa fa-star' data-index=".$companyId."-".$id."-5"."></i>
                                    </div>
                                    <hr/>
                                    <form action='reviewSave.php' method='post'>
                                    <div class='reviewContainer'>
                                            <label for='review' style='margin-bottom:1rem'>Write a review for the product: ".$newName."</label>
                                            <textarea class='form-control' rows='5' id='review' name='review'></textarea>
                                            <input type='hidden' id='prodID' name='prodID' value='".$id."'/>
                                            <input type='hidden' id='companyID' name='companyID' value='".$companyId."'/>
                                            <input type='hidden' id='currUser' name='currUser' value='".$_SESSION['user']."'/>
                                    </div>
                                    <div class='signUpBtnContainer'>
                                        <button name='ReviewSubmit' style='margin-top: 1em' class='btn btn-primary reviewSubmitBtn signUpmodal-submit'>Submit</button>
                                    </div>
                                    </form>
                                </div>
                                </div>
                            </div>
                        </div>";
                    }
                }
                echo "</div>\n";
                echo "</div>\n\n";
            }
            echo "</div>\n";

            function handleSpaces($productName)
            {
                $arr = explode(" ", $productName);
                if(isset($arr[1]))
                return $arr[0] . "_" . $arr[1];
                else
                return $productName;
            }
        ?>
    </div>

    <script>
        var ratedIndex = -1;
        var globalarr = [];
        $(document).ready(function()
        {
            resetStarColors();

            /*$('#'+globalarr[0]+"-"+globalarr[1] + " .reviewSubmitBtn").on("click", function(){
                
                temp = $('#'+globalarr[0]+"-"+globalarr[1] + " #review").val();
                console.log(temp);
            })*/

            $(".fa-star").on("click", function(){
                var temp1 = $(this).data('index');
                console.log(temp1);
                globalarr = temp1.split("-");
                ratedIndex = globalarr[2];

                saveToTheDB(globalarr[0], globalarr[1], globalarr[2]);
            });

            $(".fa-star").mouseover(function(){
                resetStarColors();

                var temp = $(this).data('index');
                var arr = temp.split("-");
                var currIndex = arr[2];

                for(var i=0;i<currIndex;i++)
                {
                    $('#'+arr[0]+"-"+arr[1]+' .fa-star:eq('+i+')').css('color','#f2e74e');
                }
            });

            $(".fa-star").mouseleave(function(){
                resetStarColors();

                if(ratedIndex!=-1)
                {
                    for(var i=0;i<ratedIndex;i++)
                    {
                        $('#'+globalarr[0]+"-"+globalarr[1]+' .fa-star:eq('+i+')').css('color','#f2e74e');
                    }
                }
            });

            $(".header-box").on('click', function(){
                console.log("Hi");
                $(this).addClass("sideNavActive");
                $(".sidebarContent").removeClass("sideNavActive");
                $(".sidebar").removeClass("animate__animated animate__slideInRight");
                $(".sidebar").addClass("animate__animated animate__slideInLeft");
            });

            $(".close-btn").on('click', function(){
                console.log("Hi1");
                $(".header-box").removeClass("sideNavActive");
                $(".sidebarContent").addClass("sideNavActive");
                $(".sidebar").removeClass("animate__animated animate__slideInLeft");
                $(".sidebar").addClass("animate__animated animate__slideInRight");
            });
        });

        function saveToTheDB(Company, product, rating)
        {
            console.log("Called");
            product = product;
            company = Company;
            $.ajax({
                url: "products.php",
                type: "POST",
                dataType: 'json',
                data: {
                    save: 1,
                    productID: product,
                    companyID: company, 
                    rating: rating
                }, success: function (r){
                    console.log(r);
                    //resetStarColors();
                }
            });
        }

        function resetStarColors()
        {
            $(".fa-star").css('color','#fff');
            $(".fa-star").css('text-shadow','0 0 3px #000');
        }
    </script>
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