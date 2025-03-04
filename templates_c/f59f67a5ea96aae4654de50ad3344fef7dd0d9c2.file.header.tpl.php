<?php /* Smarty version Smarty-3.1.18, created on 2025-02-17 22:37:38
         compiled from "D:\a_project_2024\General\web\templates\project01\header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:138376866167b357c248c4b1-37556831%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f59f67a5ea96aae4654de50ad3344fef7dd0d9c2' => 
    array (
      0 => 'D:\\a_project_2024\\General\\web\\templates\\project01\\header.tpl',
      1 => 1705982700,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '138376866167b357c248c4b1-37556831',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'domain' => 0,
    'tpldirect' => 0,
    'menu' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_67b357c261a136_75164825',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_67b357c261a136_75164825')) {function content_67b357c261a136_75164825($_smarty_tpl) {?><!DOCTYPE html>
<html lang="vi" debug="true">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta name="keywords" content="Chưa biết để gì" />
    <title>Chưa biết để gì</title>
    <link href="<?php echo $_smarty_tpl->tpl_vars['domain']->value;?>
favicon.ico" rel="shortcut icon" />
    <link href="<?php echo $_smarty_tpl->tpl_vars['domain']->value;?>
public/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="<?php echo $_smarty_tpl->tpl_vars['domain']->value;?>
public/bootstrap/css/bootstrap.css" rel="stylesheet" />
    <link href="<?php echo $_smarty_tpl->tpl_vars['domain']->value;?>
public/css/global.css" rel="stylesheet">
    <link href="<?php echo $_smarty_tpl->tpl_vars['domain']->value;?>
public/css/jquery.datetimepicker.css" rel="stylesheet">
    <link href="<?php echo $_smarty_tpl->tpl_vars['domain']->value;?>
public/css/jquery.datetimepicker.min.css" rel="stylesheet">
    <link href="<?php echo $_smarty_tpl->tpl_vars['domain']->value;?>
public/css/vanillaSelectBox.css" rel="stylesheet">
    <link href="<?php echo $_smarty_tpl->tpl_vars['domain']->value;?>
public/css/main.css" rel="stylesheet">
    
</head>
<body>
    <div class="header" style="background-color: #172226;">
        <div class="header-main">
            <div class="container">
                <div class="row">
                    <div class="col-md-1 col-sm-1 col-xs-12 logo">
                        <a href="/">
                            <img src="<?php echo $_smarty_tpl->tpl_vars['domain']->value;?>
public/images/favicon-removebg-preview.png" width="80px" height="84px" alt="">
                        </a>
                    </div>
                    
                    <div class="col-md-10 col-sm-10 col-xs-12 menu">
                        <div class="header-menu">
                            <div class="container">
                                <div class="header-menu1 d-flex justify-content-center">
                                    <div class="menu-top">
                                        <?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['tpldirect']->value)."menu/menu_top.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('menu'=>$_smarty_tpl->tpl_vars['menu']->value), 0);?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-1 col-sm-1 col-xs-12">
                        <div class="container">
                            <div class="mt-3 header-icon">
                                <div class="ms-1 me-1 mt-3">
                                    <i style="font-size: 20px;" class="fa-solid fa-bag-shopping"></i>
                                </div>
                                <div class="ms-1 me-1 mt-3">
                                    <i style="font-size: 20px;" class="fa-regular fa-user"></i>
                                </div>
                                <div class="ms-1 me-1 mt-3">
                                    <i style="font-size: 20px;" class="fa-regular fa-bell"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><?php }} ?>
