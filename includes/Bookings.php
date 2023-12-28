<?php session_start(); include_once 'dbconnect.php';?>
<?php
    $result = $conn->query("SELECT * FROM Products where productId = 11");
    $prod = $result -> fetch_assoc();
    $hits = $prod["productHits"] + 1;
    $conn->query("UPDATE Products SET productHits = ".$hits." WHERE productId = 11");    
    //$conn->close();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'head.php' ?>
    <title>Bookings | Softsol</title>
</head>
<body class="bookingsPage">
    <?php $page='Bookings'; include 'navbar.php' ?>
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
                    $custvisited = $custvisited.",B11";
                }
                else
                {
                    $custvisited = $custvisited."B11";
                }
                $conn->query("UPDATE UsersList SET visited = '".$custvisited."' WHERE userName = '".$currentUserName."'");    
                //$conn->close();
            }
        }
        ?>
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
                <img src="../img/Bookings1.jpeg" alt="Bookings1" class="d-block" style="width:100%">
            </div>
            <div class="carousel-item">
                <img src="../img/Bookings2.jpeg" alt="Bookings2" class="d-block" style="width:100%">
            </div>
            <div class="carousel-item">
                <img src="../img/Bookings3.jpeg" alt="Bookings3" class="d-block" style="width:100%">
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
            <h4 class="Desctext">Softsol Bookings</h4>
            <p class="longDesc">
            Save time when scheduling with Softsol Bookings. Customize appointment details, booking requirements, and specify service providers to streamline the booking experience for you and your customers. Bookings is integrated with your Softsol calendar to help your customers quickly find available times and avoid double-booking. With Bookings, you'll spend less time scheduling and more time meeting with customers.
            <br>
            <br>
            Make your Softsol Bookings meetings virtual. Every appointment booked as an online meeting creates a meeting link that everyone can join virtually from anywhere. Bookings is also available as an app to help you create calendars, assign staff, schedule new appointments.
            <br>
            <br>
            Softsol Bookings has flexibility and customization options to fit a variety of scheduling needs across departments, individuals, and types of appointments. Create and manage multiple Bookings calendars, each with their own unique setup. Different calendars can have different page structures, information, staff, and types of appointments and communication.
            <br>
            <br>
            Softsol Bookings offers more options for your customers when they visit your booking page, book an appointment, or get a confirmation email and calendar invitation. Customers who book an appointment online can easily reschedule or cancel it themselves to keep everyone in sync. If you prefer to book appointments for your customers, enter the appointment details in Bookings so they receive confirmations and reminders. With Bookings, it's also easy to track all changes made to appointments.
            </p>
        </div>
    </div>

    <div class="bottomContainer">
    <div class="containerHeader">
        <h3 class="reviewsText">Reviews</h4>
        <?php 
            $sql = "SELECT * FROM Products WHERE productID = 11";
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
            $sql = "SELECT * FROM Ratings WHERE productID = 11";
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