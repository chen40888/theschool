(function(window) {

	window.App = (window.App || {});
	var $ = window.jQuery;

	function _on_dom_ready() {
		$(window.document)
			.on('submit', '#hook_login_form', _on_login_submit)
			.on('focus', '.login-field', _on_focus_login_field)
	}

	function _on_login_submit(event_object) {
		var request = $(event_object.target).serializeArray();

		log(event_object);
		log(JSON.stringify(request), 'request');
		window.App.send('login', request, _on_login_response);
		return false;
	}

	function _on_login_response(response) {
		_set_warning_visible(response.error);
	}

	function _on_focus_login_field() {
		_set_warning_visible(false);
	}

	function _set_warning_visible(is_visible) {
		$('.warning').removeClass('warning_show').removeClass('warning_hide').addClass(is_visible ? 'warning_show' : 'warning_hide');
	}

	$(_on_dom_ready);
})(window);
