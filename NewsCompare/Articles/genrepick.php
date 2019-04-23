<?php
	session_start();
	$count = 0;
	$genreList = array(0 => 'politics', 1 => 'technology', 2 => 'finance', 3 => 'crime', 4 => 'opinion');
	$loaded_articles = $_SESSION['loaded_articles'];
	if (sizeof($loaded_articles) > 0){
		$genre = $_SESSION['usergenre'];
	}
?>

<html>
<head>
<link rel="stylesheet" type="text/css" href="genrepick.css">
<link href="https://fonts.googleapis.com/css?family=Amatic+SC|Open+Sans|Poiret+One" rel="stylesheet">
<script>var exports = [];</script>
<script src='../UserInput/flesch-kincaid.js'></script>
<script type='text/javascript'>var FleschKincaid = exports;</script>
</head>
<body>
	<div id="logout">
		<?php 
    		if(isset($_SESSION["loggedin"]))
   	 		{ 
      			echo "<a id='logoutbutton' href='../Login/logout.php'  class='button'>Logout</a>";
    		}
 		?>
 	</div>
	<div class = "x"></div>
	<div class = "y" id = "y">
		<?php echo "Here are some articles from " . $genre; ?>
	</div>

	<div class="flowbox">
		<div class="articlebox" id= "a">
		<div class = "innertext" id = "a1"></div>
		<div class = "innertext2" id = "a2"></div>
		<div class = "innertext3" id = "a3"></div>
		<div class = "innertext4" id = "a4"></div>
		</div>
		<div class="articlebox" id= "b">
		<div class = "innertext" id = "b1"></div>
		<div class = "innertext2" id = "b2"></div>
		<div class = "innertext3" id = "b3"></div>
		<div class = "innertext4" id = "b4"></div>
		</div>
		<div class="articlebox" id= "c">
		<div class = "innertext" id = "c1"></div>
		<div class = "innertext2" id = "c2"></div>
		<div class = "innertext3" id = "c3"></div>
		<div class = "innertext4" id = "c4"></div>
		</div>
		<div class="articlebox" id= "d">
		<div class = "innertext" id = "d1"></div>
		<div class = "innertext2" id = "d2"></div>
		<div class = "innertext3" id = "d3"></div>
		<div class = "innertext4" id = "d4"></div>
		</div>
		<div class="articlebox" id= "e">
		<div class = "innertext" id = "e1"></div>
		<div class = "innertext2" id = "e2"></div>
		<div class = "innertext3" id = "e3"></div>
		<div class = "innertext4" id = "e4"></div>
		</div>
	</div>

	<?php
		//Should always be 5
		$count = sizeof($loaded_articles) - 1;
			if ($count > 0) {
			while ($count >= 0) {
				switch($count) {
					case 4:
						$ver = 'a';
						break;
					case 3:
						$ver = 'b';
						break;
					case 2:
						$ver = 'c';
						break;
					case 1:
						$ver = 'd';
						break;
					case 0:
						$ver = 'e';
						break;
				}
				
				echo "<script type='text/javascript'> document.getElementById('",$ver,"1').innerHTML = 'Reading Level: ' + FleschKincaid.grade('", ($loaded_articles[$count]['content']) ,"');</script>";

				echo "<script type='text/javascript'> document.getElementById('",$ver,"2').innerHTML = 'Author: '+ '", ($loaded_articles[$count]['author']) ,"';</script>";
				echo "<script type='text/javascript'> document.getElementById('",$ver,"3').innerHTML = '", ($loaded_articles[$count]['title']) , " <br><br> " , $loaded_articles[$count]['newsoutlet'], " <br> " , ($loaded_articles[$count]['url']) , "<br><br>", "';</script>";
				echo "<script type='text/javascript'> document.getElementById('",$ver,"4').innerHTML = '", ($loaded_articles[$count]['content']) ,"';</script>";


				echo "<script type='text/javascript'> document.getElementById('",$ver,"').style.background = 'white';</script>";
				echo "<script type='text/javascript'> document.getElementById('",$ver,"').style.boxShadow = '0 2px 3px rgba(0,0,0,.1), 0 4px 8px rgba(0,0,0,.3)';</script>";
				$count--;
			}
		}
		else {
			echo "<script type='text/javascript'> document.getElementById('y').innerHTML = 'No articles within that genre.';</script>";
			echo "<script type ='text/javascript'>$('.articlebox').addClass('display-none');</script>";
		}

	?>

	<a id='logoutbutton' href='score_articles.php' class='button'>More Articles</a>
	<br><br>
	Scale:
	<ul>
		<li>5th grade: Very easy to read. Easily understood by an average 11-year-old student.</li>
		<li>6th grade: Easy to read. Conversational English for consumers.</li>
		<li>7th grade: Easy to read. Conversational English for consumers.</li>
		<li>8th & 9th grade: Plain English. Easily understood by 13- to 15-year-old students.</li>
		<li>10th to 12th grade: Fairly difficult to read.</li>
		<li>College: Difficult to read.</li>
	</ul>


	</body>
</html>