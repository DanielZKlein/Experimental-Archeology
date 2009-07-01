<?php
require_once("MDB2.php");
require_once("tools.php");

$url = "mysql://root@localhost/ea";
$con = MDB2::factory($url);

if (PEAR::isError($con)) {
	die("Error while connecting: ".$con->getMessage());
}

function __autoload($class_name) {
    require_once $class_name . '.php';
}

//replicateTable("gamedata_characters", "testing_characters", array("id" => "chartype"), array("playedby" => 0, "gameid" => 1), "id=0 or id=1");


$gdChars = new UberTable("gamedata_characters");
//dbug($gdChars->getRowForInsert(0, array("id"=>"chartype"), array("playedBy"), array(23)));

$newChars = $gdChars->spawnSubTable("temptest_chars", array("id"=>"chartype"), array("playedby" => "int", "gameid" => "int"), array("gameid" => 12));

$newChars->inheritRow(1, array("playedby"=>0));

function replicateTable($sourcetable, $targettable, $colTransforms, $newColsWithDefaults, $originalRowsToSelect) {

	// before we resort to table objects, let's try it naively
	// okay let's set the order of events, and in order to do that, let's think of the most likely scenario in which we'd use this function
	// so let's say it's the beginning of a new round and players choose characters. Let's also assume that characters are unique (only one person at a time can be playing Ohio Jones)
	// so we have a number of players waiting in the lobby. Each of them selects one (or more?) characters. We then:
	// 1) Create the table gamestate_characters
	// 2) Read into the table the rows corresponding to the characters that were chosen ==> MOVED
	// 3) Add a column named playedby and write into this column the ids of the players
	// 4) Technically, that is all we need to do. Since we've decided that characters are unique, we can simply refer to the characters in game by their id. But this is not very sane since we're practically guaranteed non-sequential and gapped ids. So: rename the id column to chartype, add a new column (id int key auto_increment) (remember that mysql standard auto_increment starts at 1 for some gay reason. Either work around that by setting the first entry to 0 manually or just decrease the value of id by one when you grab it), and then insert the rows you want
	// 5) Actually (and why am I still numbering this?) let's split it off. One function 
	// fuck this shit. We'll do it with table objects
	executeSql("drop table if exists $targettable");
	executeSql("create table $targettable like $sourcetable");
	
	

}




// HELPER FUNCTIONS

function getOneThing($thing, $table, $conditions) {

	$r = getFirstRow("select ".$thing." from ".$table. " where ".$conditions);
	return $r[$thing];

}

function getFirstRow($query) {

	$r = getResult($query);
	$row = $r->fetchRow(MDB2_FETCHMODE_ASSOC);
	return $row;

}

function getResult($query) {
	// for multi row queries
	
	global $con;
	//dbug("querying " . $query);
	$r = $con->query($query);
	if (PEAR::isError($r)) {
	
		dbug("MYSQL QUERY ERROR! Query was ".$query." and error is ".$r->getMessage());
		
	}
	return $r;
}

function execSql($sql) {

	global $con;
	//dbug("executing ".$sql);
	$result = $con->exec($sql);
	if (PEAR::isError($result)) {
	
		dbug("MYSQL ERROR with execute ".$sql."! ".$result->getMessage());
	
	}
	
}

function dbug($text) {

	if (!($fh = fopen("debug.log", "a"))) {
		die("can't open file");
	}
	fwrite($fh, date("d.m.Y [H:i:s] ").$text."\n");
	fclose($fh);


}

?>