<?php
class Character {

	public $id = 0;
	public $name = "";

	function __construct($id) {

		$name = getOneThing("name", "gamestate_characters", "id=".$id);
		$this->id = $id;
		$this->name = $name;
	
	}
	
	function get($thing) {

		return getOneThing($thing, "gamestate_characters", "id=".$this->id);
	
	}
	
	function set($thing, $value) {
	
		execSql("update gamestate_characters set ".$thing."=".$value." where id=".$this->id);
	
	}

}
?>