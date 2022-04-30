<!--***********************************************************************
THIS WEBPAGE IS USED TO DISPLAY ALL THE AVAILABLE TXNS
AND TO SEARCH FOR A SPECIFIC BOOK ON SALE
STYLE = DisplayAdStyle.css 
***********************************************************************-->

<?php
    session_start();
    $regdNum=$_SESSION['user_id'];
    $userName=$_SESSION['fname'];
    //error_reporting(0);
    if($regdNum == true)
    {
        // means session is established
        include_once("connection.php");
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
  <title>Display all transactions</title>
</head>
<body>
  <div class="heading">
        <!-- <h1>Recent Transactions By </h1><br> -->
        <?php  echo "<h1>All Transactions By  ".$userName."</h1>";  ?>
        <div class="filter">
        <a href="filterDb.php"><button class="search " ><div class="hoverPart">&#x1f50e<br><div class="hidden">Click To Search A Transaction </div></div></button><a></a></a>
        </div>
    </div>
  <div class="wrapper">
   
        <!-- PHP CODE TO FETCH DATA FROM BACKEND -->

      <?php
  
    $query="SELECT `user_id`, `txn_date`, `txn_type`, `txn_amount`, `initial_amount`, `final_amount` FROM `transactions` WHERE `user_id`=$regdNum ORDER BY `txn_id` DESC; ";
    $data=mysqli_query($conn,$query);
    $total=0;
    $total=mysqli_num_rows($data);

    if($total != 0)
    {
        // to display table's records 
        while($result=mysqli_fetch_assoc($data))
        {

            // split time and date
            $timestamp= $result['txn_date'];
            $new_time = explode(" ",$timestamp);
            $get_date = $new_time[0];
            $get_time = $new_time[1];


            //display data
            echo " <div><table class='adTable'>
                  <tr>
                  <td>Transaction Date :-  ".$get_date."</td>
                  </tr>
                  <tr>
                  <td>Transaction By :-  ".$userName."</td>
                  </tr>
                  <tr>
                  <td>Transaction Type :-  ".$result['txn_type']."</td>
                  </tr>
                  <tr>
                  <td>Transaction Amount :-  ".$result['txn_amount']."</td>
                  </tr>
                  <tr>
                  <td>Initial Amount :-  ".$result['initial_amount']." Rs.</td>
                  </tr>
                  <tr>
                  <td>Final Amount :-  ".$result['final_amount']." Rs.</td>
                  </tr>
                  </table> </div>" ;
        }

    }
    else
    {
        echo "No Transaction To display!";
    }
?>

      </div>
</body>
</html>
