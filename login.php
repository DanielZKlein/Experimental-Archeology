	<!--LOGIN SCREEN-->
	<html><head><title>EA -- Login</title></head>
	<body>
	<h2>Welcome to Experimental Archeology, archeologist!</h2>
	<br><br>
	<?php
	if ($login != "" && $pw != "") {
		?>
		<span style="color: red; text-weight: bold;">BAD LOGIN. Try again.</span>
		<?php
	} else if ($login !="" && $pw == "") {
		?>
		<span style="color: red; text-weight: bold;">NO PASSWORD PROVIDED. Try again.</span>
		<?php
	} else {
?>

	Please provide our mainframe with your login information.
	<?php

	}
	?><br><br>
	<form action="index.php" method="post">
	<table><tr><td>
	Login: </td><td><input type=text name="login"></td></tr>
	<tr><td>Password: </td><td><input type=text name="pw"></td></tr>
	<tr><td colspan=2 align=right><input type=submit></td></tr></table>
	</form><br><br>
	<hr>
	Also, register etc.
	