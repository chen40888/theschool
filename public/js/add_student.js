(function(window) {

	window.App = (window.App || {});
	var $ = window.jQuery;

	function _on_dom_ready() {
		$("#add_student").validate();

		$.validator.setDefaults({
			debug: true,
			success: "valid"
		});
	}

	$(_on_dom_ready);
})(window);
