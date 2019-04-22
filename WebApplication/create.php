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
              $query = "SELECT userId FROM users WHERE `email` = '".$testerID."'";
              $result = mysqli_query($dbConnection, $query);
              $row = mysqli_fetch_array($result);
              $userID = $row['userId'];
              $query = "INSERT INTO `posts` (`name`,  `description`, `userId`) VALUES ('".$itemName."',  '".$itemDescription."', '".$userID."')";
              mysqli_query($dbConnection, $query);
              header('Location: ./profile.php');
            }
    }
?>
<!doctype html>
<html lang="en">

<!doctype html>

<html lang="en">

 

<head>

    <!-- important for compatibility charset -->

    <meta charset="utf-8">

    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>Create New Post</title>

    <link rel="stylesheet" type="text/css" href="styles.css">

 

 

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
   

        <div class="err">

            <?php echo $error; ?>

        </div>

        <form method="post" enctype="multipart/form-data" id="newpost">

            <img src="./createart.png" style="float: right;" id="createart">

            <h1>New Post</h1>

            <label>

                Title<br />

                <input maxlength="100" type="text" id="nameItem" name="itemName" value="" placeholder="Enter title" />

            </label><br /><br />

            <label>

                Content<br />

                <textarea name="itemDescription" placeholder="Enter content" id="contentItem" rows="20" cols="50" maxlength="200" style="overflow-y: scroll;"></textarea>

            </label> <br>

            <input type="submit" id='postCreate' value="Create Post" class="button primary" />

        </form>

 

</body>

</html>