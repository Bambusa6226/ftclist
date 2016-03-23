<?php 


	function genid()
	{
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
				$charactersLength = strlen($characters);
				$handle = '';
				for ($i = 0; $i < 6; $i++) {
			   		$handle .= $characters[rand(0, $charactersLength - 1)];
				}

		return $handle;
	}

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

		$o->flr = (int)$off[$pre.$dc."Floor Goal"][$i];
		$pts += $POS->FLR*$o->flr;

		$o->high = (int)$off[$pre.$dc."High Goal"][$i];
		$pts += $POS->HIGH*$o->high;

		$o->mid = (int)$off[$pre.$dc."Mid Goal"][$i];
		$pts += $POS->MID*$o->mid;

		$o->low = (int)$off[$pre.$dc."Low Goal"][$i];
		$pts += $POS->LOW*$o->low;

		$o->tclm = (int)$off[$pre.$dc."Climbers in Shelter"][$i];
		$pts += $POS->TCLM*$o->tclm;

		$o->zlc = (int)$off[$pre.$dc."Zip Line"][$i];
		$pts += $POS->ZLC*$o->zlc;

		$o->acs = (int)$off[$pre.$eg."All Clear Signal"][$i];
		$pts += $POS->ACS*$o->acs;

		$o->hang = (int)$off[$pre.$eg."Robot on Pull Up Bar"][$i];
		$pts += $POS->HANG*$o->hang;

		$o->minor = (int)$off[$pre."Minor Penalty Incurred"][$i];
		$o->major = (int)$off[$pre."Major Penalty Incurred"][$i];

		$pen += (int)$off[$pre."Minor Penalty Awarded"][$i]*$POS->MINOR;
		$pen += (int)$off[$pre."Major Penalty Awarded"][$i]*$POS->MAJOR;
		$pts += (int)$pen;

		$o->score = $pts;
		$o->penalty = $pen;

		return $o;
	}



	$comps = array();
	$prevcomp = "";

	$match = 0;
	for($i=0;$i<count($off["Date"]);$i++)
	{
		if($prevcomp != $off["Event Name"][$i])
		{
			if($prevcomp != "")
			{
				
				$handle = genid();
				file_put_contents("./cmp/".$handle.".json", json_encode($comps[$prevcomp]));
			}

			$prevcomp = $off["Event Name"][$i];
			$comps[$prevcomp] = new STDClass();
			$comps[$prevcomp]->date = $off["Date"][$i];
			$comps[$prevcomp]->type = $off["Event Type"][$i];
			$comps[$prevcomp]->name = $prevcomp;
			$comps[$prevcomp]->division = $off["Division"][$i];
			$comps[$prevcomp]->rows = array();
			echo ".";
			$match = 0;
		
		}

		if($off["Match Type"][$i] != 1) continue; // deal with elim later.

		$row = new STDClass();

		$row->red1 = (string) $off["Red 1"][$i];
		$row->red2 = (string) $off["Red 2"][$i];
		$row->blue1 = (string) $off["Blue 1"][$i];
		$row->blue2 = (string) $off["Blue 2"][$i];

		if($off["Red 1 Surrogate"] == 1) $row->red1 .= "*";
		if($off["Red 2 Surrogate"] == 1) $row->red2 .= "*";
		if($off["Blue 1 Surrogate"] == 1) $row->blue1 .= "*";
		if($off["Blue 2 Surrogate"] == 1) $row->blue2 .= "*";

		$retc = count_pts($i, "Red ");
		$betc = count_pts($i, "Blue ");

		$row->redscore = $retc->score;
		$row->redpenalty = $retc->penalty;
		$row->bluescore = $betc->score;
		$row->bluepenalty = $betc->penalty;

		$row->redetc = $retc;
		$row->blueetc = $betc;

		$row->match = ++$match;

		array_push($comps[$prevcomp]->rows, $row);
	}


	file_put_contents("full.json", json_encode($comps));


?>