<html>
<head>
<link rel="stylesheet" type="text/css" href="options.css">
</head>
<?php
	session_start();
?>
<body>
	<script src="https://use.fontawesome.com/4fe18aaa6f.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Amatic+SC|Open+Sans|Poiret+One" rel="stylesheet">
	<div id="logout" >
		<?php 
    		if(isset($_SESSION["loggedin"]))
   	 		{ 
      			echo "<a href='./Login/logout.php'  class='button'>Logout</a>";
      			
    		}
 		?>
 	</div>
	<div class = "x"></div>
	<h1>Welcome back, <?php echo $_SESSION["username"] ?>! Would you like to score your own work or some articles?</h1>


	<a class = "left_button" href = "./UserInput/user_text_score.php">Calculate your scores
	<div class= "centered"><i class="fa fa-calculator" aria-hidden="true"></i></div>
	</a>
	<a class = "right_button" href = "./Articles/score_articles.php">Score Articles
	<div class= "centered"><i class="fa fa-newspaper-o" aria-hidden="true"></i></div>
	</a>
	<a class = "restart" href= "./Login/logout.php"><i class="fa fa-reply" aria-hidden="true"></i></a>
</body>
</html>
