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
$result = mysqli_query($dbConnection, $query);
$row = mysqli_fetch_array($result);
$resultCheck = mysqli_num_rows($result);
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
<?php
    if($resultCheck > 0){
        while ($row = mysqli_fetch_assoc($result)) {
            echo $row['name'];
            echo $row['description'] . "<br>";
        }
    }
?>
</body>
</html>