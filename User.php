<?php

// USER

class User {


	public $id;
	
	function __construct($id) {
		// at this point, sys has logged us in and we can trust that we are the user of this id
	
		$this->id = $id;
		// pinging database
		// CAN'T PING with every construction because then idling shows as being online
	}
	
	function ping() {
		$now = time();
		$this->set("lastping", $now); 
	}

	function get($thing) {
	
		$thing = getOneThing($thing, "user", "id=$this->id");
		return $thing;
	
	}
	
	function set($thing, $value) {
	
		global $con; // for quoting
		//dbug("setting $thing to $value");
		$value = $con->quote($value);
		execSql("UPDATE user SET $thing=$value where id=$this->id");
	
	}
	
	function gotoPage($page) {
	
		if ($page == "gametemplate.php") {
			
			// Going to a game! Take gameid as well. If it's not set, complain!
			$gid = fetchVar("gameid");
			if ($gid == "") {
				die("Can't go to a game if you won't tell me its id!");
			}
			$this->set("gameid", $gid);
		}
		
		
		if ($page == "index.php") {
			// let's not
			die();
		}
		$this->set("curpage", $page);
		dbug("went there: ".$page);
	
	}
	

}