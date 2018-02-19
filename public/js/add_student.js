(function(window) {

	window.App = (window.App || {});
	var $ = window.jQuery;

	function _on_dom_ready() {
		$("#add_student").validate();

		jQuery.validator.setDefaults({
			debug: true,
			success: "valid"
		});
		$( "#myform" ).validate({
			rules: {
				field: {
					required: true,
					digits: true
				}
			}
		});


	}

	$(_on_dom_ready);
})(window);
