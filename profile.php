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
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
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
    <table id = "postTable" class="table table-striped" style="width: 80%;">
       <thead> 
            <tr id = "tableHeader" class="thead-dark">
                <th>User</th>
                <th>Title</th>
                <th>Post</th>
            </tr>
        </thead>
        <tbody>
            <?php
                if($resultCheck > 0){
                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <tr>
                            <td style="width: 10%;"><?php echo $row['username']; ?></td>
                            <td style="width: 20%;"><?php echo $row['name']; ?></td>
                            <td style="width: 60%;"><?php echo $row['description'] . "<br>"; ?></td>
                        </tr>
                <?php
                }
                ?>
            <?php
        }
        ?>
        </tbody>
    </table>
</div>
</body>
</html>