<?php
	session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sensitive Info</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="wrapper">
        <h2>Success!</h2>
        <p>Your information is: </p>
        <p>Username: <?php echo $_SESSION["temp-un"] . "<br>";?> </p>
        <p>Password: <?php echo $_SESSION["password"] . "<br>";?> </p>
        <p><a href="home.php">Back to Home</a>.</p>
    </div>
</body>
</html>