<?php 

// USER LIST

// Creates a div with a list of users, colour-coded for last activity.
// Online: has last sent a ping less than five minutes ago.
// Away: has sent last ping between 6 minutes and an hour ago.
// Offline: has sent last ping more than an hour ago.
// Additionally, hovering over a user gives timestamp of last ping
require_once("EAheader.php");
?>
<script src="userlist.js"></script>
<link rel="stylesheet" href="userlist.css" type="text/css">

<div id="users">
</div>
