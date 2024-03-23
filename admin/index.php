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

$permission = new permission();
$lPermission = $permission->menu_load('');
$st->assign('lPermission', $lPermission);

if(!isset($_SESSION['username']) || !isset($_SESSION['pass']) ) {
	if(isset($_COOKIE['username']) && isset($_COOKIE['pass'])){
		$dUser = $user->get_detail($_COOKIE['username']);
		if( $duser['status'] == 'Active' && $dUser['password'] == $_COOKIE['pass'] ){
			$_SESSION['username'] 	= $dUser['username'];
			$_SESSION['fullname'] 	= $dUser['fullname'];
			$_SESSION['pass'] 		= $dUser['password'];
			$_SESSION['shop_id'] 	= $dUser['shop_id'];
			$_SESSION['gid'] 		= $dUser['gid'];
			setcookie('username', $_SESSION['username'], time() + 640000);
			setcookie('pass', $_SESSION['pass'], time() + 640000);
			setcookie('temp_area', @$_SESSION['temp_area'], time() + 640000);
			setcookie($_SESSION['username'].'_security', $dUser['security'] , time() + 6400000);
		}
	}

}else{
	unset($_SESSION['username']);
	unset($_SESSION['password']);
	unset($_SESSION['shop_id']);

	$main->alert( $lang['nt_closedShift'] );
	$main->redirect($link.'/?m=user&act=login');
	$db->close();
	exit();
}

$_SESSION['lang'] = 'vi';
include 'lang/vi/home.php';

$dataStore = $pos_register->get_detail_bystore_name($db_pos, $_SERVER['SERVER_NAME'] );
$tpldirect = $tpldirect.$dataStore['store_theme'].'/';
$themes_folder = $tpldomain.'templates/'.$dataStore['store_theme'].'/';
$page_404 = $link.'404';

$setting = new setting();
$setup = $setting->showall();

$menu = new menu();
$list_menu = $menu->list_menu();

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
$st->assign('setup', $setup);
$st->assign('menu', $list_menu);
$st->assign('_SERVER', $_SERVER);
$st->assign('page_404', $page_404);

unset($setting);
unset($setup);
unset($lang);

$st->display($tpldirect.'index.tpl');

$db->close();