<?php
class pos_register extends model{

	protected $class_name = 'model';
	protected $id;
	protected $customer;
	protected $store_title;
	protected $store_name;
	protected $store_address;
	protected $store_mobile;
	protected $store_email;
	protected $store_phone;
	protected $store_theme;
	protected $store_status;
	protected $pos_type;
	protected $created_at;
	protected $store_id;
	protected $time_zone;
	protected $expire_at;
	protected $note;
	protected $no_shop;
	protected $no_user;
	protected $reseller_id;
	protected $belong_to_reseller;
	protected $domain_theme;

	protected $domain;//Domain thêm vào
	protected $domain_ip;//ip domain
	protected $domain_http_type;//= 1 https; =0 http

	//Hàm xử lý nhập thông tin đăng kí hệ thống POS
	public function register( $inarrInput ){
		
		global $db_store;
		
		$arr['customer'] = $inarrInput['customer'];
		$arr['store_title'] = $inarrInput['store_title'];
		$arr['store_name'] = $inarrInput['store_name'];
		$arr['store_address'] = $inarrInput['store_address'];
		$arr['store_mobile'] = $inarrInput['store_mobile'];
		$arr['store_phone'] = $inarrInput['store_phone'];
		$arr['store_theme'] = $inarrInput['store_theme'];
		$arr['note'] = $inarrInput['note'];
		$arr['store_email'] = $inarrInput['store_email'];
		$arr['no_shop'] = 1;
		$arr['no_user'] = 2;
		$arr['store_status'] = 1;
		$arr['pos_type'] = $inarrInput['pos_type'];
		$arr['reseller_id'] = $inarrInput['reseller_id'];
		$arr['belong_to_reseller'] = $inarrInput['belong_to_reseller']+0;
		$arr['created_at'] = time();
		$arr['expire_at'] 	= $inarrInput['expire_at'];
		$arr['domain'] 		= $inarrInput['domain'];
		$arr['domain_ip'] 	= $inarrInput['domain_ip'];
		$arr['domain_http_type'] 	=  $inarrInput['domain_http_type'];
		$arr['source'] 	=  $inarrInput['source'];
		$arr['db'] 	=  $inarrInput['db'];

		$db_store->record_insert( $db_store->tbl_fix."`pos_register`", $arr );

		return $db_store->mysqli_insert_id();
	}
	
	public function update( $store_id, $inarrInput ){
		global $db_store;

		$arr['customer'] 		= $inarrInput['customer'];
		$arr['store_title'] 	= $inarrInput['store_title'];
		$arr['store_address'] 	= $inarrInput['store_address'];
		$arr['store_mobile'] 	= $inarrInput['store_mobile'];
		$arr['store_phone'] 	= $inarrInput['store_phone'];
		$arr['store_theme'] 	= $inarrInput['store_theme'];
		$arr['pos_type'] 		= $inarrInput['pos_type'];
		$arr['store_status'] 	= $inarrInput['store_status'];
		if( isset($inarrInput['expire_at']) )
			$arr['expire_at'] 		= $inarrInput['expire_at'];
		$arr['note'] 			= $inarrInput['note'];
		$arr['store_email'] 	= $inarrInput['store_email'];

		$db_store->record_update( "`pos_register`", $arr, " `id` = '$store_id' " );
		
		return true;
	}

	public function update_info( $store_id, $inarrInput ){
		global $db_store;

		$arr['customer'] 		= $inarrInput['customer'];
		$arr['store_title'] 	= $inarrInput['store_title'];
		$arr['store_address'] 	= $inarrInput['store_address'];
		$arr['store_mobile'] 	= $inarrInput['store_mobile'];
		$arr['store_phone'] 	= $inarrInput['store_phone'];
		$arr['store_theme'] 	= $inarrInput['store_theme'];
		$arr['pos_type'] 		= $inarrInput['pos_type'];
		$arr['store_status'] 	= $inarrInput['store_status'];
		if( isset($inarrInput['expire_at']) )
			$arr['expire_at'] 		= $inarrInput['expire_at'];
		$arr['note'] 			= $inarrInput['note'];
		$arr['store_email'] 	= $inarrInput['store_email'];

		$db_store->record_update( "`pos_register`", $arr, " `id` = '$store_id' " );
		
		return true;
	}
	
