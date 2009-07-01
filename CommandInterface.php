<?php
class CommandInterface {

	function __construct() {
		dbug("making new command interface");
	}
	
	function movePlayer($playerId, $targetCity) {
	
		$thisPlayer = new Player($playerId);
		$thisPlayer.set("city", $targetCity);
	
	}


}
?>