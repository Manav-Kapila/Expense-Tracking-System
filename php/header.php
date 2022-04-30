<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>My Website</title>
        <link rel="stylesheet" href="../css/header.css">
	</head>
	<body>
        <nav>
            <ul class="topnav" id="dropdownClick">
                <li><a href="pannel.php">Home</a></li>
                <li><a href="viewTxns.php">View Txns</a></li>
                <li><a href="depositAmount.php">Deposit Amount</a></li>
                <li><a href="withdrawAmount.php">Withdraw Amount</a></li>             
                <li><a href="myTxnDelete.php">Delete Txn</a></li>  
                
                <li class="topnav-right"><a href="logOut.php">Log Out</a></li>
                <li class="dropdownIcon"><a href="javascript:void(0);" onclick="dropdownMenu()">&#9776;</a> </li>
            </ul>
        </nav>
        
       <script src="../js/header.js"></script>    
	</body>
</html>