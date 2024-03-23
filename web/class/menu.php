<?php
class menu extends model
{

	protected $class_name = "menu";
	protected $id; // id của menu
	protected $name; // tên menu
	protected $link; // link của menu ví dụ: /tin-tuc, /trang-chu, /san-pham
	protected $description; // mô tả của menu
	protected $icon; // icon
	protected $root_id; // id của menu cha
	protected $level; // level của menu ví dụ: 1 là cao nhất là Ông, 2 là Cha, 3 là Cháu
	protected $open_page; // hình như mở trang như: _self, _blank
	protected $priority; // mức độ ưu tiên
	protected $is_hidden; // != 0 là menu ẩn
	protected $delete; // != 0 là menu bị xóa
	protected $shop_id; // menu thuộc shop_id nào
	protected $background; // nền menu

	// Thêm menu mới
	public function add()
	{
		global $db;

		$arr['name']                    = $this->get('name');
		$arr['link']                    = $this->get('link');
		$arr['description']             = $this->get('description');
		$arr['icon']                    = $this->get('icon');
		$arr['background']              = $this->get('background');
		$arr['root_id']                 = $this->get('root_id');
		$arr['level']                   = $this->get('level');
		$arr['open_page']               = $this->get('open_page');
		$arr['priority']                = $this->get('priority');
		$arr['description']             = $this->get('description');
		$arr['is_hidden']               = $this->get('is_hidden') + 0;
		$arr['delete']                  = $this->get('delete') + 0;

		$db->record_insert($db->tbl_fix . $this->class_name, $arr);

		return $db->mysqli_insert_id();
	}

	// Cập nhật menu
	public function update()
	{
		global $db;

		$id                             = $this->get('id');

		$arr['name']                    = $this->get('name');
		$arr['link']                    = $this->get('link');
		$arr['description']             = $this->get('description');
		$arr['icon']                    = $this->get('icon');
		$arr['background']              = $this->get('background');
		$arr['root_id']                 = $this->get('root_id');
		$arr['level']                   = $this->get('level');
		$arr['open_page']               = $this->get('open_page');
		$arr['priority']                = $this->get('priority');
		$arr['description']             = $this->get('description');
		$arr['is_hidden']               = $this->get('is_hidden') + 0;
		$arr['delete']                  = $this->get('delete') + 0;

		$db->record_update($db->tbl_fix . $this->class_name, $arr, " `id` = '$id' ");

		return true;
	}

	// Lấy ra toàn bộ menu
	public function list_menu()
	{
		global $db;

		$sql = "SELECT *
					FROM $db->tbl_fix$this->class_name 
					WHERE `is_hidden` = '0' 
					AND `delete` = '0'
					ORDER BY `priority`
				";

		$result = $db->executeQuery($sql);
		$kq = array();
		while ($row = mysqli_fetch_assoc($result)) {
			$this->set('root_id', $row['id']);
			$sub_list = $this->list_by_root();
			if (COUNT($sub_list) > 0) {
				$row['root_menu'] = $this->list_sub();
			} else {
				$row['root_menu'] = [];
			}
			$kq[] = $row;
		}
		return $kq;
	}

	// Lấy ra những menu từ menu Cha nếu có
	public function list_sub()
	{
		global $db;

		$root_id 	= $this->get('root_id');
		$is_hidden 	= $this->get('is_hidden');

		if ($is_hidden != '') {
			$is_hidden = " AND `is_hidden` = '$is_hidden' ";
		} else {
			$is_hidden = "";
		}

		$sql = "SELECT *
					FROM $db->tbl_fix$this->class_name 
					WHERE `delete` = '0'
					AND `root_id` = '$root_id'
					$is_hidden
				";

		$result = $db->executeQuery($sql);
		$kq = array();
		while ($row = mysqli_fetch_assoc($result)) {
			$this->set('root_id', $row['id']);
			$sub_list = $this->list_by_root();
			if (COUNT($sub_list) > 0) {
				$row['root_menu'] = $this->list_sub();
			} else {
				$row['root_menu'] = [];
			}
			$kq[] = $row;
		}
		return $kq;
	}

	// Lấy ra danh sách menu con thuộc menu Cha nếu có
	public function list_by_root()
	{
		global $db;

		$root_id 		= $this->get('root_id');
		$is_hidden  	= $this->get('is_hidden');

		if ($is_hidden != '') {
			$is_hidden = " AND `is_hidden` = '$is_hidden' ";
		} else {
			$is_hidden = "";
		}

		$sql = "SELECT *
					FROM $db->tbl_fix$this->class_name
					WHERE `delete` = '0'
					AND `root_id` = '$root_id'
					$is_hidden
				";

		$rsl = $db->executeQuery($sql);
		$kq = array();
		while ($row = mysqli_fetch_assoc($rsl)) {
			$kq[] = $row;
		}
		return $kq;
	}

	// tìm menu theo id
	public function get_detail_by_id()
	{
		global $db;

		$id = $this->get('id');

		$sql = "SELECT * FROM $db->tbl_fix`$this->class_name` WHERE `id` = '$id' ";

		$result = $db->executeQuery($sql, 1);

		return $result;
	}

	// Kiểm tra tên menu đã tồn tại chưa
	public function check_exists()
	{
		global $db;

		$name = $this->get('name');

		$sql = "SELECT * FROM $db->tbl_fix`$this->class_name` WHERE `name` = '$name'";

		$result = $db->executeQuery($sql, 1);

		return $result;
	}

	// lọc danh sách menu lấy menu cha
	public function filter($offset, $limit)
	{
		global $db;

		$name     		= $this->get('name');
		$is_hidden    	= $this->get('is_hidden');

		if ($name != '') {
			$name = " AND `name` LIKE '%$name%' ";
		}

		if ($is_hidden != '') {
			$is_hidden = "AND `is_hidden` = '$is_hidden' ";
		} else {
			$is_hidden = '';
		}

		if ($limit != '') {
			$limit = " LIMIT $offset, $limit";
		}

		$sql = "SELECT *
						FROM $db->tbl_fix`$this->class_name`
						WHERE `delete` = 0
						AND 1
						AND `root_id` = 0
						$is_hidden
						$name
						ORDER BY `priority` DESC
						$limit
						";

		$result = $db->executeQuery($sql);
		$kq = array();
		while ($row = mysqli_fetch_assoc($result)) {
			$this->set('root_id', $row['id']);
			$sub_list = $this->list_by_root();
			if (COUNT($sub_list) > 0) {
				$row['root_menu'] = $this->list_sub();
			} else {
				$row['root_menu'] = [];
			}
			$kq[] = $row;
		}
		return $kq;
	}

	// đếm danh sách menu cha
	public function filter_count()
	{
		global $db;

		$name     		= $this->get('name');
		$is_hidden    	= $this->get('is_hidden');

		if ($name != '') {
			$name = " AND ( `name` LIKE '%$name%' ) ";
		}

		if ($is_hidden != '') {
			$is_hidden = " AND `is_hidden` = '$is_hidden' ";
		} else {
			$is_hidden = "";
		}

		$sql = "SELECT count(*) total
						FROM $db->tbl_fix$this->class_name
						WHERE `delete` = 0
						AND 1
						AND `root_id` = 0
						$is_hidden
						$name
						";

		$result = $db->executeQuery($sql, 1);

		return $result['total'] + 0;
	}
}
