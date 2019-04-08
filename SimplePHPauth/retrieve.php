<?php
session_start();
require_once("config.php");

$real_security = $_SESSION["security"];
$real_answer = $_SESSION["answer"];

$security_err = $answer = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["answer"]))) {
        $security_err = "This field cannot be blank.";
    } else {
        $answer = $_POST["answer"];
    }

    // Validate credentials
    if(empty($username_err)) {
        // Prepare a select statement
        if ($answer == $real_answer) {
            // Redirect user to welcome page
            header("location: check.php");
        }
    } else {
        $security_err = "The question and/or answer are incorrect. Please try again.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Retrieve Password</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="wrapper">
        <h2>Answer the Security Question</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
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

            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
            </div>
            <p><a href="home.php">Back to Home</a>.</p>
        </form>
    </div>    
</body>
</html>
