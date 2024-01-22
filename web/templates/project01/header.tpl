<!DOCTYPE html>
<html lang="vi" debug="true">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta name="keywords" content="Chưa biết để gì" />
    <title>Chưa biết để gì</title>
    <link href="{$domain}favicon.ico" rel="shortcut icon" />
    <link href="{$domain}public/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="{$domain}public/bootstrap/css/bootstrap.css" rel="stylesheet" />
    <link href="{$domain}public/css/global.css" rel="stylesheet">
    <link href="{$domain}public/css/jquery.datetimepicker.css" rel="stylesheet">
    <link href="{$domain}public/css/jquery.datetimepicker.min.css" rel="stylesheet">
    <link href="{$domain}public/css/vanillaSelectBox.css" rel="stylesheet">
    <link href="{$domain}public/css/main.css" rel="stylesheet">
    {* <link href="{$domain}public/css/font-awesome.css" rel="stylesheet"> *}
</head>
<body>
    <div class="header" style="background-color: #172226;">
        <div class="header-main">
            <div class="container">
                <div class="row">
                    <div class="col-md-1 col-sm-1 col-xs-12 logo">
                        <a href="/">
                            <img src="{$domain}public/images/favicon-removebg-preview.png" width="80px" height="84px" alt="">
                        </a>
                    </div>
                    {* Thanh menu ở đây *}
                    <div class="col-md-10 col-sm-10 col-xs-12 menu">
                        <div class="header-menu">
                            <div class="container">
                                <div class="header-menu1 d-flex justify-content-center">
                                    <div class="menu-top">
                                        {include file="`$tpldirect`menu/menu_top.tpl" menu=$menu}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {* Icon thông tin như profile, cart, notification ở đây *}
                    <div class="col-md-1 col-sm-1 col-xs-12">
                        <div class="container">
                            <div class="mt-3 d-flex justify-content-center header-icon">
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
</div>