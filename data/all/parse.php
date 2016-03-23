<?php
	$data = json_decode(file_get_contents("off.json"));
	// okayyy, what do we do here...
	// so we have the data arranged into an object with arrays witheverything,
	// so we just need to iterate through each match and decide when to cut a comp
	// then score the relevent match and save it in ftclist format, and save it off with
	// what teams scored what to give some more analysis to be done...



?>