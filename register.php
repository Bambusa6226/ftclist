<?php
// ok so here I need to:
// check against all current teams for duplicates.
// start a new file for this team.
// add this team into the registry for regional teams.
// add a region if this is a new one.

if(!isset($_POST['team']) || !isset($_POST['email']) || !isset($_POST['pass']) || !isset($_POST['superregion']) || !isset($_POST['region']))
{
	var_dump($_POST);
	echo "ERROR: data missing from request";
	die;
}

if(file_exists("./data/teams/".$_POST['team'].".json"))
{
	$team = json_decode(file_get_contents("./data/teams/".$_POST['team'].".json"));

	if($team->isSet == true)
	{
		echo "ERROR: team account already created, if you believe this is incorrect please email alex.theboy.jones@gmail.com";
		die;
	}
}
else
{
	$team = new STDClass();
	$team->comps = array();

	$rgn = new STDClass();
	$rgn->number = $_POST['team'];
	$rgn->name = $_POST['tn'];

	if(!file_exists("./data/search.json"))
	{
		$search = new STDClass();
	}
	else
	{
		$search = json_decode(file_get_contents("./data/search.json"));
	}

	// if the team is really new, then add it to the region.
	if($_POST['region'] == "null")
	{
		echo "ERROR: Region not selected";
		die;
	}

	if($_POST['region'] == "other")
	{
		$regiondata = strtolower(str_replace(' ', '', $_POST['regionnew']));
	}

	$regiondata = strtolower(str_replace(' ', '', $_POST['region']));
	$newregion = false;

	if(file_exists("./data/regions/".$regiondata.".json"))
	{
		// ok cool open this file and append this team...
		$region = json_decode(file_get_contents("./data/regions/".$regiondata.".json"));
		array_push($region->teams, $rgn);
		file_put_contents("./data/regions/".$regiondata.".json", json_encode($region));
	}
	else
	{
		// ugh, lets make a new region and add it to the superregion list.
		$newregion = true;
		$region = new STDClass();
		$region->teams = array();
		$region->handle = $regiondata;
		$region->name = $_POST['regionnew'];
		array_push($region->teams, $rgn);
		$region->superregion = $_POST['superregion'];
		file_put_contents("./data/regions/".$regiondata.".json", json_encode($region));

		if(!isset($search->regions))
		{
			$search->regions = array();
		}
		array_push($search->regions, $region);

		if(file_exists("./data/super/".$_POST['superregion'].".json"))
		{
			// just append
			$super = json_decode(file_get_contents("./data/super/".$_POST['superregion'].".json"));
		}
		else
		{
			// make new file
			$super = new STDClass();
			$super->regions = array();
		}
		array_push($super->regions, $regiondata);
		file_put_contents("./data/super/".$_POST['superregion'].".json", json_encode($super));
	}
}
// ok now we are going to start a file

$pwd = new STDclass();
$pwd->hash = hash("sha256", hash("sha256", $_POST['pass']));
$pwd->team = $_POST['team'];
$pwd->email = $_POST['email'];
$pwd->region = $regiondata;

file_put_contents("./data/passwd/".$_POST['team'].".json", json_encode($pwd));

$team->number = $_POST['team'];
$team->name = $_POST['tn'];
$team->email = $_POST['email'];
$team->superregion = $_POST['superregion'];
$team->region = $regiondata;
$team->contribution = 10;
$team->isSet = true;

if(!isset($search->teams))
{
	$search->teams = array();
}
$steam = $team;
unset($steam->games);
array_push($search->teams, $steam);

file_put_contents("./data/search.json", json_encode($search));
file_put_contents("./data/teams/".$_POST['team'].".json", json_encode($team));

$contrib = json_decode(file_get_contents("./data/contrib.json"));
$contrib->teams[$team->number] = new STDClass();
$contrib->teams[$team->number]->pts = 10;
$contrib->teams[$team->number]->name = $team->name;


file_put_contents("./data/contrib.json", json_encode($contrib));

setcookie("hash", hash("sha256", $_POST['pass']));
setcookie("team", $_POST['team']);
setcookie("time", time());
setcookie("region", $regiondata);

// ok, thats easy enough...

echo "sucessfully logged in";
echo "<script>window.location='./team?".$_POST['team']."#first';</script>";


?>