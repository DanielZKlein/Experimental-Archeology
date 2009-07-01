<?php
function __autoload($class_name) {
    require_once $class_name . '.php';
}
// HERE'S my current thinking on how AJAX calls should work (so as to get by with one ticking heart per client, no matter how many ajaxie phps it'll need).
// There are certain IDENTIFYING PARAMETERS for the different ajax php scripts. For instance:
// if the ajax call has a chatid, chatajax.php is called
// if the ajax call has a gameid, gameajax.php is called
// For now this will be hardcoded. Eventually we'll have a table linking ajax parameters to php files. 
// EACH AJAX PHP SCRIPT will then run through and generate output (or buffer it somewhere first?).

require_once("db.php");
//dbug("NEW INDEX------------------------------------");

function fetchVar($varname) {
	// fetches var from either POST or GET. GET overwrites POST

	if (isset($_GET[$varname])) {
		return $_GET[$varname];
	} 
	if (isset($_POST[$varname])) {
		return $_POST[$varname];
	}
	return "";
}

function getLogin() {
	// for now just looking in post/get variables. Eventually include cookies, sessions?
	return fetchVar("login");
}

function getPw() {
	// for now just looking in post/get variables. Eventually include cookies, sessions?
	return fetchVar("pw");
}


$login = getLogin();
$pw = getPw();
$sys = new Gamesys();
$ajax = fetchVar("ajax");

// LOGIN FORK
if (true) {
	$login = "daniel"; 
	$pw = "gehirn";
}
	
if ($login == "" || $pw == "" || !$sys->loginUser($login, $pw)) {

	if ($ajax != "") {
		// ajax call without login/pw? Fishy.
		die("ERROR: no login/pw given or login/pw bad");
	}
	require_once("login.php");
	die();
}


$theVariableFromIndex = "poopsie";
// ^^ for both construction and ajax to nip naive attack in the bud. Or the butt. Depending.

// **
//AJAX / CONSTRUCTION FORK
// **

if ($ajax == "") {
	dbug("CONSTRUCTION");
	// CONSTRUCTION CALL. See if we're going somewhere, then serve up the current page.
	$goto = fetchVar("gotopage");
	if ($goto != "") {
		$sys->user->gotoPage($goto);
	}
	
	$showpage = $sys->getPage();
	require_once("show.php"); // build whatever page the user is looking at
	die(); // the rest of this file is ajax calls. A normal construction call should never get there
	
}

// AJAX CALL! Find out what ajax script we need to call (can be many) and call them one after the other
dbug("AJAX CALL! Post is ".array_dump($_POST));

// CHAT
$chat = fetchVar("chatajax");
if ($chat != "") {
	// CHAT CALLED
	require_once("chatajax.php");
}

// GAME
$game = fetchVar("gameajax");
if ($game != "") {
	// GAME CALLED
	require_once("gameajax.php");
}

// USERLIST
$user = fetchVar("userajax");
if ($user != "") {
	// USERLIST MODULE CALLED
	require_once("userajax.php");
}

?>