	public function update_by_admin( $store_id, $inarrInput ){
		global $db_store;

		$belong_to_reseller = $this->get('belong_to_reseller');
		if( $belong_to_reseller != '' && $belong_to_reseller != 0 )
			$belong_to_reseller = " AND `belong_to_reseller` = '$belong_to_reseller' ";
		else 
			$belong_to_reseller = '';
		
		$arr['store_title'] 	= $inarrInput['store_title'];
		$arr['store_address'] 	= $inarrInput['store_address'];
		$arr['store_mobile'] 	= $inarrInput['store_mobile'];
		$arr['store_phone'] 	= $inarrInput['store_phone'];
		$arr['store_theme'] 	= $inarrInput['store_theme'];
		if( isset($inarrInput['expire_at']) )
			$arr['expire_at'] 		= $inarrInput['expire_at'];
		$arr['store_status'] 	= $inarrInput['store_status'];

		$db_store->record_update($db_store->tbl_fix."`pos_register`", $arr, " `id` = '$store_id' $belong_to_reseller ");
		unset( $arr );

		return true;
	}

	public function update_expire_at( $store_name, $expire_at ){
		global $db_store;

		$belong_to_reseller = $this->get('belong_to_reseller');
		if( $belong_to_reseller != '' && $belong_to_reseller != 0 )
			$belong_to_reseller = " AND `belong_to_reseller` = '$belong_to_reseller' ";
		else 
			$belong_to_reseller = '';
		
			$arr['expire_at'] 		= $expire_at;

		$db_store->record_update($db_store->tbl_fix."`pos_register`", $arr, " `store_name` = '$store_name' $belong_to_reseller ");
		unset( $arr );

		return true;
	}

	public function update_no_shop( $store_id, $no_shop ){
		global $db_store;
		
		$arr['no_shop'] = $no_shop;
		$db_store->record_update($db_store->tbl_fix."`pos_register`",$arr, " `id` ='".$store_id."'");

		return true;
	}

	public function update_no_user( $store_id, $no_user ){
		global $db_store;

		$arr['no_user'] = $no_user;
		$db_store->record_update($db_store->tbl_fix."`pos_register`", $arr, " `id` ='".$store_id."'");

		return true;
	}

	public function change_status( $store_id, $active ){ //$active = 1, $active = 0

		global $db_store;

		$arr['store_status'] = $active;
		$db_store->record_update($db_store->tbl_fix."`pos_register`",$arr, " `id` = '".$store_id."'");

		return true;

	}

	public function update_time_zone($store_name, $time_zone){ //$active = 1, $active = 0
		global $db_store;

		$arr['time_zone'] = $time_zone;
		$db_store->record_update($db_store->tbl_fix."`pos_register`", $arr, " `store_name` = '".$store_name."'");
		
		return true;
	}

	public function check_store($store_name)
	{
		global $db_store;

		$sql = "SELECT `store_name` FROM ".$db_store->tbl_fix."`pos_register` WHERE `store_name`='".$store_name."' LIMIT 0,1";
		
		$row = $db_store->executeQuery ( $sql, 1 );
		
		if(isset($row['store_name']['3'])){
			return true; //is exit
		}else{
			return false;//not exit
		}
	}

	public function check_email( $email )
	{
		global $db_store;

		$sql = "SELECT store_name FROM ".$db_store->tbl_fix."`pos_register` WHERE `store_email`='".$email."' LIMIT 0,1";
		
		$row = $db_store->executeQuery ( $sql, 1 );
		
		if(isset($row['store_name']['3'])){
			return true; //is exit
		}else{
			return false;//not exit
		}
	}

	public function check_mobile( $store_mobile )
	{
		global $db_store;

		$sql = "SELECT `store_name` FROM ".$db_store->tbl_fix."`pos_register` WHERE `store_mobile`='".$store_mobile."' LIMIT 0,1";
		
		$row = $db_store->executeQuery ( $sql, 1 );
		
		if(isset($row['store_name']['3'])){
			return true; //is exit
		}else{
			return false;//not exit
		}
	}

	public function get_detail_byid( $id )
	{
		global $db_store;

		$belong_to_reseller = $this->get('belong_to_reseller');
		if( $belong_to_reseller != '' && $belong_to_reseller != 0 )
			$belong_to_reseller = " AND `belong_to_reseller` = '$belong_to_reseller' ";
		else 
			$belong_to_reseller = '';
		
		$sql = "SELECT * FROM ".$db_store->tbl_fix."`pos_register` WHERE `id` = '$id' $belong_to_reseller LIMIT 0,1";
		
		$row = $db_store->executeQuery ( $sql, 1 );
		return $row;
	}

