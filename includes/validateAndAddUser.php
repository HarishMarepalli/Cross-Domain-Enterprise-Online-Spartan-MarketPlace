<?php 
    session_start();
    ob_start();
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'phpmailer/src/Exception.php';
    require 'phpmailer/src/PHPMailer.php';
    require 'phpmailer/src/SMTP.php';
    $_SESSION["last_login_timestamp"] = time();
    //$_SESSION["isAdmin"] = false;
    include_once 'dbconnect.php';
     if (isset($_POST["Signup"]) && 
        !empty($_POST["firstName"]) && 
        !empty($_POST["lastName"]) &&
        !empty($_POST["newUserName"]) 
        && !empty($_POST["newPassword"]))
     {
        if(preg_match("/^[0-9]+$/", $_POST["firstName"]))
        {
            header("location: ../index.php?errmsg=2");
            $_SESSION["errmessage"] = "Invalid FirstName";
            exit;
        }
        else if(preg_match("/^[0-9]+$/", $_POST["lastName"]))
        {
            header("location: ../index.php?errmsg=3");
            $_SESSION["errmessage"] = "Invalid LastName";
            exit;
        }
        else if(!preg_match("/^([a-zA-Z0-9\.]+@+[a-zA-Z]+(\.)+[a-zA-Z]{2,3})$/", $_POST["emailID"]))
        {
            header("location: ../index.php?errmsg=4");
            $_SESSION["errmessage"] = "Invalid Email ID";
            exit;
        }
        else if(!preg_match("/^[(][0-9]{3}[)][0-9]{3}-[0-9]{4}$/", $_POST["homePhone"]))
        {
            header("location: ../index.php?errmsg=5");
            $_SESSION["errmessage"] = "Invalid Home Phone Number";
            exit;
        }
        else if(!preg_match("/^[(][0-9]{3}[)][0-9]{3}-[0-9]{4}$/", $_POST["cellPhone"]))
        {
            header("location: ../index.php?errmsg=6");
            $_SESSION["errmessage"] = "Invalid Cell Phone Number";
            exit;
        }
        else
        {
            //Check for duplicate user
            $sql = "SELECT * FROM UsersList";
            $result = mysqli_query($conn, $sql);
            while($row = mysqli_fetch_assoc($result))
            {
                if($row["email"] == $_POST["emailID"])
                {
                    header("location:../index.php?errmsg=8");
                    exit;
                }
                if($row["userName"] == $_POST["newUserName"])
                {
                    header("location:../index.php?errmsg=8");
                    exit;
                }
            }

            //Insert user to the DB
            $sql = "INSERT INTO UsersList (firstName,lastName,email,homeAddress,homePhone,cellPhone,userName,passwd) VALUES ('".$_POST["firstName"]."', '".$_POST["lastName"]."', '".$_POST["emailID"]."', '".$_POST["homeAddress"]."', '".$_POST["homePhone"]."', '".$_POST["cellPhone"]."', '".$_POST["newUserName"]."', AES_ENCRYPT('".$_POST["newPassword"]."','secretkey'))";
            mysqli_query($conn, $sql);
            $conn->close();
            $_SESSION["user"] = $_POST["newUserName"];

            $firstname = $_POST["firstName"];
            $lastName = $_POST["lastName"];
            $tomail = $_POST["emailID"];
            $phone = $_POST["homePhone"];
            $cellphone = $_POST["cellPhone"];
            $address = $_POST["homeAddress"];
            $userName = $_POST["newUserName"];

            //Create an instance; passing `true` enables exceptions
            $mail = new PHPMailer(true);
            try 
            {
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = 'sprtnmarketplacecmpe272@gmail.com';           //SMTP username
                $mail->Password   = 'zjlbancnrhtwlgzz';                     //SMTP password
                $mail->SMTPSecure = 'ssl';                                  //Enable implicit TLS encryption
                $mail->Port       = 465;

                //Send to User
                $mail->setFrom('sprtnmarketplacecmpe272@gmail.com', 'Spartan Marketplace');
                $mail->addAddress($tomail);                                 //Add a recipient
                $mail->addBCC('harish.marepalli@sjsu.edu');
                $mail->addBCC('venkatasubramanyasriraviraj.indraganti@sjsu.edu');
                $mail->addBCC('tirumalasaiteja.goruganthu@sjsu.edu');
                //Content
                $mail->isHTML(false);                                  //Set email format to HTML
                $mail->Subject = 'Spartan Marketplace | Request Submit Successfully';
                $mail->Body    = "Dear ".$firstname." ".$lastName.",\n\nThank you for choosing our marketplace.\nWe will get back to you via email within 24 hours. Your unique user name is ".$userName."\n\n\nAdministrator,\nSpartan Marketplace Ltd";

                $mail->send();
            } 
            catch (Exception $e) 
            {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }

            header("location: publicsecuresection.php");
            exit;
        }
     }
     else
    {
        header("location: ../index.php?errmsg=7");
        $_SESSION["errmessage"] = "Please fill all fields of the Signup Form in correct manner.";
    }
?>