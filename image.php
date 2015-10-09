<?php


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

// now we get the image buffer and send it to a file with the team name...?

$ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
$dest = "./data/img/".$_COOKIE['team'].".".$ext;
$src = $_FILES['image']['tmp_name'];

if($_FILES['image']['size'] > 2*1024*1024)
{
	echo "ERROR: File size too big.";
	die;
}

if($ext != "png" && $ext != "jpg" && $ext != "jpeg")
{
	echo "ERROR: incorrect file type";
	echo $ext;
	die;
}

$team = json_decode(file_get_contents("./data/teams/".$_COOKIE['team'].".json"));
$team->ext = $ext;
file_put_contents("./data/teams/".$_COOKIE['team'].".json", json_encode($team));

if (move_uploaded_file($_FILES["image"]["tmp_name"], $dest)) {
	echo "success?";
} else {
	echo "ERROR: file not uploadable for some reason";
	die;
}

// redirect?



?>