<?php


$teams = json_decode(file_get_contents("./data/contrib.json"))->teams;

$rtimes = array();
$rnames = array();
$max = 0;
$n = 10;

foreach($teams as $team)
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
for($a=0;$a<$n;$a++)
{
	$b = $a;
	while($b<0 || intval($rtimes[$b-1]) > intval($rtimes[$b]))
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
	echo "<td>".xss($cmp->date)."</td>";
	echo "<td><a href='./region/?".str_replace(" ", "", strtolower($cmp->region))."'>".xss($cmp->region)."</a></td>";
	echo "</tr>";
}


?>