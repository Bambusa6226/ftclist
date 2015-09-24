<?php

// add a new competition to a region, seems fairly simple actually.
// need to specify league meet or otherwise, maybe group together league meets???

if(!isset($_COOKIE['hash']) || !isset($_COOKIE['team']))
{
	echo "ERROR: Must be logged in to complete request";
	die;
}

if(!file_exists("./data/passwd/".$_COOKIE['team'].".json"))
{
	echo "ERROR: Logged in team does not exist.";
	die;
}

$pwd = json_decode(file_get_contents("./data/passwd/".$_COOKIE['team'].".json"));
$check = hash("sha256", $_COOKIE['hash']);

if($check != $pwd->hash)
{
	echo "ERROR: Session variable is incorrect.";
	die;
}

// now the rest;

if(!isset($_POST['name']) || !isset($_POST['place']) || !isset($_POST['date']) || !isset($_POST['type']))
{
	var_dump($_POST);
	echo "ERROR: data missing from request";
	die;
}

// ok lets generate a handle
$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
$charactersLength = strlen($characters);
$handle = '';
for ($i = 0; $i < 6; $i++) {
    $handle .= $characters[rand(0, $charactersLength - 1)];
}

// ok now we need to open a new file under that name?

$team = json_decode(file_get_contents("./data/teams/".$_COOKIE['team'].".json"));
$rhandle = strtolower(str_replace(' ', '', $team->region));

$comp = new STDClass();
$comp->date = $_POST['date'];
$comp->team = $_COOKIE['team'];
$comp->created = time();
$comp->name = $_POST['name'];
$comp->place = $_POST['place'];
$comp->type = $_POST['type'];
$comp->handle = $handle;
$comp->rows = array();

$region = json_decode(file_get_contents("./data/regions/".$rhandle.".json"));
if(!isset($region->comps)) $region->comps = array();
array_push($region->comps, $comp);
file_put_contents("./data/regions/".$rhandle.".json", json_encode($region));
file_put_contents("./data/comps/".$handle.".json", json_encode($comp));

if(!file_exists("./data/search.json"))
{
	$search = new STDClass();
}
else
{
	$search = json_decode(file_get_contents("./data/search.json"));
}
if(!isset($search->comps))
{
	$search->comps = array();
}
array_push($search->comps, $comp);
file_put_contents("./data/search.json", json_encode($search));

echo "comp added";

?>