<?php


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


for($j=$n-1;$j>=0;$j--)
{
	$cmp = json_decode(file_get_contents("./data/comps/".$rnames[$j]));
	echo "<tr>";
	echo "<td><a href='./comp/?".substr($rnames[$j], 0, -5)."'>".$cmp->name."</a></td>";
	echo "<td>".count($cmp->rows)."</td>";
	echo "<td>".$cmp->date."</td>";
	echo "<td><a href='./region/?".str_replace(" ", "", strtolower($cmp->region))."'>".$cmp->region."</a></td>";
	echo "</tr>";
}


?>