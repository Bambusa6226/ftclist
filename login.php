<?php
// check the data against the password file
// then setup our cookie system
// seperate passwd dir so we can protect hashes?

if(!isset($_POST['team']) || !isset($_POST['pass']))
{
	echo "ERROR: Data missing from request.";
	die;
}

if(!file_exists("./data/passwd/".$_POST['team'].".json"))
{
	echo "ERROR: Team does not have an account yet";
	die;
}

$pwd = json_decode(file_get_contents("./data/passwd/".$_POST['team'].".json"));

$digest = hash("sha256", hash("sha256", $_POST['pass']));
if(!$digest == $pwd->hash)
{
	echo "ERROR: Password is incorrect.";
	die;
}

// ok now we have a real user. give him cookies

setcookie("hash", hash("sha256", $_POST['pass']));
setcookie("team", $_POST['team']);
setcookie("time", time());
setcookie("region", $pwd->region);

// ok, thats easy enough...

echo "sucessfully logged in";
echo "<script>window.location='./team?".$_POST['team']."';</script>";

?>