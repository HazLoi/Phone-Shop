<?php
class permission extends model
{
	protected $class_name = 'permission';
	protected $id; // id của menu
	protected $root; // id menu cha
	protected $title; // tiêu đề
	protected $permission; // ví dụ m:report, act:delivery_showroom và trong file phpjquery có dùng act:idx => :reportdelivery_showroom:report_delivery_showroomidx:
	protected $list_permission; // Quên rồi để xem lại
	protected $is_hidden; // !=0 là ẩn 
	protected $is_menu; // =0 là phân quyền, !=0 là menu
	protected $m; // ?m=...&act=... link domain => m
	protected $act; // ?m=...&act=... link domain => act
	protected $link; // ?m=...&act=...
	protected $icon; // icon của menu
	protected $priority; // mức độ ưu tiên
	protected $description; // mô tả cho menu
	
	//Load menu to show
	public function menu_load($is_hidden){
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


	public function menu_load_sub($root_id, $is_hidden){
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
	public function menu_update($lIDs, $is_hidden){
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
