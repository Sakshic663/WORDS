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
<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <header class="header-basic">
        <div class="header-limiter">
            <h1><a href="#">WORDS</a></h1>
            <nav>
                <a href="logout.php" id="logout" class="button primary" title="SIGN OUT">SIGN OUT</a>
            </nav>
        </div>
    </header>

<a href="./create.php">
        <img src="./plus.png" class="btn">
    <!--<input type="button" value="" class="btn"/>-->
</a>

<!--<a href="logout.php" id="logout" class="button primary" title="SIGN OUT">SIGN OUT</a><br>-->

            <h2 style="text-align: center;">Posts</h2>
        
<div>
    <table id = "postTable">
        
        <tr id = "tableHeader">
            <th>User</th>
            <th>Post</th>
        </tr>
        <?php
            if($resultCheck > 0){
                while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <tr>
                        <td style="width: 20%;"><?php echo $row['name']; ?></td>
                        <td style="width: 80%;"><?php echo $row['description'] . "<br>"; ?></td>
                    </tr>
                <?php
                }
                ?>
            <?php
        }
        ?>
    </table>
</div>
</body>
</html>