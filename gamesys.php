<?php

// SYSTEM, this time fer reels

class Gamesys {

	public $userId;
	public $userPw;
	public $userLogin;
	public $user;
	

	function __construct() {
	
		// empty
	
	}
	
	function loginUser($login, $pw) {
	
		$r = getFirstRow("select * from user where login='".$login."'");
		if ($r['pw'] == $pw) {
			$this->userId = $r['id'];
			//dbug("during construction of sys object, user id is ".$this->userId);
			$this->userPw = $pw;
			$this->userLogin = $login;
			$this->user = new User($this->userId);
			$focus = fetchVar("windowfocus");
			if ($focus == "no") {
			
				$this->user->set("focus", 0);
			
			} else {
			
				$this->user->set("focus", 1);
				
			}
			return true;
		} else {
			return false;
		}
	}

	function getPage() {
	
		$viewing = $this->user->get("curpage");
		if ($viewing == "index.php") {
			die("in a fire");
			// infinite recursion for the lose
		}
		return $viewing;
	}
	
}

?>