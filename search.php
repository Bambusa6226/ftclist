<?php

// lets do some search thing or something?

$keys = explode($_GET['s'], " ");

$ref = json_decode(file_get_contents("./data/search.json"));

$rel = 0;
$comps = array();
foreach($keys as $key)
{
	foreach($ref->comps as $comp)
	{
		if(strpos($comp->name, $key) !== false ||
			strpos($comp->date, $key) !== false ||
			strpos($comp->place, $key) !== false)
		{
			array_push($comps, $comp);
		}
	}

	foreach($ref->teams as $team)
	{
		if(strpos($comp->name, $key) !== false ||
			strpos($comp->number, $key) !== false)
		{
			array_push($teams, $team);
		}
	}
}

var_dump($teams);
var_dump($comps);


?>