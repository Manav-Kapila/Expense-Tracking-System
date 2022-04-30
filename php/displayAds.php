<!--***********************************************************************
THIS WEBPAGE IS USED TO DISPLAY ALL THE AVAILABLE ADDS
AND TO SEARCH FOR A SPECIFIC BOOK ON SALE
STYLE = DisplayAdStyle.css 
***********************************************************************-->

<?php
    session_start();
    $regdNum=$_SESSION['regdNo'];
    error_reporting(0);
    
    if(!$_SESSION['regdNo'])
    {
        header('location:signIn.php');
    }
    else{
        include_once("connection.php");
        include("header.php");
        
        
    }
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" type="text/css" href="../css/DisplayAdStyle.css">
  <title>Display all ads</title>
</head>
<body>
  <div class="heading">
        <h1>Available Ads</h1><br>
        <div class="filter">
        <a href="filterDb.php"><button class="search " ><div class="hoverPart">&#x1f50e<br><div class="hidden">Click To Search A Book </div></div></button><a></a></a>
        </div>
    </div>
  <div class="wrapper">
   
        <!-- PHP CODE TO FETCH DATA FROM BACKEND -->

      <?php
  
    $query="SELECT `title`, `author`, `edition`, `price`, `eMail`, `department` FROM `books`ORDER BY `title` ASC; ";
    $data=mysqli_query($conn,$query);
    $total=0;
    $total=mysqli_num_rows($data);

    if($total != 0)
    {
        // to display table's records 
        while($result=mysqli_fetch_assoc($data))
        {
            echo " <div><table class='adTable'>
                  <tr>
                  <td>Title :-  ".$result['title']."</td>
                  </tr>
                  <tr>
                  <td>Author :-  ".$result['author']."</td>
                  </tr>
                  <tr>
                  <td>Edition :-  ".$result['edition']."</td>
                  </tr>
                  <tr>
                  <td>Price :-  ".$result['price']." Rs.</td>
                  </tr>
                  <tr>
                  <td>Email :-  ".$result['eMail']."</td>
                  </tr>
                  <tr>
                  <td>Department :-  ".$result['department']."</td>
                  </tr>
                  </table> </div>" ;
        }

    }
    else
    {
        echo "No Advertisement To display!";
    }
?>

      </div>
</body>
</html>
