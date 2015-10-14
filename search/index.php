<?php

// lets do some search thing or something?

$keys = explode(" ", $_GET['s']);

$ref = json_decode(file_get_contents("../data/search.json"));

//echo json_encode($ref)."<br/>";
$rel = 0;
$comps = array();
$teams = array();
$regions = array();
//echo json_encode($keys)."<br/>";
foreach($keys as $key)
{
	foreach($ref->comps as $comp)
	{
		if(count($comps) > 10) break;
		if(strpos(strtolower($comp->name), strtolower($key)) !== false ||
			strpos(strtolower($comp->date), strtolower($key)) !== false ||
			strpos(strtolower($comp->place), strtolower($key)) !== false)
		{
			array_push($comps, $comp);
		}
	}

	foreach($ref->teams as $team)
	{
				//echo json_encode($team->number)."<br/>";
		if(count($teams) > 10) break;
		if(strpos(strtolower($team->name), strtolower($key)) !== false ||
			strpos(strtolower($team->number), strtolower($key)) !== false)
		{
			array_push($teams, $team);
		}
	}

	foreach($ref->regions as $region)
	{
		if(count($regions) > 10) break;
		if(strpos(strtolower($region->name), strtolower($key)) !== false)
		{
			array_push($regions, $region);
		}
	}
}

//echo json_encode($comps);
//echo "<br/>";
//echo json_encode($teams);


?>

<!DOCTYPE html>
<html>
<head>
	<title> Search </title>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
	<link href='https://fonts.googleapis.com/css?family=Roboto:400,700,100' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/r/dt/jqc-1.11.3,dt-1.10.9/datatables.min.css"/>
	<link rel="stylesheet" href="../common.css"/>

</head>
<body>
	<div class="container">


		<?php include("../topbar.php"); ?>


		<h1 class="page-header">Search for "<?php echo $_GET['s']; ?>"</h1>

		<div class="row">
			<div class="col-md-4">
				<div class="panel panel-default">
  					<div class="panel-heading">
	    				<h3 class="panel-title">
	    					<span>Teams (<?php echo count($teams); ?>)</span>
	    				</h3>
	  				</div>
	  				<div class="panel-body">
	  					<?php
	  						foreach($teams as $team)
	  						{
	  							echo "<div class='team'>";
	  							echo "<a style='font-size: 12pt' href='../team?".$team->number."'>".$team->name." &ndash; ".$team->number."</a>";
	  							echo "<div><strong>Region:</strong> <a href='../region?".strtolower(str_replace(' ', '', $team->region))."'>".$team->region."</a></div>";
	  							echo "";
	  							echo "</div>";
	  							echo "<hr/>";
	  						}
	  					?>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="panel panel-default">
  					<div class="panel-heading">
	    				<h3 class="panel-title">
	    					<span>Competitions (<?php echo count($comps); ?>)</span>
	    				</h3>
	  				</div>
	  				<div class="panel-body">
	  					<?php
	  						foreach($comps as $comp)
	  						{
	  							echo "<div class='comp'>";
	  							echo "<a style='font-size: 12pt' href='../comp?".$comp->handle."'>".$comp->name."</a>";
	  							echo "<div><strong>Location:</strong> ".$comp->place."</div>";
	  							echo "<div><strong>Date: </strong>".$comp->date."</div>";
	  							echo "<div><strong>Region:</strong> <a href='../region?".strtolower(str_replace(' ', '', $comp->region))."'>".$comp->region."</a></div>";
	  							echo "";
	  							echo "</div>";
	  							echo "<hr/>";
	  						}
	  					?>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="panel panel-default">
  					<div class="panel-heading">
	    				<h3 class="panel-title">
	    					<span>Regions (<?php echo count($regions); ?>)</span>
	    				</h3>
	  				</div>
	  				<div class="panel-body">
	  					<?php
	  						foreach($regions as $region)
	  						{
	  							echo "<div class='comp'>";
	  							echo "<a style='font-size: 12pt' href='../region?".$region->handle."'>".$region->name."</a>";
	  							echo "<div><strong>Super Region:</strong> ".$region->super."</div>";
	  							echo "";
	  							echo "</div>";
	  							echo "<hr/>";
	  						}
	  					?>
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
</script>

</html>