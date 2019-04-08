<?php
	session_start();
	require_once "config.php";
?>

<!DOCTYPE html>
<body>
<div id="wrapper">
	<h1>SCIENCE QUIZ</h1>
	<form action="grade.php" method="post" id="quiz">
		<ol>
			<li>
				<h3>Which One is Science?</h3>
				<div>
                    <input type="radio" name="Q1-Answers" id="Q1-Answers-A" value="A" />
                    <label for="Q1-Answers-A">A) Binge-watching Netflix</label>
                </div>
				<div>
                    <input type="radio" name="Q1-Answers" id="Q1-Answers-B" value="B" />
                    <label for="Q1-Answers-B">B) Pouring water into a cup with lines on it</label>
                </div>
				<div>
                    <input type="radio" name="Q1-Answers" id="Q1-Answers-C" value="C" />
                    <label for="Q1-Answers-C">C) Looking at memes</label>
                </div>
				<div>
                    <input type="radio" name="Q1-Answers" id="Q1-Answers-D" value="D" />
                    <label for="Q1-Answers-D">D) Procrastinating on homework</label>
                </div>
			</li>
		</ol>
		<input type="submit" value="Submit"/>
	</form>
</div>
</body>