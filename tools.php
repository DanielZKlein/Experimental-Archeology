<?php

function dbug($text, $showbt = false) {

	if ($showbt) {
		ob_start();
		var_dump(debug_backtrace());
		$bt = ob_get_contents();
		ob_end_clean();
	}
	if (!($fh = fopen("debug.log", "a"))) {
		die("can't open file");
	}
	fwrite($fh, date("d.m.Y [H:i:s] ").$text."\n");
	if ($showbt) {
		fwrite($fh, $bt."\n\n");
	}
	fclose($fh);
}

function array_dump($array) {

	ob_start();
	var_dump($array);
	$rv = ob_get_contents();
	ob_end_clean();
	return $rv;
}

function apostrofuck($text) {

	// Fucks apostrophes. For great sanity!
	
	return preg_replace('/\'/', "&#39;", $text);

}

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



	?>

