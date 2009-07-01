<?php 
require_once("MDB2.php");


function __autoload($class_name) {
    require_once $class_name . '.php';
}

require_once("db.php");


$testplayer = new Player(0);


echo $testplayer->get("name");
$testplayer->set("ap", 15);
echo $testplayer->get("ap");

function dbug($text) {

	if (!($fh = fopen("debug.log", "a"))) {
		die("can't open file");
	}
	fwrite($fh, date("d.m.Y [H:i:s] ").$text."\n");
	fclose($fh);


}


?>

