<?php

// USER AJAX

// This is to refresh the userlist. I'm not sure if it'll ever need anything else than refreshes, 
// but I still want it to be its own file

// Is called from index.php when there's a userajax post variable
// Actually, so	

dbug("user ajax");
$chatid = fetchVar("chatid");
$um = new Userlist($chatid);
$refresh = fetchVar("UserRefresh");

if ($refresh != "") {
	dbug("refreshing");
	$um->printStatus();
}

