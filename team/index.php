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
			<div class="col-md-5">
				<div class="panel panel-default" id="image">
  					<div class="panel-heading">
	    				<h3 class="panel-title">
	    					<span>Robot Image</span>
	    					<button id="chimg" style="display: none;" class="btn btn-xs btn-default pull-right" data-toggle="modal" data-target="#modal_image">Change Image</button>
	    				</h3>
	  				</div>
	  				<div class="panel-body text-center">
	  					<img class="img-responsive img-thumbnail" id="robotimg" src="#"/>
	  				</div>
	  			</div>
	  		</div>
			<div class="col-md-7">
				<div class="panel panel-default" id="stats">
  					<div class="panel-heading">
	    				<h3 class="panel-title">
	    					<span>Statistics</span>
	    				</h3>
	  				</div>
	  				<div class="panel-body">
	  					<dl id="statslist">
	  						<div class="row">
	  							<div class="col-md-6">
			  						<dt>Competitions Attended</dt>
			  						<dd id="attended"></dd>

			  						<dt>Games Recorded</dt>
			  						<dd id="games"></dd>

			  						<dt>Score Average</dt>
			  						<dd id="avgscore"></dd>

			  						<dt>Score Standard Deviation</dt>
			  						<dd id="stddev"></dd>
			  					</div>
			  					<div class="col-md-6">
			  						<dt>Wins</dt>
			  						<dd id="wins"></dd>

			  						<dt>Losses</dt>
			  						<dd id="losses"></dd>

			  						<dt>Ties</dt>
			  						<dd id="ties"></dd>

			  						<dt>Win/Loss Ratio</dt>
			  						<dd id="winrate"></dd>
			  					</div>
			  				</div>
	  					</dl>
	  				</div>
	  			</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default" id="description">
  					<div class="panel-heading">
	    				<h3 class="panel-title">
	    					<span>Robot Info</span>
	    					<button  id="chinfo" style="display: none;" class="btn btn-xs btn-default pull-right" data-toggle="modal" data-target="#modal_data">Change Info</button>
	    				</h3>
	  				</div>
	  				<div class="panel-body">
	  					<dl>
	  						<div class="row">
	  							<div class="col-md-6">
			  						<dt>Robot Description</dt>
			  						<dd class="des"></dd>
			  							<br/>
			  						<dt>Autonomous Abilities</dt>
			  						<dd class="auto"></dd>
	  							</div>
	  							<div class="col-md-6">
			  						<dt>TeleOp Abilities</dt>
			  						<dd class="teleop"></dd>
			  							<br/>
			  						<dt>Endgame Abilities</dt>
			  						<dd class="endgame"></dd>
			  					</div>
			  				</div>
	  					</dl>
					</div>
				</div>
			</div>
		</div>


		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
	  				<div class="panel-heading">
	    				<h3 class="panel-title">
	    					<span id="competition">Competitions</span>
	    					<button class="btn btn-xs btn-default pull-right" data-toggle="modal" data-target="#modal_comp">Competition Not Listed?</button>
	    				</h3>
	  				</div>
	  				<div class="panel-body">
						<table class="table" id="comps">
							<thead>
								<tr>
									<th>Name</th>
									<th>Date</th>
									<th>Location</th>
									<th>Matches Logged</th>
									<th>Team QP</th>
									<th>Team RP</th>
								</tr>
							</thead>
							<tbody>

							</tbody>
						</table>
						
					</div>
				</div>
			</div>
		</div>
	</div>



	<div class="modal fade" id="modal_comp">
  		<div class="modal-dialog">
    		<div class="modal-content">
      			<div class="modal-header">
        			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        			<h4 class="modal-title">Add Competition</h4>
      			</div>
      			<div class="modal-body">
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
        		</div>
      			<div class="modal-footer">
        			<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
					<button class="btn btn-primary">Add Competition</button>
					</form>
      			</div>
    		</div><!-- /.modal-content -->
  		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->


	<div class="modal fade" id="modal_data">
  		<div class="modal-dialog">
    		<div class="modal-content">
      			<div class="modal-header">
        			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        			<h4 class="modal-title">Add Competition</h4>
      			</div>
      			<div class="modal-body">
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
        		</div>
      			<div class="modal-footer">
        			<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
					<button class="btn btn-primary">Change Data</button>
					</form>
      			</div>
    		</div><!-- /.modal-content -->
  		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->


	<div class="modal fade" id="modal_image">
  		<div class="modal-dialog">
    		<div class="modal-content">
      			<div class="modal-header">
        			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        			<h4 class="modal-title">Add Image</h4>
      			</div>
      			<div class="modal-body">
      				<form method="POST" action="../image.php" enctype="multipart/form-data">
						<div class="form-group">
							<label for="image">Image Upload</label>
							<input type="file" name="image" id="image">
							<div class="help-block">Maximum Size: 2 MiB</div>
						</div>
        		</div>
      			<div class="modal-footer">
        			<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
					<button class="btn btn-primary">Add Image</button>
					</form>
      			</div>
    		</div><!-- /.modal-content -->
  		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->

						



