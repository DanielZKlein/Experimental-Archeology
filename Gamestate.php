<?php  

// system

class Gamestate {

	// here's how we'll make this make sense. I am the CHARACTER whose player who called this script.
	// curAnything refers to current IN THE GAME.
	// so myId is the id of the character controlled by the player who called this script, while curId or rather
	// $gs->curPlayer->get("id") is the id of the CHARACTER currently playing. 
	// Let's practise semantic hygiene here.

	public $myId; // character ID for me
	public $me; // character object for the character whose player called us
	public $gameId;
	public $IAmPlaying; // BOOLEAN 
	public $curCommand;
	public $curChar; // character who's currently playing
	public $curCharId; // shortcut for the truly lazy
	public $numChars; // total players in this game
	protected $sysObj;


	function __construct($gameid, $sysobj) {
	
		
		// find out number of players in the game right now (why does this go here? Feels tidier)
		
		$r = getResult("select id from gamestate_characters where gameid=$gameid");
		$allIds = $r->fetchCol("id");
		$this->sysObj = $sysobj;
		$this->numChars = count($allIds);
		$this->gameId = $gameid;
		$this->makeMe($sysobj->userId);		
	
	}
	
	function makeCards() {
	
		// return the list of names and descriptions for all the cards a player has
		
		$cards = explode(" ", $this->me->get("cards"));
		$i = 0;
		$rv = "gamestate.cards = [];";
		
		foreach ($cards as $value) {
			$name = getOneThing("name", "gamedata_cards", "id=".$value);
			$description = getOneThing("description", "gamedata_cards", "id=".$value);
			$rv .= "gamestate.cards[".$i."] = new Object();\n";
			$rv .= "gamestate.cards[".$i."].name = '".$name."';\ngamestate.cards[".$i."].description = '".$description."';\n";
			$i++;
			}
		
	
		return $rv;
		
	
	}

	function makeMe($userId) {
	
		$this->myId = getOneThing("id", "gamestate_characters", "playedby=".$userId." and gameid=$this->gameId");
		$this->me = new Character($this->myId);
		$this->curCharId = getOneThing("character_playing", "gamestate", "gameid=$this->gameId");
		$this->curChar = new Character($this->curCharId);

		if ($this->myId == $this->curCharId) {
			$this->IAmPlaying = true;
		} else {
			$this->IAmPlaying = false;
		}
	}
		
	function makeCommand($city, $text, $ap, $dollar, $effect) {

		$sql = "insert into gamestate_commands values (".$this->curCommand.", '".$text."', '".$effect."', ".$ap.", ".$dollar.", ".$city.", ".$this->gameId.")";
		execSql($sql);
		$rv = "gamestate.commands[".$this->curCommand."] = { city : ".$city.", text : '".$text." (".$ap." AP, ".$dollar."$)'};\n";
		$this->curCommand++;
		return $rv;
	}

	function resetEverything() {

		//let's not use this anymore
		execSql("drop table gamestate_characters");
		execSql("create table gamestate_characters select * from initialstate_players");
		$this->printState();

	}
	
	function endRound() {
	
		$fullAp = 5; // probably want to read that from a rules table at some point?
		execSql("update gamestate_characters set ap=".$fullAp." where id=".$this->curCharId." and gameid=$this->gameId");
		if ($this->curCharId < $this->numChars - 1) {
			// there's another player this round. Pass the controls on.
			$newPlayerId = $this->curCharId + 1;
			execSql("update gamestate set character_playing=".$newPlayerId." where gameid=$this->gameId"); //TODO: dynamicize gameid
		
		} else {
			$newPlayerId = 0;
			$round = getOneThing("current_round", "gamestate", "gameid=1");
			$newround = $round + 1;
			execSql("update gamestate set current_round=".$newround." where gameid=$this->gameId");
			execSql("update gamestate set character_playing=".$newPlayerId." where gameid=$this->gameId"); //TODO: dynamicize gameid
		
		}
		
		$everythingisdifferentnow = new Gamestate($this->gameId);
		$everythingisdifferentnow->makeMe($this->sysObj->userId);
		$everythingisdifferentnow->printState();
	}

	function printState() {
	
		// print javascript arrays for the current game state
		$state = $this->getState();
		echo $state;

	
	}
	
	function makeCities() {
	
		return dumpTableIntoJavascript("mapdata_cities", "gamestate.cities", "iconsRendered : 0");
	
	}
	
