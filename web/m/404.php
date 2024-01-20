<?php

if( $act == 'index' ){
	$meta_title .= '404 lỗi đường dẫn không tồn tại';
	
}else{
	$main->redirect($domain);
}
