<?php
// change and upload new team data for your team..


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

// now that we're auth'd we can get the file out.

$team = json_decode(file_get_contents("./data/teams/".$_COOKIE['team'].".json"));

$len = 1000;
if(strlen($_POST['des']) > $len || strlen($_POST['auto']) > $len || strlen($_POST['teleop']) > $len || strlen($_POST['endgame']) > $len)
{
	echo "ERROR: description input too long, 1000 characters max";
	die;
}

if(isset($_POST['des']) && $_POST['des'] != '')
{
	$team->description = $_POST['des'];
}

if(isset($_POST['auto']) && $_POST['auto'] != '')
{
	$team->autonomous = $_POST['auto'];
}

if(isset($_POST['teleop']) && $_POST['teleop'] != '')
{
	$team->teleop = $_POST['teleop'];
}

if(isset($_POST['endgame']) && $_POST['endgame'] != '')
{
	$team->endgame = $_POST['endgame'];
}

file_put_contents("./data/teams/".$_COOKIE['team'].".json", json_encode($team));


//echo "<script>window.location='./team?".$_COOKIE['team']."';</script>";

?>