<?php
// a nice way to view teams scores and data

// name description comps done, QR RP, analysis, robot abilities, images maybe, contribution points

?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
	<link href='https://fonts.googleapis.com/css?family=Roboto:400,700,100' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/r/dt/jqc-1.11.3,dt-1.10.9/datatables.min.css"/>
	<link rel="stylesheet" href="../common.css" />

	

</head>
<body>
	<h1></h1>
	<div id="description"></div>
	<div id="autonomous"></div>
	<div id="teleop"></div>
	<div id="endgame"></div>


	<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/r/dt/jqc-1.11.3,dt-1.10.9/datatables.min.js"></script>
	<script src="../common.js"></script>
	<script>
		$("document").ready(function() {
			$.getJSON("../data/teams/"+team()+".json", function(data) {
				console.log(data);
				$("h1").text(data.number + " " + data.name);
				$("#description").text(data.description);
				$("#autonomous").text(data.autonomous);
				$("#teleop").text(data.teleop);
				$("#endgame").text(data.endgame);
			})
		})
	</script>
</body>
</html>