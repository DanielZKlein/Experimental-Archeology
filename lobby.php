<?php

// LOBBY

// The Lobby is the place where you see what games you are in, go to a game screen, join a running game, or choose to create a new game.

// HEADER

// Subheader: Games you're currently in
// As last item: CREATE A NEW GAME --> goes to createnew.php

// Subheader: Other games currently being set up (CUR/MAX). <JOIN GAME>

// Subheader: Other games currently running
// List other games

// CHAT

?>
<div id="lobbywrapper">
<link rel="stylesheet" href="lobby.css" type="text/css">

<h1>LZ 129 Hindenburg -- Lounge (a.k.a. The Lobby)</h1>
<br>
<h2>You currently have characters playing in the following games:</h2>
<div id="curplayingin"></div>
<br>
<h2>These games are currently being set up.</h2>
<div id="curbeingsetup"></div>
<br>
<h2>These games are currently being played, but they don't like you.</h2>
<div id="othersplaying"></div>
<br>
</div>
<script>
ajaxOpts["chatid"] = 0;
</script>
<?php
require_once("chattemplate.php");
require_once("userlisttemplate.php");
?>
