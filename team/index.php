<?php
// a nice way to view teams scores and data

// name description comps done, QR RP, analysis, robot abilities, images maybe, contribution points

?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script src="../../jquery.js"></script>
	<script>
		function team()
		{
			return window.location.search.substring(1);
		}

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
</head>
<body>
	<h1></h1>
	<div id="description"></div>
	<div id="autonomous"></div>
	<div id="teleop"></div>
	<div id="endgame"></div>
</body>
</html>