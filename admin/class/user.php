<?php
class user extends model
{

	protected $class_name = "user";
	protected $id; // < 0 Là tài khoản không hiển thị
	protected $username; // Tên đăng nhập
	protected $fullname; // Đầy đủ họ tên
	protected $password; // Mật khẩu
	protected $salt; // Mã sau password
	protected $position; // Chức vụ
	protected $mobile; // Số điện thoại
	protected $email; // Email của thành viên
	protected $address; // Địa chỉ
	protected $avatar; // Ảnh đại diện
	protected $status; // =0 là không hoạt động, =1 là hoạt động
	protected $permission; // Quyền hạn
	protected $session_token; // Token đăng nhập


	// Thêm menu mới
	public function add()
	{
		global $db;

		$arr['username']					= $this->get('username');
		$arr['fullname']					= $this->get('fullname');

		$arr['password']					= '';
		$arr['salt']						= '';
		if ($this->get('password') != '') {
			$salt = $this->randString();
			$password = md5(md5($this->get('password')) . $salt);
			$arr['password']					= $password;
			$arr['salt']						= $salt;
		}
		$arr['position']					= $this->get('position');
		$arr['mobile']						= $this->get('mobile');
		$arr['email']						= $this->get('email');
		$arr['address']					= $this->get('address');
		$arr['avatar']						= $this->get('avatar');
		$arr['status']						= $this->get('status');
		$arr['permission']				= $this->get('permission');
		$arr['session_token']			= $this->get('session_token');


		$db->record_insert($db->tbl_fix . $this->class_name, $arr);

		return $db->mysqli_insert_id();
	}

	// Cập nhật menu
	public function update()
	{
		global $db;

		$id                           = $this->get('id');
		$arr['fullname']					= $this->get('fullname');
		$arr['position']					= $this->get('position');
		$arr['mobile']						= $this->get('mobile');
		$arr['email']						= $this->get('email');
		$arr['address']					= $this->get('address');
		$arr['status']						= $this->get('status');
		if ($this->get('password') != '') {
			$salt = $this->randString();
			$password = md5(md5($this->get('password')) . $salt);
			$arr['password']					= $password;
			$arr['salt']						= $salt;
		}

		$db->record_update($db->tbl_fix . $this->class_name, $arr, " `id` = '$id' ");

		return true;
	}

	private function randString($length = 10)
	{
		$characters = 'w01s2345arbctvdeffg1hijklm4nop6789qrstuv3wxyz5AB675839CDEFGHIJ627g184g9gKLMfNdOPsQRSTfUVWgXdYsZ';
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, strlen($characters) - 1)];
		}
		return $randomString;
	}

	public function check_login()
	{
		global $db;

		$username = $this->get('username');

		$rows = array();
		$username = str_replace(' ', '_', $username);
		$username = str_replace('#', '_', $username);
		$username = str_replace('/', '_', $username);
		$username = str_replace('\\', '_', $username);

		$sql = "SELECT `user`.*
					FROM $db->tbl_fix`user`
					LEFT JOIN $db->tbl_fix`position` ON position.`id` = user.`position`
					WHERE `username` = '$username' 
					AND `password` = '{$this->get('password')}' 
					AND `status` = '1' 
					limit 0,1
				";
		$rows = $db->executeQuery($sql, 1);

		return $rows;
	}

	// lọc danh sách
	public function filter($keyword, $offset, $limit)
	{
		global $db;

		if ($keyword != '') {
			$keyword = " AND `name` LIKE '%$keyword%' ";
		}

		if ($limit != '') {
			$limit = " LIMIT $offset, $limit";
		}

		$sql = "SELECT user.*
					, po.`name` position_name
				FROM $db->tbl_fix`$this->class_name` user
				LEFT JOIN $db->tbl_fix`position` po ON po.`id` = user.`position`
				WHERE user.`id` > 0
				$keyword
				ORDER BY user.`id` DESC
				$limit
		";

		$result = $db->executeQuery($sql);
		$kq = array();
		while ($row = mysqli_fetch_assoc($result)) {
			$kq[] = $row;
		}
		return $kq;
	}

	// đếm danh sách 
	public function filter_count($keyword)
	{
		global $db;

		if ($keyword != '') {
			$keyword = " AND ( `name` LIKE '%$keyword%' ) ";
		}

		$sql = "SELECT count(*) total
							FROM $db->tbl_fix$this->class_name
							WHERE `id` > 0
							$keyword
							";

		$result = $db->executeQuery($sql, 1);

		return isset($result['total']) ? $result['total'] : 0;
	}

	public function check_mobile()
	{
		global $db;

		$id = $this->get('id');
		$mobile = $this->get('mobile');

		$sql_id = '';
		if ($id != '') {
			$sql_id = " AND `id` != '$id' ";
		}

		$sql = "SELECT *
				FROM $db->tbl_fix`$this->class_name`
				WHERE `mobile` = '$mobile'
				$sql_id
				";

		$result = $db->executeQuery($sql, 1);

		return $result;
	}

	public function list_all($keyword = '', $field = '', $sort = 'DESC', $offset = '', $limit = '')
	{
		global $db;

		$shop_id = $this->get('shop_id');
		$gid = $this->get('gid');

		$sql_shop_id = '';
		if ($shop_id != '') {
			$sql_shop_id = " AND `shop_id` = '$shop_id' ";
		}

		$sql_gid = '';
		if ($gid != '') {
			$sql_gid = " AND `gid` = '$gid' ";
		}

		$sql_keyword = '';
		if ($keyword != '') {
			$sql_keyword = " AND ( `username` LIKE '%$keyword%' OR `mobile` LIKE '%$keyword%' OR `fullname` LIKE '%$keyword%') ";
		}

		$sql_order_by = " ORDER BY `id` DESC ";
		if ($field != '') {
			$sql_order_by = " ORDER BY $field $sort ";
		}

		$sql_limit = '';
		if ($limit != '') {
			$sql_limit = " LIMIT $offset, $limit ";
		}

		$sql = "SELECT `user`.*
				FROM $db->tbl_fix`user`
				WHERE 1
				$sql_shop_id
				$sql_gid
				$sql_keyword
				$sql_order_by
				$sql_limit
				";

		$result = $db->executeQuery_list($sql);

		return $result;
	}

	// đếm tất cả
	public function count_all($keyword = '')
	{
		global $db;

		$shop_id = $this->get('shop_id');
		$gid = $this->get('gid');

		$sql_shop_id = '';
		if ($shop_id != '') {
			$sql_shop_id = " AND `shop_id` = '$shop_id' ";
		}

		$sql_gid = '';
		if ($gid != '') {
			$sql_gid = " AND `gid` = '$gid' ";
		}

		$sql_keyword = '';
		if ($keyword != '') {
			$sql_keyword = " AND ( `username` LIKE '%$keyword%' OR `mobile` LIKE '%$keyword%' OR `fullname` LIKE '%$keyword%') ";
		}

		$sql = "SELECT COUNT(*) total_record
				FROM $db->tbl_fix`user`
				WHERE 1
				$sql_shop_id
				$sql_gid
				$sql_keyword
				";

		$result = $db->executeQuery($sql, 1);

		$data = array();
		$data['total_record'] = isset($result['total_record']) && $result['total_record'] > 0 ? $result['total_record'] : 0;
		return $data;
	}
}
