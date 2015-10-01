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

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
	<link href='https://fonts.googleapis.com/css?family=Roboto:400,700,100' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/r/dt/jqc-1.11.3,dt-1.10.9/datatables.min.css"/>
	<link rel="stylesheet" href="./common.css"/> 

</head>
<body>
	<div class="container">
	<?php 
		include("topbar.php"); 
	?>

	<p class="lead"></p>

	<div class="row">

		<div class="col-md-4">
			<h2>login</h2>
			<form method="POST" action="login.php">
				<input class="form-control" type="text" name="team" placeholder="Team Number"><br/>
				<input class="form-control" type="password" name="pass" placeholder="Password">
				<br/>
				
				<button class="btn btn-default">Login</button>
			</form>
		</div>

		<div class="col-md-8">
		<h2>Register</h2>
			<form method="POST" action="register.php">
				<div class="row">
					<div class="col-md-6">
						<input class="form-control" type="text" name="team" placeholder="Team Number">
					</div>
					<div class="col-md-6">
						<input class="form-control" type="text" name="tn" placeholder="Team Name">
					</div>
				</div><br/>
				<div class="row">
					<div class="col-md-6">
						<input class="form-control" type="text" name="email" placeholder="Email">
					</div>
					<div class="col-md-6">
						<input class="form-control" type="password" name="pass" placeholder="Password">
					</div>
				</div><br/>
				<div class="row">
					<div class="col-md-6">
						<select class="form-control" name="superregion">
							<option selected value="north">North Region</option>
							<option value="west">West Region</option>
							<option value="south">South Region</option>
							<option value="east">East Region</option>
							<option value="outside">Outside US</option>
						</select>
					</div>
					<div class="col-md-6">
						<input class="form-control" type="text" name="region" placeholder="Region Name">
					</div>
				</div><br/>

				
				<button class="btn btn-default">Register</button>
			</form>
	
	</div>

	<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/r/dt/jqc-1.11.3,dt-1.10.9/datatables.min.js"></script>
	<script src="./common.js"></script>



</body>
</html>