<?php /* Smarty version Smarty-3.1.18, created on 2025-02-09 14:11:00
         compiled from "D:\a_project_2024\General\admin\templates\project01\manage\user.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2872969967a85339a28579-93081060%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7ef48c03c7417816581d5d7455f5f57de5bd21de' => 
    array (
      0 => 'D:\\a_project_2024\\General\\admin\\templates\\project01\\manage\\user.tpl',
      1 => 1739084929,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2872969967a85339a28579-93081060',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_67a85339a77fb9_69155228',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_67a85339a77fb9_69155228')) {function content_67a85339a77fb9_69155228($_smarty_tpl) {?><div class="layout-page">
	
	<div class="content-wrapper">
		<div class="container-xxl flex-grow-1 container-p-y">
			<div class="row mb-2">
				<div class="col-md-2 col-lg-2">
					<select class="form-select" id="menu_is_hidden">
						<option value="">Trạng thái</option>
						<option value="0">Khóa</option>
						<option value="1">Hoạt động</option>
					</select>
				</div>
				<div class="col-md-4 col-lg-4">
					<div class="position-relative">
						<input id="keyword" type="text" class="form-control" placeholder="Tên nhân viên">
						<button type="button" class="btn btn-info btn-search-eye" id="btn_find_user">
							<i class="fa fa-eye"></i>&nbsp;Xem
						</button>
					</div>
				</div>
				<div class="col-md-2 col-lg-2">
					<button type="button" class="btn btn-success" id="add_user">Thêm nhân viên</button>
					<div class="modal fade" id="modalAddUser" tabindex="-1" aria-hidden="true">
						<div class="modal-dialog modal-xl" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="modalAddUserLabel">Thêm nhân viên</h5>
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								</div>
								<div class="modal-body">
									<div class="row">
										<div class="col-md-6 col-lg-6 mb-3">
											<label for="fullname" class="form-label">Tên nhân viên</label>
											<input type="text" id="fullname" class="form-control" placeholder="Tên nhân viên" />
										</div>
										<div class="col-md-6 col-lg-6 mb-3">
											<label for="password" class="form-label">Mật khẩu</label>
											<input type="text" id="password" class="form-control" placeholder="Mật khẩu" />
										</div>
										<div class="col-md-6 col-lg-6 mb-3">
											<label for="position" class="form-label">Chức vụ</label>
											<select class="form-select" id="position"></select>
										</div>
										<div class="col-md-6 col-lg-6 mb-3">
											<label for="mobile" class="form-label">Số điện thoại</label>
											<input type="text" id="mobile" class="form-control" placeholder="Số điện thoại" />
										</div>
										<div class="col-md-6 col-lg-6 mb-3">
											<label for="email" class="form-label">Email</label>
											<input type="text" id="email" class="form-control" placeholder="Email"  autocomplete="email"/>
										</div>
										<div class="col-md-6 col-lg-6 mb-3">
											<label for="address" class="form-label">Địa chỉ</label>
											<input type="text" id="address" class="form-control" placeholder="Địa chỉ" autocomplete="address" />
										</div>
										<div class="col-md-6 col-lg-6 mb-3">
											<label for="status" class="form-label">Trạng thái</label>
											<select class="form-select" id="status">
												<option value="0">Khóa</option>
												<option value="1">Hoạt động</option>
											</select>
										</div>
									</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Đóng</button>
									<button type="button" class="btn btn-primary" id="save_user">Lưu</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 col-lg-12">
					<div class="card">
						<div id="lUser"></div>
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
