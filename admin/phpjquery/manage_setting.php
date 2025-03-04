<?php

$nod = $main->get('nod');
if ($act == 'idx') {
	if ($nod == 'permission') {
		$data = array();
		$data['permission'] = $dUserLogin['permission'];
		$data['gid'] = $dUserLogin['gid'];
		$permission = new permission();

		echo 'done##', $main->toJsonData(200, 'Success', $data);
	} else {
		echo '404 Forbidden - Nod missing!';
	}
} elseif ($act == 'view_table_idx') {
	if ($nod == 'get_table_name') {
		$permission = new permission();
		$data = $permission->get_all_table_name_in_database();

		echo 'done##', $main->toJsonData(200, 'Success', $data);
	} elseif ($nod == 'get_columns_table') {
		$permission = new permission();
		$table_name = $main->post('table_name');

		$data = $permission->get_all_columns_in_table($table_name)['list_columns'];

		echo 'done##', $main->toJsonData(200, 'Success', $data);
	} elseif ($nod == 'get_rows_table') {
		$permission = new permission();
		$table_name = $main->post('table_name');
		$page = $main->post('page');
		$limit = $main->post('limit');
		$field = $main->post('field');
		$sort = $main->post('sort');
		$keyword = $main->post('keyword');
		$type_keyword = $main->post('type_keyword');

		if ($page == '' || $page < 1) $page = 1;
		$paging = new paging();
		$paging->page = $page;
		$paging->limit = $limit;
		$offset = ($page - 1) * $paging->limit;

		$info = $permission->filter_count_by_table_name($table_name, $keyword, $type_keyword);
		$list = $permission->filter_by_table_name($table_name, $keyword, $type_keyword, $field, $sort, $offset, $limit);

		$paging->total = $info['total_record'];
		$page_html = $paging->display("paging_view_table");
		$data['page_html'] = $page_html;
		$data['list'] = $list;

		echo 'done##', $main->toJsonData(200, 'Success', $data);
	} else {
		echo '404 Forbidden - Nod missing!';
	}
} elseif ($act == 'view_table_add') {
	if ($nod == 'add') {
		$permission = new permission();
		$table_name = $main->post('table_name');
		$list_columns_table = $main->post('list_columns_table');
		$list_columns_table = json_decode($list_columns_table, true);
		$array_add = array();

		// lọc qua danh sách cột để lấy ra giá trị
		foreach ($list_columns_table as $index => $column) {
			if ($index > 0) {
				$array_add[$column] = $main->post($column);
			} else {
				$array_add[$column] = null;
			}
		}
		// truyền 2 mảng qua bên class để cập nhật
		$permission->add_rows_table($table_name, $list_columns_table, $array_add);

		echo 'done##', $main->toJsonData(200, 'Success', '');
	} else {
		echo '404 Forbidden - Nod missing!';
	}
} elseif ($act == 'view_table_edit') {
	if ($nod == 'edit') {
		$permission = new permission();
		$id_key = $main->post('id_key');
		$column_key = $main->post('column_key');
		$table_name = $main->post('table_name');
		$list_columns_table = $main->post('list_columns_table');
		$list_columns_table = json_decode($list_columns_table, true);
		$array_update = array();

		// lọc qua danh sách cột để lấy ra giá trị
		foreach ($list_columns_table as $index => $column) {
			$array_update[$column] = $main->post($column);
		}
		if ($column_key == '') {
			echo 'done##', $main->toJsonData(403, 'Không tìm thấy cột lưu dữ liệu chính', '');
		} elseif ($id_key == '') {
			echo 'done##', $main->toJsonData(403, 'Không tìm thấy giá trị chính cần thực hiện', '');
		} elseif ($table_name == '') {
			echo 'done##', $main->toJsonData(403, 'Không tìm thấy tên bảng cần thực hiện', '');
		} else {
			// truyền 2 mảng qua bên class để cập nhật
			$permission->update_rows_table($table_name, $list_columns_table, $array_update, $column_key, $id_key);

			echo 'done##', $main->toJsonData(200, 'Success', '');
		}
	} else {
		echo '404 Forbidden - Nod missing!';
	}
} elseif ($act == 'view_table_delete') {
	if ($nod == 'delete') {
		$permission = new permission();
		$id_key = $main->post('id_key');
		$column_key = $main->post('column_key');
		$table_name = $main->post('table_name');

		if ($column_key == '') {
			echo 'done##', $main->toJsonData(403, 'Không tìm thấy cột lưu dữ liệu chính', '');
		} elseif ($id_key == '') {
			echo 'done##', $main->toJsonData(403, 'Không tìm thấy giá trị chính cần thực hiện', '');
		} elseif ($table_name == '') {
			echo 'done##', $main->toJsonData(403, 'Không tìm thấy tên bảng cần thực hiện', '');
		} else {
			// truyền 2 mảng qua bên class để cập nhật
			$permission->delete_rows_table($table_name, $column_key, $id_key);

			echo 'done##', $main->toJsonData(200, 'Success', '');
		}
	} else {
		echo '404 Forbidden - Nod missing!';
	}
} elseif ($act == 'permission_idx') {
	if ($nod == 'filter') {
		$perm = new permission();

		$page = $main->post('page');
		$limit = $main->post('limit');
		$keyword = $main->post('keyword');
		$field = $main->post('field');
		$sort = $main->post('sort');
		$type = $main->post('type');

		if ($page == '' || $page < 1) $page = 1;
		$paging = new paging();
		$paging->page = $page;
		$paging->limit = $limit;
		$offset = ($page - 1) * $paging->limit;

		$info = $perm->filter_count($keyword, $type);
		$list = $perm->filter($keyword, $type, $field, $sort, $offset, $limit);

		$paging->total = $info['total_record'];
		$page_html = $paging->display("paging_permission");

		$data = array();
		$data['list_permission'] = $list;
		$data['page_html'] = $page_html;
		$data['info'] = $info;

		echo 'done##', $main->toJsonData(200, 'Success', $data);
	} else {
		echo '404 Forbidden - Nod missing!';
	}
} elseif ($act == 'permission_add') {
	if ($nod == 'add') {
		$perm = new permission();

		$group = $main->post('group');
		$root = $main->post('root');
		$title = $main->post('title');
		$permission = $main->post('permission');
		$list_permission = $main->post('list_permission');
		$is_hidden = $main->post('is_hidden');
		$is_menu = $main->post('is_menu');
		$m = $main->post('m');
		$act = $main->post('act');
		$link = $main->post('link');
		$icon = $main->post('icon');
		$priority = $main->post('priority');
		$description = $main->post('description');

		$perm->set('group', $group);
		$perm->set('root', $root);
		$perm->set('title', $title);
		$perm->set('permission', $permission);
		$perm->set('list_permission', $list_permission);
		$perm->set('is_hidden', $is_hidden);
		$perm->set('is_menu', $is_menu);
		$perm->set('m', $m);
		$perm->set('act', $act);
		$perm->set('link', $link);
		$perm->set('icon', $icon);
		$perm->set('priority', $priority);
		$perm->set('description', $description);
		// Thêm quyền
		$id = $perm->add();
		// trả dữ liệu
		$perm->set('id', $id);
		$data = $perm->get_detail();
		echo 'done##', $main->toJsonData(200, 'Success', $data);
	} else {
		echo '404 Forbidden - Nod missing!';
	}
} elseif ($act == 'permission_edit') {
	if ($nod == 'edit') {
		$perm = new permission();

		$id = $main->post('id');
		$group = $main->post('group');
		$root = $main->post('root');
		$title = $main->post('title');
		$permission = $main->post('permission');
		$list_permission = $main->post('list_permission');
		$is_hidden = $main->post('is_hidden');
		$is_menu = $main->post('is_menu');
		$m = $main->post('m');
		$act = $main->post('act');
		$link = $main->post('link');
		$icon = $main->post('icon');
		$priority = $main->post('priority');
		$description = $main->post('description');
		$id_key = $main->post('id_key');

		$perm->set('id', $id_key);
		$detail_permission = $perm->get_detail();
		if (!isset($detail_permission['id'])) {
			echo 'done##', $main->toJsonData(403, 'Không tìm thấy phân quyền này', '');
		} else {
			// cập nhật
			$perm->set('group', $group);
			$perm->set('root', $root);
			$perm->set('title', $title);
			$perm->set('permission', $permission);
			$perm->set('list_permission', $list_permission);
			$perm->set('is_hidden', $is_hidden);
			$perm->set('is_menu', $is_menu);
			$perm->set('m', $m);
			$perm->set('act', $act);
			$perm->set('link', $link);
			$perm->set('icon', $icon);
			$perm->set('priority', $priority);
			$perm->set('description', $description);
			$perm->set('id', $id);
			$perm->update($id_key);
			// trả dữ liệu
			$data = $perm->get_detail();
			echo 'done##', $main->toJsonData(200, 'Success', $data);
		}
	} else {
		echo '404 Forbidden - Nod missing!';
	}
} elseif ($act == 'permission_delete') {
	if ($nod == 'delete') {
		$perm = new permission();

		$id = $main->post('id');

		$perm->set('id', $id);
		$detail_permission = $perm->get_detail();
		if (!isset($detail_permission['id'])) {
			echo 'done##', $main->toJsonData(403, 'Không tìm thấy phân quyền này', '');
		} else {
			// cập nhật
			$perm->delete();
			echo 'done##', $main->toJsonData(200, 'Success', '');
		}
	} else {
		echo '404 Forbidden - Nod missing!';
	}
} elseif ($act == 'perm_function_idx') {
	if ($nod == 'filter') {
		$perm_function = new permission_function();

		$page = $main->post('page');
		$limit = $main->post('limit');
		$keyword = $main->post('keyword');
		$field = $main->post('field');
		$sort = $main->post('sort');

		if ($page == '' || $page < 1) $page = 1;

		$paging = new paging();
		$paging->page = $page;
		$paging->limit = $limit;
		$offset = ($page - 1) * $paging->limit;

		$info = $perm_function->filter_count($keyword);
		$list = $perm_function->filter($keyword, $field, $sort, $offset, $limit);

		$paging->total = $info['total_record'];
		$page_html = $paging->display("paging_perm_function");

		$data = array();
		$data['list_perm_function'] = $list;
		$data['page_html'] = $page_html;
		$data['info'] = $info;

		echo 'done##', $main->toJsonData(200, 'Success', $data);
	} else {
		echo '404 Forbidden - Nod missing!';
	}
} elseif ($act == 'perm_function_add') {
	if ($nod == 'add') {
		$perm_function = new permission_function();

		$name_en = $main->post('name_en');
		$name_vi = $main->post('name_vi');

		$perm_function->set('name_en', $name_en);
		$perm_function->set('name_vi', $name_vi);
		// Thêm quyền
		$id = $perm_function->add();
		// trả dữ liệu
		$perm_function->set('id', $id);
		$data = $perm_function->get_detail();
		echo 'done##', $main->toJsonData(200, 'Success', $data);
	} else {
		echo '404 Forbidden - Nod missing!';
	}
} elseif ($act == 'perm_function_edit') {
	if ($nod == 'edit') {
		$perm_function = new permission_function();

		$name_en = $main->post('name_en');
		$name_vi = $main->post('name_vi');
		$id = $main->post('id');

		$perm_function->set('name_en', $name_en);
		$perm_function->set('name_vi', $name_vi);
		$perm_function->set('id', $id);

		$detail_perm_function = $perm_function->get_detail();
		if (!isset($detail_perm_function['id'])) {
			echo 'done##', $main->toJsonData(403, 'Không tìm thấy chức năng phân quyền này', '');
		} else {
			// cập nhật
			$perm_function->update();
			// trả dữ liệu
			$data = $perm_function->get_detail();
			echo 'done##', $main->toJsonData(200, 'Success', $data);
		}
	} else {
		echo '404 Forbidden - Nod missing!';
	}
} elseif ($act == 'perm_function_delete') {
	if ($nod == 'delete') {
		$perm_function = new permission_function();

		$id = $main->post('id');

		$perm_function->set('id', $id);
		$detail_perm_function = $perm_function->get_detail();
		if (!isset($detail_perm_function['id'])) {
			echo 'done##', $main->toJsonData(403, 'Không tìm thấy chức năng phân quyền này', '');
		} else {
			// cập nhật
			$perm_function->delete();
			echo 'done##', $main->toJsonData(200, 'Success', '');
		}
	} else {
		echo '404 Forbidden - Nod missing!';
	}
} elseif ($act == 'personnel_user_idx') {
	if ($nod == 'filter') {
		$personnel_user = new user();

		$page = $main->post('page');
		$limit = $main->post('limit');
		$keyword = $main->post('keyword');
		$field = $main->post('field');
		$sort = $main->post('sort');

		if ($page == '' || $page < 1) $page = 1;

		$paging = new paging();
		$paging->page = $page;
		$paging->limit = $limit;
		$offset = ($page - 1) * $paging->limit;

		$info = $personnel_user->count_all($keyword);
		$list = $personnel_user->list_all($keyword, $field, $sort, $offset, $limit);

		$paging->total = $info['total_record'];
		$page_html = $paging->display("paging_personnel_user");

		$data = array();
		$data['list_personnel_user'] = $list;
		$data['page_html'] = $page_html;
		$data['info'] = $info;

		echo 'done##', $main->toJsonData(200, 'Success', $data);
	} elseif ($nod == 'get_password_md5') {
		$password = $main->post('password');
		$salt = $main->post('salt');

		$result = md5(md5($password) . $salt);
		echo 'done##', $main->toJsonData(200, 'Success', $result);
	} else {
		echo '404 Forbidden - Nod missing!';
	}
} elseif ($act == 'personnel_user_add') {
	if ($nod == 'add') {
		$personnel_user = new user();

		$strID = $main->post('strID');
		$username = $main->post('username');
		$fullname = $main->post('fullname');
		$password = $main->post('password');
		$salt = $main->post('salt');
		$gid = $main->post('gid');
		$mobile = $main->post('mobile');
		$phone = $main->post('phone');
		$email = $main->post('email');
		$address = $main->post('address');
		$avatar = $main->post('avatar');
		$note = $main->post('note');
		$bank_name = $main->post('bank_name');
		$bank_account = $main->post('bank_account');
		$bank_branch = $main->post('bank_branch');
		$bank_id = $main->post('bank_id');
		$shop_id = $main->post('shop_id');
		$status = $main->post('status');
		$security = $main->post('security');
		$create_user = $main->post('create_user');
		$accessed = $main->post('accessed');
		$add_device = $main->post('add_device');
		$lang = $main->post('lang');
		$total_coffers = $main->post('total_coffers');
		$permission = $main->post('permission');
		$vehicle = $main->post('vehicle');
		$unit_cost = $main->post('unit_cost');
		$session_token = $main->post('session_token');
		$regard_client_id = $main->post('regard_client_id');

		$personnel_user->set('strID', $strID);
		$personnel_user->set('username', $username);
		$personnel_user->set('fullname', $fullname);
		$personnel_user->set('password', $password);
		$personnel_user->set('salt', $salt);
		$personnel_user->set('gid', $gid);
		$personnel_user->set('mobile', $mobile);
		$personnel_user->set('phone', $phone);
		$personnel_user->set('email', $email);
		$personnel_user->set('address', $address);
		$personnel_user->set('avatar', $avatar);
		$personnel_user->set('note', $note);
		$personnel_user->set('bank_name', $bank_name);
		$personnel_user->set('bank_account', $bank_account);
		$personnel_user->set('bank_branch', $bank_branch);
		$personnel_user->set('bank_id', $bank_id);
		$personnel_user->set('shop_id', $shop_id);
		$personnel_user->set('status', $status);
		$personnel_user->set('security', $security);
		$personnel_user->set('create_user', $create_user);
		$personnel_user->set('accessed', $accessed);
		$personnel_user->set('add_device', $add_device);
		$personnel_user->set('lang', $lang);
		$personnel_user->set('total_coffers', $total_coffers);
		$personnel_user->set('permission', $permission);
		$personnel_user->set('vehicle', $vehicle);
		$personnel_user->set('unit_cost', $unit_cost);
		$personnel_user->set('session_token', $session_token);
		$personnel_user->set('regard_client_id', $regard_client_id);
		// Thêm quyền
		$id = $personnel_user->add_new();
		// trả dữ liệu
		$data = $personnel_user->get_detail_by_id($id);
		echo 'done##', $main->toJsonData(200, 'Success', $data);
	} else {
		echo '404 Forbidden - Nod missing!';
	}
} elseif ($act == 'personnel_user_edit') {
	if ($nod == 'edit') {
		$personnel_user = new user();

		$strID = $main->post('strID');
		$username = $main->post('username');
		$fullname = $main->post('fullname');
		$password = $main->post('password');
		$salt = $main->post('salt');
		$gid = $main->post('gid');
		$mobile = $main->post('mobile');
		$phone = $main->post('phone');
		$email = $main->post('email');
		$address = $main->post('address');
		$avatar = $main->post('avatar');
		$note = $main->post('note');
		$bank_name = $main->post('bank_name');
		$bank_account = $main->post('bank_account');
		$bank_branch = $main->post('bank_branch');
		$bank_id = $main->post('bank_id');
		$shop_id = $main->post('shop_id');
		$status = $main->post('status');
		$security = $main->post('security');
		$create_user = $main->post('create_user');
		$accessed = $main->post('accessed');
		$add_device = $main->post('add_device');
		$lang = $main->post('lang');
		$total_coffers = $main->post('total_coffers');
		$permission = $main->post('permission');
		$vehicle = $main->post('vehicle');
		$unit_cost = $main->post('unit_cost');
		$session_token = $main->post('session_token');
		$regard_client_id = $main->post('regard_client_id');
		$id = $main->post('id');

		$personnel_user->set('id', $id);
		$personnel_user->set('strID', $strID);
		$personnel_user->set('username', $username);
		$personnel_user->set('fullname', $fullname);
		$personnel_user->set('password', $password);
		$personnel_user->set('salt', $salt);
		$personnel_user->set('gid', $gid);
		$personnel_user->set('mobile', $mobile);
		$personnel_user->set('phone', $phone);
		$personnel_user->set('email', $email);
		$personnel_user->set('address', $address);
		$personnel_user->set('avatar', $avatar);
		$personnel_user->set('note', $note);
		$personnel_user->set('bank_name', $bank_name);
		$personnel_user->set('bank_account', $bank_account);
		$personnel_user->set('bank_branch', $bank_branch);
		$personnel_user->set('bank_id', $bank_id);
		$personnel_user->set('shop_id', $shop_id);
		$personnel_user->set('status', $status);
		$personnel_user->set('security', $security);
		$personnel_user->set('create_user', $create_user);
		$personnel_user->set('accessed', $accessed);
		$personnel_user->set('add_device', $add_device);
		$personnel_user->set('lang', $lang);
		$personnel_user->set('total_coffers', $total_coffers);
		$personnel_user->set('permission', $permission);
		$personnel_user->set('vehicle', $vehicle);
		$personnel_user->set('unit_cost', $unit_cost);
		$personnel_user->set('session_token', $session_token);
		$personnel_user->set('regard_client_id', $regard_client_id);

		$detail_personnel_user = $personnel_user->get_detail_by_id($id);
		if (!isset($detail_personnel_user['id'])) {
			echo 'done##', $main->toJsonData(403, 'Không tìm thấy chức năng phân quyền này', '');
		} else {
			// cập nhật
			$personnel_user->update_new();
			// trả dữ liệu
			$data = $personnel_user->get_detail_by_id($id);
			echo 'done##', $main->toJsonData(200, 'Success', $data);
		}
	} else {
		echo '404 Forbidden - Nod missing!';
	}
} elseif ($act == 'personnel_user_delete') {
	if ($nod == 'delete') {
		$personnel_user = new user();

		$id = $main->post('id');

		$personnel_user->set('id', $id);
		$detail_personnel_user = $personnel_user->get_detail_by_id($id);
		if (!isset($detail_personnel_user['id'])) {
			echo 'done##', $main->toJsonData(403, 'Không tìm thấy phân quyền này', '');
		} else {
			// cập nhật
			$personnel_user->delete_by_id();
			echo 'done##', $main->toJsonData(200, 'Success', '');
		}
	} else {
		echo '404 Forbidden - Nod missing!';
	}
} elseif ($act == 'sql_idx') {
	if ($nod == 'format_sql') {
		$sql_text = $main->post('sql_text');
		// Loại bỏ khoảng trắng đầu và cuối của chuỗi $sql_text.
		$sql_text = trim($sql_text);
		// Hàm `preg_replace` để thay thế các khoảng trắng liên tiếp (gồm cả dấu xuống dòng) bằng một khoảng trắng duy nhất.
		$sql_text = preg_replace('/\s+/', ' ', $sql_text);

		// Thêm xuống dòng sau các từ khóa chính
		$keywords = [
			'SELECT',
			'FROM',
			'WHERE',
			'AND',
			'OR',
			'GROUP BY',
			'ORDER BY',
			'INSERT INTO',
			'VALUES',
			'UPDATE',
			'SET',
			'DELETE',
			'LIMIT',
			'LEFT JOIN',
			'RIGHT JOIN',
			'INNER JOIN'
		];

		// Sử dụng `preg_replace` để tìm các từ khóa trong câu SQL (không phân biệt chữ hoa/thường nhờ `/i`) và thêm xuống dòng trước từ khóa.
		// `\b` đảm bảo rằng chỉ khớp từ khóa độc lập (ví dụ: không nhầm "SELECT" với "SELECTED").
		// `preg_quote` đảm bảo các ký tự đặc biệt trong từ khóa không gây lỗi trong biểu thức chính quy.
		foreach ($keywords as $keyword) {
			$sql_text = preg_replace("/\b" . preg_quote($keyword, '/') . "\b/i", "\n$keyword", $sql_text);
		}

		// Chia câu SQL đã được định dạng thành các dòng nhỏ dựa trên ký tự xuống dòng `\n`.
		// Mỗi phần tử trong mảng $lines là một dòng riêng lẻ.
		$lines = explode("\n", $sql_text);
		$formattedSql = '';
		$indentLevel = 0;
		foreach ($lines as $line) {
			// Loại bỏ khoảng trắng đầu và cuối của từng dòng $line.
			$line = trim($line);
			$line = str_replace('\\', '', $line);
			// Nếu dòng bắt đầu là một trong những từ sau thì đặt mức thụt lề là 1 (tức là thụt vào một tab hoặc 4 khoảng trắng).
			if (preg_match('/^(AND|LEFT JOIN|RIGHT JOIN|INNER JOIN|VALUES|SET)/i', $line)) {
				$indentLevel = 1;
				// Thêm dòng vào chuỗi $formattedSql với mức thụt lề hiện tại.
				// `str_repeat('    ', $indentLevel)` lặp 4 khoảng trắng tương ứng với mức thụt lề.
				$formattedSql .= str_repeat('    ', $indentLevel) . $line . "\n";
			} elseif (preg_match('/^(SELECT|INSERT INTO|UPDATE|DELETE|FROM|WHERE|GROUP BY|ORDER BY|LIMIT)/i', $line)) {
				$indentLevel = 0;
				// đặt mức thụt lề tiếp theo là 0.
				$formattedSql .= str_repeat('', $indentLevel) . $line . "\n";
			}
		}
		// bỏ khoảng trắng
		$data = trim($formattedSql);
		// Loại bỏ các ký tự gạch chéo ngược (`\`) trong chuỗi $data, nếu có.
		// Điều này có thể cần thiết nếu dữ liệu đầu vào chứa các ký tự thoát không mong muốn.
		$data = str_replace('\\', '', $data);

		echo 'done##', $main->toJsonData(200, 'Success', $data);
	} elseif ($nod == 'submit') {
		$sql_text = $main->post('sql_text');
		$is_check = $main->post('is_check');
		if ($is_check == 1) {
			echo 'done##', $main->toJsonData(403, 'Chức năng đang trong giai đoạn xử lý toạn khóa', '');
		} else {
			// chuyển chuỗi sql thành mảng cách nhau bởi ";"
			$list_sql = explode(';', $sql_text);
			// lọc qua mảng chạy sql
			$display = array();
			foreach ($list_sql as $sql) {
				if ($sql != '') {
					$sql = str_replace('\\', '', trim($sql));
					$result = $db->executeQuery($sql);
					$display[] = $result;
					// echo "</pre>";
					// print_r($result);
					// echo "</pre>";
				}
			}

			echo 'done##', $main->toJsonData(200, 'Success', $display);
		}
	} elseif ($nod == 'compare_table') {
		$permission = new permission();
		$tableA = $main->post('tableA');
		$tableB = $main->post('tableB');
		if ($tableA != '' && $tableB != '') {
			$data = $permission->generate_alter_table($tableA, $tableB);
			echo 'done##', $main->toJsonData(200, 'Success', $data);
		} else {
			echo 'done##', $main->toJsonData(403, 'Vui lòng chọn bảng cần so sánh', '');
		}
	} else {
		echo '404 Forbidden - Nod missing!';
	}
} elseif ($act == 'use_files_idx') {
	if ($nod == 'filter') {
		// vì đang ở trong thư mục phpjquery nên dùng cách này lấy danh sách file trong phpjquery
		$directory = '../phpjquery/';
		$limit = 20; // giới hạn số lượng file trả về
		$keyword = $main->post('keyword'); // lấy keyword từ request

		// kiểm tra đọc 
		if (is_dir($directory) && is_readable($directory)) {
			// bỏ đi những file có .. hoặc . ở đầu file
			$files = array_diff(scandir($directory), array('..', '.'));

			// lọc file theo keyword nếu có
			if (isset($keyword) && $keyword != '') {
				$files = array_filter($files, function ($file) use ($keyword) {
					return stripos($file, $keyword) !== false;
				});
			}

			// giới hạn số lượng file trả về
			$files = array_slice($files, 0, $limit);

			// trả về dữ liệu
			echo 'done##', $main->toJsonData(200, 'Success', $files);
		} else {
			echo 'done##', $main->toJsonData(403, 'Không tìm thấy thư mục hoặc không thể đọc được', '');
		}
	} else {
		echo '404 Forbidden - Nod missing!';
	}
} elseif ($act == 'use_files_add') {
	if ($nod == 'add') {
		// Đường dẫn đến file members_chat.php
		$file_path = $main->post('file');
		// Giá trị $m và $act từ file index.php
		$m = $main->post('m');
		$act_outer = $main->post('act');

		// Trích xuất các giá trị $act từ file members_chat.php
		$act_values = extract_acts_from_file($file_path);

		// Kết hợp giá trị $m và $act từ file index.php với $act từ file members_chat.php
		$permissions = [];
		foreach ($act_values as $act_inner) {
			$combined_act = $m . '_' . $act_outer . $act_inner;
			// kiểm tra trong chuỗi $act_inner nếu mà có chữ idx thì title là xem, add là thêm, edit là sửa, delete là xóa, download là tải
			if (strpos($act_inner, 'idx') !== false) {
				$title = "'Xem'";
			} elseif (strpos($act_inner, 'add') !== false) {
				$title = "'Thêm'";
			} elseif (strpos($act_inner, 'edit') !== false) {
				$title = "'Sửa'";
			} elseif (strpos($act_inner, 'delete') !== false) {
				$title = "'Xóa'";
			} elseif (strpos($act_inner, 'download') !== false) {
				$title = "'Tải'";
			} else {
				$title = "'Khác'";
			}

			$goup = 0;
			$root = "'@last_id'";
			$permission = "':{$m}{$act_outer}:{$combined_act}':";
			$list_permission = "''";
			$is_hidden = 0;
			$is_menu = 0;
			$link = "''";
			$icon = "''";
			$priority = 0;
			$description = "''";

			// nếu những giá trị là '' thì vẫn phải hiển thị ra được ký tự '' nên phải thêm dấu nháy đơn vào
			$temp = "INSERT INTO `permission` (`id`, `group`, `root`, `title`, `permission`, `list_permission`, `is_hidden`, `is_menu`, `m`, `act`, `link`, `icon`, `priority`, `description`) VALUES (null, $goup, $root, $title, $permission, $list_permission, $is_hidden, $is_menu, '$m', '$act_outer', $link, $icon, $priority, $description);";
			$permissions[] = $temp;
		}

		echo 'done##', $main->toJsonData(200, 'Success', $permissions);
	} else {
		echo '404 Forbidden - Nod missing!';
	}
} else {
	echo '404 Forbidden - Action missing!';
}

// đây là hàm đọc file gốp phần tạo permission
function extract_acts_from_file($file_path)
{
	// Đọc nội dung file
	$file_content = file_get_contents($file_path);

	// Kiểm tra lỗi khi đọc file
	if ($file_content === false) {
		die('Error reading file');
	}

	// Biểu thức chính quy để tìm các giá trị của $act trong các điều kiện if và elseif
	$pattern = '/\$act\s*==\s*[\'"]([^\'"]+)[\'"]/';

	// Tìm tất cả các kết quả khớp
	preg_match_all($pattern, $file_content, $matches);

	// Lấy các giá trị của $act
	return $matches[1];
}
