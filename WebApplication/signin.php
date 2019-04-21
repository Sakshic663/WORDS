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

<!doctype html>
<html lang="en">
<head>
	<!-- important for compatibility charset -->
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="styles.css">

</head>

<body >

    <header class="header-basic">
        <div class="header-limiter">
            <h1><a href="#">ConnectMe</a></h1>
            <nav>
                <a href="#">About</a>
                <a href="#">Login</a>
                <a href="#">Register</a>
                <a href="#">Dev Team</a>
            </nav>
        </div>
    </header>



    <div class="medium-5 small-12 columns form-container">

        <!--<h2>Login</h2>-->

        <div class="err"><?php echo $error; ?></div>
        <form method="post" id="app">
            <h2>Login</h2>
        <!--<label>
            Your Email address-->
            <input type="text" value="" placeholder="Enter email" name="email"/><br /><br />
            <!--</label>-->

            <!--<label>
            Your Password-->
            <input type="password" value="" placeholder="Enter password" name="password"/><br /><br />
            <!--</label>-->
            <input type="submit" value="Login" class="button primary" /> <br /><br />
            <div>
                Don't have an account?
            </div>
            <div>
                <a href="./signup.php">
                    <input type="button" value="Register" class="button primary" />
                </a>                            
            </div>
        </form>
        
    </div>
</body>
</html>

