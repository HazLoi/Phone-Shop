$(document).ready(function() {
	$('#authorize-button').click(function() {
		let data = new FormData();
		_doAjaxNod('POST', data, 'manage_setting', 'idx', 'auth', true, function(res) {
			if (res.data.authUrl) {
				window.open(res.data.authUrl, '_blank');
			} else {
				$('#authorize-button').hide();
				$('#filter-section').show();
				checkAuthorization();
			}
		});
	});

	if (window.location.pathname.endsWith('setting.php')) {
		checkAuthorization();
	}

	function checkAuthorization() {
		let data = new FormData();
		_doAjaxNod('POST', data, 'manage_setting', 'idx', 'checkAuth', true, function(res) {
			if (res.data.error) {
				$('#authorize-button').show();
				$('#filter-section').hide();
			} else {
				$('#authorize-button').hide();
				$('#filter-section').show();
				displayFiles(res.data.files);
			}
		});
	}

	function displayFiles(files) {
		var fileList = $('#file-list');
		fileList.empty();
		var ul = $('<ul></ul>');
		files.forEach(function(file) {
			var li = $('<li></li>');
			if (file.mimeType.startsWith('image/')) {
				li.append('<img src="https://drive.google.com/uc?id=' + file.id + '">');
			} else {
				li.append('<img src="public/file-icon.png">');
			}
			li.append('<div class="file-name">' + file.name + '</div>');
			ul.append(li);
		});
		fileList.append(ul);
	}

	$('#search-box').on('input', function() {
		var searchTerm = $(this).val().toLowerCase();
		$('#file-list li').each(function() {
			var fileName = $(this).find('.file-name').text().toLowerCase();
			if (fileName.includes(searchTerm)) {
				$(this).show();
			} else {
				$(this).hide();
			}
		});
	});
});