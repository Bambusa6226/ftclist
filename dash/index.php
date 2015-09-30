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

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
	<link href='https://fonts.googleapis.com/css?family=Roboto:400,700,100' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/r/dt/jqc-1.11.3,dt-1.10.9/datatables.min.css"/>
	<link rel="stylesheet" href="../common.css"/>

</head>
<body>
	<div class="container">


		<?php include("../topbar.php"); ?>


		<h1 class="page-header">Dashboard</h1>
	
		<div class="row">
			<div class="col-md-12">
				<p>Info about how the robot is doing here..</p>
				<hr/>
			</div>
		</div>

		<div class="row">
			<div class="col-md-6">
				<div class="panel panel-default">
  					<div class="panel-heading">
	    				<h3 class="panel-title">
	    					Robot Info
	    				</h3>
	  				</div>
	  				<div class="panel-body">
						<form method="POST" action="../teamdata.php">

							<div class="form-group">
								<label for="des">Robot Description</label>
								<textarea class="form-control" name="des" id="des"></textarea>
							</div>
							<div class="form-group">
								<label for="auto">Autonomous Abilities</label>
								<textarea class="form-control" name="auto" id="auto"></textarea>
							</div>
							<div class="form-group">
								<label for="teleop">TeleOp Abilities</label>
								<textarea class="form-control" name="teleop" id="teleop"></textarea>
							</div>
							<div class="form-group">
								<label for="endgame">Endgame Abilities</label>
								<textarea class="form-control" name="endgame" id="endgame"></textarea>
							</div>
							<button class="btn btn-primary">Change Data</button>
						</form>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="panel panel-default">
	  				<div class="panel-heading">
	    				<h3 class="panel-title" id="competition">
	    					Competitions
	    				</h3>
	  				</div>
	  				<div class="panel-body">
						<table class="table" id="comps">
							<thead>
								<tr>
									<th>Name</th>
									<th>Date</th>
									<th>Location</th>
								</tr>
							</thead>
							<tbody>

							</tbody>
						</table><br/>
						<form method="POST" action="../addcomp.php">
							<div class="form-group">
								<label for="name">Competition Name</label>
								<input class="form-control" type="text" name="name">
							</div>
							
							<div class="form-group">
								<label for="place">Compitition Location</label>
								<input class="form-control" type="text" name="place">
							</div>

							<div class="form-group">
								<label for="date">Date</label>
								<input class="form-control" type="date" name="date">
							</div>

							<div class="radio">
								<label>
									<input type="radio" name="type" value="qual">
									Qualifier
								</label>
							</div>
							<div class="radio">
								<label>
									<input type="radio" name="type" value="league">
									League Meet
								</label>
							</div>
							<div class="radio">
								<label>
									<input type="radio" name="type" value="region">
									Regional
								</label>
							</div>
							<div class="radio">
								<label>
									<input type="radio" name="type" value="noncomp">
									Non-competitive/practice
								</label>
							</div>
							<button class="btn btn-primary">Add Competition</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>

<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/r/dt/jqc-1.11.3,dt-1.10.9/datatables.min.js"></script>
<script src="../common.js"></script>

<script>

$("document").ready(function() {
	$("h1").text("Dashboard - Team "+getcookie("team"));
	if(getcookie("team") != null)
	{
		$.getJSON("../data/teams/"+getcookie("team")+".json", function(team) {
			$("#des").val(team.description);
			$("#auto").val(team.autonomous);
			$("#teleop").val(team.teleop);
			$("#endgame").val(team.endgame);
		});
		var region = getcookie("region").toLowerCase().replace("+", "").replace(" ", "");
		$.getJSON("../data/regions/"+region+".json", function(reg) {

			$("#competition").text("Competitions in "+reg.name);

			var rows = "";
			for(var a=0;a<reg.comps.length;a++)
			{
				rows += "<tr>";
				rows += "<td><a href='../comp?"+reg.comps[a].handle+"'>"+reg.comps[a].name+"</a></td>";
				rows += "<td>"+reg.comps[a].date+"</td>";
				rows += "<td>"+reg.comps[a].place+"</td>";
				rows += "</tr>";
			}
			$("#comps tbody").empty().append(rows);
			$("#comps").dataTable({
				paging: false,
				info: false,
				bFilter: false,
				bInfo: false
			});
		})
	}
})

	</script>
</html>