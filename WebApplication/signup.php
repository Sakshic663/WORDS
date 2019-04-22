    
<?php
include 'DatabaseConnection.php';
$dbConnection = DatabaseConnection::getInstance()->getConnection();
//require '../vendor/autoload.php';
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
        $error = '<div class="signup-success" style="color:green;"><p>Sign Up Success!</p></div>';
        $password_hash = password_hash($password, PASSWORD_DEFAULT); //? Hashing the password
        $query = "INSERT INTO `users` (`email`, `password`, `username`) VALUES ('".$email."', '".$password_hash."', '".$username."')";
        mysqli_query($dbConnection, $query);
    }
  }
?>
<!doctype html>
<html lang="en">
<head>
	<!-- important for compatibility charset -->
    <meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
    
    <title>Register</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
	
    
    
</head>

<body class="inner-page">

    <header class="header-basic">
        <div class="header-limiter">
            <h1><a href="#">ConnectMe</a></h1>
            <nav>
                <a href="#">About</a>
                <a href="signin.php">Login</a>
                <a href="#">Register</a>
                <a href="#">Dev Team</a>
            </nav>
        </div>
    </header>
	<!-- MAIN Container Start here. -->
	<div class="container">
    
        <div class="content-container module">
           <div class="row">
            	<div class="medium-5 small-12 medium-offset-1 columns form-container">

                                <!--<h2>Register</h2>-->

                                <div class="err"><?php echo $error; ?></div>

                                <form method="post" id="app">
                                    <h2>Register</h2>
                                    <!--<label>
                                            Username-->
                                            <input type="text" name="username" value="" placeholder="Enter username" /><br /><br />
                                            <!--</label>-->
    
                                    <!--<label> 
                                    <label>
                                        Your Email address-->
                                        <input type="text" name="email" value="" placeholder="Enter email" /><br /><br />
                                    <!--</label>
                                    
                                        Your Password-->
                                        <input type="password" name="password" value="" placeholder="Enter password" /><br><br />
                                    <!--</label>

                                    <label>
                                            Confirm Password-->
                                            <input type="password" name="confirmPassword" value="" placeholder="Confirm password" /><br /><br />
                                        <!--</label>-->


                                    <input type="submit" value="Sign Up" class="button primary" /><br />
                                    <a href="signin.php">Already have an account?</a>
                                </form>
                
                </div>
            </div>
   
        </div> <!-- content-container /-->
        

	</div>
    
</body>
</html>