	public function get_detail()
	{
		global $db_store, $database, $listdb;
		if ($listdb["pos_register"]) $db_store->setDatabase($listdb["order"]);

		$id 						= $this->get('id');

		$belong_to_reseller = $this->get('belong_to_reseller');
		if( $belong_to_reseller != '' && $belong_to_reseller != 0 )
			$belong_to_reseller = " AND `belong_to_reseller` = '$belong_to_reseller' ";
		else 
			$belong_to_reseller = '';

		$sql = "SELECT * FROM ".$db_store->tbl_fix."`pos_register` WHERE `id`='".$id."' $belong_to_reseller LIMIT 0,1";
		
		$row = $db_store->executeQuery ( $sql, 1 );
		
		if ($listdb["pos_register"]) $db_store->setDatabase( $database );
		
		return $row;
	}

	public function delete()
	{
		global $db_store;

		$belong_to_reseller = $this->get('belong_to_reseller');
		if( $belong_to_reseller != '' && $belong_to_reseller != 0 )
			$belong_to_reseller = " AND `belong_to_reseller` = '$belong_to_reseller' ";
		else 
			$belong_to_reseller = '';

		$db_store->record_delete ( $db_store->tbl_fix."`pos_register`", " `id` = '$id' $belong_to_reseller " );

		return true;
	}

	public function search_pos( $keyword )
	{
		global $db_store;

		$belong_to_reseller = $this->get('belong_to_reseller');
		if( $belong_to_reseller != '' && $belong_to_reseller != 0 )
			$belong_to_reseller = " AND `belong_to_reseller` = '$belong_to_reseller' ";
		else 
			$belong_to_reseller = '';

		$keyword = str_replace('\'', '', $keyword);
		$sql = "SELECT * FROM ".$db_store->tbl_fix."`pos_register` WHERE (`store_name` LIKE '%".$keyword."%' OR `store_mobile` LIKE '%".$keyword."%' OR `store_title` LIKE '%".$keyword."%' ) $belong_to_reseller ORDER BY `store_title` LIMIT 10";
		
		$result = $db_store->executeQuery ( $sql );
		$kq = array();
		while ($row = mysqli_fetch_assoc( $result ) ) {
			$kq[] = $row;
		}

		return $kq;
	}

	public function get_all_option()
	{
		global $db_store;
		
		$belong_to_reseller = $this->get('belong_to_reseller');
		if( $belong_to_reseller != '' && $belong_to_reseller != 0 )
			$belong_to_reseller = " AND `belong_to_reseller` = '$belong_to_reseller' ";
		else 
			$belong_to_reseller = '';

		$sql = "SELECT id,store_title FROM ".$db_store->tbl_fix."`pos_register` WHERE 1 $belong_to_reseller ORDER BY `store_title`";
		$result = $db_store->executeQuery( $sql );
		
		$opt = '';
		while( $row = mysqli_fetch_assoc($result) ){
			$opt .= '<option value="'.$row['id'].'" >'.$row['store_title'].'</option>';
		}
		
		unset($row);
		mysqli_free_result($result);
		return $opt;
	}

