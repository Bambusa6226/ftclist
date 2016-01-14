<?php
// alright, here we check if this row is in either commited in the database, or
// or already in the unconf pool
// if neither then we add the list to the unconf pool and wait for conf
// if its in unconf and its the same, then we move unconf.

// we also need to do a check auth in here at some point...
// but that requires a login first..

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

/*if(!isset($_POST['comp']) || !isset($_POST['match']) || !isset($_POST['red1']) || !isset($_POST['red2']) || !isset($_POST['redscore']) || !isset($_POST['blue1']) || !isset($_POST['blue2']) || !isset($_POST['bluescore']));
{
	echo isset($_POST['bluescore']);
	echo json_encode($_POST);
	echo "ERROR: missing data, cannot complete request";
	die;
}*/

if(!file_exists("./data/unconf/".$_POST['comp'].".json"))
{
	// we have a comp where no unconf data has come in yet
	$unconf = new STDClass();
	$unconf->rows = array();
	$unconf->confed = array();

	// any init logic here...
}
else
{
	$unconf = json_decode(file_get_contents("./data/unconf/".$_POST['comp'].".json"));
}

foreach($unconf->confed as $conf)
{
	if($conf == $_POST['match'])
	{
		echo "ERROR: this match score has already been confirmed";
		die;
	}
}

$obj = new STDClass();
	$obj->comp = $_POST['comp'];
	$obj->match = $_POST['match'];
	$obj->red1 = $_POST['red1'];
	$obj->red2 = $_POST['red2'];
	$obj->redscore = $_POST['redscore'];
	$obj->blue1 = $_POST['blue1'];
	$obj->blue2 = $_POST['blue2'];
	$obj->bluescore = $_POST['bluescore'];
	$obj->contrib = $_COOKIE['team'];

	if(isset($_POST['bluepenalty']) && strlen($_POST['bluepenalty']) != 0) 
		$obj->bluepenalty = $_POST['bluepenalty'];
	else 
		$obj->bluepenalty = "0";

	if(isset($_POST['redpenalty']) && strlen($_POST['redpenalty']) != 0) 
		$obj->redpenalty = $_POST['redpenalty'];
	else
		$obj->redpenalty = "0"; 

$found = false;
foreach($unconf->rows as $row)
{
	if($row->match == $_POST['match'])
	{
		if((($row->red1 == $_POST['red1'] && $row->red2 == $_POST['red2'])
			|| ($row->red1 == $_POST['red2'] && $row->red2 == $_POST['red1']))
			&& ($row->redscore == $_POST['redscore'])
			&& (($row->blue1 == $_POST['blue1'] && $row->blue2 == $_POST['blue2'])
			|| ($row->blue1 == $_POST['blue2'] && $row->blue2 == $_POST['blue1']))
			&& ($row->bluescore == $_POST['bluescore'])
			&& ($row->bluepenalty == $obj->bluepenalty)
			&& ($row->redpenalty == $obj->redpenalty))
		{
			// this is a match, move it to confirmed and remove from unconf, and check off on confed list.
			if($row->contrib == $_COOKIE['team'])
			{
				echo "ERROR: Data must be validated by a different team";
				continue;
			}
			// ok, we need to credit accounts with points here...
			echo "row confirmed and added";
			$orig = json_decode(file_get_contents("./data/teams/".$row->contrib.".json"));
			$orig->contribution += 3;
			file_put_contents("./data/teams/".$row->contrib.".json", json_encode($orig));

			$supp = json_decode(file_get_contents("./data/teams/".$_COOKIE['team'].".json"));
			$supp->contribution += 2;
			file_put_contents("./data/teams/".$_COOKIE['team'].".json", json_encode($supp));

			$contrib = json_decode(file_get_contents("./data/contrib.json"));
			$onum = (string)$orig->number;
			$snum = (string)$supp->number;
			$contrib->teams->$onum->pts += 3;
			$contrib->teams->$snum->pts += 2;
			file_put_contents("./data/contrib.json", json_encode($contrib));

			array_push($unconf->confed, $_POST['match']);
			$comp = json_decode(file_get_contents("./data/comps/".$_POST['comp'].".json"));
			array_push($comp->rows, $row);
			file_put_contents("./data/comps/".$_POST['comp'].".json", json_encode($comp));

			saveteam($_POST['red1'], $obj);
			saveteam($_POST['red2'], $obj);
			saveteam($_POST['blue1'], $obj);
			saveteam($_POST['blue2'], $obj);

			$found = true;
			break;
		}
	}
}

if(!$found)
{
	array_push($unconf->rows, $obj);
}

file_put_contents("./data/unconf/".$_POST['comp'].".json", json_encode($unconf));

// now lets send some postdata?


echo "<form action='./comp/?".$_POST['comp']."' method='post' name='frm'>";

if($found) echo "<input type='hidden' name='message' value='You have confirmed match data. Row Added.'>";
else echo "<input type='hidden' name='message' value='Match data added. Data must now be confirmed by another team to be valid.'>";
?>

</form>
<script>
document.frm.submit();
</script>