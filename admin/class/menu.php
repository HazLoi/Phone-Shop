<?php
class menu extends model{
    
	protected $class_name = "menu";
   protected $id; // id của menu
   protected $name; // tên menu
   protected $type_link; // menu thuộc loại gì ví dụ: là "danh mục sản phẩm" thì loại "category"
   protected $link; // link của menu ví dụ: /tin-tuc, /trang-chu, /san-pham
   protected $description; // mô tả của menu
   protected $icon; // icon
   protected $root_id; // id của menu cha
   protected $level; // level của menu ví dụ: 1 là cao nhất là Ông, 2 là Cha, 3 là Cháu
   protected $type; // loại menu ví dụ: 0 là menu trên, 1 là menu dưới
   protected $open_page; // hình như mở trang như: _self, _blank
   protected $priority; // mức độ ưu tiên
   protected $is_hidden; // != là menu ẩn
   protected $delete; // != 0 là menu bị xóa
   protected $shop_id; // menu thuộc shop_id nào
   protected $avatar; // ảnh menu
   protected $background; // nền menu
   protected $theme_id; // vẫn chưa biết dùng làm gì ( có thể bỏ đi )
   protected $type_cat; // vẫn chưa biết dùng làm gì ( có thể bỏ đi )
   protected $type_value; // vẫn chưa biết dùng làm gì ( có thể bỏ đi )

	// Thêm menu mới
	public function add(){
		 global $db;

		 $arr['name']                    = $this->get('name');
		 $arr['type_link']               = $this->get('type_link');
		 $arr['link']                    = $this->get('link');
		 $arr['description']             = $this->get('description');
		 $arr['icon']                    = $this->get('icon');
		 $arr['avatar']                  = $this->get('avatar');
		 $arr['background']              = $this->get('background');
		 $arr['root_id']                 = $this->get('root_id');
		 $arr['level']                   = $this->get('level');
		 $arr['type']                    = $this->get('type');
		 $arr['type_cat']                = $this->get('type_cat');
		 $arr['type_value']              = $this->get('type_value');
		 $arr['open_page']               = $this->get('open_page');
		 $arr['priority']                = $this->get('priority');
		 $arr['description']             = $this->get('description');
		 $arr['is_hidden']               = $this->get('is_hidden') + 0;
		 $arr['delete']                  = $this->get('delete') + 0;
		 $arr['shop_id']                 = $this->get('shop_id');
		 $arr['theme_id']                = $this->get('theme_id');
		 
		 $db->record_insert($db->tbl_fix . $this->class_name, $arr);

		 return $db->mysqli_insert_id();
	}

	// Cập nhật menu
	public function update(){
		 global $db;
		 
		 $id                             = $this->get('id');

		 $arr['name']                    = $this->get('name');
		 $arr['type_link']               = $this->get('type_link');
		 $arr['link']                    = $this->get('link');
		 $arr['description']             = $this->get('description');
		 $arr['icon']                    = $this->get('icon');
		 $arr['avatar']                  = $this->get('avatar');
		 $arr['background']              = $this->get('background');
		 $arr['root_id']                 = $this->get('root_id');
		 $arr['level']                   = $this->get('level');
		 $arr['type']                    = $this->get('type');
		 $arr['type_cat']                = $this->get('type_cat');
		 $arr['type_value']              = $this->get('type_value');
		 $arr['open_page']               = $this->get('open_page');
		 $arr['priority']                = $this->get('priority');
		 $arr['description']             = $this->get('description');
		 $arr['is_hidden']               = $this->get('is_hidden') + 0;
		 $arr['delete']                  = $this->get('delete') + 0;
		 $arr['shop_id']                 = $this->get('shop_id');
		 $arr['theme_id']                = $this->get('theme_id');

		 $db->record_update($db->tbl_fix . $this->class_name, $arr, " `id` = '$id' ");

		 return true;
	}

	// Lấy ra toàn bộ menu
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

	// Lấy ra những menu từ menu Cha nếu có
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

	// Lấy ra danh sách menu con thuộc menu Cha nếu có
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