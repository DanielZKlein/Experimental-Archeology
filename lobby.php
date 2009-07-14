<?php

// LOBBY.php


class Lobby extends Ajaxmodule {


	function __construct($execute = true) {
	
		parent::__construct();
		if ($execute) {
			$this->doStuff();
		}
	
	}

	function printGame($id) {
	
		// ACTUALLY this should be in game.php to keep everything in one place.
		// Currently I don't foresee any other place where a gameslist might be needed,
		// but once that changes, MOVE THAT GEAR UP!
		// DONE
		$tempgame = new Game($id, false);
		$out = $tempgame->printGame();
		return $out;
			
	}
	
	function printStatus() {
	
		$out = "";
		$id = $this->sys->userId;
		$mygameids = getRow("gameid", "gametouserid", "userid = $id");
		//dbug("my game ids are ".array_dump($mygameids));
		$gamesbeingsetup = getRow("gameid", "gamestate", "status = 0");
		//dbug("games being setup are ".array_dump($gamesbeingsetup));
		$allgameids = getRow("gameid", "gamestate");
		$othersplaying = array_values(array_diff($allgameids, $mygameids, $gamesbeingsetup));
		//dbug("games that others are playing are ".array_dump($othersplaying));
		$cpout = "";
		$tempstr = "";
		foreach ($mygameids as $gid) {
			$tempstr .= apostrofuck($this->printGame($gid))."<br>"; 
		}
		$out .= "overwriteDiv('curplayingin', '$tempstr');\n";
		$tempstr = "";
		foreach ($gamesbeingsetup as $gid) {
			$tempstr .= apostrofuck($this->printGame($gid))."<br>"; 
		}
		$out .= "overwriteDiv('curbeingsetup', '$tempstr');\n";
		$tempstr = "";
		foreach ($othersplaying as $gid) {
			$tempstr .= apostrofuck($this->printGame($gid))."<br>"; 
		}
		$out .= "overwriteDiv('othersplaying', '$tempstr');\n";
		$this->output("thereisonlyonelobby", $out);
	
	
	}
	

}