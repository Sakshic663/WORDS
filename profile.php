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
            <h1><a href="index.html">WORDS</a></h1>
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
                <th>Posts</th>
            </tr>
        </thead>
        <tbody>
            <?php
                if($resultCheck > 0){
                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <tr>
                            <td>
                                <h5 style="text-align: left;"><?php echo $row['name']; ?></h5>
                                <p style="text-align: left;  border: 0.5px #000; border-bottom-style: solid"><?php echo $row['description'] . "<br>"; ?></p>
                                <p style="text-align: right; font-size: 15px;"><?php echo  strtoupper($row['username']); ?></p>
                            </td>
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