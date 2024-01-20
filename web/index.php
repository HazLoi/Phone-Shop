<?php
error_reporting(E_ALL);
ini_set('display_errors', true);
ini_set('display_startup_errors', true);
include 'define.php';

$title 	= '';
$m 		= $main->get('m');
$act 		= $main->get('act');

if($m == ''){
	$m = 'home';
}
if($act == ''){
	$act = 'index';
}

if( isset($setup['lang']) && in_array($setup['lang'],array('vi','en')) ){
	include 'lang/'.$setup['lang'].'/home.php';//load ngôn ngữ lên
	$_SESSION['lang'] = $setup['lang'];
}else{
	$_SESSION['lang'] = 'vi';
	include 'lang/vi/home.php';
}

$dataStore = $pos_register->get_detail_bystore_name($db_pos, $_SERVER['SERVER_NAME'] );
$tpldirect = $tpldirect.$dataStore['store_theme'].'/';
$themes_folder = $tpldomain.'templates/'.$dataStore['store_theme'].'/';

$stemp = 'm/'.$m.'.php';
$temp = $m . '/' . $act . '.tpl';
include $stemp;

$st->assign('temp', $temp);
$st->assign('m', $m);
$st->assign('act', $act);
$st->assign('session', $_SESSION);
$st->assign('title', $title);
$st->assign('domain', $tpldomain);
$st->assign('link', $link);
$st->assign('subdirect', $subdirect);
$st->assign('rewrite_url', $rewrite_url);
$st->assign('themes_folder', $themes_folder);
$st->assign('tpldirect', $tpldirect);
$st->assign('tpldomain', $tpldomain);
$st->assign('lang', $lang);

unset($setting);
unset($setup);
unset($lang);

$st->display($tpldirect.'index.tpl');

$db->close();