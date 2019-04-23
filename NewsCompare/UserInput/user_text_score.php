<html>
<head>
<link rel="stylesheet" href="userinputstyle.css">
</head>

<body>
	<script type="text/javascript"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script>
		function choosecp(){
		 $("#copy").removeClass('display-none');
		 $("#a").addClass('display-none');
		 $("#b").addClass('display-none');
		 $("#c").removeClass('display-none');
		 }
		 function restart(){
		 $("#file").addClass('display-none');
		 $("#copy").addClass('display-none');
		 $("#a").removeClass('display-none');
		 $("#b").removeClass('display-none');
		 $("#c").addClass('display-none');
		 $("#d").addClass('display-none');
		 }
	</script>
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
	<h1>Test the readability of any text!</h1>
	<a><div id="b" class="choice_button" onclick="choosecp()">Paste your work
	<div class= "centered"><i class="fa fa-clipboard" aria-hidden="true"></i></i></div>
	</div></a> 
	<!-- Processes inserted text -->
	<form id = "copy" class= "display-none" action="typeaction.php" method = "post">
	  <textarea class = "text_box" type="text" placeholder= "What will your score be...." minlength="30" name="paste"></textarea><br>
	  <input class = "submit_button" type="submit" value="Submit">
	</form>
	

	<a class = "restart" href= "../options.php"><i class="fa fa-reply" aria-hidden="true"></i></a>
	</body>
</html>