	public function filter_pos($sort, $pos_type, $store_status, $store_theme, $keyword ='', $offset = '', $limit = ''){
		global $db_store;

		$sorting = '';

		if( !empty( $sort['store_title'] ) )
			if(	$sort['store_title'] == 'up'){
				$sorting = "ORDER BY `store_title` ASC ";
			}else{
				$sorting = "ORDER BY `store_title` DESC ";
			}
		if( !empty( $sort['store_name'] ) )
			if(	$sort['store_name'] == 'up'){
				$sorting = "ORDER BY `store_name` ASC ";
			}else{
				$sorting = "ORDER BY `store_name` DESC ";
			}
		if( !empty( $sort['customer'] ) )
			if(	$sort['customer'] == 'up'){
				$sorting = "ORDER BY `customer` ASC ";
			}else{
				$sorting = "ORDER BY `customer` DESC ";
			}
		if( !empty( $sort['created_at'] ) )
			if(	$sort['created_at'] == 'up'){
				$sorting = "ORDER BY `created_at` DESC ";
			}else{
				$sorting = "ORDER BY `created_at` ASC ";
			}
		if( !empty( $sort['expire_at'] ) )
			if(	$sort['expire_at'] == 'up'){
				$sorting = "ORDER BY `expire_at` ASC ";
			}else{
				$sorting = "ORDER BY `expire_at` DESC ";
			}

		if( $pos_type != '' ) $pos_type = " AND `pos_type` = '$pos_type' ";
		if( $store_status != '' ) $store_status = " AND `store_status` = '$store_status' ";
		if( $store_theme != '' ) $store_theme = " AND `store_theme` = '$store_theme' ";

		if( $limit != '' ) $limit = "LIMIT $offset,$limit";

		$belong_to_reseller = $this->get('belong_to_reseller');
		if( $belong_to_reseller != '' && $belong_to_reseller != 0 )
			$belong_to_reseller = " AND `belong_to_reseller` = '$belong_to_reseller' ";
		else 
			$belong_to_reseller = '';

		if( $keyword !== '' ){
			$keyword = "AND ( `store_name` = '$keyword' OR `store_title` = '$keyword' )";
		}
		
		$sql = "SELECT * FROM `pos_register` WHERE 1 $belong_to_reseller $keyword $pos_type $store_status $store_theme $sorting ".$limit;

		$kq = array();
		$result = $db_store->executeQuery( $sql );
		while( $row = mysqli_fetch_assoc($result) ){
			$kq[] = $row;
		}

		unset( $result );
		unset( $sql );
		return $kq;
	}
	
	public function filter_pos_count($pos_type, $store_status, $store_theme, $keyword = ''){
		global $db_store;

		if($pos_type != '') $pos_type = " AND `pos_type` = '$pos_type' ";
		if($store_status != '') $store_status = " AND `store_status` = '$store_status' ";
		if($store_theme != '') $store_theme = " AND `store_theme` = '$store_theme' ";

		$belong_to_reseller = $this->get('belong_to_reseller');
		if( $belong_to_reseller != '' && $belong_to_reseller != 0 )
			$belong_to_reseller = " AND `belong_to_reseller` = '$belong_to_reseller' ";
		else 
			$belong_to_reseller = '';

		if( $keyword !== '' ){
			$keyword = "AND ( `store_name` = '$keyword' OR `store_title` = '$keyword' )";
		}

		$sql = "SELECT COUNT(id) as total FROM `pos_register` WHERE 1 $pos_type $keyword $store_status $store_theme $belong_to_reseller ";

		$result = $db_store->executeQuery( $sql, 1);

		return ($result['total'] + 0);
	}

	public function list_per_page_count()
	{
		global $db_store;
		
		$belong_to_reseller = $this->get('belong_to_reseller');
		if( $belong_to_reseller != '' && $belong_to_reseller != 0 )
			$belong_to_reseller = " AND `belong_to_reseller` = '$belong_to_reseller' ";
		else 
			$belong_to_reseller = '';

		$sql = "SELECT COUNT(*) as total FROM ".$db_store->tbl_fix."`pos_register` WHERE 1 $belong_to_reseller";
		
		$result = $db_store->executeQuery ( $sql, 1 );
		return $result['total'] + 0;
	}
	
	public function list_per_page( $offset, $limit )
	{
		global $db_store;
		if( $limit != '' ) $limit = " LIMIT $offset,$limit";

		$belong_to_reseller = $this->get('belong_to_reseller');
		if( $belong_to_reseller != '' && $belong_to_reseller != 0 )
			$belong_to_reseller = " AND `belong_to_reseller` = '$belong_to_reseller' ";
		else 
			$belong_to_reseller = '';
		
		$sql = "SELECT pos_type,store_name FROM ".$db_store->tbl_fix."`pos_register` WHERE 1 $belong_to_reseller $limit";
		
		$result = $db_store->executeQuery ( $sql );
		return $result;
	}

