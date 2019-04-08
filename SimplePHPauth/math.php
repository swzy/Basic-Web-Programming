<?php
	session_start();
	require_once "config.php";
?>

<!DOCTYPE html>
<body>
<div id="wrapper">
	<h1>MATH QUIZ</h1>
	<form action="grade.php" method="post" id="quiz">
		<ol>
			<li>
				<h3>1 + 1 = ?</h3>
				<div>
                    <input type="radio" name="Q1-Answers" id="Q1-Answers-A" value="A" />
                    <label for="Q1-Answers-A">A) 0</label>
                </div>
				<div>
                    <input type="radio" name="Q1-Answers" id="Q1-Answers-B" value="B" />
                    <label for="Q1-Answers-B">B) 2</label>
                </div>
				<div>
                    <input type="radio" name="Q1-Answers" id="Q1-Answers-C" value="C" />
                    <label for="Q1-Answers-C">C) 3</label>
                </div>
				<div>
                    <input type="radio" name="Q1-Answers" id="Q1-Answers-D" value="D" />
                    <label for="Q1-Answers-D">D) 1</label>
                </div>
			</li>
		</ol>
		<input type="submit" value="Submit"/>
	</form>
</div>
</body>