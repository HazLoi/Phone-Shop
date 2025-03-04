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
						<input id="keyword" type="text" class="form-control" placeholder="Tên khách hàng">
						<button type="button" class="btn btn-info btn-search-eye" id="btn_find_user">
							<i class="fa fa-eye"></i>&nbsp;Xem
						</button>
					</div>
				</div>
				<div class="col-md-2 col-lg-2">
					<button type="button" class="btn btn-success" id="add_user">Thêm khách hàng</button>
					<div class="modal fade" id="modalAddUser" tabindex="-1" aria-hidden="true">
						<div class="modal-dialog modal-xl" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="modalAddUserLabel">Thêm khách hàng</h5>
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								</div>
								<div class="modal-body">
									<div class="row">
										<div class="receipt-form">
											<div class="form-group">
												<label for="fullName">Họ tên:</label>
												<input type="text" id="fullName" name="fullName" class="form-control">
											</div>
											<div class="form-group">
												<label for="phoneNumber">Số điện thoại:</label>
												<input type="text" id="phoneNumber" name="phoneNumber" class="form-control">
											</div>
											<div class="form-group">
												<label for="transactionDate">Ngày thu/chi:</label>
												<input type="date" id="transactionDate" name="transactionDate" class="form-control">
											</div>
											<div class="form-group">
												<label for="address">Địa chỉ:</label>
												<input type="text" id="address" name="address" class="form-control">
											</div>
											<div class="form-group">
												<label for="amount">Số tiền:</label>
												<input type="number" id="amount" name="amount" class="form-control">
											</div>
											<div class="form-group">
												<label for="debt">Còn nợ:</label>
												<input type="number" id="debt" name="debt" class="form-control">
											</div>
											<div class="form-group">
												<label for="reason">Lý do:</label>
												<input type="text" id="reason" name="reason" class="form-control">
											</div>
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
						<div id="lUser" class="card-body"></div>
					</div>
				</div>
			</div>
			<div class="row mt-3">
				<div id="page_html" class="col-12"></div>
			</div>
		</div>
		<div class="content-backdrop fade"></div>
	</div>
</div>