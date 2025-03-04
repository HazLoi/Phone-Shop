<?php
class permission extends model
{
	protected $class_name = 'permission';
	protected $id; // id của menu
	protected $root; // id menu cha
	protected $title; // tiêu đề
	/**
	 * - Đầu tiên là m.act (a) của trang menu cha đó viết liền
	 *	- Kế là m.act (b) quyền của trang menu con đó
	 *	VD: 
	 *	- Đầu tiên mà menu cho "CEO - điều hành" = ":ceoindex:"
	 *	- Trong đó có "Chi nhánh" = ":ceoshop:"
	 *	+ Chức năng: ":ceo_shopidx:ceo_shopadd:..."
	 *	=> :ceoindex:ceoshop:ceo_shopidx:ceo_shopadd:....
	 */
	protected $permission;
	protected $list_permission; // Quên rồi để xem lại
	protected $is_hidden; // !=0 là ẩn 
	protected $is_menu; // =0 là phân quyền, !=0 là menu
	protected $m; // ?m=...&act=... link domain => m
	protected $act; // ?m=...&act=... link domain => act
	protected $link; // ?m=...&act=...
	protected $icon; // icon của menu
	protected $priority; // mức độ ưu tiên
	protected $description; // mô tả cho menu

	// thêm
	public function add()
	{
		global $db;

		$arr['group'] 				= $this->get('group');
		$arr['root'] 				= $this->get('root');
		$arr['title'] 				= $this->get('title');
		$arr['permission'] 		= $this->get('permission');
		$arr['list_permission']	= $this->get('list_permission');
		$arr['is_hidden'] 		= $this->get('is_hidden');
		$arr['is_menu'] 			= $this->get('is_menu');
		$arr['m'] 					= $this->get('m');
		$arr['act'] 				= $this->get('act');
		$arr['link'] 				= $this->get('link');
		$arr['icon'] 				= $this->get('icon');
		$arr['priority'] 			= $this->get('priority');
		$arr['description'] 		= $this->get('description');

		$db->record_insert($db->tbl_fix . $this->class_name, $arr);

		$id = $db->mysqli_insert_id();

		return $id;
	}

	// cập nhật
	public function update($id_key)
	{
		global $db;

		$arr['id']					= $this->get('id');
		$arr['group'] 				= $this->get('group');
		$arr['root'] 				= $this->get('root');
		$arr['title'] 				= $this->get('title');
		$arr['permission'] 		= $this->get('permission');
		$arr['list_permission']	= $this->get('list_permission');
		$arr['is_hidden'] 		= $this->get('is_hidden');
		$arr['is_menu'] 			= $this->get('is_menu');
		$arr['m'] 					= $this->get('m');
		$arr['act'] 				= $this->get('act');
		$arr['link'] 				= $this->get('link');
		$arr['icon'] 				= $this->get('icon');
		$arr['priority'] 			= $this->get('priority');
		$arr['description'] 		= $this->get('description');

		$db->record_update($db->tbl_fix . $this->class_name, $arr, " `id` = '$id_key' ");

		return true;
	}

	// xóa
	public function delete()
	{
		global $db;

		$id = $this->get('id');
		$db->record_delete($db->tbl_fix . $this->class_name, " `id` = '$id' ");

		return true;
	}

	// lọc dữ liệu lấy danh sách quyền
	public function get_detail()
	{
		global $db;

		$id = $this->get('id');

		$sql = "SELECT * 
			FROM $db->tbl_fix`$this->class_name` 
			WHERE `id` = '$id'
			";

		$result = $db->executeQuery($sql, 1);

		return $result;
	}

	// lọc dữ liệu lấy danh sách quyền
	public function filter($keyword = '', $type = '', $field = '', $sort = 'DESC', $offset = '', $limit = '')
	{
		global $db;

		$sql_keyword = '';
		if ($keyword != '') {
			if (in_array($type, ['id', 'root'])) {
				$sql_keyword = " AND `$type` = '$keyword' ";
			} else if (in_array($type, ['title', 'permission', 'icon'])) {
				$sql_keyword = " AND `$type` LIKE '%$keyword%' ";
			}
		}

		$sql_limit = '';
		if ($limit != '') {
			$sql_limit = " LIMIT $offset, $limit ";
		}

		$sql_order_by = " ORDER BY `id` DESC";
		if ($field != '') {
			$sql_order_by = " ORDER BY $field $sort ";
		}

		$sql = "SELECT * 
			FROM $db->tbl_fix`$this->class_name` 
			WHERE 1
			$sql_keyword
			$sql_order_by
			$sql_limit
			";

		$result = $db->executeQuery_list($sql);

		return $result;
	}

