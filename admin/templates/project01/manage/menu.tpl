<div class="layout-page">
	{* {include file="`$tpldirect`menu/search.tpl"} *}
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
</div>