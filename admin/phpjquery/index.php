<?php
error_reporting(E_ALL);
ini_set('display_errors', true);
ini_set('display_startup_errors', true);
require_once __DIR__.'/../../#directconfig/config.php';

$main = new main();
$pos_register = new pos_register();
$dataStore = $pos_register->get_detail_bystore_name( $db_pos, $_SERVER['SERVER_NAME'] );

$db_pos 			= $dataStore['store_name'];
$domain_http_type 	= $dataStore['domain_http_type'];
//Nếu custome db => chỉnh lại cho đúng
if( isset($dataStore['db']) && $dataStore['db'] != '' ){
	$db_pos = $dataStore['db'];
}
$_SESSION['db_pos'] = $db_pos;

date_default_timezone_set( $dataStore['time_zone'] );
$default_time_zone = $dataStore['time_zone'];//set default time_zone

include '../define.php';
include '../m/global.php';

$m 		= $main->get('m');
$act 		= $main->get('act');

if( isset($_SESSION['lang']) && in_array($_SESSION['lang'],array('vi','en')) ){
	include '../lang/'.$_SESSION['lang'].'/home.php';
}else{
	include '../lang/vi/home.php';
	$_SESSION['lang'] = 'vi';
}
include $m . '.php';
@$db->close();
