<!--***********************************************************************
THIS WEBPAGE IS USED TO DELETE A USER SELECTED ADVERTISEMENT
STYLE = DisplayAdStyle.css 
***********************************************************************-->

<?php
    session_start();
    $regdNum=$_SESSION['user_id'];
    $userName=$_SESSION['fname'];
    // error_reporting(0);
    
    if(!$_SESSION['user_id'])
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
  <title>Delete Transaction</title>
</head>
<body>
  <div class="heading">
        <h1>Select A Transaction To Delete</h1>
    </div>
  <div class="wrapper">

<?php
    $userid= mysqli_real_escape_string($conn,$regdNum);
    $query="SELECT `txn_id`, `user_id`, `txn_date`, `txn_type`, `txn_amount`, `initial_amount`, `final_amount` FROM `transactions` WHERE `user_id`=$regdNum ORDER BY `txn_id` DESC; ";
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
                  <td><a href='deleteTxn.php?tid=$result[txn_id]' onclick='return checkDelete()'><button class='confirmDelete'>Delete</button></a></td>
                  </table> </div>" ;
        }

    }
    else
    {
        echo "No Transaction To display!";
    }
?>

      </div>
    <script>
//  Defining Confirm delete modal's checkDelete()
    function checkDelete() 
    {
        var r= confirm('Are You Sure You Really Want To Delete This Transaction?');
        if(r)
        {
                return true;
        }
        else
        {
                return false;
        }
    }
</script>

</body>
</html>
