<?php
require_once __DIR__.'/../include/session.php';
require_once __DIR__.'/../include/db.php';
require_once __DIR__.'/../include/global.php';
require_once __DIR__.'/../include/model.php';
require_once __DIR__.'/../include/pos_register.php';

$db_store = new db();

$server_sql             = 'localhost';
$user_sql               = 'root';
$pass_sql               = '';
$database               = 'project_store';
$db_retail_refix        = 'project_';
$db_cafe_refix          = 'project_';

$db_store->setServer   ( $server_sql );
$db_store->setUsername ( $user_sql );
$db_store->setPassword ( $pass_sql );
$db_store->setDatabase ( $database );
$db_store->tbl_fix = $db_store->getDatabase().'.';
$db_pos = explode('.', $_SERVER['SERVER_NAME']);

if( COUNT($db_pos) > 2 ){
    $db_pos = $db_pos['0'];
}else{
    $db_pos = '';
}

$domain_http_type = 'http://';
