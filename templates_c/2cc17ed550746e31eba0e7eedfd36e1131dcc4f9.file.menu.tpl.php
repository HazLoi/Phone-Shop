<?php /* Smarty version Smarty-3.1.18, created on 2025-02-09 14:03:17
         compiled from "D:\a_project_2024\General\admin\templates\project01\manage\menu.tpl" */ ?>
<?php /*%%SmartyHeaderCode:68554598367a85335a75985-32956771%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2cc17ed550746e31eba0e7eedfd36e1131dcc4f9' => 
    array (
      0 => 'D:\\a_project_2024\\General\\admin\\templates\\project01\\manage\\menu.tpl',
      1 => 1708875436,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '68554598367a85335a75985-32956771',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_67a85335aca553_11036801',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_67a85335aca553_11036801')) {function content_67a85335aca553_11036801($_smarty_tpl) {?><div class="layout-page">
	
	<div class="content-wrapper">
		<div class="container-xxl flex-grow-1 container-p-y">
			<div class="row mb-2">
				<div class="col-md-2 col-lg-2">
					<select class="form-select" id="menu_is_hidden">
						<option value="">Trạng thái</option>
						<option value="0">Hiện</option>
						<option value="1">Ẩn</option>
					</select>
				</div>
				<div class="col-md-4 col-lg-4">
					<div class="position-relative">
						<input id="keyword" type="text" class="form-control" placeholder="Tên menu">
						<button type="button" class="btn btn-info btn-search-eye" id="btn_find_menu">
							<i class="fa fa-eye"></i>&nbsp;Xem
						</button>
					</div>
				</div>
				<div class="col-md-2 col-lg-2">
					<button type="button" class="btn btn-success" id="add_menu">Thêm menu</button>
					<div class="modal fade" id="modalAddMenu" tabindex="-1" aria-hidden="true">
						<div class="modal-dialog modal-xl" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="modalAddMenuLabel">Thêm menu</h5>
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								</div>
								<div class="modal-body">
									<div class="row">
										<div class="col-md-6 col-lg-6 mb-3">
											<label for="name" class="form-label">Tên menu</label>
											<input type="text" id="name" class="form-control" placeholder="Tên menu" />
										</div>
										<div class="col-md-6 col-lg-6 mb-3">
											<label for="root_id" class="form-label">Vị trí menu</label>
											<select class="form-select" id="root_id"></select>
										</div>
									</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Đóng</button>
									<button type="button" class="btn btn-primary" id="btnModalAddMenu">Lưu</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 col-lg-12">
					<div class="card">
						<div id="lMenu"></div>
					</div>
				</div>
			</div>
			<div class="row mt-3">
				<div id="page_html"></div>
			</div>
		</div>
		<div class="content-backdrop fade"></div>
	</div>
</div><?php }} ?>