<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/r/dt/jqc-1.11.3,dt-1.10.9/datatables.min.js"></script>
<script src="../common.js"></script>

<script>

$("document").ready(function() {
	var me = readtop();
	if(getcookie("team") != undefined && getcookie("team") == me)
	{
		$("#chimg").css("display", "block");
		$("#chinfo").css("display", "block");
	}
	if(me != null)
	{
		$.getJSON("../data/teams/"+me+".json", function(team) {
			$(".des").text(team.description);
			$(".auto").text(team.autonomous);
			$(".teleop").text(team.teleop);
			$(".endgame").text(team.endgame);

			$("#des").val(team.description);
			$("#auto").val(team.autonomous);
			$("#teleop").val(team.teleop);
			$("#endgame").val(team.endgame);

			$("h1").text("Team "+me+" - "+team.name);


			$("#robotimg").attr("src", "../data/img/"+me+"."+team.ext);


			// lets order the data for the comps for our team
			var comps = {};
			if(team.games != undefined && team.games.length != 0)
			{
				var avg = 0;
				for(var a=0;a<team.games.length;a++)
				{
					if(team.games[a].red1 == me || team.games[a].red2 == me)
					{
						avg += Number(team.games[a].redscore);
					}
					else
					{
						avg += Number(team.games[a].bluescore);
					}				
				}
				avg /= team.games.length;

				var wins = 0;
				var losses = 0;
				var ties = 0;
				var sv = 0;
				var compnum = 0;
				for(var a=0;a<team.games.length;a++)
				{
					var c = team.games[a];
					if(comps[c.comp] == undefined)
					{
						comps[c.comp] = {};
						comps[c.comp].QP = 0;
						comps[c.comp].RP = 0;
						comps[c.comp].num = 0;
						compnum++;
					}
					comps[c.comp].num ++;

					if(c.red1 == me || c.red2 == me)
					{
						comps[c.comp].RP += parseInt(c.bluescore);
						if(c.redscore > c.bluescore)
						{
							comps[c.comp].QP += 2;
							wins ++;
						}
						else losses ++;
						sv += Math.pow((c.redscore - avg), 2);
					}
					else
					{
						comps[c.comp].RP += parseInt(c.redscore);
						if(parseInt(c.redscore) < parseInt(c.bluescore)) 
						{
							comps[c.comp].QP += 2;
							wins ++;
						}
						else losses ++;
						sv += Math.pow((c.bluescore - avg), 2);
					}
					if(parseInt(c.redscore) == parseInt(c.bluescore))
					{
						comps[c.comp].QP ++;
						ties ++;
						sv += Math.pow((c.bluescore - avg), 2);
					} 
				}
				sv = Math.sqrt(sv/team.games.length);

				$("#attended").text(compnum);
				$("#games").text(team.games.length);
				$("#avgscore").text(parseInt(avg));
				$("#stddev").text(parseInt(sv));
				$("#wins").text(wins);
				$("#losses").text(losses);
				$("#ties").text(ties);
				$("#winrate").text((wins/losses).toFixed(2))

				$("#image").height($("#stats").height());

			}
			else
			{
				$("#statslist").html("No Statistics are availible"); 
				$("#stats").height($("#image").height());
			}
			
			var region = team.region.toLowerCase().replace("+", "").replace(" ", "");
			$.getJSON("../data/regions/"+region+".json", function(reg) {

				$("#competition").html("Competitions in <a href='../region?"+reg.handle+"'>"+reg.name+"</a>");

				var rows = "";
				if(reg.comps != undefined && reg.comps.length != 0)
				{
					for(var a=0;a<reg.comps.length;a++)
					{
						rows += "<tr>";
						rows += "<td><a href='../comp?"+reg.comps[a].handle+"'>"+reg.comps[a].name+"</a></td>";
						rows += "<td>"+reg.comps[a].date+"</td>";
						rows += "<td>"+reg.comps[a].place+"</td>";
						if(comps[reg.comps[a].handle] != undefined)
						{
							rows += "<td>"+comps[reg.comps[a].handle].num+"</td>";
							rows += "<td>"+comps[reg.comps[a].handle].QP+"</td>";
							rows += "<td>"+comps[reg.comps[a].handle].RP+"</td>";
						}
						else
						{
							rows += "<td>0</td>";
							rows += "<td>N/A</td>";
							rows += "<td>N/A</td>";
						}
						rows += "</tr>";
					}
				}
				else {
					rows += "";
				}

				$("#comps tbody").empty().append(rows);
				$("#comps").dataTable({
					paging: false,
					info: false,
					bFilter: false,
					bInfo: false
				});
				
			})
		});

			// ok now lets render some data or something
	}
})

	</script>
</body>
</html>