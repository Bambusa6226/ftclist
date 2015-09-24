<?php
// what needs to be here

// a list of teams in the region
// a list of comps in the region

// your running QP and RP for reference
// a place to edit your team description, robot abilities, images, and team name?


?>
<!DOCTYPE html>
<html>
<head>
	<title> DASH </title>
</head>
<body>
	<h1>Dashboard</h1>
	<h2>change robot data</h2>
	<form method="POST" action="../teamdata.php">
		<textarea name="des" placeholder="Robot Description"></textarea>
		<textarea name="auto" placeholder="Autonomous Abilities"></textarea>
		<textarea name="teleop" placeholder="TeleOp Abilities"></textarea>
		<textarea name="endgame" placeholder="Endgame Abilities"></textarea>
		<input type="submit"/>
	</form>

	<h2>add a comp in the region</h2>
	<form method="POST" action="../addcomp.php">
		<input type="text" name="name" placeholder="Competition name">
		<input type="text" name="place" placeholder="Competition location">
		Date: <input type="date" name="date">
		Type: <input type="radio" name="type" value="qual"> Qualifier
		<input type="radio" name="type" value="league"> League Meet
		<input type="radio" name="type" value="region"> Regional
		<input type="radio" name="type" value="noncomp"> Non-competitive/practice
		<input type="submit">
	</form>
	
</body>
</html>