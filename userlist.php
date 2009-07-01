<?php

// USERLISTMODULE.PHP


class Userlist {

	public $users;

	function __construct($chatid) {
	
		$tempchat = new Chatmodule($chatid);
		$this->users = $tempchat->users;
	
	}
	
	function printStatus() {
	
		foreach ($this->users as $user) {
		
			$tu = new User($user);
			$now = time();
			$name = $tu->get("login");
			$timestamp = $tu->get("lastping");
			$formateddate = date("M jS Y, H:i:s", $timestamp);
			if ($now - $timestamp < 10) {
				$status = "online";
			} else if ($now - $timestamp < 30) {
				$status = "away";
			} else {
				$status = "offline";
			}
			print "setUser($user, '$name', '$status', 'Last activity: $formateddate');\n";
			dbug("setUser($user, '$name', '$status', 'Last activity: $formateddate');\n");
			
		}
	
	}

}