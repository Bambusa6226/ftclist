<?php

// register page, lets go through this step by step here probably

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


		<h1 class="page-header">Register for a Team Account</h1>
		<form method="POST" action="../register.php" class="form-horizontal">
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label for="team" class="col-md-3 control-label">Team Number</label>
						<div class="col-md-9">
							<input class="form-control" type="text" name="team" id="team">
						</div>
					</div>
					<div class="form-group">
						<label for="tn" class="col-md-3 control-label">Team Name</label>
						<div class="col-md-9">
							<input class="form-control" type="text" name="tn" id="tn">
						</div>
					</div>
					<div class="form-group">
						<label for="email" class="col-md-3 control-label">Email</label>
						<div class="col-md-9">
							<input class="form-control" type="email" name="email" id="email">
						</div>
					</div>
					<div class="form-group">
						<label for="pass" class="col-md-3 control-label">Password</label>
						<div class="col-md-9">
							<input class="form-control" type="password" name="pass" id="pass">
						</div>
					</div>
					
					<button class="btn btn-default col-md-offset-3" id='register' disabled>Register</button>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="superregion" class="col-md-3 control-label">Super Region</label>
						<div class="col-md-9">
							<select class="form-control" name="superregion" id="superregion">
								<option value="null">Select a Superregion</option>
								<option value="north">North Region</option>
								<option value="west">West Region</option>
								<option value="south">South Region</option>
								<option value="east">East Region</option>
								<option value="outside">Outside US</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="region" class="col-md-3 control-label">Region</label>
						<div class="col-md-9">
							<div class="radio" id="region">
  								<label>
    								<input type="radio" name="region" value="null" disabled>
    								None Yet
  								</label>
							</div>
						</div>
						<div id="newregion" style="display: none;">
							<br/><br/>
							<div class="form-group">
								<label for="rgn" class="col-md-3 control-label">New Region Name</label>
								<div class="col-md-9">
									<input class="form-control" type="text" name="regionnew" id="rgn">
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
		
	</div>

<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/r/dt/jqc-1.11.3,dt-1.10.9/datatables.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="../common.js"></script>

<script>

$("document").ready(function() {
	$("input").on("input propertychange", function() {
		if($("#team").val() != "" && $("#tn").val() != "" && $("#email").val() != "" && $("#pass").val() != "" && $("#superregion").val() != "null")
		{
			$("#register").removeAttr("disabled");
		}
		else $("#register").attr("disabled", "disabled");
	})

	$("#superregion").change(function() {

		console.log("ch");
		var val = $("#superregion").val();
		$.getJSON("../data/super/"+val+".json", function(data) {
			var cols = "";
			if(data.regions != undefined)
			{
				for(var a=0;a<data.regions.length;a++)
				{
					cols += "<label>";
					cols += "<input type='radio' name='region' class='rgnc' value='"+data.regions[a]+"'>"+data.regions[a]
					cols += "</label><br/>";
				}
			}
			cols += "<label><input type='radio' name='region' class='rgnc' value='other'>Not Listed, Add New Region</label><br/>";
			$("#region").empty().append(cols);

			$(".rgnc").change(function() {

				if($("#team").val() != "" && $("#tn").val() != "" && $("#email").val() != "" && $("#pass").val() != "" && $("#superregion").val() != "null")
				{
					$("#register").removeAttr("disabled");
				}
				else $("#register").attr("disabled", "disabled");

				if($("input:radio[name=region]:checked").val() == "other")
				{
					$("#newregion").css("display", "block");
				}
				else
				{
					$("#newregion").css("display", "none");
				}
			})

		})
	})

	
})

</script>

</html>