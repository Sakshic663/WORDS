<?php
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
        //? Generate the query command/code
        $query = "SELECT password FROM users WHERE `email` = '".$email."'";
        //? Query the database
        $result = mysqli_query($link, $query);
        //? Get the row from database as an array
        $row = mysqli_fetch_array($result);
        //? Single out the hashed password from the row array
        $hashed_password = $row['password'];
        //echo "<br/>";
        //echo $hashed_password;
        if(password_verify($password, $hashed_password)) {
            // If the password inputs matched the hashed password in the database
            // Log them in.
            echo "Login sucess!";
        }else{
            echo "Login failure!";
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
    
    <title>ConnectMe - Sign In</title>

</head>

<body >
		
            <!-- Title Section -->
            <div class="title-section">
                <div class="row">
                    <div class="small-12 columns">
                        <h1>Welcome</h1>
                    </div> <!-- title /-->
                </div><!-- row /-->
            </div>
            <!-- Title Section End -->
            
           
                <div class="medium-5 small-12 columns form-container">

                        <h2>Sign In to start browing</h2>

                        <div class="err"><?php echo $error; ?></div>
                        <form method="post">
    
                            <label>
                                Your Email address
                                <input type="text" value="" placeholder="Your Email Address ..." name="email"/><br>
                            </label>
                            
                            <label>
                                Your Password
                                <input type="password" value="" placeholder="Enter password ..." name="password"/><br>
                            </label>
                            <input type="submit" value="Sign In" class="button primary" />
    
                        </form>
                        <div>
                            Don't have an account?
                        </div>
                        <div>
                        <a href="./signup.php">
                            <input type="submit" value="Register" class="button primary" />
                        </a>
                            
                        </div>
        
        </div>
 
</body>
</html>