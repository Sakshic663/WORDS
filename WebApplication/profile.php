<?php
include 'DatabaseConnection.php';
$dbConnection = DatabaseConnection::getInstance()->getConnection();
session_start();
    $testerID = "";
    if(!$_SESSION['email']){
        header('Location: signin.php'); 
    }else{
        $testerID = $_SESSION['email'];
    }
$query = "SELECT * FROM posts;";

$resultCheck = mysqli_num_rows($query);
?>
<!DOCTYPE html>
<html>
<head>
<title> Profile Page</title>
</head>
<body>

<a href="./create.php">
    <input type="button" value="Create Post" />

</a>
<a href="logout.php" id="logout" class="button primary" title="SIGN OUT">SIGN OUT</a><br>
</body>
</html>