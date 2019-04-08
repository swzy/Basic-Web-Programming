<?php
	session_start();
	require_once "config.php";
?>

<!DOCTYPE html>
<body>
<div id="wrapper">
	<h1>RELIGION QUIZ</h1>
	<form action="grade.php" method="post" id="quiz">
		<ol>
			<li>
				<h3>Pick the Real World Religion</h3>
				<div>
                    <input type="radio" name="Q1-Answers" id="Q1-Answers-A" value="A" />
                    <label for="Q1-Answers-A">A) Pizza</label>
                </div>
				<div>
                    <input type="radio" name="Q1-Answers" id="Q1-Answers-B" value="B" />
                    <label for="Q1-Answers-B">B) Shinto</label>
                </div>
				<div>
                    <input type="radio" name="Q1-Answers" id="Q1-Answers-C" value="C" />
                    <label for="Q1-Answers-C">C) Haruhiism</label>
                </div>
				<div>
                    <input type="radio" name="Q1-Answers" id="Q1-Answers-D" value="D" />
                    <label for="Q1-Answers-D">D) Prism</label>
                </div>
			</li>
		</ol>
		<input type="submit" value="Submit"/>
	</form>
</div>
</body>