	// đếm bộ lọc dữ liệu lấy danh sách quyền
	public function filter_count($keyword = '', $type = '')
	{
		global $db;

		$sql_keyword = '';
		if ($keyword != '') {
			if (in_array($type, ['id', 'root'])) {
				$sql_keyword = " AND `$type` = '$keyword' ";
			} else if (in_array($type, ['title', 'permission', 'icon'])) {
				$sql_keyword = " AND `$type` LIKE '%$keyword%' ";
			}
		}

		$sql = "SELECT COUNT(*) total_record 
			FROM $db->tbl_fix`$this->class_name` 
			WHERE 1
			$sql_keyword
			";

		$result = $db->executeQuery($sql, 1);

		$data = array();
		$data['total_record'] = isset($result['total_record']) ? $result['total_record'] : 0;

		return $data;
	}

	// lấy ra toàn bộ tên bảng có trong database
	public function get_all_table_name_in_database()
	{
		global $db;

		$sql = "SHOW TABLES";

		$result = $db->executeQuery_list($sql);
		// lọc qua danh sách lấy ra mảng
		$data = array();
		foreach ($result as $item) {
			foreach ($item as $value) {
				$data[] = $value;
			}
		}
		return $data;
	}

	// lấy ra toàn bộ cột có trong bảng
	public function get_all_columns_in_table($table_name)
	{
		global $db;

		$sql = "SHOW COLUMNS FROM $db->tbl_fix`$table_name`";

		$result = $db->executeQuery_list($sql);
		// lọc qua danh sách lấy ra mảng
		$data = array();
		$data['list_columns'] = array();
		$data['compare'] = array();
		foreach ($result as $item) {
			$data['list_columns'][] = $item['Field'];
			$data['compare'][$item['Field']] = $item;
		}

		return $data;
	}

	// lấy ra toàn bộ cột có trong bảng
	public function filter_by_table_name($table_name, $keyword, $type_keyword, $field, $sort, $offset, $limit)
	{
		global $db;

		$sql_keyword = '';
		if ($type_keyword != '' && $keyword != '') {
			$sql_keyword = " AND $type_keyword LIKE '%$keyword%' ";
		}

		$sql_order_by = '';
		if ($field != '') {
			if ($sort == '') $sort = 'DESC';
			$sql_order_by = " ORDER BY $field $sort ";
		}

		$sql_limit = '';
		if ($limit != '') {
			$sql_limit = " LIMIT $offset, $limit ";
		}

		$sql = "SELECT * 
			FROM $db->tbl_fix`$table_name` 
			WHERE 1
			$sql_keyword
			$sql_order_by
			$sql_limit
			";
		// echo $sql;die;
		$data = $db->executeQuery_list($sql);

		return $data;
	}

	// đếm
	public function filter_count_by_table_name($table_name, $keyword, $type_keyword)
	{
		global $db;

		$sql_keyword = '';
		if ($type_keyword != '' && $keyword != '') {
			$sql_keyword = " AND $type_keyword LIKE '%$keyword%' ";
		}

		$sql = "SELECT COUNT(*) total_record
			FROM $db->tbl_fix`$table_name` 
			WHERE 1
			$sql_keyword
			";

		$result = $db->executeQuery($sql, 1);

		$data = array();
		$data['total_record'] = isset($result['total_record']) ? $result['total_record'] : 0;

		return $data;
	}

