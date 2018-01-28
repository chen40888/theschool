(function(window) {

	window.App = (window.App || {});
	var $ = window.jQuery;

	window.App.send = send;
	$(_on_dom_ready);

	function send(command, request, callback) {
		var options = {
			url: window.config.api_url + command,
			type: 'POST',
			data: request,
			dataType: 'json'
		};

		$.ajax(options).always(_on_response);

		function _on_response(response) {
			if(isset(response, 'data.user')) window.user = response.data.user;

			if(typeof response !== 'object') response = {
				error: true,
				error_code: null
			};

			if(response.error) {
				if(response['error_code'] === null) window.App.alert('בעיית התקשרות עם השרת. נא בידקו את חיבור הרשת שלכם');
				else window.App.alert('תקלה בלתי צפויה התרחשה,<br> עמכם הסליחה');
			} else if(isset(response, 'data.warning_translation')) {
				window.App.alert(response.data['warning_translation']);
			} else if(isset(response, 'data.redirect_to_url')) {
				_on_redirect();
			} else if(callback) {
				callback(isset(response, 'data') ? response.data : null);
			}

			function _on_redirect() {
				if(window.location.pathname === '/') window.location.reload(true);
				else window.location = response.data['redirect_to_url'];
			}
		}
	}

	function _handle_global_events() {
		$(window.document).on('submit', _prevent_default_behaviour);

		function _prevent_default_behaviour(event_object) {
			event_object.preventDefault();
		}
	}

	function _on_dom_ready() {
		_handle_global_events();
	}
})(window);
