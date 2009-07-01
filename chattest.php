<?php
// CHAT TEST
// to make a chat, include chat.js and create a chatform form, a chatarea div, and a chatbox input. That's all.
if (!isset($theVariableFromIndex)) {
	die("please go through index.php like a nice boy");
}

require_once("EAheader.php");
?><script src="chat.js"></script>
<form id="chatform">
<div id="chatarea"></div>


<input name="ja" type=text id="chatbox">

</form>