	public function get_detail_bystore_name( $store_name, $domain = '' )
	{
		global $db_store, $domain_http_type, $main;

		$sqlDomain = '';
		if( $domain != '' )
			$sqlDomain = "OR ( `domain` = '$domain' AND `domain` <> '' )";

		$row = array();
		$sql = "SELECT * 
				FROM $db_store->tbl_fix`pos_register` 
				WHERE ( `store_name` = '$store_name' $sqlDomain )
				LIMIT 1";
		$row = $db_store->executeQuery ( $sql, 1 );
		
		if( $domain != '' && $domain == $row['domain'] ){
			$row['domain_http_type'] = $row['domain_http_type'] == '1' ? 'https://':'http://';
		}else{
			$row['domain_http_type'] = $domain_http_type;
		}
		return $row;
	}

	public function get_pos_retail_by( $id, $keyword )//keyword = email or mobile
	{
		global $db_store;

		$belong_to_reseller = $this->get('belong_to_reseller');
		if( $belong_to_reseller != '' && $belong_to_reseller != 0 )
			$belong_to_reseller = " AND `belong_to_reseller` = '$belong_to_reseller' ";
		else 
			$belong_to_reseller = '';

		$sql = "SELECT
				`id`,
				store_title `name`,
				customer `contact`,
				`store_address` `address`,
				`store_mobile` `mobile`,
				`store_email` `email`
				FROM ".$db_store->tbl_fix."`pos_register` WHERE `id` <> '$id' $belong_to_reseller AND `pos_type` = 'retail' AND ( `store_email` = '$keyword' OR `store_mobile` = '$keyword' ) LIMIT 1";
		
		$row = $db_store->executeQuery ( $sql, 1 );
		
		return $row;
	}
	
	public function get_detail_by_store( $store_name )
	{
		global $db_store;

		$belong_to_reseller = $this->get('belong_to_reseller');
		if( $belong_to_reseller != '' && $belong_to_reseller != 0 )
			$belong_to_reseller = " AND `belong_to_reseller` = '$belong_to_reseller' ";
		else 
			$belong_to_reseller = '';

		$sql = "SELECT * FROM ".$db_store->tbl_fix."`pos_register` WHERE `store_name` = '$store_name' $belong_to_reseller LIMIT 0,1";
		
		$row = $db_store->executeQuery ( $sql, 1 );
		return $row;
		
	}

	public function delete_store_name( $store_name )
	{
		global $db_store;

		$belong_to_reseller = $this->get('belong_to_reseller');
		if( $belong_to_reseller != '' && $belong_to_reseller != 0 )
			$belong_to_reseller = " AND `belong_to_reseller` = '$belong_to_reseller' ";
		else 
			$belong_to_reseller = '';

		$db_store->record_delete ( $db_store->tbl_fix."`pos_register`", " `store_name` = '$store_name' $belong_to_reseller " );
		
		return true;
	}

	// Lấy pos_register theo pos_type và db cho trang quản lý giao diện kh - DUy code 29/08/2022
	public function get_pos_for_theme($pos_type, $db){
		global $db_store;
		
		if( $db != ''){ $db = "AND `db` = '$db'"; }

		if( $pos_type != '' ) $pos_type = " AND `pos_type` = '$pos_type' ";
		
		$sql = "SELECT * FROM `pos_register` WHERE 1 $pos_type $db ";
		
		$kq = array();
		$result = $db_store->executeQuery( $sql );
		while( $row = mysqli_fetch_assoc($result) ){
			$kq[] = $row;
		}

		unset( $result );
		unset( $sql );
		return $kq;
	}

	// Lấy chi tiết pos_register bằng store_name
	public function get_pos_by_db_pos($db_name=''){
		global $db_store;

		if($db_name != ''){
			$db_name = "AND db = '$db_name'";
		}

		$sql = "SELECT * FROM $db_store->tbl_fix`pos_register` WHERE 1 $db_name LIMIT 1";
		
		$kq = $db_store->executeQuery( $sql, 1);
		return $kq;
	}

