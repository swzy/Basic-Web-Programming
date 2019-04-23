<html>
<head>
<link rel="stylesheet" type="text/css" href="score_articles.css">
</head>

<!-- $genreList = array(1 => 'politics', 2 => 'technology', 3 => 'finance', 4 => 'crime', 5 => 'opinion'); -->

<body>
	<script src="https://use.fontawesome.com/4fe18aaa6f.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Amatic+SC|Open+Sans|Poiret+One" rel="stylesheet">
	<div id="logout">
		<?php 
			session_start();
    		if(isset($_SESSION["loggedin"]))
   	 		{ 
      			echo "<a id='logoutbutton' href='../Login/logout.php'  class='button'>Logout</a>";
      			
    		}
 		?>
 	</div>
	<div class = "x"></div>
	<h1>Choose a genre.</h1>
	<form action="./api_call.php" method = "get">
	  <select class = "form_field" name= "genre">
		<option value="0">Politics</option>
		<option value="1">Technology</option>
		<option value="2">Finance</option>
		<option value="3">Crime</option>
		<option value="4">Opinion</option>
	  </select>
	  <input class = "submit_button" type="submit" value="Submit">
	</form>
	<a class = "restart" href= "../options.php"><i class="fa fa-reply" aria-hidden="true"></i></a>
	</body>
</html>
