let thePage = {};
thePage.user_is_hidden = '';
thePage.keyword = '';
thePage.page = 1;
thePage.user_edit_id = '';
thePage.data_user = '';

$(function () {
	thePage.filter();
})

thePage.filter = () => {
	let data = new FormData();
	data.append('is_hidden', thePage.user_is_hidden);
	data.append('keyword', thePage.keyword);
	data.append('page', thePage.page);
	_doAjaxNod("POST", data, "manage_user", "idx", "filter", true, function (res) {
		thePage.data_user = res.data.lUser;
		$('#lUser').html(thePage.render(res.data.lUser, res.data.offset));
		$('#position').html(thePage.render_position(res.data.lPosition))
		$('#page_html').html(res.data.page_html);
	});
}

thePage.render = (kq, offset) => {
	let html = `
	<table class="table table-hover col-md-12 col-lg-12">
		<tr>
			<th width="3%" class="text-center">#</th>
			<th>Tên thành viên</th>
			<th>Số điện thoại</th>
			<!--<th>Email</th>-->
			<th>Địa chỉ</th>
			<th>Chức vụ</th>
			<th>Trạng thái</th>
			<th class="text-end">@</th>
		</tr>
	`;
	let i = offset;
	kq.forEach(item => {
			html += `
			<tr>
				<td width="3%" class="text-center">${i++}</td>
				<td>${item.fullname}</td>
				<td>${item.mobile}</td>
				<!--<td>${item.email}</td>-->
				<td>${item.address}</td>
				<td>${item.position_name==null?'Mặc định':item.position_name}</td>
				<td class="${item.status==0?'text-danger':'text-success'}">${item.status==0?'Khóa':'Hoạt động'}</td>
				<td class="d-flex text-center">
					<button class="border-0 btn btn-primary edit_user" user-id="${item.id}"><i class="fa-solid fa-pen-to-square"></i></button>
					<button class="border-0 btn btn-danger remove_user" user-id="${item.id}"><i class="fa-solid fa-trash"></i></button>
				</td>
			</tr>`;
	});
	html += '</table>';
	return html;
}

thePage.render_position = (kq) => {
	let html = '';

	html =  `<option value="0">Chọn chức vụ</option>`;
	kq.forEach(item=> {
		html += `
			<option value="${item.id}">${item.name}</option>
		`;
	})

	return html;
}

function change_page(page) {
	thePage.page = page;
	thePage.filter();
}

function reset_modal() {
	$('#modalAddUserLabel').html('Thêm nhân viên');
	$('#fullname').val('');
	$('#password').val('');
	$('#position').val(0);
	$('#mobile').val('');
	$('#email').val('');
	$('#address').val('');
	$('#status').val(0);
	thePage.user_edit_id = '';
}

$(document).on('click', '#add_user', function(){
	reset_modal();
	$('#modalAddUser').modal('show');
})

$(document).on('click', '.edit_user', function(){
	reset_modal();
	let id = $(this).attr('user-id');
	thePage.user_edit_id = id;

	let data = new FormData();
	data.append('id', id);
	_doAjaxNod("POST", data, "manage_user", "save", "detail", true, function (res) {
		$('#modalAddUserLabel').html('Chỉnh sửa tài khoản');
		$('#fullname').val(res.data.fullname);
		$('#mobile').val(res.data.mobile);
		$('#address').val(res.data.address);
		$('#email').val(res.data.email);
		$('#position').val(res.data.position);
		$('#status').val(res.data.status);
		$('#modalAddUser').modal('show');
	});
})

$(document).on('click', '#save_user', function(){
	$('.error_label').remove();
	let flag = false;
	let fullname = $('#fullname');
	let mobile = $('#mobile');
	let address = $('#address');
	let email = $('#email');
	let position = $('#position');
	let status = $('#status');
	let password = $('#password');

	if (fullname.val().trim() == '') {
		fullname.after('<span class="error_label">Vui lòng nhập tên tài nhân viên</span>')
		flag = true;
	}

	if (mobile.val().trim() == '') {
		mobile.after('<span class="error_label">Vui lòng nhập số điện thoại</span>')
		flag = true;
	}else if(!mobileIsValid(mobile.val())){
		mobile.after('<span class="error_label">Số điện thoại không đúng định dạng</span>')
		flag = true;
	}

	if (address.val().trim() == '') {
		address.after('<span class="error_label">Vui lòng nhập địa chỉ</span>')
		flag = true;
	}

	if (position.val() == 0) {
		position.after('<span class="error_label">Vui lòng chọn chức vụ</span>')
		flag = true;
	}

	if (password.val() == '') {
		password.after('<span class="error_label">Vui lòng nhập mật khẩu</span>')
		flag = true;
	}

	if (flag) {
		return false;
	} else {
		let data = new FormData();
		data.append('id', thePage.user_edit_id);
		data.append('fullname', fullname.val());
		data.append('mobile', mobile.val());
		data.append('address', address.val());
		data.append('email', email.val());
		data.append('position', position.val());
		data.append('status', status.val());
		data.append('password', password.val());
		_doAjaxNod("POST", data, "manage_user", "save", "save", true, function (res) {
			$('#modalAddUser').modal('hide');
			thePage.filter();
		});
	}
})