	// Lấy thông tin chi tiết của pos theo cột domain
	public function get_pos_by_domain( $store_name,$domain = '',$type_filter){
		global $db_store;
		// type_filter :  
		// + 1 : dùng để lấy thông tin chi tiết của pos theo cột domain
		// + 2 : dùng để lấy thông tin chi tiết của pos theo cột domain_theme
		if($type_filter == 1){
			$sqlDomain = '';
			if( $domain != '' ){
				$sqlDomain = "OR ( `domain` = '$domain' AND `domain` <> '' )";
			}	

			$sql = "SELECT * 
					FROM $db_store->tbl_fix`pos_register` 
					WHERE ( `store_name` = '$store_name' $sqlDomain)
					LIMIT 1";
			$kq = $db_store->executeQuery( $sql, 1);
		
		}elseif($type_filter == 2){
			$sqlDomainTheme = '';
			if( $domain != '' ){
				$sqlDomainTheme = "	AND `domain_theme` LIKE '%$domain%'
									AND `pos_type` = 'web_erp'";
			}
	
			$sql = "SELECT * 
					FROM $db_store->tbl_fix`pos_register`
					WHERE 1 
					$sqlDomainTheme
					ORDER BY `id` DESC
					LIMIT 1";
			$kq = $db_store->executeQuery( $sql, 1);
		}
		return $kq;
	}

	
	// Lấy thông tin chi tiết của pos theo cột domain
	public function get_pos_by_domain_theme( $domain_theme = ''){
		global $db_store;

		$sqlDomainTheme = '';
		if( $domain_theme != '' ){
			$sqlDomainTheme = "	AND`domain_theme` LIKE '%$domain_theme%'
								AND `pos_type` = 'web_erp'";
		}

		$sql = "	SELECT * 
					FROM $db_store->tbl_fix`pos_register`
					WHERE 1 
					$sqlDomainTheme
					LIMIT 1";
		$kq = $db_store->executeQuery( $sql, 1);
		return $kq;
	}

	// Lấy tất cả các store_name ngoại trừ store_name đang thao tác ra
	// kiểm tra domain xem có domain nào giống như domain_theme mà người dùng nhập vào hay ko
	public function check_domain_of_store_name($type_filter='',$theme_id=''){
		global $db_store;
		$store_name 			= $this->get('store_name');
		$domain_theme 			= $this->get('domain_theme');

		$sql_store_name 		= "";
		$sql_domain_theme_1 	= "";
		$sql_domain_theme_2 	= "";
		$sql_theme_id 			= "";
		
		// type_filter = 1 : tìm kiếm các pos khác có tồn tại domain mà người dùng nhập hay ko
		// type_filter = 2 : tìm kiếm trong pos hiện tại xem theme hiện tại có bị trùng domain nhập vào hay ko
		if($type_filter == 1){
			// trường hợp 1 : check xem các store_name khác ngoài store_name hiện tại đã có domain nào bị trùng với domain mà người dùng nhập hay ko
			// Nếu có thì kết quả là domain mà người dùng nhập vào bị trùng với domain được sử dụng ở store_name khác.
			if($store_name != ''){ $sql_store_name = "AND ps.`db` != '$store_name'"; }
			if($domain_theme != ''){ $sql_domain_theme_1 = "AND ps.`domain_theme` LIKE '%$domain_theme%'"; }
			if($store_name != ''){ $sql_domain_theme_2 = "AND ps.`domain_theme` NOT LIKE '%$store_name%'"; }
			// echo 'a';exit();
		}elseif($type_filter == 2){
			// trường hợp 2 : check xem cùng store_name , cùng theme xem có domain nào giống với domain mà người dùng nhập ko
			// Nếu có thì kết quả là domain có cùng store_name , cùng theme đã bị trùng với domain mà người dùng nhập
			if($store_name != ''){ $sql_store_name = "AND ps.`db` = '$store_name'"; }
			if($domain_theme != ''){ $sql_domain_theme_1 = "AND ps.`domain_theme` LIKE '%$domain_theme%'"; }
			if($theme_id != ''){ $sql_theme_id = "AND ps.`domain_theme` LIKE '%$theme_id%'"; }
		}

		$sql = "SELECT COUNT(*) total FROM $db_store->tbl_fix`pos_register` ps
				WHERE 1 
				$sql_store_name 
				$sql_domain_theme_1
				$sql_domain_theme_2
				$sql_theme_id
				";

		$kq = $db_store->executeQuery($sql,1);
		return $kq['total'] + 0;
	}


	// tìm kiếm các pos khác có tồn tại domain_theme mà người dùng nhập hay ko
	// public function check_domain_theme_exist_another_pos(){
	// 	global $db_store;
	// 	$store_name 			= $this->get('store_name');
	// 	$domain_theme 			= $this->get('domain_theme');

	// 	$sql_store_name 		= "";
	// 	$sql_domain_theme_1 	= "";
	// 	$sql_domain_theme_2 	= "";
	// 	$sql_theme_id 			= "";
		
