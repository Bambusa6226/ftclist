<?
// okay so what is going to happen here....

// what I need

// login page
// process registrations
// process logins
// populate an account with info
// select superregion, region, and team number
// once the team has an account they can add the following information

// add a competition, league or qualifier.
// add a game schedule, partial or full.
// add a score for a game
// add info about your own robot or team

// pages:
// - login or signup
// - dashboard
// - team
// - compitions: list by region
// - compitition: info about a single one

// schema?
// - team folder with team numbers to accounts with team data
// - competition folder holding stats on competition wide results
// - top level team lists and comp lists with overhead data
// - 

?>
<!DOCTYPE html>
<html>
<head>
	<title>ftclist</title>

</head>
<body>
	<h1>ftclist</h1>

	<h2>register</h2>
	<form method="POST" action="register.php">
		<input type="text" name="team" placeholder="Team Number">
		<input type="text" name="tn" placeholder="Team Name">
		<input type="text" name="email" placeholder="Email">
		<input type="password" name="pass" placeholder="Password">
		Super Region:<select name="superregion">
			<option selected value="north">North Region</option>
			<option value="west">West Region</option>
			<option value="south">South Region</option>
			<option value="east">East Region</option>
			<option value="outside">Outside US</option>
		</select>
		<input type="text" name="region" placeholder="Region Name">
		<input type="submit">
	</form>
	<h2>login</h2>
	<form method="POST" action="login.php">
		<input type="text" name="team" placeholder="Team Number">
		<input type="password" name="pass" placeholder="Password">
		<input type="submit">
	</form>
</body>
</html>