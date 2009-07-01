<?php

// CHAT AJAX 
if (!isset($theVariableFromIndex)) {
	die("please go through index.php like a nice boy");
}

$chatid = fetchVar("chatid");
$chat = new Chatmodule($chatid);

if (!$chat->isMember($sys->user)) {
	dbug("THIS USER IS NOT A MEMBER OF THIS CHAT!");
	die();
}

$chatrefresh = fetchVar("ChatRefresh");
$chatline = fetchVar("chatline");

if ($chatrefresh == "x") {
	$lastline = fetchVar("chatlast");
	$chat->printRefresh($lastline);
} 

if ($chatline != "") {
	$chat->addLine($chatline, $sys->user);
}

?>