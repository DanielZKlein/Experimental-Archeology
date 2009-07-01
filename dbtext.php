<?php
require_once("MDB2.php");

$url = "mysql://root@localhost/ea";
$con = MDB2::factory($url);

if (PEAR::isError($con)) {
	die("Error while connecting: ".$con->getMessage());
}

function replicateTable($sourcetable, $targettable, $colTransforms, $newColsWithDefaults) {


}


?>