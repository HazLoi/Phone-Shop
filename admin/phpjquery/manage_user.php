<?php
$nod = $main->get('nod');

if ($act == 'idx') {
	if ($nod == 'filter') { // filter toàn bộ thành viên
		$user = new user();
		$paging = new paging();
		$position = new position();

		$keyword 		= $main->post('keyword');
		$page 		= $main->post('page');

		if ($page == '' || $page < 0) $page = 1;
		$paging->limit = $limit = $setup['perpage'];
		$offset = ($page - 1) * $paging->limit;
		$paging->page = $page;
		$paging->total = $user->filter_count($keyword);
		$lUser = $user->filter($keyword, $offset, $limit);

		$kq['offset'] = $offset+1;
		$kq['total_record'] = $paging->total;
		$kq['page_html'] = $paging->display('change_page');
		$kq['lUser'] = $lUser;
		$kq['lPosition'] = $position->filter('','','');

		echo 'done##', $main->toJsonData(200, 'success', $kq);
		unset($kq);
	} else {
		echo 'Missing action';
		$db->close();
		exit();
	}
} elseif ($act == 'save') {
	if ($nod == 'save') { //lưu menu khi tạo/ sửa
		$user = new user();
		
		$id 	= $main->post('id');
		$fullname 	= $main->post('fullname');
		$mobile 		= $main->post('mobile');
		$address 	= $main->post('address');
		$position 	= $main->post('position');
		$status 		= $main->post('status');
		$email 		= $main->post('email');
		$password 		= $main->post('password');

		$user->set('fullname', $fullname);
		$user->set('address', $address);
		$user->set('position', $position);
		$user->set('status', $status);
		$user->set('email', $email);
		$user->set('mobile', $mobile);
		$user->set('password', $password);
		$check_mobile = $user->check_mobile();

		if(isset($check_mobile['id'])){
			echo 'done##', $main->toJsonData(403, 'Số điện thoại đã tồn tại', '');
		}else{
			if (isset($id) && $id != '') {
				$user->set('id', $id);
				$user->update();
			} else {
				$user->add();
			}
			echo 'done##', $main->toJsonData(200, 'success', '');
		}

	} elseif ($nod == 'detail') {
		$user = new user();
		$id  = $main->post('id');

		$user->set('id', $id);
		$kq = $user->get_detail();
		echo 'done##', $main->toJsonData(200, 'success', $kq);
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
