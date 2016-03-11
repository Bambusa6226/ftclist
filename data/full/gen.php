<?php 

	$POS = new STDClass();
	$POS->PLC_N = {"NO ZERO", "Beacon Repair Zone", "In Floor Goal", "On Mountain Touching Floor", "On Mountain, Low Zone", "On Mountain, Mid Zone", "On Mountain, High Zone"};
	$POS->PLC_P = {0, 5, 5, 5, 10, 20, 40};
	$POS->BCN = 20;
	$POS->ACLM = 10;
	$POS->FLR = 1;
	$POS->HIGH = 15;
	$POS->MID = 10;
	$POS->LOW = 5;
	$POS->TCLM = 10;
	$POS->ZLC = 20;
	$POS->ACS = 20;
	$POS->HANG = 80;
	$POS->MINOR = 10;
	$POS->MAJOR = 40;


	function count_pts($i, $pre)
	{
		$aut = "Autonomous Period; ";

		$o = new STDClass();
		$pts = 0;
		$o->p1aplc = $off[$pre.$aut."Robot 1 Placement"][$i];
		$o->p1aplcn = $POS->PLC_N[$o->p1aplc];
		$pts += $POS->PLC_P[$o->$p1aplc];

		$o->p2aplc = $off[$pre.$aut."Robot 2 Placement"][$i];
		$o->p2aplcn = $POS->
	}



	$off = json_decode(file_get_contents("./off.json"));
	$comps = new STDClass();
	$prevcomp = "";
	for($i=0;$i<count($off->Date);$i++)
	{
		if($prevcomp != $off["Event Name"][$i])
		{
			$prevcomp = $off["Event Name"][$i];
			$comps[$prevcomp] = new STDClass();
			$comps[$prevcomp]->date = $off["Date"][$i];
			$comps[$prevcomp]->type = $off["Event Type"][$i];
			$comps[$prevcomp]->name = $prevcomp;
			$comps[$prevcomp]->division = $off["Division"][$i];
			$comps[$prevcomp]->rows = array();
		}
		if($off["Match Type"] != 1) continue; // deal with elim later.

		$row = new STDClass();

		$row->red1 = $off["Red 1"][$i];
		$row->red2 = $off["Red 2"][$i];
		$row->blue1 = $off["Blue 1"][$i];
		$row->blue2 = $off["Blue 2"][$i];

		if($off["Red 1 Surrogate"] == 1) $row->red1 .= "*";
		if($off["Red 2 Surrogate"] == 1) $row->red2 .= "*";
		if($off["Blue 1 Surrogate"] == 1) $row->blue1 .= "*";
		if($off["Blue 2 Surrogate"] == 1) $row->blue2 .= "*";

		$retc = count_pts($i, "Red ");
		$betc = count_pts($i, "Blue ");


	}


?>