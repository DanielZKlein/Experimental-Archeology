<?php
if (!isset($theVariableFromIndex)) {
	die("please go through index.php like a nice boy");
}
$gameid = $sys->user->get("gameid");
$gs = new Gamestate($gameid, $sys);

$do = $command;
//dbug("do is " . $do);
if ($do == "getInitialGamestate") {
	// initialize it (read stuff like cities from the map table into the mapdata table, read starting locations and values from wherever)
	$gs->printState();
	die();
}

if ($do == "docommand") {
	if ($gs->IAmPlaying) {
		doCommand($_POST['number']);
		die();
	} else {
		die();
	}
}

if ($do == "reseteverything") {

	dbug("resetting everything");
	$gs->resetEverything();

}

if ($do == "endround") {
	if ($gs->IAmPlaying) {
		dbug("ending round");
		$gs->endRound();
	}
}

function doCommand($number) {
	global $gs;
	$effect = getOneThing("effect", "gamestate_commands", "id=".$number);
	$ap = getOneThing("apcost", "gamestate_commands", "id=".$number);
	$dol = getOneThing("dollarcost", "gamestate_commands", "id=".$number);
	$sql = "select * from gamestate_characters where id=0";
	$row = getFirstRow($sql);
	$curap = $gs->me->get("ap");
	$curdol = $gs->me->get("dollar");
	if ($ap > $curap) {
		echo "ERROR: Not enough AP";
		dbug("ERROR: Not enough AP");
		die();
	}
	if ($dol > $curdol) {
		echo "ERROR: Not enough dollar";
		die();
	
	}
	$curdol = $curdol - $dol;
	$curap = $curap - $ap;
	dbug("after adjustment, current ap is now ".$curap);
	$gs->me->set("ap", $curap);
	$gs->me->set("dollar", $curdol);
	$t = explode(" ", $effect);
	$etype = $t[0];
	$city = $t[1];
	switch ($etype) {
		case "goto":
			$gs->me->set("city", $city);
			$gs->printState();
			break;
		case "digleads":
			echo "Ya find nothin'";
			break;
		case "getmoney":
			$oldMoney = $gs->me->get("dollar");
			$newMoney = $oldMoney + 23;
			$gs->me->set("dollar", $newMoney);
			$gs->printState();
			break;
	}
}

?>
