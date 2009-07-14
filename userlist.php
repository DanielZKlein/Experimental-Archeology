<?php

// USERLISTMODULE.PHP


class Userlist extends Ajaxmodule{

	public $awaySeconds = 30; // how many seconds before user is flagged as away to frontend
	public $offlineSeconds = 300;
	public $users;
	public $id;

	function __construct($execute = true) {
	
		// set execute to false to just create the object but not run through its ajax variables and output stuff
		// the reason why I put $execute in all the subclasses and not once in the parentclass is this:
		// doStuff needs to be called after all the construct work is done
		// The construct work in the parentclass is the groundwork. It needs to be done before anything
		// else.
		// Profit.
		parent::__construct(); 
		$chatid = fetchVar("userlistid");
		$this->id = $chatid;
		$tempchat = new Chat($chatid, false); // currently every userlist is tied to a chat.
		$this->users = $tempchat->users;
		if ($execute) {
			$this->doStuff();
		}
	
	}
	
	function printStatus() {


		$output = "";
		foreach ($this->users as $user) {
		
			$tu = new User($user);
			$now = time();
			$name = $tu->get("login");
			$timestamp = $tu->get("lastping");
			$focus = $tu->get("focus");
			if ($focus == "0") {
				$name = "(".$name.")";
			}
			$formateddate = date("M jS Y, H:i:s", $timestamp);
			if ($now - $timestamp < $this->awaySeconds) {
				$status = "online";
			} else if ($now - $timestamp < $this->offlineSeconds) {
				$status = "away";
			} else {
				$status = "offline";
			}
			$output .= "setUser($user, '$name', '$status', 'Last activity: $formateddate');\n";
			//dbug("setUser($user, '$name', '$status', 'Last activity: $formateddate');\n");
		}
		
		$this->output($this->id, $output); // chatid will do as identifier since there can be only one userlist per chat. Remember the cache table is named for the module, so no overlap with chat output
	}

}