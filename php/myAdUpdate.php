<!--***********************************************************************
THIS WEBPAGE IS USED TO UPDATE A USER SELECTED ADVERTISEMENT
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
  <title>Update Advertisement</title>
</head>
<body>
  <div class="heading">
        <h1>Select An Ad To Update/Edit</h1>
    </div>
  <div class="wrapper">
<!--   `title`, `author`, `edition`, `price`, `eMail`, `department`-->
        <!-- PHP CODE TO FETCH DATA FROM BACKEND -->

<?php
    $userid= mysqli_real_escape_string($conn,$regdNum);
     $sql="SELECT `book_id`,`title`, `author`, `edition`, `price`, `eMail`, `department` FROM `books` WHERE `user_id`=?";
            $stmt= mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt,$sql)){
                        echo"<script>alert('SQL Error')</script>";
                }
                else{
                    mysqli_stmt_bind_param($stmt,"s",$userid);
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
                                    echo"<script>alert('No Ads Posted By You! .')</script>";        
                                }
                                else{
                                     while($results=mysqli_fetch_assoc($result))
                                {
                                    echo " <div><table class='adTable'>
                                          <tr>
                                          <td>Title :-  ".$results['title']."</td>
                                          </tr>
                                          <tr>
                                          <td>Author :-  ".$results['author']."</td>
                                          </tr>
                                          <tr>
                                          <td>Edition :-  ".$results['edition']."</td>
                                          </tr>
                                          <tr>
                                          <td>Price :-  ".$results['price']." Rs.</td>
                                          </tr>
                                          <tr>
                                          <td>Email :-  ".$results['eMail']."</td>
                                          </tr>
                                          <tr>
                                          <td>Department :-  ".$results['department']."</td>
                                          </tr>
                                          <td><a href='update_one_ad.php?bi=$results[book_id] & tl=$results[title] & au=$results[author] & ed=$results[edition] & pr=$results[price] & dp=$results[department]' onclick='return checkUpdate()'><button class='confirmUpdate'>Update</button></a></td>
                                       </table> </div>" ;
                                }
                                    
                                }
                            }
                        } 
     
    
?>

      </div>
    <script>
//  Defining Confirm delete modal's checkDelete()
    function checkUpdate() 
    {
        var r= confirm('Are You Sure You Really Want To Update/Edit This Record ?');
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
