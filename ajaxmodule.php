<?php
/*  This is a template only class to derive ajax modules from.
	Stuff that I want these classes to handle:
	* Inclusion of appropriate .js file(s)
	... UHM actually not quite sure I'll need this at all
	
	Yes we do. Let's put the crc caching in here because it's sexeh
	Also firstcall handling weeeee
	
	
*/


class Ajaxmodule {

	protected $cacheTableName; // this is black magic. Look, a weather balloon!
	protected $firstCall = false; // is this the first ajax call to this function? Must be tracked 
								 // through JS
	protected $sys; // copy of the system object for ease of use. TODO: is this a performance bottleneck?
	protected $execSuffixes = array("Refresh" => "printStatus");
	
	function __construct() {
	
		global $sys;
		$this->sys = $sys;
		$this->cacheTableName = get_class($this)."cachetable";
		$ct = $this->cacheTableName;
		execSql("CREATE TABLE IF NOT EXISTS $ct (identifier varchar(64), userid int, crc int)");
		$fcvar = get_class($this)."firstcall";
		$fc = fetchVar($fcvar);
		if ($fc != "") {
			$this->firstCall = true;
		}
	
	}
	
	function output($identifier, $text) {
	
		$newcrc = crc32($text);
		$ui = $this->sys->userId;
		$ct = $this->cacheTableName;
		$oldcrc = getOneThing("crc", $ct, "userid = $ui and identifier = '$identifier'");
		// Okay, so what do we do now? 
		// If oldcrc is the empty string, this userid/identifier combo did not have a crc registered yet
		// Insert it. Output the string.
		// If oldcrc != newcrc, the crc has changed.
		// Update it. Output the string.
		// If oldcrc == newcrc, nothing changed. However, if this is firstcall, output anyway.
		
		if ($oldcrc == "") {
			execSql("INSERT INTO $ct (userid, identifier, crc) values ($ui, '$identifier', $newcrc)");
			print $text;
		} else if ($oldcrc != $newcrc) {
			execSql("UPDATE $ct set crc=$newcrc where userid=$ui and identifier='$identifier'");
			print $text;
		} else {
			// oldcrc == newcrc
			if ($this->firstCall) {
				print $text;
			}
		}
	}
	
		function doStuff() {
	
		// I thought for like a minute and this is the best name I could come up with.
		// Here's what this function does. 
		// It goes through a list of standard suffixes in $execSuffixes and calls the function
		// whose name is in the value of $execSuffixes["key"]
		
		foreach ($this->execSuffixes as $suffix => $myfunc) {
			$varname = get_class($this).$suffix;
			$var = fetchVar($varname);
			if ($var) {
				eval("\$this->".$myfunc."();"); // oh great satan
			}
		}
	
	}
}

?>