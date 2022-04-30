<!--***********************************************************************
THIS WEBPAGE IS DEFAULT USER LANDING PAGE
STYLE = DisplayAdStyle.css AND internal stylesheet style
***********************************************************************--><?php
    session_start();
    $regdNum=$_SESSION['user_id'];
    $userName=$_SESSION['fname'];
    //error_reporting(0);
    if($regdNum == true)
    {
        // means session is established
        include("header.php");
    }
    else{
        header('location:signIn.php');
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" type="text/css" href="../css/DisplayAdStyle.css">
     <link rel="stylesheet" type="text/css" href="../css/panel.css">
  <title>Thanks User</title>

  <style>

        html {
            background-image: url(../img/thanks.jpg);
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
            overflow: hidden;
            font-family: cursive, sans-serif, serif;
        }

        h1{
            margin-top: 10%;
        }

        div.heading {
            font-size: 28px;
            background-color: #9e9e9eb5;
        }

  </style>
</head>
<body>
  <div class="heading greetings">
         <?php  
            echo "<h1>Thanks  ".$userName.", <br>your request has been processed.</h1>";
      ?>