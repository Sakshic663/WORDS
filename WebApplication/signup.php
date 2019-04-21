    
<?php
    $error = "";
    $password = "";
    $confirmedPassword = "";
    $email = "";
    $username = "";
    $host = "localhost";
    $uname = "root";
    $pwd = "";
    $database = "connect_me";
    $link = mysqli_connect($host, $uname, $pwd, $database);
    if(mysqli_connect_error()){
        exit("There was an error connecting to the database");
    }else{
        //echo "Database connection successful!";
    }
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
    }
    //! Displaying the error message if its not empty or executing main code if it is
    if($error != ""){
      $error = '<div class="signup-error" style="color:red;"><strong>Error:</strong><br>'.$error.'</div>';
    }
    else{
        $error = '<div class="signup-success" style="color:green;"><p>Sign Up Success!</p></div>';
        $password_hash = password_hash($password, PASSWORD_DEFAULT); //? Hashing the password
        $query = "INSERT INTO `users` (`email`, `password`, `username`) VALUES ('".$email."', '".$password_hash."', '".$username."')";
        mysqli_query($link, $query);
    }
  }
?>

<!doctype html>
<html lang="en">
<head>
	<!-- important for compatibility charset -->
    <meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
    
    <title>ConnectMe - Sign Up</title>
	
    
    
</head>

<body class="inner-page">
	<!-- MAIN Container Start here. -->
	<div class="container">
    
        <div class="content-container module">
           <div class="row">
            	<div class="medium-5 small-12 medium-offset-1 columns form-container">

                                <h2>Sign Up to start browing</h2>

                                <div class="err"><?php echo $error; ?></div>

                                <form method="post">
                                    <label>
                                            Username
                                            <input type="text" name="username" value="" placeholder="Your Username ..." /><br>
                                            </label>
    
                                        <label> 

                                    <label>
                                        Your Email address
                                        <input type="text" name="email" value="" placeholder="Your Email Address ..." /><br>
                                    </label>
                                    
                                        Your Password
                                        <input type="password" name="password" value="" placeholder="Enter password ..." /><br>
                                    </label>

                                    <label>
                                            Confirm Password
                                            <input type="password" name="confirmPassword" value="" placeholder="Confirm password ..." /><br>
                                        </label>


                                    <input type="submit" value="Sign Up" class="button primary" />
            
                                </form>
                
                </div>
            </div>
   
        </div> <!-- content-container /-->
        

	</div>
    
</body>
</html>