	function makeStatus() {
	
		// stuff like AP, dollar, who is playing, what round it is, etc
		$ap = $this->me->get("ap");
		$dollar = $this->me->get("dollar");
		$name = $this->me->get("name");
		$userName = $this->sysObj->userLogin;
		$myCityId = $this->me->get("city");
		$myCityName = getOneThing("name", "mapdata_cities", "id=".$myCityId);
		$round = getOneThing("current_round", "gamestate", "gameid=$this->gameId");
		if ($this->IAmPlaying) {
			$curCharName = $name;
			$curPlayerName = $userName;
		} else {
			$curCharName = $this->curChar->get("name");
			$curPlayerName = getOneThing("login", "user", "id=".getOneThing("playedby", "gamestate_characters", "id=".$this->curCharId));
		}
		$rv = "
		gamestate.ap = ".$ap.";\n
		gamestate.dollar = ".$dollar.";\n
		gamestate.charname = '".$name."';\n
		gamestate.username = '".$userName."';\n
		gamestate.curcityname = '".$myCityName."';\n
		gamestate.round = ".$round.";\n
		gamestate.curcharname = '".$curCharName."';\n
		gamestate.curplayername = '".$curPlayerName."';\n
		gamestate.me = ".$this->myId.";\n";
		return $rv;	
	}
	
	function getState() {
	
		// returns a string containing javascript arrays describing the current gamestate
		$sql = "select * from gamestate_characters";
		$results = getResult($sql);

		$i = 0;
		$output = "";
		$output = $output . "// <![CDATA[\n";
		$output = $output . $this->makeStatus();
		$output .= $this->makeCities();


		// write out all "player" data (should change this to character eventually)
		// this doesn't use any of your fancy new OO functions, but it's elegant and robust,
		// so it stays
		while($row = $results->fetchRow(MDB2_FETCHMODE_ASSOC)) {
			$output .= "gamestate.characters[".$i."] = { ";
			foreach($row as $field => $value) {
				if (!((string)intval($value) === $value)) {
					$output .= $field.' : "'.$value.'", ';
				} else {
					$output .= $field.' : '.$value.', ';
				}
			}
			$output = trim($output, ", ")."};\n";
			$i++;
		}
		$output .= $this->makeCards();		
		
		if ($this->IAmPlaying) {
			$output = $output.$this->makeAllCommands();
		} else {
			$output = $output."\ngamestate.therearenocommands=true;\n";
		}
		$output = $output . "// ]]>";
		return $output;

	
	}
	
	function makeAllCommands() {
	
		$this->curCommand = 0; // eek global iteration variable. DON'T LOOK!
			

		// now building commands list
		// first of all, lots of hardcoded assumptions that we'll swap out for dynamically definable doodads eventually
		// hah triple alliteration!
		$output = "";
		$output = $output . "gamestate.commands = [];\n";
		execSql("delete from gamestate_commands");

		$weAreIn = $this->me->get("city");
		
		$output .= $this->makeCommand($weAreIn, "Raise money", 1, 0, "getmoney ".$weAreIn);
		$output .= $this->makeCommand($weAreIn, "Dig for leads", 1, 0, "digleads ".$weAreIn);

		$sql = "select * from mapdata_routes where city1id=".$weAreIn;
		$results = getResult($sql);
		while($row = $results->fetchRow(MDB2_FETCHMODE_ASSOC)) {

			$targetCity = $row['city2id'];
			$apcost = $row['apcost'];
			$dollarcost = $row['dollarcost'];
			$description = $row['description'];
			$sql = "select name from mapdata_cities where id=".$targetCity;
			$row = getFirstRow($sql);
			
			$description = preg_replace('/\%s/', $row['name'], $description);
			$output .= $this->makeCommand($targetCity, $description, $apcost, $dollarcost, "goto ".$targetCity);

		}
		
		$sql = "select * from mapdata_routes where city2id=".$weAreIn;
		$results = getResult($sql);
		while($row = $results->fetchRow(MDB2_FETCHMODE_ASSOC)) {

			$targetCity = $row['city1id'];
			$apcost = $row['apcost'];
			$dollarcost = $row['dollarcost'];
			$description = $row['description'];
			$sql = "select name from mapdata_cities where id=".$targetCity;
			$row = getFirstRow($sql);
			
			$description = preg_replace('/\%s/', $row['name'], $description);
			$output .= $this->makeCommand($targetCity, $description, $apcost, $dollarcost, "goto ".$targetCity);

		}

	
		return $output; //d'oh!
	}

	function getUserIds() {
	// returns an array of the users who have a character in this game
		$charIds = $this->getCharIds();
		$idsToReturn = array();
		foreach ($charIds as $id) {
		
			$idsToReturn[] = getOneThing("playedby", "gamestate_characters", "id=$id and gameid=$this->gameId");
		
		}
		dbug("getUserIds is about to return ".implode(", ", $idsToReturn));
		return $idsToReturn;
	}

	function getCharIds() {
	// returns an array of all chars playing in this game
	
		$r = getResult("SELECT id FROM gamestate_characters WHERE gameid=$this->gameId");
		$idsToReturn = array();
		while ($row = $r->fetchRow(MDB2_FETCHMODE_ASSOC)) {
		
			$idsToReturn[] = $row['id'];
		
		}
	
		dbug("getCharIds is about to return ".implode(", ", $idsToReturn));
		return $idsToReturn;
	}
	
	
}
