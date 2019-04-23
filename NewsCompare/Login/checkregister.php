<?php
	require("config.php");

	$un= $_POST["emailadd"];
	$pwd1 = $_POST["pwd1"];
	$pwd2= $_POST["pwd2"];
	$question = $_POST["question"];
	$answer = $_POST["ans"];

	if(preg_match('/^[a-zA-Z0-9_.]+@[a-zA-Z]+\.[a-zA-Z]+/', $un) !== 1)
	{
		echo "<h4>INVALID EMAIL ADDRESS ENTERED!</h4>";		//stores the error message to be displayed in new webpage
		exit();
	}


	//gets all emails from db
	$result = mysqli_query($link,"SELECT username FROM users3;");
	$list = Array();

	//checks if user entered email is already registered or not
	while ($row = mysqli_fetch_assoc($result))
    {
    	$list[] = $row['username'];
    	
    	if(strcasecmp($row['username'], $un) == 0)
    	{
    		echo "<h4>EMAIL IS ALREADY IN USE!</h4>";	
    		exit();
    	}
    }

   	//this will check if the entered passwords match or not
	if($pwd1 !== $pwd2)
	{
		echo "<h4>PASSWORDS DO NOT MATCH!</h4>";
		exit();
	}
	else 	//if everthing is good insert new user into db
	{
		$sql = "INSERT INTO users3 (username, password, question, answer) VALUES ('".$un."', '".$pwd1."', '".$question."', '".$answer."');";
		mysqli_query($link, $sql);
		session_start();
		$_SESSION["loggedin"] = true;
		$_SESSION["username"] = $un;
		
		$obj = new stdClass();
		$obj->bool = true;

		echo json_encode($obj);

	}
	mysqli_close($link);
?>
