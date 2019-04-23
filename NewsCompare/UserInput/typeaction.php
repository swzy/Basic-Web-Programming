<html>
	<head>
	<link rel="stylesheet" href="typeaction.css">
</head>
	<body>
	<script src="https://use.fontawesome.com/4fe18aaa6f.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Amatic+SC|Open+Sans|Poiret+One" rel="stylesheet">
	<div id="logout" >
		<?php 
			session_start();
    		if(isset($_SESSION["loggedin"]))
   	 		{ 
      			echo "<a href='./Login/logout.php'  class='button'>Logout</a>";
      			
    		}

    		//Escapes all special characters - HIGHLY NECESSARY
			function esc($string)
			{
			    return str_replace("\n", '\n', str_replace('"', '\"', addcslashes(str_replace("\r", '', (string)$string), "\0..\37'\\")));
			}
 		?>
 	</div>
	<div class = "x"></div>
	<h1>Here are your results:</h1>
	<div class = "original_box" id="original"></div>
	<div class = "grade_box" id = "grade"></div>
	<a class = "restart" href= "../options.php"><i class="fa fa-reply" aria-hidden="true"></i></a>

	<script>var exports = [];</script>
	<script src="flesch-kincaid.js"></script>
		<?php
		//This corrects quotations error in POST response
		$userinput = esc($_POST["paste"]);
		echo'<script type="text/javascript">
		var FleschKincaid = exports;
		document.getElementById("original").innerHTML = "Original text:<br><br>\"',$userinput,'\"";
		document.getElementById("grade").innerHTML = "Grade: " + FleschKincaid.grade("',$userinput,'");
		</script>';
		?>

	</body>
</html>
