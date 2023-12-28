<?php 
    session_start();
    ob_start();
    $_SESSION["last_login_timestamp"] = time();
    //$_SESSION["isAdmin"] = false;
    include_once 'dbconnect.php';
     if (isset($_POST["ReviewSubmit"]) && 
        !empty($_POST["review"]) &&
        !empty($_POST["prodID"]) &&
        !empty($_POST["companyID"]) &&
        !empty($_POST["currUser"]))
     {
        $productID = intval($_POST['prodID']);
        $companyID = $_POST['companyID'];
        $currUser = $_SESSION["user"];
        $givenRating = 0;
        $givenReview = $_POST["review"];


        /*$sql = "SELECT * FROM Ratings WHERE productID =".$_POST["prodID"]." AND companyName = '".$_POST["companyID"]."' AND userName = '".$_POST["currUser"]."'";
        $result = mysqli_query($conn, $sql);
        $rows = mysqli_num_rows($result);*/

        $result = $conn->query("SELECT * FROM Ratings WHERE productID =".$_POST["prodID"]." AND companyName = '".$_POST["companyID"]."' AND userName = '".$_POST["currUser"]."'");
        $numOfrows = mysqli_num_rows($result);
        $row = $result -> fetch_assoc();



        if($numOfrows != 0)
        {
            $sql1 = "UPDATE Ratings SET review = '".$_POST["review"]."' WHERE productID =".$_POST["prodID"]." AND companyName = '".$_POST["companyID"]."' AND userName = '".$_POST["currUser"]."'";
            mysqli_query($conn, $sql1);
            // $conn->close();
           

            // if($numOfrows != 0)
            $result = $conn->query("SELECT * FROM Products where productId = ".$_POST["prodID"]);
            $prod = $result -> fetch_assoc();
            $prc = $prod["productReviewCount"];
 
            $prc = $prod["productReviewCount"] + 1;
            $conn->query("UPDATE Products SET productReviewCount = ".$prc." WHERE productId = ".$_POST["prodID"]); 
            
            header("location: products.php");
            exit;
        }
        
            $sql2 = "INSERT INTO Ratings (userName,productID,companyName,review,rating) VALUES ('".$_POST["currUser"]."', ".$_POST["prodID"].", '".$_POST["companyID"]."', '".$_POST["review"]."', 0)";
            mysqli_query($conn, $sql2);

            // $sql = "INSERT INTO Ratings (userName,productID,companyName,rating) VALUES ('".$currUser."', ".$productID.", '".$companyID."', ".$givenRating.")";
            // mysqli_query($conn, $sql);


            //$conn->query("INSERT INTO Ratings (userName,productID,companyName,review) VALUES ('".$_POST["currUser"]."', ".$_POST["prodID"].", '".$_POST["companyID"]."', ".$_POST["review"].")");
            //$numOfrows = mysqli_num_rows($result);
            //$row = $result -> fetch_assoc();

            $result = $conn->query("SELECT * FROM Products where productId = ".$_POST["prodID"]);
            $prod = $result -> fetch_assoc();
            $prc = $prod["productReviewCount"] + 1;
            $conn->query("UPDATE Products SET productReviewCount = ".$prc." WHERE productId = ".$_POST["prodID"]);  
  
        //$conn->close();
        header("location: products.php");
        exit;
    }
     else
    {
        header("location: ../index.php?errmsg=7");
        $_SESSION["errmessage"] = "Please fill all fields of the Signup Form in correct manner.";
    }
?>