<?php
$nod = $main->get('nod');

if ($act == 'idx') {
	if ($nod == 'filter') { // filter toàn bộ menu
		$menu = new menu();
		$paging = new paging();

		$keyword 		= $main->post('keyword');
		$is_hidden 	= $main->post('is_hidden');
		$page 		= $main->post('page');

		$menu->set('is_hidden', $is_hidden);

		if ($page == '' || $page < 0) $page = 1;
		$paging->limit = $limit = $setup['perpage'];
		$offset = ($page - 1) * $paging->limit;
		$paging->page = $page;
		$paging->total = $menu->filter_count($keyword);
		$lMenu = $menu->filter($keyword, $offset, $limit);

		$kq['offset'] = $offset+1;
		$kq['total_record'] = $paging->total;
		$kq['page_html'] = $paging->display('change_page');
		$kq['lMenu'] = $lMenu;

		echo 'done##', $main->toJsonData(200, 'success', $kq);
		unset($kq);
	} else {
		echo 'Missing action';
		$db->close();
		exit();
	}
} elseif ($act == 'save') {
	if ($nod == 'save') { //lưu menu khi tạo/ sửa
		$menu = new menu();

		$id                     = $main->post('id');
		$name                   = $main->post('name');
		$root_id                = $main->post('root_id');
		$level = 1;
		$priority = 1;
		$open_page = '_self';
		$link = $main->convert_link_url($name);

		if (isset($root_id) && $root_id > 0) {
			$menu->set('id', $root_id);
			$dRoot = $menu->get_detail();
			if (isset($dRoot['id'])) {
				$menu->set('is_hidden', $dRoot['is_hidden']);
			}
			$level = $dRoot['level'] + 1;
		}

		$menu->set('name', $name);
		$menu->set('root_id', $root_id);
		$menu->set('level', $level);
		$menu->set('priority', $priority);
		$menu->set('open_page', $open_page);
		$menu->set('link', $link);

		$check_menu_exists = $menu->check_exists();
	
		if(!isset($check_menu_exists)){
			if (isset($id) && $id != '') {
				$menu->set('id', $id);
				$menu->update();
			} else {
				$menu->add();
			}
			echo 'done##', $main->toJsonData(200, 'success', '');
		}else{
			echo 'done##', $main->toJsonData(403, 'Tên menu đã tồn tại', '');
		}

	} elseif ($nod == 'detail') { //get chi tiết menu để edit
		$menu = new menu();
		$id  = $main->post('id');

		$menu->set('id', $id);
		$kq = $menu->get_detail_by_id();
		echo 'done##', $main->toJsonData(200, 'success', $kq);
	} else {
		echo 'Missing action';
		$db->close();
		exit();
	}
} elseif ($act == 'delete') {
	if ($nod == 'delete') {
		$menu = new menu();

		$id = $main->post('id');
		$menu->set('id', $id);
		$menu->delete_menu();
		
		echo 'done##', $main->toJsonData(200, 'success', '');
	} else {
		echo 'Missing action';
		$db->close();
		exit();
	}
} elseif ($act == 'hidden') {
	if ($nod == 'hidden') { //ẩn menu
		$menu = new menu();
		$id        = $main->post('id');
		$is_hidden = $main->post('is_hidden');

		$menu->set('id', $id);
		$menu->set('is_hidden', $is_hidden == 0 ? 1 : 0);
		$menu->update_hidden();

		echo 'done##', $main->toJsonData(200, 'success', '');
	} else {
		echo 'Missing action';
		$db->close();
		exit();
	}
} else {
	echo 'Missing action';
	$db->close();
	exit();
}
