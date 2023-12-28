<?php session_start();  $_SESSION["isAdmin"] = false; include "header.php"; include "dbconnect.php"?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'head.php' ?>
    <title>PSecure | Spartan Marketplace</title>
</head>
<body class="psecurePage">
    <?php $_SESSION["isSecure"] = true; $page='Secure'; $secure = true; include 'navbar.php' ?>

    <div class="loginHomePage">
        <h1 class="psecureWelcome">Hello, <?php echo $_SESSION["user"]?></h1>
        <hr>
        <h2 class="psecureText">Your Most Visited Products</h2>
        <div class="homebtnsContainer">
            <a class='loginHomeBtn1 animate__animated animate__zoomIn animate__delay-1' data-bs-toggle='modal' data-bs-target='#top5MarketModal'>Your Top 5 in MarketPlace</a>
            <a class='loginHomeBtn2 animate__animated animate__zoomIn animate__delay-1' data-bs-toggle='modal' data-bs-target='#top5GTSToursModal'>Your Top 5 in GTS Tours</a>
            <a class='loginHomeBtn3 animate__animated animate__zoomIn animate__delay-1' data-bs-toggle='modal' data-bs-target='#top5SoftsolModal'>Your Top 5 in Softsol</a>
            <a class='loginHomeBtn3 animate__animated animate__zoomIn animate__delay-1' data-bs-toggle='modal' data-bs-target='#top5GlobetrotterModal'>Your Top 5 in Globetrotter</a>
        </div>
    </div>
    <script>
        setTimeout(function () {
            window.location.href= '../index.php?errmsg=1'; // the redirect goes here

            },<?php echo $timeoutInSec*1000 ?>);
    </script>

    <!-- The Modal -->
    <div class="modal fade modal-xl" id="top5MarketModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Top 5 Most Visited Products in the Marketplace</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body container">
                    <?php
                        $currUser = $_SESSION["user"];
                        $sql = "SELECT * FROM UsersList WHERE userName ='".$currUser."'";
                        $results = $conn->query($sql);
                        $row1 = $results->fetch_assoc();
                        $visited = $row1['visited'];
                        echo "<div class='row'>\n";
                        $heatmap=array();
                        $myarrCnt = 0;
                        foreach (explode(",",$visited) as $id)
                        {
                            if(isset($heatmap[$id]))
                            {
                                $heatmap[$id] = $heatmap[$id] + 1;
                            }
                            else {
                                $heatmap[$id] = 1;
                                $myarrCnt++;
                            }
                            
                        }
                        for($i=0; $i<5 and $i<$myarrCnt; $i++)
                        {
                            $max=0;
                            $maxid=0;
                            foreach ($heatmap as $key => $value)
                            {
                                if($value>$max)
                                {
                                    $max = $value;
                                    $maxid = $key;
                                }
                            }
                            
                            
                            $pid = intval(substr($maxid, 1, strlen($maxid) -1));
                            $result = $conn->query("SELECT * FROM Products where productId = ".$pid.";");
                            $row = $result->fetch_assoc();
                            echo "<div class='col-xl-4 card'>\n";
                            echo "<img class='card-img-top' style='width:100%' src = ' ../".$row["productImgUrl"]."' alt = '".$row["productName"]."'>\n";
                            echo "<div class='card-body'>";
                            echo "<h4 class='card-title'>".$row["productName"]."</h4>\n";
                            echo "<h4 class='shortDescText'>Short Description:</h4>\n";
                            echo "<p class='card-text'>".$row["productShortDesc"]."</p>\n";
                            echo "<h4 class='priceText'>Price:</h4>\n";
                            echo "<p class='card-text'>$".$row["productPrice"]."</p>\n";
                            echo "<div class='knowMoreBtn'>\n";
                            $newName = handleSpaces($row["productName"]);
                            echo "<a href='$newName.php' class='btn btn-primary'>Know More</a>";
                            echo "</div>";
                            echo "</div>\n";
                            echo "</div>\n\n";
                            unset($heatmap[$maxid]);    
                            
                        }
                        $myarrCnt =0;
                        unset($heatmap);
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
            </div>
        </div>
    </div>


     <!-- The Modal -->
     <div class="modal fade modal-xl" id="top5GTSToursModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Top 5 Most Visited Products in GTSTours Company</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body container">
                    <?php
                        $currUser = $_SESSION["user"];
                        $sql = "SELECT * FROM UsersList WHERE userName ='".$currUser."'";
                        $results = $conn->query($sql);
                        $row1 = $results->fetch_assoc();
                        $visited = $row1['visited'];
                        echo "<div class='row'>\n";
                        $heatmap=array();
                        $myarrCnt = 0;
                        foreach (explode(",",$visited) as $id)
                        {
                            if($id[0] == 'A')
                            {
                                if(isset($heatmap[$id]))
                                {
                                    $heatmap[$id] = $heatmap[$id] + 1;
                                }
                                else {
                                    $heatmap[$id] = 1;
                                    $myarrCnt++;
                                }
                                
                            }
                        }
                        for($i=0;$i<5 and $i<$myarrCnt;$i++)
                        {
                            $max=0;
                            $maxid=0;
                            foreach ($heatmap as $key => $value)
                            {
                                if($value>$max)
                                {
                                    $max = $value;
                                    $maxid = $key;
                                }
                            }
                            $pid = intval(substr($maxid, 1, strlen($maxid) -1));
                            $result = $conn->query("SELECT * FROM Products where productId = ".$pid.";");
                            $row = $result->fetch_assoc();
                            echo "<div class='col-xl-4 card'>\n";
                            echo "<img class='card-img-top' style='width:100%' src = ' ../".$row["productImgUrl"]."' alt = '".$row["productName"]."'>\n";
                            echo "<div class='card-body'>";
                            echo "<h4 class='card-title'>".$row["productName"]."</h4>\n";
                            echo "<h4 class='shortDescText'>Short Description:</h4>\n";
                            echo "<p class='card-text'>".$row["productShortDesc"]."</p>\n";
                            echo "<h4 class='priceText'>Price:</h4>\n";
                            echo "<p class='card-text'>$".$row["productPrice"]."</p>\n";
                            echo "<div class='knowMoreBtn'>\n";
                            $newName = handleSpaces($row["productName"]);
                            echo "<a href='$newName.php' class='btn btn-primary'>Know More</a>";
                            echo "</div>";
                            echo "</div>\n";
                            echo "</div>\n\n";
                            unset($heatmap[$maxid]);    
                        }
                        $myarrCnt =0;
                        unset($heatmap);
                        echo "</div>\n";
                    ?>
                </div>
            </div>
        </div>
    </div>

    <!-- The Modal -->
    <div class="modal fade modal-xl" id="top5SoftsolModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Top 5 Most Visited Products in Softsol Company</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body container">
                    <?php
                        $currUser = $_SESSION["user"];
                        $sql = "SELECT * FROM UsersList WHERE userName ='".$currUser."'";
                        $results = $conn->query($sql);
                        $row1 = $results->fetch_assoc();
                        $visited = $row1['visited'];
                        echo "<div class='row'>\n";
                        $heatmap=array();
                        $myarrCnt = 0;
                        foreach (explode(",",$visited) as $id)
                        {
                            if($id[0] == 'B')
                            {
                                if(isset($heatmap[$id]))
                                {
                                    $heatmap[$id] = $heatmap[$id] + 1;
                                }
                                else {
                                    $heatmap[$id] = 1;
                                    $myarrCnt++;
                                }
                                
                            }
                        }
                        for($i=0;$i<5 and $i<$myarrCnt;$i++)
                        {
                            $max=0;
                            $maxid=0;
                            foreach ($heatmap as $key => $value)
                            {
                                if($value>$max)
                                {
                                    $max = $value;
                                    $maxid = $key;
                                }
                            }
                            $pid = intval(substr($maxid, 1, strlen($maxid) -1));
                            $result = $conn->query("SELECT * FROM Products where productId = ".$pid.";");
                            $row = $result->fetch_assoc();
                            echo "<div class='col-xl-4 card'>\n";
                            echo "<img class='card-img-top' style='width:100%' src = ' ../".$row["productImgUrl"]."' alt = '".$row["productName"]."'>\n";
                            echo "<div class='card-body'>";
                            echo "<h4 class='card-title'>".$row["productName"]."</h4>\n";
                            echo "<h4 class='shortDescText'>Short Description:</h4>\n";
                            echo "<p class='card-text'>".$row["productShortDesc"]."</p>\n";
                            echo "<h4 class='priceText'>Price:</h4>\n";
                            echo "<p class='card-text'>$".$row["productPrice"]."</p>\n";
                            echo "<div class='knowMoreBtn'>\n";
                            $newName = handleSpaces($row["productName"]);
                            echo "<a href='$newName.php' class='btn btn-primary'>Know More</a>";
                            echo "</div>";
                            echo "</div>\n";
                            echo "</div>\n\n";
                            unset($heatmap[$maxid]);    
                        }
                        $myarrCnt =0;
                        unset($heatmap);
                        echo "</div>\n";
                    ?>
                </div>
            </div>
        </div>
    </div>

    <!-- The Modal -->
    <div class="modal fade modal-xl" id="top5GlobetrotterModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Top 5 Most Visited Products in Globetrotter Company</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body container">
                    <?php
                        $currUser = $_SESSION["user"];
                        $sql = "SELECT * FROM UsersList WHERE userName ='".$currUser."'";
                        $results = $conn->query($sql);
                        $row1 = $results->fetch_assoc();
                        $visited = $row1['visited'];
                        echo "<div class='row'>\n";
                        $heatmap=array();
                        $myarrCnt =0;
                        foreach (explode(",",$visited) as $id)
                        {
                            if($id[0] == 'C')
                            {
                                if(isset($heatmap[$id]))
                                {
                                    $heatmap[$id] = $heatmap[$id] + 1;
                                }
                                else {
                                    $heatmap[$id] = 1;
                                    $myarrCnt++;
                                }
                            }
                        }
                        for($i=0;$i<5 and $i<$myarrCnt;$i++)
                        {
                            $max=0;
                            $maxid=0;
                            foreach ($heatmap as $key => $value)
                            {
                                if($value>$max)
                                {
                                    $max = $value;
                                    $maxid = $key;
                                }
                            }
                            $pid = intval(substr($maxid, 1, strlen($maxid) -1));
                            $result = $conn->query("SELECT * FROM Products where productId = ".$pid.";");
                            $row = $result->fetch_assoc();
                            echo "<div class='col-xl-4 card'>\n";
                            echo "<img class='card-img-top' style='width:100%' src = ' ../".$row["productImgUrl"]."' alt = '".$row["productName"]."'>\n";
                            echo "<div class='card-body'>";
                            echo "<h4 class='card-title'>".$row["productName"]."</h4>\n";
                            echo "<h4 class='shortDescText'>Short Description:</h4>\n";
                            echo "<p class='card-text'>".$row["productShortDesc"]."</p>\n";
                            echo "<h4 class='priceText'>Price:</h4>\n";
                            echo "<p class='card-text'>$".$row["productPrice"]."</p>\n";
                            echo "<div class='knowMoreBtn'>\n";
                            $newName = handleSpaces($row["productName"]);
                            echo "<a href='$newName.php' class='btn btn-primary'>Know More</a>";
                            echo "</div>";
                            echo "</div>\n";
                            echo "</div>\n\n";
                            unset($heatmap[$maxid]);    
                        }
                        $myarrCnt =0;
                        unset($heatmap);
                        echo "</div>\n";
                    ?>
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