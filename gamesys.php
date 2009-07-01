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
			$this->userPw = $pw;
			$this->userLogin = $login;
			$this->user = new User($this->userId);
			
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