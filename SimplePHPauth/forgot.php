<?php

session_start();
require("config.php");
// Define variables and initialize with empty values
$username = $username_err = "";
$rpassword = $security = $answer = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else {
        $username = trim($_POST["username"]);
    }
    
    // Validate credentials
    if(empty($username_err)) {
        // Prepare a select statement
        $sql = "SELECT id, username, password, security, answer FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)) {
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if (mysqli_stmt_num_rows($stmt) == 1) {
                	if ($result = mysqli_query($link, "SELECT username, password, security, answer FROM users WHERE username = '$username'")) {

                        while ($row = mysqli_fetch_row($result)) {
                            //Session variables to be carried into retrieve.php.
                            $_SESSION["temp-un"] = $row["0"];
                            $_SESSION["password"] = $row["1"];
                            $_SESSION["security"] = $row["2"];
                            $_SESSION["answer"] = $row["3"];
                        }

                        // Redirect user to recovery page
                        header("location: retrieve.php");  
                    } else {
                        echo "Query didn't work.";
                    }
                } else {
                    $username_err = "No account found with that username.";
                }
            }
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="wrapper">
        <h2>Recover Your Password</h2>
        <p>Please enter your username</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>    
            
            <div class="form-group">
                <input type="submit" class="btnlogin" value="Submit">
            </div>

            <p>Don't have an account? <a href="register.php">Sign up now</a>.</p>

            <p>Go Back <a href="home.php">Home</a>.</p>
            
        </form>
    </div>    
</body>
</html>