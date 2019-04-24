<?php
include 'DatabaseConnection.php';
$dbConnection = DatabaseConnection::getInstance()->getConnection();

$error = "";
$password = "";
$confirmedPassword = "";
$email = "";
$username = "";

if ($_POST){
    //! Checking if username field is empty
    if(!$_POST['username']){
        $error .= "A username is required.<br>";

    }
    else
        $username = $_POST['username'];
    //! Checking if email field is empty
    if(!$_POST['email']){
      $error .= "An email address is required.<br>";

  }
  else
      $email = $_POST['email'];
    //! Checking if password field is empty
  if(!$_POST['password']){
      $error .= "The password is required.<br>";
  }
  else
      $password = $_POST['password'];
    //! Checking if confirm password field is empty
  if(!$_POST['confirmPassword']){
    $error .= "Confirmation of your password is required.<br>";
}
else
    $confirmedPassword = $_POST['confirmPassword'];
    //! Checking if the passwords match
if(($_POST['confirmPassword'] && $_POST['password']) && $_POST['confirmPassword'] != $_POST['password']){
    $error .= "Passwords do not match.<br>";
}
    //! Checking if the email is in valid format
if($_POST['email'] && filter_var($_POST['email'],FILTER_VALIDATE_EMAIL) == false){
  $error .= "The email address is invalid.<br>";
  $email = "";
}else if ($_POST['email'] && filter_var($_POST['email'],FILTER_VALIDATE_EMAIL) == true){
    $query = "SELECT * FROM users WHERE `email` = '".$_POST['email']."'";
    if($rslt = mysqli_query($dbConnection, $query)) {
        if (mysqli_num_rows($rslt)) {
            $error .= "An account with the same email address already exists. <br>";
        }
    }
}
    //! Displaying the error message if its not empty or executing main code if it is
if($error != ""){
  $error = '<div class="signup-error" style="color:red;"><strong>Error:</strong><br>'.$error.'</div>';
}
else{
       // $error = '<div class="signup-success" style="color:green;"><p>Sign Up Success!</p></div>';
        $password_hash = password_hash($password, PASSWORD_DEFAULT); //? Hashing the password
        $query = "INSERT INTO `users` (`email`, `password`, `username`) VALUES ('".$email."', '".$password_hash."', '".$username."')";
        mysqli_query($dbConnection, $query);
        header('Location: ./signin.php');
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    
    <title>Register</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
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
        .signupForm {
          position: absolute;
          top: 50%;
          left: 50%;
          transform: translate(-50%, -50%);
          color: white;
          opacity: 3;
          background-color: #fff;
        }
        #signup {
            border-radius: 3px;
            background-color: #000;
            color: #fff;
        }
        #signup:hover{
            color: #000;
            background-color: #fff;
            border-radius: 3px;
        }
    </style>
</head>
<body class="inner-page">
    <!-- header -->
    <header class="header-basic">
        <div class="header-limiter">
            <h1><a href="#">WORDS</a></h1>
            <nav>
                <a href="index.html">About</a>
                <a href="signin.php">Login</a>
                <a href="#">Register</a>
                <a href="#">DevTeam</a>
            </nav>
        </div>
    </header>

    <div class="hero-image"></div>

    <!-- Sign up form -->
    <!--<div class="container">-->
        <!--<div class="content-container module">-->
         <!--<div class="row">-->
           <!--<div class="medium-5 small-12 medium-offset-1 columns form-container">-->
            <form method="post" id="app" class="signupForm" style="margin-top: 5%; padding: 50px; width: 30%; height: 65%;">
                <h2 style="color: #000;">Register</h2>
                <input type="text" name="username" value="" placeholder=" Enter username" /><br /><br />
                <input type="text" name="email" value="" placeholder=" Enter email" /><br /><br />
                <input type="password" name="password" value="" placeholder=" Enter password" /><br><br />
                <input type="password" name="confirmPassword" value="" placeholder=" Confirm password" /><br /><br />
                <!--<div class="err"><?php echo $error; ?></div>-->
                <input type="submit" value="Sign Up" class="button primary" id="signup" style="width: 30%;" /><br />
                <a href="signin.php">Already have an account?</a>
            </form>
        <!--</div>-->
    <!--</div>-->
<!--</div>-->
<!--</div>-->
</body>
</html>