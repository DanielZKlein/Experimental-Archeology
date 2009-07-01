<?php
require_once("MDB2.php");
require_once("tools.php");
$url = "mysql://root@localhost/ea";
$con = MDB2::factory($url);

if (PEAR::isError($con)) {
	die("Error while connecting: ".$con->getMessage());
}

// BEGIN DATABASE HELPER FUNCTIONS


function getRow($row, $table, $query) {

	$r = getResult("select ".$row." from ".$table." where ".$query);
	$rv = array();
	while ($item = $r->fetchRow(MDB2_FETCHMODE_ASSOC)) {
	
		$rv[] = $item[$row];
	
	}
	
	return $rv;

}

function getOneThing($thing, $table, $conditions) {

	$r = getFirstRow("select ".$thing." from ".$table. " where ".$conditions);
	return $r[$thing];

}

function getFirstRow($query) {

	$r = getResult($query);
	$row = $r->fetchRow(MDB2_FETCHMODE_ASSOC);
	return $row;

}

function stateFromData($table) {
	// I foresee a need for this function in all kinds of contexts. Here's what I'm getting at:
	// you have a table gamedata_cards. This table holds all cards in the game
	// you want a table character1_deck. This table holds all the cards character 1 has in his deck
	// right now. In order to create the second table, we want to:
	// 1) replicate the original table: create table $targettable like $sourcetable;
	// 2) add rows from the original table
	// --> see ubertable.php


}

function dumpTableIntoJavascript($table, $jsarray, $additionalstring="") {

	$results = getResult("select * from ".$table);

	$i = 0;
	$output = $jsarray." = [];\n";

	while($row = $results->fetchRow(MDB2_FETCHMODE_ASSOC)) {
		$output .= $jsarray."[".$i."] = { ";
		foreach($row as $field => $value) {
			if (!((string)intval($value) === $value)) {
				$output .= $field.' : "'.$value.'", ';
			} else {
				$output .= $field.' : '.$value.', ';
			}
		}
		$output .= $additionalstring;
		$output = trim($output, ", ")."};\n";
		$i++;
	}

	return $output;


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
// END DATABASE HELPER FUNCTIONS

function dbug($text) {

	if (!($fh = fopen("debug.log", "a"))) {
		die("can't open file");
	}
	fwrite($fh, date("d.m.Y [H:i:s] ").$text."\n");
	fclose($fh);


}


?>