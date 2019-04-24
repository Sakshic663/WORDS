<?php
include 'DatabaseConnection.php';
session_start();
  $error = "";
  $password = "";
  $email = "";
  if ($_POST){
    //! Checking if the email field is empty
    if(!$_POST['email']){
      $error .= "An email address is required.<br>";
    
    }
    else
      $email = $_POST['email'];
    //! Checking if the password field is empty
    if(!$_POST['password']){
      $error .= "The password is required.<br>";
    }
    else{
        $password = $_POST['password'];
        //echo "Reaches here!";
        //echo $password;
    }
    //! Checking the validity of the email
    if($_POST['email'] && filter_var($_POST['email'],FILTER_VALIDATE_EMAIL) == false){
      $error .= "The email address is invalid.<br>";
      $email = "";
    }
    //! Checking if the error message is empty. If not run the main code
    if($error != ""){
      $error = '<div class="signin-error" style="color:red;"><strong>Error:</strong><br>'.$error.'</div>';
    }
    else{
        $dbConnection = DatabaseConnection::getInstance()->getConnection();
        $query = "SELECT password FROM users WHERE `email` = '".$email."'";
        if($result = mysqli_query($dbConnection, $query)){
            $row = mysqli_fetch_array($result);
            $hashed_password = $row['password'];
            if(password_verify($password, $hashed_password)) {
                $_SESSION['email'] = $email;
                header("Location: profile.php");
            }else{
                $error = "Invalid email address or password combination OR unregistered account.";
                $error = '<div class="signin-error" style="color:red;"><strong>Error:</strong><br>'.$error.'</div>';
            }
        }
  
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon.png">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        body, html {
          height: 100%;
          margin: 0;
        }
        .hero-image {
          background-image: url("./background_header.jpg");
          background-color: #fff; 
          height: 100%;
          background-position: center;
          background-repeat: no-repeat;
          background-size: cover;
          opacity: 0.5;
        }
        .signinForm {
          position: absolute;
          top: 50%;
          left: 50%;
          transform: translate(-50%, -50%);
          color: white;
          opacity: 3;
          background-color: #fff;
        }
        #signin {
            border-radius: 3px;
            background-color: #000;
            color: #fff;
        }
        #signin:hover{
            color: #000;
            background-color: #fff;
            border-radius: 3px;
        }
    </style>
</head>

<body >

    <header class="header-basic">
        <div class="header-limiter">
            <h1 style="color: #fff;">WORDS</h1>
            <nav>
                <a href="index.html">About</a>
                <a href="#">Login</a>
                <a href="signup.php">Register</a>
                <a href="#">DevTeam</a>
            </nav>
        </div>
    </header>

    <div class="hero-image"></div>

    <div class="medium-5 small-12 columns form-container">
        <form method="post" id="app" style="width: 30%; height: 55%; padding-top: 35px;" class="signinForm">
            <h2 style="color: #000;">Login</h2>
            <input type="text" value="" placeholder=" Enter email" name="email"/><br /><br />
            <input type="password" value="" placeholder=" Enter password" name="password"/><br /><br />
            <input type="submit" value="Login" class="button primary" id="signin" /> <br />
            <div class="err"><?php echo $error; ?></div>
            <div style="color: #000;">
                <a href="./signup.php">Don't have an account?</a>
            </div>
        </form>    
    </div>
</body>
</html>