let thePage = {};
thePage.menu_is_hidden = '';
thePage.keyword = '';
thePage.page = 1;
thePage.menu_edit_id = '';

thePage.data_menu = '';

$(function () {
	thePage.filter();
})

thePage.filter = () => {
	let data = new FormData();
	data.append('is_hidden', thePage.menu_is_hidden);
	data.append('keyword', thePage.keyword);
	data.append('page', thePage.page);
	_doAjaxNod("POST", data, "manage_menu", "idx", "filter", true, function (res) {
		thePage.data_menu = res.data.lMenu;
		$('#root_id').html(thePage.render_select_menu(res.data.lMenu, res.data.offset));
		$('#lMenu').html(thePage.render(res.data.lMenu, res.data.offset));
		$('#page_html').html(res.data.page_html);
	});
}

thePage.render_select_menu = (kq) => {
	let html = '';
	html = '<option value="0">Menu chính</option>';
	kq.forEach(item => {
		if (item.root_id == 0) {
			html += `<option value="${item.id}">${item.name}</option>`;
			if (item.root_menu.length > 0) {
				html += thePage.render_select_menu_child(item.root_menu, 1);
			}
		}
	});

	return html;
}

thePage.render_select_menu_child = (kq, level) => {
	let html = '';
	let before_name = '-- ';
	for (let i = 1; i < level; i++) {
		before_name += before_name;		
	}

	kq.forEach(item => {
		html += `<option value="${item.id}">${before_name} ${item.name}</option>`;
		if (item.root_menu.length > 0) {
			html += thePage.render_select_menu_child(item.root_menu, 2);
		}
	});

	return html;
}

thePage.render = (kq, i) => {
	let html = `
	<table class="table table-hover col-md-12 col-lg-12">
		<tr>
			<th width="3%" class="text-center">#</th>
			<th width="70%" >Tên menu</th>
			<th width="10%" class="text-center">Ẩn / Hiện</th>
			<th width="10%" class="text-end">@</th>
		</tr>
	`;
	kq.forEach(item => {
		if (item.root_id == 0) {
			html += `
			<tr id="main_menu_${item.id}" class="main_menu" menu-id="${item.id}">
				<td class="text-center">${i++}</td>
				<td class="my-2">${item.name}</td>
				<td class="text-center text-success">
					<button class="border-0 btn ${item.is_hidden == 0 ? 'btn-success' : 'btn-secondary'} hidden_menu" menu-id="${item.id}" is-hidden="${item.is_hidden}">
						${item.is_hidden == 0 ? '<i class="fa-solid fa-eye"></i>' : '<i class="fa-solid fa-eye-slash"></i>'}
					</button>
				</td>
				<td class="d-flex text-center">
					<button class="border-0 btn btn-primary edit_menu" menu-id="${item.id}"><i class="fa-solid fa-pen-to-square"></i></button>
					<button class="border-0 btn btn-danger remove_menu" menu-id="${item.id}"><i class="fa-solid fa-trash"></i></button>
				</td>
			`;
			if (item.root_menu.length > 0) {
				html += thePage.render_child(item.root_menu, 1);
			}
			html += `</tr>`;
		}
	});
	html += '</table>';
	return html;
}

thePage.render_child = (kq, level) => {
	let html = '';
	let before_name = '-- ';
	for (let i = 1; i < level; i++) {
		before_name += before_name;
	}

	kq.forEach(item => {
		html += `</tr>
	<tr>
		<td class="text-center"></td>
		<td class="my-2">${before_name} ${item.name}</td>
		<td class="text-center text-success">
			<button class="border-0 btn ${item.is_hidden == 0 ? 'btn-success' : 'btn-secondary'} hidden_menu" menu-id="${item.id}" is-hidden="${item.is_hidden}">${item.is_hidden == 0 ? '<i class="fa-solid fa-eye"></i>' : '<i class="fa-solid fa-eye-slash"></i>'}
			</button>
		</td>
		<td class="d-flex text-center">
			<button class="border-0 btn btn-primary edit_menu" menu-id="${item.id}"><i class="fa-solid fa-pen-to-square"></i></button>
			<button class="border-0 btn btn-danger remove_menu" menu-id="${item.id}"><i class="fa-solid fa-trash"></i></button>
		</td>	
	`;
		if (item.root_menu.length > 0) {
			html += thePage.render_child(item.root_menu, 2);
		}
		html += `</tr>`;
	});

	return html;
}

function change_page(page) {
	thePage.page = page;
	thePage.filter();
}

function reset_modal() {
	$('#modalAddMenuLabel').html('Thêm menu');
	$('#name').val('');
	$('#root_id').val(0);
	thePage.menu_edit_id = '';
}

$(document).on('click', '#add_menu', function(){
	reset_modal();
	$('#modalAddMenu').modal('show');
})

$(document).on('click', '.edit_menu', function(){
	reset_modal();
	let id = $(this).attr('menu-id');
	thePage.menu_edit_id = id;

	let data = new FormData();
	data.append('id', id);
	_doAjaxNod("POST", data, "manage_menu", "save", "detail", true, function (res) {
		$('#modalAddMenuLabel').html('Chỉnh sửa menu');
		$('#name').val(res.data.name);
		$('#root_id').val(res.data.root_id);
		$('#modalAddMenu').modal('show');
	});
})

$(document).on('click', '.hidden_menu', function () {
	let id = $(this).attr('menu-id');
	let is_hidden = $(this).attr('is-hidden');
	let data = new FormData();
	data.append('id', id);
	data.append('is_hidden', is_hidden);
	_doAjaxNod("POST", data, "manage_menu", "hidden", "hidden", true, function (res) {
		thePage.filter();
	});
})

$(document).on('change', '#menu_is_hidden', function () {
	thePage.menu_is_hidden = $('#menu_is_hidden :selected').val();
	thePage.filter();
})

$(document).on('click', '#btn_find_menu', function () {
	thePage.keyword = $('#keyword').val().trim();
	thePage.filter();
})

$(document).on('click', '#btnModalAddMenu', function () {
	$('.error_label').remove();
	let flag = false;
	let name = $('#name');
	let root_id = $('#root_id');

	if (name.val().trim() == '') {
		name.after('<span class="error_label">Vui lòng nhập tên menu</span>')
		flag = true;
	}

	if (flag) {
		return false;
	} else {
		let data = new FormData();
		data.append('id', thePage.menu_edit_id);
		data.append('name', name.val().trim());
		data.append('root_id', root_id.val());
		_doAjaxNod("POST", data, "manage_menu", "save", "save", true, function (res) {
			if (res.status == 200) {
				$('#modalAddMenu').modal('hide');
				thePage.filter();
				reset_modal();
			}
		});
	}
})

$(document).on('click', '.remove_menu', function () {
	let id = $(this).attr('menu-id');

	let data = new FormData();
	data.append('id', id);
	_doAjaxNod("POST", data, "manage_menu", "delete", "delete", true, function (res) {
		if (res.status == 200) {
			thePage.filter();
		}
	});
})