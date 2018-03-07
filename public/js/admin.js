$(document).ready(function(){

	$(window).scroll(_show_all);

	function _show_all() {
		$(".slideanim").each(_show_it)
	}
		function _show_it() {
			var pos = $(this).offset().top;

			var winTop = $(window).scrollTop();
			if (pos < winTop + 1500) {
				$(this).addClass("slide");
		}
	}
});
