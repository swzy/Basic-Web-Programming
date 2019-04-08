<?php
// Include config file
session_start();
require_once "config.php";
 
// Define variables and initialize with empty values
$username = $password = $confirm_password = "";
$name = $answer = "";
$username_err = $password_err = $confirm_password_err = "";
$name_err = $security_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["username"]))) {
        $username_err = "Please enter a username.";
	} 

    elseif ($username = trim($_POST["username"])) {
		if (!filter_var($username, FILTER_VALIDATE_EMAIL)) {
			$username_err = "Must enter an email address. Try again.";
        } 
        else {
            // Prepare a select statement
            $sql = "SELECT id FROM users WHERE username = ?";
            
            if($stmt = mysqli_prepare($link, $sql)) {
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "s", $param_username);
                
                // Set parameters
                $param_username = trim($_POST["username"]);
                
                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    /* store result */
                    mysqli_stmt_store_result($stmt);
                    // If any rows are returned with that username...
                    if(mysqli_stmt_num_rows($stmt) == 1){
                        $username_err = "This username is already taken.";
                    } else {
                        $username = trim($_POST["username"]);
                    }
                } else {
                    echo "Oops! Something went wrong. Please try again later.";
                }
            }
             
            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 5){
        $password_err = "Password must have atleast 5 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }

    // Validate name
    if(empty(trim($_POST["name"]))){
        $name_err = "Please enter your name";
    } else{
        $name = trim($_POST["name"]);
    }


    // Validate security answer
    if(empty(trim($_POST["answer"]))){
        $security_err = "Cannot leave this field blank.";     
    } else{
        $answer = trim($_POST["answer"]);
    }
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err) && empty($name_err) && empty($security_err)) {
        
        // Prepare an insert statement
        $sql = "INSERT INTO users (username, password, name, security, answer, topic) VALUES (?, ?, ? ,? ,? ,?)";

        // Prepare an insert statement to store selected into table
        $sql2 = "INSERT INTO topics (username, math, science, religion) VALUES (?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssss", $param_username, $param_password, $param_name, $param_security, $param_answer, $param_topic);
            
            // Set all parameters for both $sql and $sql2 statements
            $param_username = $username;
            $param_password = $password;
            $param_name = $_POST["name"];
            $param_security = $_POST["security"];
            $param_answer = $_POST["answer"];
            $param_topic = $_POST["topic"];

            $param_math = "0";
            $param_science = "0";
            $param_religion = "0";
            // Simple logic to record what topic user chose in topics table
            if ($param_topic == "Math") {
                $param_math = "1";
            } elseif ($param_topic == "Science") {
                $param_science = "1";
            } elseif ($param_topic == "Religion") {
                $param_religion = "1";
            }
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)) {
                //Close statement
                mysqli_stmt_close($stmt);
            } else {
                echo "Something went wrong. Please try again later.";
            }
        } 
        if($stmt2 = mysqli_prepare($link, $sql2)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt2, "ssss", $param_username, $param_math, $param_science, $param_religion);

            if(mysqli_stmt_execute($stmt2)) {  
                // Close mysqli stmt
                mysqli_stmt_close($stmt2);
                // Redirect to login page and save username
                $_SESSION['username'] = $username;
                header("location: user_home.php");

            } else {
                echo "Topic wasn't saved. Please try again.";
            }

        } else {
            echo "Something with topic table went wrong.";
        }
    }
    // Close connection
    mysqli_close($link);
}

?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="wrapper">
        <h2>Sign Up</h2>
        <p>Fill this form to create an account.</p>
        
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block" style="color: #a52a2a;"><?php echo $username_err; ?></span>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                <span class="help-block" style="color: #a52a2a;"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
                <span class="help-block" style="color: #a52a2a;"><?php echo $confirm_password_err; ?></span>
            </div>

            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" class="form-control" placeholder="Your Name Here" value="<?php echo $name; ?>">
                <span class="help-block" style="color: #a52a2a;"><?php echo $name_err; ?></span>
            </div>

            <div class="form-group">
                <label>Security Question</label>
                <select id="security" name="security">
                    <option>Childhood Name</option>
                    <option>Favorite Color</option>
                    <option>Random</option>
                </select>
            </div>

            <div class="form-group">
                <label>Answer</label>
                <input type="text" name="answer" class="form-control" value="<?php echo $answer; ?>">
                <span class="help-block" style="color: #a52a2a;"><?php echo $security_err; ?></span>
            </div>

            <p>Select topic to register for! You can select more later.</p>
            <div class="form-group">
                <label>topic</label>
                <select id="topic" name="topic">
                    <option>Math</option>
                    <option>Science</option>
                    <option>Religion</option>
                </select>
                <!-- We may want to create a way to save topic dropdown menu options here -->
                <div id="topicTable">
                </div>
            </div>

            

            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">
            </div>
            <p>Already have an account? <a href="home.php">Return to Home</a></p>
        </form>
    </div>    
</body>
</html>