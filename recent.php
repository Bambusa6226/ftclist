<?php


	function timeago($timestamp)
	{

		$fromnow =  time() - $timestamp;
		
		$days =  floor($fromnow/86400);
		$hours = floor(($fromnow%86400)/3600);
		$minutes = floor(($fromnow%3600)/60);
		$seconds = floor($fromnow&60);
		$acc = "";
		if($days != 0 && $days != 1) $acc = $days . " days ago";
		else if($days == 1) $acc = " 1 day ago";
		else if($hours != 0 && $hours != 1) $acc = $hours . " hours ago";
		else if($hours == 1) $acc = "1 hour ago";
		else if($minutes != 0 && $minutes != 1) $acc = $minutes . " minutes ago";
		else if($minutes == 1) $acc = "1 minute ago";
		else if($seconds != 0 && $seconds != 1) $acc = $seconds . " seconds ago";
		else if($seconds == 1) $acc = "1 second ago";
		else $acc = "just now";
		
		return $acc;
	}


$files = scandir("./data/comps");

$rtimes = array();
$rnames = array();
$max = 2000000000;
$n = 10;

foreach($files as $file)
{
	if($file == "." || $file == "..") continue;
	$time = intval(filemtime("./data/comps/".$file));

	if(count($rtimes) < $n)
	{
		array_push($rtimes, $time);
		array_push($rnames, $file);
		if($time < $max) $max = $time;
	}
	else
	{
		if($time > $max)
		{
			for($i=0;$i<$n;$i++)
			{
				if($time > $rtimes[$i])
				{
					$rtimes[$i] = $time;
					$rnames[$i] = $file;
					break;
				}
			}
		}
	}
}
// insertion sort bc the data is close?
for($a=1;$a<$n;$a++)
{
	$b = $a;
	while($b>0 && intval($rtimes[$b-1]) > intval($rtimes[$b]))
	{
		$mid = $rtimes[$b-1];
		$rtimes[$b-1] = $rtimes[$b];
		$rtimes[$b] = $mid;

		$mid = $rnames[$b-1];
		$rnames[$b-1] = $rnames[$b];
		$rnames[$b] = $mid;
		$b--;
	}
}

function xss($val)
{
	$val = str_replace("&", "&amp;", $val);
	$val = str_replace("<", "&lt;", $val);
	$val = str_replace(">", "&gt;", $val);
	$val = str_replace('"', "&quot;", $val);
	$val = str_replace("'", "&#x27;", $val);
	$val = str_replace("/", "&#x2F;", $val);
	return $val;
}

for($j=$n-1;$j>=0;$j--)
{
	$cmp = json_decode(file_get_contents("./data/comps/".$rnames[$j]));
	echo "<tr>";
	echo "<td><a href='./comp/?".substr($rnames[$j], 0, -5)."'>".xss($cmp->name)."</a></td>";
	echo "<td>".count($cmp->rows)."</td>";
	echo "<td>".timeago($rtimes[$j])."</td>";
	echo "<td>".xss($cmp->date)."</td>";
	if(isset($cmp->region))
	echo "<td><a href='./region/?".str_replace(" ", "", strtolower($cmp->region))."'>".xss($cmp->region)."</a></td>";
	else echo "<td></td>";
	echo "</tr>";
}

?>