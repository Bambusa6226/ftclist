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

// darker color 

?>
<!DOCTYPE html> 
<html>
<head>
	<title>FTCList</title>

	<link rel="icon" type="image/png" href="http://example.com/image.png" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
	<link href='https://fonts.googleapis.com/css?family=Roboto:400,700,100' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/r/dt/jqc-1.11.3,dt-1.10.9/datatables.min.css"/>
	<link rel="stylesheet" href="./common.css"/> 

</head>
<body>
	<?php 
		include("topbar.php"); 
	?>
	<div class="jumbotron">
		<div class="container">
			<h1>FTCList</h1>
			<p>The easiest way to stay up to date on FTC robotics teams and competitions.</p>
			<a href="./register" class="btn btn-primary btn-lg">Register</a>
		</div>
	</div>

	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<h2 class="page-header">Recent competitions</h2>
				<table class="table table-striped table-hover">
					<thead>
						<tr>
							<th>Name</th>
							<th>Matches Recorded</th>
							<th>Date</th>
							<th>Region</th>
						</tr>
					</head>
					<tbody>
						<?php
							include("recent.php");
						?>
					</tbody>
				</table>
		  	</div>
		  	<div class="col-md-6">
		  		<h2 class="page-header">Top Contributors</h2>
		  	</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<h2 class="page-header">Random Team</h2>
		  	</div>
		  	<div class="col-md-6">
		  		<h2 class="page-header">Links</h2>
		  	</div>
	  	</div>
	</div>


	<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/r/dt/jqc-1.11.3,dt-1.10.9/datatables.min.js"></script>
	<script src="./common.js"></script>



</body>
</html>