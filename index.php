<?php
error_reporting(E_ALL & ~E_NOTICE);
ini_set('display_errors', true);
ini_set('display_startup_errors', true);
require_once __DIR__.'/#directconfig/config.php';

$pos_register = new pos_register();
$db = new db();
$main = new main();
$model = new model();
$dataStore = $pos_register->get_detail_bystore_name($db_pos, $_SERVER['SERVER_NAME'] );
if(isset($dataStore['pos_type']) ){
	date_default_timezone_set( $dataStore['time_zone'] );
	$default_time_zone 	= $dataStore['time_zone'];
	$db_pos 					= $dataStore['store_name'];
	$domain_http_type 	= $dataStore['domain_http_type'];
	$pos_created 			= $dataStore['created_at'];
	$_SESSION['db_pos'] 	= $db_pos;
	$globalSetup 			= $main->globalSetup();			
	if( $dataStore['pos_type'] == 'admin'  ){
		if(isset($dataStore['source']) && $dataStore['source'] != '' ){
			include ($dataStore['source'].'/index.php');
		}
	}elseif($dataStore['pos_type'] == 'web'  ){
		if(isset($dataStore['db']) && $dataStore['db'] != ''){
			$db_pos = $dataStore['db'];
			if(isset($dataStore['source']) && $dataStore['source'] != '' ){
				include ($dataStore['source'].'/index.php');
				die;
			}
		}else{
			$main->alert('Không thể khởi chạy ứng dụng.');
		}
	}else{
		$main->alert('Not found type shop');
	}
}else{
	$main->alert('Không tìm thấy website có đường dẫn này: '.$db_pos);
}
@$db_store->close();
