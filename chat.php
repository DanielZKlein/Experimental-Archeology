<?php
/* CHAT.PHP
   Extends ajaxmodule
   Obsoletes chatmodule.php
   Handles sending out chat refreshes and receiving new lines
*/


class Chat extends Ajaxmodule {

	public $id;
	public $users;
	public $outputBuffer;
	
	function __construct($chatid = -1, $execute = true) {
	
		parent::__construct();
		//dbug("constructing chat ".$chatid);
		
		if ($chatid == -1) {
			$this->id = fetchVar("chatid");
		} else {
			$this->id = $chatid;
		}
		//dbug("about to fill users; this id is ".$this->id);
		$this->users = getRow("userid", "chattouserid", "chatid = ".$this->id);
		$this->execSuffixes = $this->execSuffixes + array("Line" => "addLine");
		if ($execute) {
			if ($this->isMember($this->sys->user)) {
				$this->doStuff();
			}
		}
		
	}
	
	function isMember($user) {
	
		if (in_array($user->id, $this->users)) {
			return true;
		} else {
			return false;
		}
	
	}
	
	function printStatus($last = -1, $first = -1) {
	
		if ($last == -1) {
			$last = fetchVar("chat".$this->id."last");
		}
		if ($first == -1) {
			$first = fetchVar("chat".$this->id."first"); // FIRST LINE to display in case you don't want to see everything. Might be swapped out for an update length variable at some point
		}
		
		list($returntext, $lastid) = $this->getRefresh($last, $first);
		if ($returntext != "") {
			$this->setText($returntext);
		}
		if ($lastid != "") {
			$this->setLastId($lastid);
		}
		$this->output($this->id, $this->outputBuffer); // should not need to be run through the output uniquifier due to lastline juggling, but you never know. Also reuse pipes in case we want to pin shiny things to output later so we have to do it in one place only.
	}

		
	function getRefresh ($last = -1, $first = -1) {
		$result = getResult("SELECT * FROM chatcontent WHERE chatid=$this->id AND id>$last");
		$returntext = ""; 
		$lastid = 0;
		$allrows = $result->fetchAll(MDB2_FETCHMODE_ASSOC);

		$len = count($allrows);
		if ($len == 0) {

			return array("", "");
		}
		foreach ($allrows as $r) {
		
			$username = getOneThing("login", "user", "id=".$r['userid']);
			$timestamp = date("H:i:s", $r['timestamp']);
			
			$returntext .= "<br>[$timestamp] &lt;$username&gt; ".$r['chattext'];
			$lastid = $r['id'];
		
		}
		$returntext = apostrofuck($returntext);
//		dbug($returntext);
		$ra = array($returntext, $lastid);
		return $ra;
	}
	
	function setText($text) {
		// makes JS set new text
		
		$this->outputBuffer .= "takeChatRefresh(".$this->id.", '$text');\n";
	}

	function setLastId($id) {
		$this->outputBuffer .= "setChatLastId(".$this->id.", $id);\n";
	}

	function addLine() {
		$tempid = fetchVar("chatid");
		if ($tempid != $this->id) {
			dbug("we are in chat object for ".$this->id." and we've received a line for chat ".$tempid);
			return;
		}
		$line = fetchVar("ChatLine");
		$myid = $this->sys->user->get("id");
		$this->sys->user->ping();
		$now = time();
		execSql("insert into chatcontent (chatid, timestamp, userid, chattext) values ($this->id, $now, $myid, '$line')");
	}
	
}



?>