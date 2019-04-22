<?php
    include 'DatabaseConnection.php';
    $dbConnection = DatabaseConnection::getInstance()->getConnection();
    session_start();
    $testerID = "";
   
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

    <!--<div class="container">
                <div class="header">
            <div class="row">
                <div class="float-right">
                    
                <a href="logout.php" id="logout" class="button primary" title="SIGN OUT">SIGN OUT</a>
                </div>
            </div>
        </div>-->
        <!--<div class="row">
                    <div class="small-12 columns">
                        <h1>New Post</h1>
                    </div>
        </div>-->
    
        <div class="err">
            <?php echo $error; ?>
        </div>
        <form method="post" enctype="multipart/form-data" id="newpost">
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
