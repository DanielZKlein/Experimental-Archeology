<?php
function __autoload($class_name) {
    require_once $class_name . '.php';
}

require_once("db.php");

function getLogin() {
	// for now just looking in post/get variables. Eventually include cookies, sessions?
	// GET overwrites POST
	if ($_GET['login'] != "") {
		return $_GET['login'];
	}
	return $_POST['login'];
}

function getPw() {
	// for now just looking in post/get variables. Eventually include cookies, sessions?
	// GET overwrites POST
	if ($_GET['pw'] != "") {
		return $_GET['pw'];
	}
	return $_POST['pw'];
}


$login = getLogin();
$pw = getPw();
print "Login is ".$login." and pw is ".$pw."<br><br>";

$test = getOneThing("curpage", "user", "id=0");
if ($test == "") {

	print "not currently looking at any page";

} else {

	print "currently looking at $test";
	
}
$gs = new Gamestate(1);

$gs->getUserIds();


?>