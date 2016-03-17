<?php 

	$POS = new STDClass();
	$POS->PLC_N = ["Nowhere of Circumstance", "Beacon Repair Zone", "In Floor Goal", "On Mountain Touching Floor", "On Mountain, Low Zone", "On Mountain, Mid Zone", "On Mountain, High Zone"];
	$POS->PLC_P = [0, 5, 5, 5, 10, 20, 40];
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

	$off = json_decode(file_get_contents("./off.json"), true);



	function count_pts($i, $pre)
	{
		global $POS;
		global $off;

		$aut = "Autonomous Period, ";
		$dc = "Driver Controlled; ";
		$eg = "End Game; ";

		$o = new STDClass();
		$pts = 0;
		$pen = 0;

		$o->p1aplc = (int)$off[$pre.$aut."Robot 1 Placement"][$i];
		$o->p1aplcn = $POS->PLC_N[$o->p1aplc];
		$pts += $POS->PLC_P[$o->p1aplc];

		$o->p2aplc = (int)$off[$pre.$aut."Robot 2 Placement"][$i];
		$o->p2aplcn = $POS->PLC_N[$o->p2aplc];
		$pts += $POS->PLC_P[$o->p2aplc];

		$o->bcn = (int)$off[$pre.$aut."Rescue Beacons"][$i];
		$pts += $POS->BCN*$o->bcn;

		$o->aclm = (int)$off[$pre.$aut."Climbers in Shelter"][$i];
		$pts += $POS->ACLM*$o->aclm;

		$o->p1plc = (int)$off[$pre.$dc."Robot 1 Placement"][$i];
		$o->p1plcn = $POS->PLC_N[$o->p1plc];
		$pts += $POS->PLC_P[$o->p1plc];

		$o->p2plc = (int)$off[$pre.$dc."Robot 2 Placement"][$i];
		$o->p2plcn = $POS->PLC_N[$o->p2plc];
		$pts += $POS->PLC_N[$o->p2plc];

		$o->flr = (int)$off[$pre.$dc."Floor Goal"];
		$pts += $POS->FLR*$o->flr;

		$o->high = (int)$off[$pre.$dc."High Goal"];
		$pts += $POS->HIGH*$o->high;

		$o->mid = (int)$off[$pre.$dc."Mid Goal"];
		$pts += $POS->MID*$o->mid;

		$o->low = (int)$off[$pre.$dc."Low Goal"];
		$pts += $POS->LOW*$o->low;

		$o->tclm = (int)$off[$pre.$dc."Climbers in Shelter"];
		$pts += $POS->TCLM*$o->tclm;

		$o->zlc = (int)$off[$pre.$dc."Zip Line"];
		$pts += $POS->ZLC*$o->zlc;

		$o->acs = (int)$off[$pre.$eg."All Clear Signal"];
		$pts += $POS->ACS*$o->acs;

		$o->hang = (int)$off[$pre.$eg."Robot on Pull Up Bar"];
		$pts += $POS->HANG*$o->hang;

		$o->minor = (int)$off[$pre."Minor Penalty Incurred"];
		$o->major = (int)$off[$pre."Major Penalty Incurred"];

		$pen += (int)$off[$pre."Minor Penalty Awarded"]*$POS->MINOR;
		$pen += (int)$off[$pre."Major Penalty Awarded"]*$POS->MAJOR;
		$pts += (int)$pen;

		$o->score = $pts;
		$o->penalties = $pen;

		return $o;
	}



	$comps = array();
	$prevcomp = "";
	for($i=0;$i<count($off["Date"]);$i++)
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

		if($off["Match Type"][$i] != 1) continue; // deal with elim later.

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

		$row->redscore = $retc->score;
		$row->redpenalty = $retc->penalty;
		$row->bluescore = $bect->score;
		$row->bluepenalty = $bect->penalty;

		$row->redetc = $retc;
		$row->blueetc = $betc;

		array_push($comps[$prevcomp]->rows, $row);
	}

	file_put_contents("full.json", json_encode($comps));


?>