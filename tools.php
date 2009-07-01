<?php
function array_concat() {
	$vars = func_get_args();
    $array = array();
    foreach ($vars as $var) {
		if (is_array($var)) {
			foreach ($var as $val) {$array[] = $val;}
		} else {
			$array[] = $var;
		}
    }
    return $array;
	}

function array_dump($array) {

	$rv = "{ ";
	$firstrun = true;
	foreach ($array as $key => $value) {
		if (!$firstrun) {
			$rv .= ", ";
		} else {
			$firstrun = false;
		}
		
		$rv .= $key." : ";
		if (is_array($value)) {
			$rv .= array_dump($value);
		} else {
			$rv .= $value;
		}
	}
	$rv .= " }";
	return $rv;	
}
	?>

