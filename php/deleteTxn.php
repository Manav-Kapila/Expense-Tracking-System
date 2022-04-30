<!--***********************************************************************
THIS WEBPAGE IS USED TO DELETE USER SELECTED TRANSACTION
STYLE = DisplayAdStyle.css
***********************************************************************-->

<?php
    session_start();
    $regdNum=$_SESSION['user_id'];
    // error_reporting(0);
    
    if(!$_SESSION['user_id'])
    {
        header('location:signIn.php');
    }
    else{
        include_once("connection.php");
        $txnId=$_GET['tid'];
        $txn_id= mysqli_real_escape_string($conn,$txnId);
        echo("txn_id = ");
        echo ( $_GET['tid']);
        echo("\n");
        echo("user id = ");
        echo ($regdNum);
        $query= "DELETE FROM `transactions` WHERE `txn_id`='$txn_id';";
        $data= mysqli_query($conn,$query);
        if($data)
            {
                echo "<script>alert('Transaction Deleted Successfully'); document.location='myTxnDelete.php'</script>";
            }  
        else
            { 
                echo "<script>alert('Transaction Deletion Failed '); document.location='myTxnDelete.php'</script>";
           } 
    }

