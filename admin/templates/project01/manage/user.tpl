<div class="layout-page">
	{* {include file="`$tpldirect`menu/search.tpl"} *}
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
</div>