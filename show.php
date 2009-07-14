<?php

/* 	SHOW.PHP
	This file is called whenever a complete page is built for display on the browser.
	
*/

if (!isset($theVariableFromIndex)) {
	die("please go through index.php like a nice boy");
}

require_once("EAheader.php");
?>
<input type=button value="Stop AJAX refreshes" id="stopajaxbutton">
<input type=button value="Test button" id="testbutton">
<?php
require_once($showpage);
?>
