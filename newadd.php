<?php


function saveteam($team, $data)
{
	if(!file_exists("./data/teams/".$team.".json"))
	{
		// no team, lets just drop these here.
		$file = new STDClass();
		$file->games = array();
	}
	else
	{
		$file = json_decode(file_get_contents("./data/teams/".$team.".json"));
		if(!isset($file->games)) $file->games = array();
	}
	array_push($file->games, $data);

	file_put_contents("./data/teams/".$team.".json", json_encode($file));
}


if(!isset($_COOKIE['hash']) || !isset($_COOKIE['team']))
{
	echo '{"title":"Error","message":"Must be logged in to complete request."}';
	die;
}

if(!file_exists("./data/passwd/".$_COOKIE['team'].".json"))
{
	echo '{"title":"Error","message":"Logged in team does not exist."}';
	die;
}

$pwd = json_decode(file_get_contents("./data/passwd/".$_COOKIE['team'].".json"));
$check = hash("sha256", $_COOKIE['hash']);

if($check != $pwd->hash)
{
	echo '{"title":"Error","message":"Session variable is incorrect."}';
	die;
}


// k so what needs to happen here...
// we need to see what type were dealing with
// 

if($_POST['type'] == "match")
{
	if(!isset($_POST['match']) || !isset($_POST['red1']) || !isset($_POST['red2']) || !isset($_POST['blue1']) || !isset($_POST['blue2']))
	{
		echo '{"title":"Error","message":"Request missing one or more fields."}';
		die;
	}
	// k now we check if this exists

}
else if($_POST['type'] == "score")
{

}
else
{
	echo '{"title":"Error","message":"Request type not recognized."}';
	die;
}



?>