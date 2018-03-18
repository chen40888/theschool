(function(window) {

	window.App = (window.App || {});
	var $ = window.jQuery;

	function _on_dom_ready() {
		$('#hook_delete').on('click', show_real_btn);

		function show_real_btn() {
			$('#show_btn').toggleClass('hidden');
		}
	}

	$(_on_dom_ready);
})(window);
