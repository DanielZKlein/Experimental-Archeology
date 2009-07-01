<?php 
function __autoload($class_name) {
    require_once $class_name . '.php';
}

require_once("db.php");

$login = $_POST["login"];
$pw = $_POST["pw"];

$gs = new Gamestate(1); // hardcoded until we do proper login etc




if ($login == "" || $pw == "" || !$gs->loginUser($login, $pw)) {

	require("login.php");
	die();
} 
?>

<html><head><title>Experimental Archeology</title>
<link rel=stylesheet href="style.css" type="text/css">
<link type="text/css" href="css/mint-choc/jquery-ui-1.7.1.custom.css" rel="stylesheet" />	
<link type="text/css" href="css/jquery.contextMenu.css" rel="stylesheet" />	
<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.7.1.custom.min.js"></script>
<script type="text/javascript" src="js/jquery.contextMenu.js"></script>
<script src="gui.js"></script>
<script>
myLogin = "<?=$login?>";
myPW = "<?=$pw?>";
</script>
</head>
<body oncontextmenu="return false;">
<div id="mapcontainer">
</div>
<table id="controlltable"><tr>
<td><h3>User Stuff</h3><br>
Logged in as user <span id="user"></span><br>
<a href="EA.php">Logout</a>
</td><td><h3>Character Stuff</h3><br>
Playing as character <span id="char"></span>.<br>
You have $<span id="dollar"></span> and <span id="ap"></span> Action Points.<br>
You are in <span id="curcity"></span>.<br>
<input type=button value="End Round!" id="endroundbutton" />
</td><td>
<h3>Helper</h3>
You have commands available to you in the following cities:<br>
<div id="comavailable"></div>
</td><td>
<h3>Game Stuff</h3>
We are in round number <span id="round"></span> and <span id="curchar"></span>, played by <span id="curplayer"></span>, is playing.<br>
<!--<input type=button value="Reset everything" id="resetbutton" /><br />-->
</td>
</tr>
<tr><td colspan=2><h3>Cards</h3>
<div id="carddiv"></div>
</td>
<td></td><td></td>
</tr>
</table>

<br><br><br>DEBUG STUFF

<div id="coords"></div>
<div id="tempdiv"></div>
</body></html>
