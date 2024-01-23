<?php

if( $act == 'index' ){
	$title .= '404 lỗi đường dẫn không tồn tại';
	$st->assign('title', $title);
}else{
	$main->redirect($page_404);
}
