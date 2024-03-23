<?php
class position extends model
{
	protected $class_name = 'position';
	protected $id; // id chức vụ
	protected $name; // Tên chức vụ

	// Thêm chức vụ mới
	public function add()
	{
		global $db;

		$arr['name']			= $this->get('name');


		$db->record_insert($db->tbl_fix . $this->class_name, $arr);

		return $db->mysqli_insert_id();
	}

	// Cập nhật chức vụ
	public function update()
	{
		global $db;

		$id                           = $this->get('id');
		$arr['name']                  = $this->get('name');

		$db->record_update($db->tbl_fix . $this->class_name, $arr, " `id` = '$id' ");

		return true;
	}

	public function filter($keyword, $offset, $limit){
		global $db;

		if($limit != ''){
			 $limit = " LIMIT $offset, $limit";
		}

		if($keyword !=''){
			$keyword = " AND ( `name` LIKE '%$keyword%' )";
		}

		$sql = "SELECT * 
				FROM $db->tbl_fix$this->class_name
		";

		$result = $db->executeQuery($sql);
		$kq = array();
		while ($row = mysqli_fetch_assoc($result)) {
			$kq[] = $row;
		}
		return $kq;
	}
}