	// viết hàm kiểm tra 2 bảng A - B => lấy ra câu lệnh insert cho bảng B những cột mà không có trong bảng A
	public function generate_alter_table($tableA, $tableB)
	{
		global $db;
		// Lấy danh sách cột của bảng A và B
		$columnsA = $this->get_all_columns_in_table($tableA)['compare'];
		$columnsB = $this->get_all_columns_in_table($tableB)['compare'];
		// Kiểm tra và tạo câu ALTER TABLE nếu bảng A có cột mà B không có
		$sql = [];
		foreach ($columnsA as $column_name => $column_details) {
			if (!array_key_exists($column_name, $columnsB)) {
				// Tạo câu ALTER TABLE dựa trên chi tiết cột từ bảng A
				$temp = $column_details['Type'];
				if ($column_details['Null'] === 'NO') {
					$temp .= " NOT NULL";
				}
				if ($column_details['Default'] !== null) {
					$temp .= " DEFAULT '{$column_details['Default']}'";
				}
				if ($column_details['Extra']) {
					$temp .= " {$column_details['Extra']}";
				}

				$sql[] = "ALTER TABLE `$tableB` ADD COLUMN `$column_name` $temp;";
			}
		}
		// Trả về kết quả
		if (empty($sql)) {
			return "Bảng '$tableB' đã có đầy đủ các cột giống bảng '$tableA'";
		} else {
			return implode("\n", $sql);
		}
	}

	// thêm 1 dòng dữ liệu với tên bảng
	public function add_rows_table($table_name, $list_columns_name, $array_add)
	{
		global $db;

		// lọc qua mảng để lưu mảng cập nhật dữ liệu
		foreach ($list_columns_name as $column) {
			$arr[$column] = $array_add[$column];
		}

		$db->record_insert($db->tbl_fix . $table_name, $arr);

		return true;
	}

	// cập nhật 1 dòng dữ liệu với id_key và tên bảng
	public function update_rows_table($table_name, $list_columns_name, $array_update, $column_key, $id_key)
	{
		global $db;

		// lọc qua mảng để lưu mảng cập nhật dữ liệu
		foreach ($list_columns_name as $column) {
			$arr[$column] = $array_update[$column];
		}

		$db->record_update($db->tbl_fix . $table_name, $arr, " `$column_key` = '$id_key' ");

		return true;
	}

	// xóa 1 dòng dữ liệu bằng id_key và column_key + table_name
	public function delete_rows_table($table_name, $column_key, $id_key)
	{
		global $db;

		$db->record_delete($db->tbl_fix . $table_name, " `$column_key` = '$id_key' ");

		return true;
	}

	// Lấy danh sách menu phân quyền cha
	public function list_menu_permission_parents()
	{
		global $db;

		$sql = "SELECT *
					FROM $db->tbl_fix`$this->class_name`
					WHERE `is_hidden` = 0
					AND `is_menu` = 0
					AND `root` = 0
					AND `permission` = ''
					ORDER BY `priority`
				";

		$result = $db->executeQuery_list($sql);

		return $result;
	}

	// Lấy danh sách menu phân quyền con
	public function list_menu_permission_child($id)
	{
		global $db;

		$sql = "SELECT *
				FROM $db->tbl_fix`$this->class_name`
				WHERE `is_hidden` = 0
				AND `is_menu` = 0
				AND `root` = '$id'
				AND `permission` = ''
				ORDER BY `priority`
			";

		$result = $db->executeQuery($sql);

		$kq = array();
		while ($row = mysqli_fetch_assoc($result)) {
			// lấy ra danh sách menu cấp dưới nếu còn
			$row['list_menu_child'] = [];
			$list_menu_permission_child = $this->list_menu_permission_child($row['id']);
			if (isset($list_menu_permission_child) && count($list_menu_permission_child) > 0) {
				$row['list_menu_child'] = $list_menu_permission_child;
			}

			// lấy danh sách phân quyền của những menu child này
			$row['list_permission'] = [];
			$list_menu_permission = $this->list_menu_permission($row['id']);
			if (isset($list_menu_permission) && count($list_menu_permission) > 0) {
				$row['list_permission'] = $list_menu_permission;
			}

			$kq[] = $row;
		}

		return $kq;
	}

