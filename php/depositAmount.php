<!--***********************************************************************
THIS WEBPAGE IS USED TO DROP A NEW ADVERTISEMENT 
STYLE = loginRegisterStyle.css 
***********************************************************************-->
<?php
   session_start();
   $regdNum=$_SESSION['user_id'];
   $userName=$_SESSION['fname'];
   //error_reporting(0);
   if(!$_SESSION['user_id'])
    {
        header('location:signIn.php');
    }
    else{
        include_once("connection.php");
        include("header.php");
        if (isset($_POST['depositAmount'])) {
            $u_id= mysqli_real_escape_string($conn,$regdNum);
            $title=mysqli_real_escape_string($conn,$_POST['title']);
            $creditor = mysqli_real_escape_string($conn,$_POST['creditor']);
            $depositor = mysqli_real_escape_string($conn,$_POST['depositor']);
            $amount= mysqli_real_escape_string($conn,$_POST['amount']);
            $comment= mysqli_real_escape_string($conn,$_POST['comment']);
            

            if(empty($u_id) || empty($title) || empty($creditor) || empty($depositor) || empty($amount) || empty($comment) ){
                echo"<script>alert('Please Fill The Form Completely!')</script>";
            }    
            else{ 
                $sql= "INSERT INTO `deposit_amount`(`user_id`, `creditTitle`, `creditor`, `depositor`, `creditAmount`, `creditComment`) VALUES  (?,?,?,?,?,?);";
                $stmt= mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt,$sql)){
                    echo"<script>alert('SQL Error')</script>";
                }
                else{
                    mysqli_stmt_bind_param($stmt,"ssssss",$u_id, $title, $creditor,$depositor,$amount,$comment); 
                    if(!mysqli_stmt_execute($stmt)){
                        echo"<script>alert('Failed To Deposit Amount ')</script>";
                    }
                    else{
                        //echo"<script>alert('Amount Deposited Successfully!')</script>";
                        //header('Location: thanks.php');
                    }
                }
                // ///////////////////////////////////////////////////////////////////////

                // <!-- ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
                        // <!--            UPDATING BANK BALANCE AND TRANSACTION DETAILS                                                -->
                        // <!-- ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

                        // fetching initial and final balance from database

                $query="SELECT `initial_balance`, `final_balance` FROM `bank_statement` WHERE `user_id`=$u_id ORDER BY `statement_id` DESC LIMIT 1;";
                $data=mysqli_query($conn,$query);
                $init_bal=0;
                $end_bal=0;
                while($result=mysqli_fetch_assoc($data))
                {
                $init_bal= $result['initial_balance'];
                $end_bal= $result['final_balance'];
                // echo " init bal ".$init_bal;
                // echo " final bal".$end_bal;

                    // to display table's records 
                }
                // Update balance after deposit

                $query2="SELECT `creditId`, `user_id`, `creditAmount`, `date` FROM `deposit_amount` WHERE `user_id`=$u_id ORDER BY `creditId` DESC LIMIT 1;";
                $data2=mysqli_query($conn,$query2);
                $total2=0;
        
                while($result=mysqli_fetch_assoc($data2)){
                //$u_id= $result[`user_id`];
                    $deposit_date= $result['date'];
                    $type="Deposit";
                    $deposit= $result['creditAmount'];
                }
                    $init_bal= $end_bal;
                    $end_bal= $init_bal + $deposit;
                    // to display table's records 
                
                // Updating Bank statement

                if(empty($u_id) || empty($deposit_date) || empty($type) || is_null($init_bal) || is_null($end_bal) ){
                    echo"<script>alert('Values for updating bank statement are missing!')</script>";
                // echo " user id ".$u_id;
                // echo " date ".$deposit_date;
                // echo " type ".$type;
                // echo " init bal ".$init_bal;
                // echo " final bal ".$end_bal;
                }    
                else{ 

                    // UPDATING TRANSACTIONS TABLE
                    $sql2= "INSERT INTO `transactions`(`user_id`, `txn_date`, `txn_type`, `txn_amount`, `initial_amount`, `final_amount`) VALUES  (?,?,?,?,?,?);";
                    $stmt2= mysqli_stmt_init($conn);
                    if(!mysqli_stmt_prepare($stmt2,$sql2)){
                        echo"<script>alert('SQL Error')</script>";
                    }
                    else{
                        mysqli_stmt_bind_param($stmt2,"ssssss",$u_id, $deposit_date, $type, $deposit, $init_bal, $end_bal); 
                        if(!mysqli_stmt_execute($stmt2)){
                        echo"<script>alert('Failed To Update Transaction Record ')</script>";
                        }
                        else{
                            //echo"<script>alert('Amount Deposited Successfully!')</script>";
                            //header('Location: thanks.php');
                        }
                    }
                    // UPDATING BANK_STATEMENT TABLE

                    $sql3= "INSERT INTO `bank_statement`(`user_id`, `initial_balance`, `final_balance`, `date`) VALUES  (?,?,?,?);";
                    $stmt3= mysqli_stmt_init($conn);
                    if(!mysqli_stmt_prepare($stmt3,$sql3)){
                        echo"<script>alert('SQL Error')</script>";
                    }
                    else{
                        mysqli_stmt_bind_param($stmt3,"ssss",$u_id, $init_bal, $end_bal,$deposit_date,); 
                        if(!mysqli_stmt_execute($stmt3)){
                        echo"<script>alert('Failed To Update Balance Sheet ')</script>";
                        }
                        else{
                            echo"<script>alert('Amount Deposited Successfully!')</script>";
                            header('Location: thanks.php');
                        }
                    }
                }
                // ////////////////////////////////////////////////////////////////////
            }
        }
    }  
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deposit Amount</title>
    <link rel="stylesheet" href="../css/loginRegisterStyle.css">
    <link rel="stylesheet" href="../css/creditDepositStyle.css">
  </head>
  <body>

<form class="box" method="post"> 
      <h1>DEPOSIT AMOUNT</h1>

      <input type="text" name="title" placeholder="Enter Transaction's Title" required>
      <input type="text" name="creditor" placeholder="Enter Creditor's Name" required> 
      <input type="text" name="depositor" placeholder="Enter Depositor's Name" required>
      <input type="text" name="amount" placeholder="Enter Amount (in Rs.)" required>
      <input type="text" name="comment" placeholder="Enter Credit Comment (salary/tsfr/borrow/etc)" required>
      
      <input type="submit" name="depositAmount" value="Deposit Amount">     
</form>
  </body>
</html>



