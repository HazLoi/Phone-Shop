<?php
$db_pos         = 'phoneshop';
$server_sql     = 'localhost';
$user_sql       = 'root';
$pass_sql       = '';
$database       = 'project_'.$db_pos.'';

$db     	= new db();
$setting  = new setting();
$db->setUsername ( $user_sql );
$db->setPassword ( $pass_sql );
$db->setServer ( $server_sql );
$db->setDatabase ( $database );
$db->tbl_fix    = $database.'.';

$link 		= $domain_http_type.$_SERVER['SERVER_NAME'].'/';
$tpldomain 	= $domain_http_type.$_SERVER['SERVER_NAME'].'/web/';
$rewrite_url 	= $domain_http_type.$_SERVER['SERVER_NAME'].'/';
$subdirect 	= '/web';
$tpldirect 	= __DIR__.'/../templates/'; 

$st->assign('folder', 'web');

$setup = $setting->showall();
$st->assign('setup', $setup);
$st->assign('db_pos', $db_pos);