	// Lấy danh sách phân quyền của menu
	public function list_menu_permission($id)
	{
		global $db;

		$sql = "SELECT *
				FROM $db->tbl_fix`$this->class_name`
				WHERE `is_hidden` = 0
				AND `is_menu` = 0
				AND `root` = '$id'
				AND `permission` != ''
				ORDER BY `priority`
			";

		$result = $db->executeQuery_list($sql);

		return $result;
	}

	// hàm lấy ra tất cả phân quyền trong danh sách menu phân quyền con
	public function get_permission_menu($list, $data = [])
	{
		foreach ($list as $item_menu) {
			if (count($item_menu['list_permission']) > 0) {
				foreach ($item_menu['list_permission'] as $item_permission) {
					if (isset($item_permission['permission']) && $item_permission['permission'] != '') {
						$data[] = $item_permission['permission'];
					}
				}
				if (count($item_menu['list_menu_child']) > 0) {
					$data = $this->get_permission_menu($item_menu['list_menu_child'], $data);
				}
			}
		}

		return $data;
	}

	//Load menu to show
	public function menu_load($is_hidden)
	{
		global $db;

		$sqlHidden = '';
		if ($is_hidden != '') {
			$sqlHidden = " AND `is_hidden` = '$is_hidden' ";
		}

		//Mục bán hàng
		$sql = "SELECT `id`, `title`, `is_hidden`, `link`, `m`, `act`, `root`, `icon` FROM $db->tbl_fix`permission`
				WHERE `root` = '0'
				$sqlHidden
				AND `is_menu` = '1'
				ORDER BY `priority` ASC
				";

		$r = $db->executeQuery($sql);
		$arr = array();
		while ($row = mysqli_fetch_assoc($r)) {
			$row['subItems'] = $this->menu_load_sub($row['id'], $is_hidden);
			$arr[] = $row;
		}
		return $arr;
	}


	public function menu_load_sub($root_id, $is_hidden)
	{
		global $db;

		$sqlHidden = '';
		if ($is_hidden != '') {
			$sqlHidden = " AND `is_hidden` = '$is_hidden' ";
		}

		//Mục bán hàng
		$sql = "SELECT `id`, `root`, `title`, `is_hidden`, `m`, `act`, `url_domain`, `icon` FROM $db->tbl_fix`permission`
				WHERE `root` = '$root_id'
				$sqlHidden
				AND `is_menu` = '1'
				ORDER BY `priority` 
				";

		$r = $db->executeQuery($sql);

		$arr = array();
		while ($row = mysqli_fetch_assoc($r)) {
			$row['subItems'] = $this->menu_load_sub($row['id'], $is_hidden);
			$arr[] 			 = $row;
		}

		return $arr;
	}

	// update thông tin menu
	public function menu_update($lIDs, $is_hidden)
	{
		global $db;

		$sqlIDs = '';
		$lIDs = explode(';', $lIDs);
		if (COUNT($lIDs) > 0) {
			foreach ($lIDs as $ite) {
				if ($ite != '') {
					$sqlIDs .= " `id` = '$ite' OR ";
				}
			}

			if ($sqlIDs != '') {
				$sqlIDs = "(" . substr($sqlIDs, 0, -3) . ") AND (`is_menu` = 1 OR `is_menu` = 2)";
				$arr['is_hidden'] = $is_hidden;
				$db->record_update("$db->tbl_fix`permission`", $arr, $sqlIDs);

				//List toàn bộ danh sách quyền con và ẩn theo luôn
				$sql = "SELECT `list_permission` FROM $db->tbl_fix`permission`
						WHERE $sqlIDs ";
				$lPer = $db->executeQuery_list($sql);
				$sqlPers = '';
				foreach ($lPer as $item) {
					$lPerArr = explode(';', $item['list_permission']);
					foreach ($lPerArr as $itePer) {
						if ($itePer != '') {
							$sqlPers .= " `id` = '$itePer' OR ";
						}
					}
				}

				if ($sqlPers != '') {
					$sqlPers = "(" . substr($sqlPers, 0, -3) . ") AND `is_menu` = 0";
					$arr['is_hidden'] = $is_hidden;
					$db->record_update("$db->tbl_fix`permission`", $arr, $sqlPers);
				}
			}
		}

		return true;
	}
}
