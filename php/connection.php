<?php
		$conn =mysqli_connect('localhost', 'root', '' , 'expense_tracking_system');
       // error_reporting(0);
        if($conn){
        //    echo "Connection Established";
        }
        else{
            echo "Connection Failed".mysqli_connect_error();
        }