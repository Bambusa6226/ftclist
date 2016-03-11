<?php


function isInteger($input){
    return(ctype_digit(strval($input)));
}

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


if(!file_exists("./data/comps/".$_POST['comp'].".json"))
{
	echo '{"title":"Error","message":"Competition does not exist."}';
	die;

}

// k so what needs to happen here...
// we need to see what type were dealing with
// 

if($_POST['type'] == "match")
{
	if(!isset($_POST['match']) || !isset($_POST['red1']) || !isset($_POST['red2']) || !isset($_POST['blue1']) || !isset($_POST['blue2']) || !isset($_POST['comp']) 
		|| $_POST['match'] == "" || $_POST['red1'] == "" || $_POST['red2'] == "" || $_POST['blue1'] == "" || $_POST['blue2'] == "" || $_POST['comp'] == "")
	{
		echo '{"title":"Error","message":"Request missing one or more fields."}';
		die;
	}

	if(!isInteger($_POST['match']) 
		|| (!isInteger($_POST['red1']) && strpos($_POST['red1'], '*') == -1) 
		|| (!isInteger($_POST['red2']) && strpos($_POST['red2'], '*') == -1) 
		|| (!isInteger($_POST['blue1']) && strpos($_POST['blue1'], '*') == -1) 
		|| (!isInteger($_POST['blue2']) && strpos($_POST['blue2'], '*') == -1))
	{
		echo '{"title":"Error","message":"One or more fields are not Integers."}';
		die;
	}

	if($_POST['match'] <= 0 || $_POST['match'] > 300)
	{
		echo '{"title":"Error","message":"Match number entered is outside of acceptable range."}';
		die;
	}

	// k now we check if this exists
	$file = "./data/unconf/".$_POST['comp'].".json";
	if(file_exists($file))
		$unconf = json_decode(file_get_contents($file));
	else 
	{
		$unconf = new STDClass();
	}

	if(!isset($unconf->teams) || count($unconf->teams) == 0) $unconf->teams = new STDClass();

	if($_POST['match'] > count((array) $unconf->teams)+1)
	{
		echo '{"title":"Error","message":"Please enter match number ('.(count((array) $unconf->teams)+1).') before later matches."}';
		die;
	} 

	$match = (string)$_POST['match'];
	if(!isset($unconf->teams->$match))
	{
		// we are adding for the first time
		// just cat them to the file, put them in official, and credit the team.

		$obj = new STDClass();
		$obj->red1 = $_POST['red1'];
		$obj->red2 = $_POST['red2'];
		$obj->blue1 = $_POST['blue1'];
		$obj->blue2 = $_POST['blue2'];
		$obj->match = $_POST['match'];
		$obj->contrib = $_COOKIE['team'];

		$unconf->teams->$match = array();
		array_push($unconf->teams->$match, $obj);

		$real = json_decode(file_get_contents("./data/comps/".$_POST['comp'].".json"));
		if(!isset($real->teams) || count($real->teams) == 0) $real->teams = new STDClass();
		$real->teams->$match = $obj;
		$real->rng = rand(); // for updators

		file_put_contents($file, json_encode($unconf));
		file_put_contents("./data/comps/".$_POST['comp'].".json", json_encode($real));

		$supp = json_decode(file_get_contents("./data/teams/".$_COOKIE['team'].".json"));
		$supp->contribution += 2;
		file_put_contents("./data/teams/".$_COOKIE['team'].".json", json_encode($supp));

		$contrib = json_decode(file_get_contents("./data/contrib.json"));
		$onum = (string)$_COOKIE['team'];
		$contrib->teams->$onum->pts += 2;
		file_put_contents("./data/contrib.json", json_encode($contrib));


		echo '{"title":"Success","message":"Match entered for the first time, added to tables."}';
		die;
	}
	else
	{
		// its time to settle a dispute
	}

}
else if($_POST['type'] == "score")
{
	if(!isset($_POST['match']) || !isset($_POST['redscore']) || !isset($_POST['bluescore']) || !isset($_POST['comp'])
		|| $_POST['match'] == "" || $_POST['redscore'] == "" || $_POST['bluescore'] == "" || $_POST['comp'] == "")
	{
		echo '{"title":"Error","message":"Request missing one or more fields."}';
		die;
	}

	if(!isInteger($_POST['match']) 
		|| (!isInteger($_POST['redscore'])) 
		|| (!isInteger($_POST['bluescore'])) 
		|| (!isInteger($_POST['redpenalty']) && $_POST['redpenalty'] != "") 
		|| (!isInteger($_POST['bluepenalty']) && $_POST['bluepenalty'] != ""))
	{
		echo '{"title":"Error","message":"One or more fields are not Integers."}';
		die;
	}

	// check to see if there is a valid comp for this match

	$real = json_decode(file_get_contents("./data/comps/".$_POST['comp'].".json"));
	$unconf = json_decode(file_get_contents("./data/unconf/".$_POST['comp'].".json"));
	$match = (string)$_POST['match'];

	if(!isset($real->teams->$match))
	{
		echo '{"title":"Error","message":"Teams have not been set for this match."}';
		die;
	}
<<<<<<< Updated upstream

	if(!isset($unconf->scores) || count($unconf->scores) == 0) $unconf->scores = new STDClass();

	if(!isset($unconf->scores->$match))
	{
		// first time score..
		$obj = new STDClass();
		$obj->red1 = $real->teams->$match->red1;
		$obj->red2 = $real->teams->$match->red2;
		$obj->blue1 = $real->teams->$match->blue1;
		$obj->blue2 = $real->teams->$match->blue2;
		$obj->match = $_POST['match'];
		$obj->contrib = $_COOKIE['team'];


		$obj->redscore = (int)$_POST['redscore'];
		$obj->bluescore = (int)$_POST['bluescore'];
		if(!isset($_POST['redpenalty']) || $_POST['redpenalty'] == "")
		{
			$obj->redpenalty = 0;
		}
		else
		{
			$obj->redpenalty = (int)$_POST['redpenalty'];
		}

		if(!isset($_POST['bluepenalty']) || $_POST['bluepenalty'] == "")
		{
			$obj->bluepenalty = 0;
		}
		else
		{
			$obj->bluepenalty = (int)$_POST['bluepenalty'];
		}

		$unconf->scores->$match = array();
		array_push($unconf->scores->$match, $obj);

		if(!isset($real->scores)) $real->scores = new STDClass();
		$real->scores->$match = $obj;
		$real->rng = rand(); // for updators

		file_put_contents("./data/unconf/".$_POST['comp'].".json", json_encode($unconf));
		file_put_contents("./data/comps/".$_POST['comp'].".json", json_encode($real));

		$supp = json_decode(file_get_contents("./data/teams/".$_COOKIE['team'].".json"));
		$supp->contribution += 2;
		file_put_contents("./data/teams/".$_COOKIE['team'].".json", json_encode($supp));

		$contrib = json_decode(file_get_contents("./data/contrib.json"));
		$onum = (string)$_COOKIE['team'];
		$contrib->teams->$onum->pts += 2;
		file_put_contents("./data/contrib.json", json_encode($contrib));

		echo '{"title":"Success","message":"Match entered for the first time, added to tables."}';
		die;


	}
	else
	{
		// settle dispute on score...
	}




=======
>>>>>>> Stashed changes
}
else
{
	echo '{"title":"Error","message":"Request type not recognized."}';
	die;
}



?>