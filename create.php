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
    $date = new DateTime();
    $currentTime = $date->format('U');
    $itemName = "";
   
    $itemDescription = "";
  
    $error = "";
    if ($_POST){
        if(!$_POST['itemName']){
          $error .= "A name for the item is required.<br>";
        }else{
          $itemName = $_POST['itemName'];
        }
       
        if(!$_POST['itemDescription']){
            $error .= "A description is required.<br>";
        }else{
            $itemDescription = $_POST['itemDescription'];
        } 
        
        
        if($error != ""){
            $error = '<div class="signin-error" style="color:red;"><strong>Error:</strong><br>'.$error.'</div>';
          }else{
              $query = "SELECT * FROM users WHERE `email` = '".$testerID."'";
              $result = mysqli_query($dbConnection, $query);
              $row = mysqli_fetch_array($result);
              $userID = $row['userId'];
              $uname = $row['username'];
              $query = "INSERT INTO `posts` (`name`,  `description`, `userId`, `username`) VALUES ('".$itemName."',  '".$itemDescription."', '".$userID."','".$uname."')";
              mysqli_query($dbConnection, $query);
              header('Location: ./profile.php');
            }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Create New Post</title>
    <style>
        body, html {
            height: 100%;
          margin: 0;
        }
        .hero-image {
          background-image: url("./create_background.jpg");
          background-color: #fff; 
          height: 80%;
          background-position: center;
          background-repeat: no-repeat;
          background-size: cover;
          opacity: 0.75;
        }
        .createForm {
          position: absolute;
          top: 50%;
          left: 50%;
          transform: translate(-50%, -50%);
          background-color: #fff;
        }
        #postCreate {
            border-radius: 3px;
            background-color: #fff;
            border: 2px solid #000;
            color: #000;
            float: right;
            margin-right: 6%;
        }
        #postCreate:hover{
            color: #fff;
            background-color: #000;
            border-radius: 3px;
        }
    </style>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <meta name="author" content="">
    <meta name="keywords" content="">
    <meta name="description" content="">
</head>
<body class="inner-page">
    <header class="header-basic">
        <div class="header-limiter">
            <h1><a href="#">WORDS</a></h1>
            <nav>
                <a href="logout.php" id="logout" class="button primary" title="SIGN OUT">SIGN OUT</a>
            </nav>
        </div>
    </header>

    <div class="hero-image"></div>
        <form method="post" enctype="multipart/form-data" id="newpost" class="createForm" style="margin-top: 10%;">
            <h1>New Post</h1>
             <div class="err" style="margin-left: 5px;">
                <?php echo $error; ?>
            </div>
            <label>
                Title<br />
                <input maxlength="100" type="text" id="nameItem" name="itemName" value="" placeholder=" Enter title" />
            </label><br />
            <label>
                Content<br />
                <textarea name="itemDescription" placeholder=" Enter content" id="contentItem" rows="13" cols="110" maxlength="300" style="overflow-y: scroll;"></textarea>
            </label> <br>
            <input type="submit" id='postCreate' value="Create Post" class="button primary" />
        </form>
    </body>
</html>