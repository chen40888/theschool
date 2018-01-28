(function(window) {

	window.App = (window.App || {});
	var $ = window.jQuery;

	function _on_dom_ready() {
		log('this IS USER');
	}

	$(_on_dom_ready);
})(window);
