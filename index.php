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

	<link rel="icon" type="image/png" href="./robot.png" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
	<link href='https://fonts.googleapis.com/css?family=Roboto:400,700,100' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/r/dt/jqc-1.11.3,dt-1.10.9/datatables.min.css"/>
	<link rel="stylesheet" href="./common.css"/> 

	<style>
		.logoimg:hover {
			cursor: pointer;
		}
	</style>

</head>
<body>
	<?php 
		include("topbar.php"); 
	?>
	<div class="jumbotron">
		<div class="container">
			<div class="row">
				<div class="col-md-7">
					<h1>FTCList</h1>
					<p>Realtime match data and analysis for FTC robotics competitions.</p>
					<a href="./register" class="btn btn-primary btn-lg">Register</a>
				</div>
				<div class="col-md-5" style="margin-top: 30px;">
					<div><strong>Brought to you by:</strong></div>
					<div class="img-responsive" style="margin-top: 3px;">
						<img onclick="window.location='./about';" class="logoimg" src="./data/img/logo.png" alt="Team 6226 Bambusa"/>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<!-- search thingyyy -->
				<form role="search" action="../search" method="GET">
	  				<div class="form-group" style="margin: 0 auto;">
	    				<input name="s" type="text" class="form-control input-lg" placeholder="Search for a Team, Competition, or Region">
	  				</div>
				</form>	

			</div>
		</div><br/><br/>
		<!--<div class="row">
			<h2 class="page-header">Regions</h2>
			<div class="col-md-12">

			</div>
		</div>-->
		<div class="row">
			<div class="col-md-8">
				<h2 class="page-header">Recent Competitions</h2>
				<table class="table table-striped table-hover">
					<thead>
						<tr>
							<th>Name</th>
							<th>Matches</th>
							<th>Changed</th>
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
		  	<div class="col-md-4">
		  		<h2 class="page-header">Top Contributors <small><a href='./contrib'>more...</a></small></h2>
		  		<table class="table table-striped table-hover"  id='contrib'>
					<thead>
						<tr>
							<th>Team Number</th>
							<th>Team Name</th>
							<th>Points</th>
						</tr>
					</head>
					<tbody>
						
					</tbody>
				</table>
		  	</div>
		</div>
	</div>


	<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/r/dt/jqc-1.11.3,dt-1.10.9/datatables.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	<script src="./common.js"></script>
	<script>

	var which = readtop();

	if(which != undefined && which != "")
	{
		if(which.length == 6) window.location = "./comp?"+which;
		else window.location = "./team?"+which;
	}


	Array.prototype.insert = function (index, item) {
  		this.splice(index, 0, item);
	};

	$("document").ready(function() {
		$.getJSON("./data/contrib.json",function(contrib)
		{
			var teams = contrib.teams;
			var tops = [];
			var n = 10;
			var max = 1000000000;
			for(var key in teams)
			{
				teams[key].num = key;

				if(tops.length < n)
				{
					tops.push(teams[key]);
					if(parseInt(teams[key].pts) < max) max = parseInt(teams[key].pts);
				}
				else
				{
					if(parseInt(teams[key].pts) > max)
					{
						var min = 1000000;
						var ths = -1;
						for(var i=0;i<n;i++)
						{
							console.log(tops[i]);
							if(parseInt(teams[key].pts) > parseInt(tops[i].pts)) 
							{
								if(parseInt(tops[i].pts) < parseInt(min)) 
								{
									min = tops[i].pts;
									ths = i;
								}
							}
						}
						if(ths != -1) 
						{
							console.log(tops[ths].pts);
							tops[ths] = teams[key];
						}
					}
				}
			}
			for(var i=1;i<tops.length;i++)
			{
				var j=i;
				while(j>0 && tops[j-1].pts < tops[j].pts)
				{
					var tmp = tops[j-1];
					tops[j-1] = tops[j];
					tops[j] = tmp;
					j--;
				}
			}
			
			var tbl = "";
			for(var i=0;i<tops.length;i++)
			{
				tbl += "<tr>";
				tbl += "<td><a href='./team?"+tops[i].num+"'>"+xss(tops[i].num)+"</a></td>";
				tbl += "<td>"+xss(tops[i].name)+"</td>";
				tbl += "<td>"+tops[i].pts+"</td>";
				tbl += "</tr>";
			}
			$("#contrib tbody").empty().append(tbl);
		})
	})

	</script>


</body>
</html>