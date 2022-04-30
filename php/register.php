<!--***********************************************************************
THIS WEBPAGE IS USED TO REGISTER A NEW USER 
STYLE = loginRegisterStyle.css 
***********************************************************************-->
<?php
    include_once("connection.php");
    //error_reporting(0);
	if (isset($_POST['submit'])) {

        $rn=mysqli_real_escape_string($conn,$_POST['uID']);
		$fn = mysqli_real_escape_string($conn,$_POST['fname']);
        $pwd= mysqli_real_escape_string($conn,$_POST['password']);
        $conPwd= mysqli_real_escape_string($conn,$_POST['conPassword']);
        
        if(empty($rn) || empty($fn) || empty($pwd) || empty($conPwd) ){
                echo"<script>alert('Please Fill The Form Completely!')</script>";
        }
        else{
            if($pwd !== $conPwd){
                echo"<script>alert('The Two Passwords Does Not Match!')</script>";
            }
            else{
                $sql= "INSERT INTO `users` (`user_id`, `name`, `password`) VALUES (?,?,?);";
                $stmt= mysqli_stmt_init($conn);
                    if(!mysqli_stmt_prepare($stmt,$sql)){
                           echo"<script>alert('SQL Error')</script>";
                    }
                    else{
                        mysqli_stmt_bind_param($stmt,"sss",$rn, $fn,$pwd); 
                        if(!mysqli_stmt_execute($stmt))
                       {echo"<script>alert('Registeration Failed Details Entered are Incorrect ')</script>";}
                        else{echo"<script>alert('Registered SuccessFully! Sign In To Continue ')</script>";}
                        
                    }
            }
        }
    }
        
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="../css/loginRegisterStyle.css">
  </head>
  <body>
      
<?php 
    // if(!empty($success_message)) {
    //     echo $success_message;    
    //     } 
    // if(!empty($error_message)) { 
    //     echo $error_message; 
    //     }
?>
      
<form class="box" method="post">
  <h1>Register</h1>
  <input type="text" name="uID" placeholder="User ID " required>
  <input type="text" name="fname" placeholder="First Name" required> 
  <input type="password" name="password" placeholder="Password" required>
  <input type="password" name="conPassword" placeholder="Confirm Password" required>
  <input type="submit" name="submit" value="Register">     
    <p>Existing User? <a href="signIn.php">Sign In</a> </p>
</form>
  </body>
</html>