	// 	// check xem các store_name khác ngoài store_name hiện tại đã có domain nào bị trùng với domain mà người dùng nhập hay ko
	// 	// Nếu có thì kết quả là domain mà người dùng nhập vào bị trùng với domain được sử dụng ở store_name khác.
	// 	if($store_name != ''){ $sql_store_name = "AND ps.`db` != '$store_name'"; }
	// 	if($domain_theme != ''){ $sql_domain_theme_1 = "AND ps.`domain_theme` LIKE '%$domain_theme%'"; }
	// 	if($store_name != ''){ $sql_domain_theme_2 = "AND ps.`domain_theme` NOT LIKE '%$store_name%'"; }
	
	// 	$sql = "SELECT COUNT(*) total FROM $db_store->tbl_fix`pos_register` ps
	// 			WHERE 1 
	// 			$sql_store_name 
	// 			$sql_domain_theme_1
	// 			$sql_domain_theme_2
	// 			$sql_theme_id
	// 			";
	// }
	
	// // Tìm kiếm trong pos hiện tại xem theme hiện tại có bị trùng domain người dùng nhập vào hay ko
	// public function check_domain_theme_same_theme_in_pos_exist($theme_id=''){
	// 	global $db_store;
	// 	$store_name 			= $this->get('store_name');
	// 	$domain_theme 			= $this->get('domain_theme');

	// 	$sql_store_name 		= "";
	// 	$sql_domain_theme 		= "";
	// 	$sql_theme_id 			= "";
		
	// 	// Check xem cùng store_name , cùng theme xem có domain nào giống với domain mà người dùng nhập ko
	// 	// Nếu có thì kết quả là domain có cùng store_name , cùng theme đã bị trùng với domain mà người dùng nhập
	// 	if($store_name != ''){ $sql_store_name = "AND ps.`db` = '$store_name'"; }
	// 	if($domain_theme != ''){ $sql_domain_theme = "AND ps.`domain_theme` LIKE '%$domain_theme%'"; }
	// 	if($theme_id != ''){ $sql_theme_id = "AND ps.`domain_theme` LIKE '%$theme_id%'"; }
	
	// 	$sql = "SELECT COUNT(*) total FROM $db_store->tbl_fix`pos_register` ps
	// 			WHERE 1 
	// 			$sql_store_name 
	// 			$sql_domain_theme
	// 			$sql_theme_id
	// 			";
	// 	$kq = $db_store->executeQuery($sql,1);
	// 	return $kq['total'] + 0;
	// }

	public function modify_domain_theme($db_name=''){
		global $db_store;

		$domain_theme 	= $this->get('domain_theme');
		$arr['domain_theme'] = $domain_theme;

		$sql = "UPDATE $db_store->tbl_fix`pos_register` 
				SET `domain_theme` = '$domain_theme'
				WHERE `db` = '$db_name'
				";
		$db_store->executeQuery($sql);
		// $db_store->record_update( "`pos_register`", $arr, " `db` = '$db_name' " );
		return true;
	}

