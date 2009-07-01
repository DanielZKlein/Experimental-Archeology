<?php
/* CHATMODULE.PHP
   Extends ajaxmodule
   Handles sending out chat refreshes and receiving new lines
*/


class Chatmodule {

	public $id;
	public $users;
	
	function __construct($id) {
	
		$this->id = $id;
		$this->users = getRow("userid", "chattouserid", "chatid = ".$id);
		
	}
	
	function isMember($user) {
	
		if (in_array($user->id, $this->users)) {
			return true;
		} else {
			return false;
		}
	
	}
	
	function printRefresh($last = -1, $first = -1) {

		list($returntext, $lastid) = $this->getRefresh($last, $first);
		if ($returntext != "") {
			$this->setText($returntext);
		}
		if ($lastid != "") {
			$this->setLastId($lastid);
		}
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
		$returntext = preg_replace('/\'/', "&#39;", $returntext);
//		dbug($returntext);
		$ra = array($returntext, $lastid);
		return $ra;
	}
	
	function setText($text) {
		// makes JS set new text
		
		print "takeChatRefresh('$text');\n";
	}

	function setLastId($id) {
		print "setChatLastId($id);\n";
	}

	function addLine($line, $user) {
		//dbug("adding line $line from $user");
		$myid = $user->get("id");
		$user->ping();
		$now = time();
		execSql("insert into chatcontent (chatid, timestamp, userid, chattext) values ($this->id, $now, $myid, '$line')");

	
	}
	
}



?>