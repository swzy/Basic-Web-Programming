<?php
	session_start();
	require_once "config.php";
?>

<!DOCTYPE html>
<body>
<div id="wrapper">

		<h1>Answer</h1>
		<h3>It's B</h3>
        <?php
            
            $answer1 = $_POST['Q1-Answers'];
            
            if ($answer1 == "B") { echo"You got it."; }
			else{echo"You didn't get it.";}
            
        ?>
	
	</div>
</body>