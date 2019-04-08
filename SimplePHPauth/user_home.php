<?php
	session_start();
	require_once "config.php";

	$username = $_SESSION['username'];
	$result = mysqli_query($link, "SELECT name FROM users WHERE USERNAME ='".$username."'");
	$row = mysqli_fetch_array($result);
	$name = $row['name'];

	echo "Hello, ";
	echo $name;
	echo "!<br>
		Below is the topic you have chosen:";
	
	$result = mysqli_query($link, "SELECT * FROM topics WHERE USERNAME ='".$username."'");
	$row = mysqli_fetch_array($result);

?>

<!DOCTYPE html>
<body>
	<?php
		if($row['math'] == '1'){
			echo "<form action='math.php'>
		<input type='submit' value='Math'>";
		}else if($row['religion'] == '1'){
			echo "<form action='religion.php'>
		<input type='submit' value='Religion'>";
		}else{
			echo "<form action='science.php'>
		<input type='submit' value='Science'>";
		}
	?>
	</form>
</body>