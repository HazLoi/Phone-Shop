<?php
if ($act == 'index') {
    $st->assign('title', 'Trang chủ');
} else {
    $main->redirect($tpldomain);
}
