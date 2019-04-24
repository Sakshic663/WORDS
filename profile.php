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
    <title>Profile Page</title>
    <script src="logoutSuccess.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon.png">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        body, html {
            height: 100%;
            margin: 0;
        }
        .hero-image {
          background-image: url("./create_background.jpg");
          background-color: #fff; 
          height: 80%;
          background-repeat: repeat-y;
          background-size: cover;
          opacity: 0.75;
        }
        .table {
          position: absolute;
          top: 50%;
          left: 50%;
          transform: translate(-50%, -50%);
          background-color: #fff;
        }
    </style>
</head>
<body>
    <header class="header-basic">
        <div class="header-limiter">
            <h1 style="color: #fff;">WORDS</h1>
            <nav>
                <a href="logout.php" id="logout" class="button primary" title="SIGN OUT">SIGN OUT</a>
            </nav>
        </div>
    </header>
    <script type="text/javascript">
        logoutSuccess('logout');
    </script>

        <div class="hero-image"></div>
        <div class="hero-image"></div>

        <a href="./create.php">
        <img src="./plus.png" class="btn">
</a>        
<div>
    <table id = "postTable" class="table table-striped" style="width: 80%; margin-top: 30%;">
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