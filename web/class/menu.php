<?php
class menu extends model{
    
	protected $class_name = "menu";
   protected $id;
   protected $name;
   protected $type_link;
   protected $link;
   protected $description;
   protected $icon;
   protected $root_id;
   protected $level;
   protected $type;
   protected $open_page;
   protected $priority;
   protected $is_hidden;
   protected $delete;
   protected $shop_id;
   protected $theme_id;
   protected $avatar;
   protected $background;
   protected $type_cat;
   protected $type_value;

	public function list_menu(){
		global $db;

		$sql = "SELECT *
					FROM $db->tbl_fix$this->class_name 
					WHERE `is_hidden` = '0' 
					AND `delete` = '0'
				";

		$result = $db->executeQuery($sql);
		$kq = array();
		while($row = mysqli_fetch_assoc( $result )){
			$this->set('root_id', $row['id']);
			$sub_list = $this->list_by_root();
			if(COUNT($sub_list) > 0){
				$row['root_menu'] = $this->list_sub();
			}else{
				$row['root_menu'] = [];
			}
			$kq[] = $row;
		}
		return $kq;
	} 

	public function list_sub(){
		global $db;

		$root_id = $this->get('root_id');

		$sql = "SELECT *
					FROM $db->tbl_fix$this->class_name 
					WHERE `is_hidden` = '0' 
					AND `delete` = '0'
					AND `root_id` = '$root_id'
				";
		$result = $db->executeQuery($sql);
		$kq = array();
		while($row = mysqli_fetch_assoc( $result )){
			$this->set('root_id', $row['id']);
			$sub_list = $this->list_by_root();
			if(COUNT($sub_list) > 0){
				$row['root_menu'] = $this->list_sub();
			}else{
				$row['root_menu'] = [];
			}
			$kq[] = $row;
		}
		return $kq;
	}

	public function list_by_root(){
		global $db;

		$root_id = $this->get('root_id');

		$sql = "SELECT *
					FROM $db->tbl_fix$this->class_name
					WHERE `is_hidden` = '0'
					AND `delete` = '0'
					AND `root_id` = '$root_id'
				";

		$rsl = $db->executeQuery($sql);
		$kq = array();
		while($row = mysqli_fetch_assoc( $rsl )){
			$kq[] = $row;
		}
		return $kq;
	}
} 