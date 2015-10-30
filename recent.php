<?php


$files = scandir("./data/comps");

$rtimes = array();
$rnames = array();
$max = 0;

foreach($files as $file)
{
	if($file == "." || $file == "..") continue;
	$time = filemtime("./data/comps/".$file);

	if(count($rtimes) < 5)
	{
		array_push($rtimes, $time);
		array_push($rnames, $file);
		if($time < $max) $max = $time;
	}
	else
	{
		if($time < $max)
		{
			for($i=0;$i<5;$i++)
			{
				if($time < $rtimes[$i])
				{
					$rtimes[$i] = $time;
					$rnames[$i] = $file;
					break;
				}
			}
		}
	}
}
for($j=0;$j<5;$j++)
{
	$cmp = json_decode(file_get_contents("./data/comps/".$rnames[$j]));
	echo "<tr>";
	echo "<td><a href='./comp/?".substr($rnames[$j], 0, -5)."'>".$cmp->name."</a></td>";
	echo "<td>".count($cmp->rows)."</td>";
	echo "<td>".$cmp->date."</td>";
	echo "<td><a href='./region/?".str_replace(" ", "", strtolower($cmp->region))."'>".$cmp->region."</a></td>";
	echo "</tr>";
}


$n;

foreach($n)
{
	foreach($n)
	{

	}
}

O(n^2)



?>