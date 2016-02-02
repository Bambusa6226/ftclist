<?php
//ini_set("memory_limit", "64M");

function mkhnd()
{
	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$charactersLength = strlen($characters);
	$handle = '';
	for ($i = 0; $i < 6; $i++) {
	    $handle .= $characters[rand(0, $charactersLength - 1)];
	}
	return $handle;
}



$file = json_decode(file_get_contents("./data/old.json"));


$comps = new STDClass();
$ht = "Home-Town";

foreach($file->teams as $team)
{
	$hnd = (String)$team->event;
	if(!isset($comps->$hnd))
	{
		// new team
		$comps->$hnd = new STDClass();
		$comps->$hnd->place = $team->venue;
		$comps->$hnd->name = $team->event;
		$comps->$hnd->date = $team->date_start;
		$comps->$hnd->handle = mkhnd();
		$comps->$hnd->teams = array();
	}


	$tm = new STDClass();
	$tm->highest = $team->Highest;
	$tm->QP = $team->QP;
	$tm->RP = $team->RP;
	$tm->matches = $team->Matches;
	$tm->name = $team->Team_Name;
	$tm->number = $team->Team;

	array_push($comps->$hnd->teams, $tm);
}

foreach($comps as $num => $team)
{
	file_put_contents("./data/comps_o/".$num.".json", json_encode($team));
}

/*foreach($file->teams as $team)
{
	$num = (String)$team->Team;
	if(!isset($teams->$num))
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

	array_push($teams->$num->comps, $cmp);
}

foreach($teams as $num => $team)
{
	file_put_contents("./data/teams_o/".$num.".json", json_encode($team));
}*/

?>