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

<div>
    <table>
        <tr>
            <th colspan="2"><h2>Posts</h2></th>
        </tr>
        <t>
            <th>User</th>
            <th>Post</th>
        </t>
        <?php
            if($resultCheck > 0){
                while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <tr>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['description'] . "<br>"; ?></td>
                    </tr>
                <?php
                }
                ?>
            }
        ?>
    </table>
</div>
</body>
</html>