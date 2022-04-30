<!--***********************************************************************
THIS WEBPAGE IS USED FOR LOGGING IN A REGISTERED USER 
STYLE = loginRegisterStyle.css 
***********************************************************************-->

<?php
include_once("connection.php");
error_reporting(0);
session_start();
	if (isset($_POST['signIn'])) {
        $rn=mysqli_real_escape_string($conn,$_POST['user_id']);
        $nm= mysqli_real_escape_string($conn,$_POST['fname']);
        $pwd= mysqli_real_escape_string($conn,$_POST['password']);

        if(empty($rn) || empty($nm) || empty($pwd)){
                    echo"<script>alert('Please Fill The Details Completely!')</script>";
        }
        else{ 
            $sql="SELECT * FROM `users` WHERE `user_id`=? AND `name`=? AND `password`=?;";
            $stmt= mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt,$sql)){
                        echo"<script>alert('SQL Error')</script>";
                }
                else{
                    mysqli_stmt_bind_param($stmt,"sss",$rn ,$nm ,$pwd);
                    mysqli_stmt_execute($stmt);
                        if(!mysqli_stmt_execute($stmt)){
                            echo "stmt not executed";
                        }
                        else{
                        $result= mysqli_stmt_get_result($stmt);
                            $total=mysqli_num_rows($result);
                           
                           // while($row= mysqli_fetch_assoc($result)){
                                if($total == 0)
                                {
                                    echo"<script>alert('No Such Record Found! Enter Correct details Or Register First.')</script>";        
                                }
                                else{
                                  if($total ==1){
                                      $_SESSION['user_id']=$rn;
                                      $_SESSION['fname']=$nm;
                                    header('location:pannel.php');
                                  }
                                     
                                }
                            }
                        }
                }
        }
  //  }
    
?>

<!--************************************************************************
            HTML CODE
****************************************************************************-->
<!DOCTYPE html>
<html lang="en" >
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In Form</title>
    <link rel="stylesheet" href="../css/loginRegisterStyle.css">
  </head>
  <body>

<form class="box" method="post">
  <h1>Sign In</h1>
  <input type="text" name="user_id" placeholder="User ID" required>
  <input type="text" name="fname" placeholder="First Name" required>
  <input type="password" name="password" placeholder="Password" required>
  <input type="submit" name="signIn" value="Sign In">
    <p>New User? <a href="register.php">Register</a> </p>
</form>
  </body>
</html>

