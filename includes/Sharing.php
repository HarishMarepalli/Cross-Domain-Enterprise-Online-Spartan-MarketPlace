<?php session_start();  include_once 'dbconnect.php';?>
<?php
    $result = $conn->query("SELECT * FROM Products where productId = 14");
    $prod = $result -> fetch_assoc();
    $hits = $prod["productHits"] + 1;
    $conn->query("UPDATE Products SET productHits = ".$hits." WHERE productId = 14");    
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
               $custvisited = $custvisited.",B14";
           }
           else
           {
               $custvisited = $custvisited."B14";
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
    <title>Sharing | Softsol</title>
</head>
<body class="sharingPage">
    <?php $page='Sharing'; include 'navbar.php' ?>
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
                <img src="../img/FileSharing1.jpeg" alt="FileSharing1" class="d-block" style="width:100%">
            </div>
            <div class="carousel-item">
                <img src="../img/FileSharing2.jpeg" alt="FileSharing2" class="d-block" style="width:100%">
            </div>
            <div class="carousel-item">
                <img src="../img/FileSharing3.jpeg" alt="FileSharing3" class="d-block" style="width:100%">
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
            <h4 class="Desctext">Softsol Sharing</h4>
            <p class="longDesc">
            Share and manage content, knowledge, and applications to empower teamwork, quickly find information, and seamlessly collaborate across the organization.
            <br>
            <br>
            Softsol Sharing empowers teamwork with dynamic and productive team sites for every project team, department, and division. Share files, data, news, and resources. Customize your site to streamline your team's work. Collaborate effortlessly and securely with team members inside and outside your organization, across PCs, Macs, and mobile devices.
            <br>
            <br>
            Build cohesion and inform your employees throughout your intranet. Drive organizational efficiency by sharing common resources and applications on home sites and portals. Tell your story with beautiful communication sites. And stay in the know with personalized, targeted news on the web and the mobile apps.
            <br>
            <br>
            You're just a click away from what you are looking for, with powerful search and intelligent ways to discover information, expertise, and insights to inform decisions and guide action. Softsol sharing's rich content management, along with valuable connections and conversations surfaced in Yammer, enable your organization to maximize the velocity of knowledge.
            <br>
            <br>
            Accelerate productivity by transforming processes—from simple tasks like notifications and approvals to complex operational workflows. With Softsol Sharing' lists and libraries, Power Automate, and Power Apps, you can create rich digital experiences with forms, workflows, and custom apps for every device.
            </p>
        </div>
    </div>

    <div class="bottomContainer">
    <div class="containerHeader">
        <h3 class="reviewsText">Reviews</h4>
        <?php 
            $sql = "SELECT * FROM Products WHERE productID = 14";
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
            $sql = "SELECT * FROM Ratings WHERE productID = 14";
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