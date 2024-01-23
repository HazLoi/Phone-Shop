<?php
class setting {
	private $varname;
	private $title;
	private $value;
	private $defaultvalue;
	private $datatype;
	private $group;
	private $priority;
	private $type;
	private $is_hidden;
	private $not_edit;
	
	// set get varname
	public function setvarname($varname) {
		$this->varname = $varname;
	}
	public function getvarname() {
		return $this->varname;
	}
	// set get title
	public function setvalue($value) {
		$this->value = $value;
	}
	public function getvalue() {
		return $this->value;
	}
	// set get group
	public function setgroup($group) {
		$this->group = $group;
	}
	public function getgroup() {
		return $this->group;
	}
	public function update(){
		global $db;
		$arr['value'] = $this->getvalue();
		$db->record_update($db->tbl_fix."setting", $arr,"varname='".$this->getvarname()."'");
	}
	public function listall() {
		Global $db;
		$sql = "SELECT * FROM " . $db->tbl_fix . "`setting` ORDER BY `varname`";
		$result = $db->executeQuery_list( $sql );
		
		return $result;
		
	}
	public function listbygroup() {
		Global $db;
		$sql = "SELECT * FROM `setting` where `group`='".$this->getgroup()."' order by priority";

		$result = $db->executeQuery ( $sql );
		while ( $rows = mysqli_fetch_assoc ( $result ) ) {
			$return [] = $rows;
		}
		return $return;
		
	}
	public function showall(){
		$arr = $this->listall();
		$res = array();
		foreach ($arr as $key => $item) {
			$res[$item['varname']] = $item['value'];
		}
		return $res;
	}
	public function get_by_varname() {
		Global $db;
		$sql = "SELECT * FROM `setting` where `varname`='".$this->getvarname()."'";
		$result = $db->executeQuery ( $sql,1 );
		return $result;
		
	}
}