	public function get_pos_active($theme_id = '', $theme_domain = ''){
		if($theme_domain == ''){
			$arr_server_name = explode('.',$_SERVER['SERVER_NAME']);
			$dt_pos_by_domain = $this->get_pos_by_domain($arr_server_name[0],$_SERVER['SERVER_NAME'],1);
		}else{
			$arr_server_name = explode('.',$theme_domain);
			$dt_pos_by_domain = $this->get_pos_by_domain($arr_server_name[0],$theme_domain,1);
		}
        

		// kiểm tra : 
        // Nếu tìm được pos_register bằng domain thì vẫn load theme như bình thường
		if(isset($dt_pos_by_domain) && $dt_pos_by_domain['id'] != ''){
			// var_dump($dt_pos_by_domain['domain_theme']);exit();
			$dt_pos_by_domain['domain_theme'] = array();

			return $dt_pos_by_domain['domain_theme'];
        }else{
            // Nếu không tìm được pos_register bằng domain tìm pos_register bằng domain_theme
    		// + 2 : dùng để lấy thông tin chi tiết của pos theo cột domain_theme
			if($theme_domain == ''){
				$dt_pos_by_domain_theme = $this->get_pos_by_domain('',$_SERVER['SERVER_NAME'],2);
			}else{
				$dt_pos_by_domain_theme = $this->get_pos_by_domain('',$theme_domain,2);
			}
            
            // Lấy tất cả các theme có chứa domain_theme và thuộc web
			
			$item = array();
            if($dt_pos_by_domain_theme['domain_theme'] != '' && is_array(json_decode($dt_pos_by_domain_theme['domain_theme'],true)) ){
				// is_object(json_decode($dt_pos_by_domain_theme['domain_theme'],true));exit();
				$arr_domain_theme = json_decode($dt_pos_by_domain_theme['domain_theme'], true);
				if($theme_domain == ''){
					foreach($arr_domain_theme as $key => $value){
						if($theme_id != ''){
							if($value['folder'] != ''){
								if($value['theme'] == $theme_id && $value['domain_theme'] == $_SERVER['SERVER_NAME']){
									$item[] = $value;
								}
							}
						}
					}
				}else{
					foreach($arr_domain_theme as $key => $value){
						if($theme_id != ''){
							if($value['folder'] != ''){
								if($value['theme'] == $theme_id && $value['domain_theme'] == $theme_domain){
									$item[] = $value;
								}
							}
						}
					}
				}
				
				return $item;
			}else{
				return $item;
			}
        }
	}

	public function get_detail_by_short_name2( $store_name, $domain = '' )
	{
		global $db_store, $domain_http_type;

		$belong_to_reseller = $this->get('belong_to_reseller');
		if( $belong_to_reseller != '' && $belong_to_reseller != 0 )
			$belong_to_reseller = " AND `belong_to_reseller` = '$belong_to_reseller' ";
		else 
			$belong_to_reseller = '';


		$sqlDomain = '';
		if( $domain != '' )
			$sqlDomain = "OR ( `domain` = '$domain' AND `domain` <> '' )";

		$row = array();
		$sql = "SELECT * 
				FROM $db_store->tbl_fix`pos_register` 
				WHERE ( `store_name` = '$store_name' $sqlDomain )
				$belong_to_reseller
				LIMIT 1";
		$row = $db_store->executeQuery ( $sql, 1 );

		// kiểm tra xem link domain của pos_register có tồn tại record nào hay ko
		// Nếu ko có thì tìm link trong cột domain_members_card để tìm record 
		if(!isset($row['id'])){
			// cắt chuỗi domain thành mảng chứa tên và đuôi của domain
			$arr_domain = explode('.',$domain);
			$sql_2 = "	SELECT * 
						FROM $db_store->tbl_fix`pos_register`
						WHERE `domain_members_card` LIKE '%".$arr_domain['0']."%'
						AND `pos_type` = 'web_erp' 
						LIMIT 1";
			$row_2 = $db_store->executeQuery ( $sql_2, 1 );
			$row = $row_2;
		}

		if( $domain != '' && $domain == $row['domain'] ){
			$row['domain_http_type'] = $row['domain_http_type'] == '1' ? 'https://':'http://';
		}else{
			$row['domain_http_type'] = $domain_http_type;
		}
		return $row;
	}

	public function get_info_card($web_type){
		global $setup;
		$theme = new theme();
		$theme->set('type', $web_type);

		// Lấy chi tiết pos_register bằng domain
        $arr_server_name = explode('.',$_SERVER['SERVER_NAME']);
        $kq = array();
		
		$dt_pos_by_domain_theme = $this->get_pos_by_domain('',$arr_server_name[0],2);
		
		$arr_domain_members_card = array();
		if($dt_pos_by_domain_theme['domain_theme'] != '' && is_array(json_decode($dt_pos_by_domain_theme['domain_theme'],true)) ){
			$arr_domain_members_card = json_decode($dt_pos_by_domain_theme['domain_theme'], true);
		}

		// $value['short_name'].'.sees.vn'
		foreach ($arr_domain_members_card as $key => $value) {
			if($_SERVER['SERVER_NAME'] == $arr_server_name[0].'.'.$setup['domain_card']){
				$kq = $value;
			}elseif($value['type'] == 'card' && $value['short_name'].'.local' == $_SERVER['SERVER_NAME']){
				$kq = $value;
			}
			elseif(strpos($value['domain_members_card'], $_SERVER['SERVER_NAME']) != ''){
				$kq = $value;
			}
		}

		return $kq;
	}
}