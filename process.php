<?php
//ini_set("memory_limit", "64M");


$fl = json_decode(file_get_contents("./data/old.json"));

var_dump($fl);

$teams = new STDClass();
$ht = "Home-Town";

foreach($file->theteams as $team)
{
	$num = (String) $team->Team;
	if($teams->$num == undefined)
	{
		// new team
		$teams->$num = new STDClass();
		$teams->$num->from = $team->$ht;
		$teams->$num->name = $team->Team_Name;
		$teams->$num->num = $team->Team;
		$teams->$num->comps = array();
	}
	$cmp = new STDClass();

	$cmp->name = $team->event;
	$cmp->place = $team->venue;
	$cmp->date = $team->date_start;
	$cmp->highest = $team->Highest;
	$cmp->QP = $team->QP;
	$cmp->RP = $team->RP;
	$cmp->matches = $team->Matches;

	array_push($teams->num->comps, $cmp);
}

foreach($teams as $num => $team)
{
	file_put_contents("./data/teams_o/".$num.".json", json_encode($team));
}

?>