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
        
        
        
    }
?>
<!doctype html>
<html lang="en">

<head>
    <!-- important for compatibility charset -->
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title> New Post</title>

    <meta name="author" content="">
    <meta name="keywords" content="">
    <meta name="description" content="">
</head>

<body class="inner-page">
    <!-- MAIN Container Start here. -->
    <div class="container">
        <!-- Header Starts -->
        <div class="header">
            <div class="row">
                <div class="float-right">
                    
                <a href="logout.php" id="logout" class="button primary" title="SIGN OUT">SIGN OUT</a>
                </div>
            </div>
        </div>
        <div class="row">
                    <div class="small-12 columns">
                        <h1>New Listing</h1>
                    </div>
                    <!-- title /-->
        </div>
    
        <div class="err">
            <?php echo $error; ?>
        </div>
        <form method="post" enctype="multipart/form-data">
            <label>
                Item For Sale
                <input maxlength="100" type="text" id="nameItem" name="itemName" value="" placeholder="Enter Item Name" />
            </label>
            <label>
                Description
                <textarea name="itemDescription" placeholder="Brief Description" id="descriptionItem" rows="4" maxlength="200"></textarea>
            </label> <br>
            <input type="submit" id='postCreate' value="Create Post" class="button primary" />
        </form>
</body>

</html>
