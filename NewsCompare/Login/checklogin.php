<?php
	require("config.php");

	$un= $_POST["emailadd"];
	$pwd1 = $_POST["pwd1"];

	if(preg_match('/^[a-zA-Z0-9_.]+@[a-zA-Z]+\.[a-zA-Z]+/', $un) !== 1)
	{
		echo "<h4>INVALID EMAIL ADDRESS ENTERED!</h4>";					//display error message
		exit();
	}

	//gets all emails from db
	$result = mysqli_query($link,"SELECT username FROM users3;");
	$list = Array();

	$found = false;
	//checks if user entered email is already registered or not. if it finds a match it will grab the password
	while ($row = mysqli_fetch_assoc($result))
    {
    	if(strcasecmp($row['username'], $un) == 0)
    	{
    		$found = true;
    		$pass = mysqli_query($link, "SELECT password FROM users3 WHERE username='$un';");
    		$rows = mysqli_fetch_assoc($pass);	
			$password = $rows['password'];
    	}
    }

    //display an error message if no email address matches
    if($found == false)
    {
    	echo "<h4>EMAIL IS NOT ASSOCIATED WITH AN ACCOUNT!</h4>";
    	exit();
    }

   	//checks if the entered password matches one in db
	if($password !== $pwd1)
	{
		echo "<h4>INCORRECT PASSWORD ENTERED!</h4>";
		exit();
	}
	else 	//if everthing is good then sign in
	{
		session_start();
		$_SESSION["loggedin"] = true;
		$_SESSION["username"] = $un;

		$obj = new stdClass();
		$obj->bool = true;

		echo json_encode($obj);

		
	}
	mysqli_close($link);
?>
