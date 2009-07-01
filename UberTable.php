<?php

class UberTable {

	protected $tableName;
	protected $cols;
	protected $colTypes;
	protected $colToType;
	protected $subTable; // currently a string holding the MYSQL name of the subtable. I want to turn it into an object, but that way insanity lies
	// fuck it. Bring the insanity
	
	function __construct($tableName) {
	
		$doIExist = getFirstRow("show tables like '$tableName'");
		if (count($doIExist) < 1) {
			die("UBERTABLE $tableName does not exist");
		}
		$this->tableName = $tableName;
		$this->makeCols();

	}
	
	function getColDef($col) {
	
	// for stupid MySQL
	
		$rv = "";
		$res = getResult("describe $this->tableName");
		while ($row = $res->fetchRow(MDB2_FETCHMODE_ASSOC)) {
			if (strtoupper($row['field']) == strtoupper($col)) {
				$rv .= $row['type'];
				continue;
				if ($row['null'] == "NO") {
					$rv .= " NOT NULL";
				}
				if (stripos($row['extra'], "auto_increment") !== false) {
					$rv .= " AUTO_INCREMENT";
				}
				if ($row['key'] != "") {
					$rv .= " KEY";
				}
			}
		}
		return $rv;
	}
	
	function renameCol($old, $new) {
	
		$def = $this->getColDef($old);
		execSql("ALTER TABLE $this->tableName CHANGE $old $new $def");
	
	}
	
	function makeCols() {
	
		$r = getResult("describe $this->tableName");
		$this->cols = array();
		$this->colTypes = array();
		$this->colToType = array();
		while ($row = $r->fetchRow(MDB2_FETCHMODE_ASSOC)) {
			//print_r($row);
			$this->cols[] = $row['field'];
	
			if ((stripos($row['type'], "text") !== false) || (stripos($row['type'], "varchar") !== false)) {
				$this->colTypes[] = "string";
				$this->colToType[$row['field']] = "string";
			} else {
				$this->colTypes[] = "int";
				$this->colToType[$row['field']] = "int";
			}
		}
	}
	
	function getRowForInsert($id, $colTransforms = array(), $additionals = array()) {
		
		$additionalCols = array();
		$additionalVals = array();
		foreach ($additionals as $additionalCol => $additionalVal) {
		
			$additionalCols[] = $additionalCol;
			$additionalVals[] = $additionalVal;
		
		}
		$colsCopy = $this->cols;
		foreach ($colTransforms as $orig=>$new) {
		
			if (in_array($orig, $colsCopy)) {
			
				$key = array_search($orig, $colsCopy);
				$colsCopy[$key] = $new;
			
			}
		}
		$myCols = array_merge($colsCopy, $additionalCols);
		$insertString = "(".implode(", ", $myCols).") values (";
	
		$row = getFirstRow("select * from $this->tableName where id=$id");
		
		foreach($row as $key=>$value) {		
			if ($this->colToType[$key] == "string") {
				$insertString .= "'$value', ";
			} else {
				$insertString .= "$value, ";
			}
		}
		
		$insertString .= implode(", ", $additionalVals);
		$insertString = trim($insertString, ", ");
		$insertString .= ")";
		return $insertString;
	}
	
	function spawnSubTable($subTableName, $colTransforms, $additionalCols, $additionalVals) {

		// additionalVals is an array of $colName => $value so we can have cols without defaults
		$tempObject = new SubTable($subTableName, $colTransforms, $additionalCols, $this, $additionalVals);
		return $tempObject;
	}

}
	

class SubTable extends UberTable {

	protected $parentTableName;
	protected $transforms; // array of $old -> $new colnames
	protected $inheritedCols; // just those cols that have the same name in the parent table
	protected $additionalColsAndVals; 
	protected $parentTable;
	
	
	
	function __construct($subName, $trans, $cols = array(), $parObj, $vals = array()) {

		// take a note of your parent's name
		$this->parentTableName = $parObj->tableName;
		$this->parentTable = $parObj; // just in case we'll need stuff like the col list at some point
		$this->transforms = $trans;
		$this->additionalColsAndVals = $vals;
		execSql("create table IF NOT EXISTS $subName like $parObj->tableName");

		parent::__construct($subName);

		foreach ($trans as $old=>$new) {
		
			$this->renameCol($old, $new);
		
		}
		
		foreach ($cols as $name=>$type) {
		
			execSql("ALTER TABLE $this->tableName ADD COLUMN $name $type");
		
		}
	}

	function inheritRow($id, $additionals) {
	
		$newAdd = $additionals + $this->additionalColsAndVals;
		$insertString = $this->parentTable->getRowForInsert($id, $this->transforms, $newAdd);
		execSql("INSERT INTO $this->tableName $insertString");
	
	}
}

?>