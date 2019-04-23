<?php
require("config.php");

$un= $_POST["value"];

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
    		$result2 = mysqli_query($link, "SELECT password, question, answer FROM users3 WHERE username='$un';");
    		$obj = new stdClass();
			while ($info = mysqli_fetch_assoc($result2))
			{
				$obj->pass = $info["password"];
				$obj->quest = $info["question"];
				$obj->answ = $info["answer"];

				echo json_encode($obj);
			}

    	}
    }

    //display an error message if no email address matches
    if($found == false)
    {
    	echo "<h4>EMAIL IS NOT ASSOCIATED WITH AN ACCOUNT!</h4>";
    	exit();
    }
?>