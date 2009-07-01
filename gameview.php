<?php 
if (!isset($theVariableFromIndex)) {
	die("please go through index.php like a nice boy");
}
// we get $sys from index

$gameid = $sys->user->get("gameid"); // somewhat awkward, but the best short term solution I can think of. Ideally it'd be part of curpage, but I don't wanna.

$gs = new Gamestate($gameid, $sys);

require_once("EAheader.php");

?>
<script>gameid = <?=$gameid?>;</script>
<script src="gamegui.js"></script>

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
