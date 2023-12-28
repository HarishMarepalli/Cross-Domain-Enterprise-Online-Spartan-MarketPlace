<?php session_start();  include_once 'dbconnect.php';?>
<?php
    $result = $conn->query("SELECT * FROM Products where productId = 15");
    $prod = $result -> fetch_assoc();
    $hits = $prod["productHits"] + 1;
    $conn->query("UPDATE Products SET productHits = ".$hits." WHERE productId = 15");    
    //$conn->close();
?>

<?php 
   if(isset($_SESSION["isSecure"]))
   {
       if($_SESSION["isSecure"])
       {
           $currentUserName = $_SESSION["user"];
           $result = $conn->query("SELECT * FROM UsersList where userName = '".$currentUserName."'");
           $customer = $result -> fetch_assoc();
           $custvisited = $customer["visited"];
           if(isset($custvisited) && $custvisited!="")
           {
               //$custvisitedarr = explode(",",$custvisited);
               //if(!in_array("A1",$custvisitedarr))
               $custvisited = $custvisited.",B15";
           }
           else
           {
               $custvisited = $custvisited."B15";
           }
           $conn->query("UPDATE UsersList SET visited = '".$custvisited."' WHERE userName = '".$currentUserName."'");    
           //$conn->close();
       }
   }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'head.php' ?>
    <title>Drive | Softsol</title>
</head>
<body class="drivePage">
    <?php $page='Drive'; include 'navbar.php' ?>
    <div class="topContainer">
        <!-- Carousel -->
        <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
            <!-- Indicators/dots -->
            <div class="carousel-indicators">
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active"></button>
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2"></button>
            </div>

            <!-- The slideshow/carousel -->
            <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="../img/Drive1.jpeg" alt="Drive1" class="d-block" style="width:100%">
            </div>
            <div class="carousel-item">
                <img src="../img/Drive2.jpeg" alt="Drive2" class="d-block" style="width:100%">
            </div>
            <div class="carousel-item">
                <img src="../img/Drive3.jpeg" alt="Drive3" class="d-block" style="width:100%">
            </div>
            </div>

            <!-- Left and right controls/icons -->
            <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
            </button>
        </div>

        <div class="longDescContainer">
            <h4 class="Desctext">Softsol Drive</h4>
            <p class="longDesc">
            Access and protect your business and school work with this intelligent files app. Share and collaborate from anywhere, on any device.
            <br>
            <br>
            Easily add shared files from Softsol Teams or Sharing to Softsol Drive, upload files up to 100GB, sync libraries, and more.
            <br>
            <br>
            Work better together. New integrations allow you to create sharable links, grant expiring access, and follow configured policies.
            <br>
            <br>
            Enhance admin capabilities with sync reports, apply sensitivity labels, and manage migration.
            <br>
            <br>
            Easily store, access, and discover your individual and shared work files in Softsol apps, from all your devices. Your offline edits will automatically sync next time you connect.
            <br>
            <br>
            Work faster and smarter with anyone inside or outside your organization. Securely share files and work together in real time using Word, Excel, and PowerPoint across web, mobile, and desktop.
            <br>
            <br>
            Create, view, edit, and share files on the go with the Drive mobile app. Easily capture whiteboards and scan work receipts, business cards, and other paper documents for safekeeping.
            <br>
            <br>
            Back up and protect your files with Softsol Drive. You can easily recover files from accidental deletes or malicious attacks and administrators can manage security policies to help keep your information safe.
            </p>
        </div>
    </div>

    <div class="bottomContainer">
    <div class="containerHeader">
        <h3 class="reviewsText">Reviews</h4>
        <?php 
            $sql = "SELECT * FROM Products WHERE productID = 15";
            $result = mysqli_query($conn, $sql);
            $rows = mysqli_num_rows($result);
            if($rows > 0)
            {
                while($row = $result->fetch_assoc())
                {
                    echo "<div class='reviewContainer'>\n";
                        echo"<h4 style='margin-right:1em'>Average Rating</h4>";
                        for($i = 1; $i<=5; $i++)
                        {
                            $roundedRating = ceil($row["productAvgRating"]);
                            echo "<i class='fa fa-star ";
                            if($i <= $roundedRating)
                            {
                                echo "checked";
                            }
                            else
                            {
                                echo "unchecked";
                            }
                            echo"'></i>\n";
                        }
                echo "</div>\n";
                }
            }
        ?>
    </div>
        <?php 
            $sql = "SELECT * FROM Ratings WHERE productID = 15";
            $result = mysqli_query($conn, $sql);
            $rows = mysqli_num_rows($result);
            if($rows > 0)
            {
                while($row = $result->fetch_assoc())
                {
                    echo "<div class='topReviewContainer'>\n";
                        echo "<div class='ratingContainer'>\n";
                            echo "<h4 class='currentUser'>".$row['userName']."</h4>";

                            for($i=1; $i<=5; $i++)
                            {
                                echo "<i class='fa fa-star ";
                                
                                if($i <= $row['rating'])
                                {
                                    echo "checked";
                                }
                                else
                                {
                                    echo "unchecked";
                                }
                                echo"'></i>\n";
                            }
                        echo "</div>\n";

                        echo "<div class='reviewContainer'>\n";
                            echo "<p class='reviewText'>".$row['review']."</p>";
                        echo "</div>\n";
                    echo "</div>\n";
                }
            }
        ?>
    </div>
</body>