<?php
class Failed_Resource_Handler {

	public function __construct() {
		//Log::write('$uri: ' . Request::$uri . ' | $full_url: ' . conf('full_url'));
		// $class = new ReflectionClass('Request'); $arr = $class->getStaticProperties(); //Log::w($arr, '$arr');

		if(strpos(Request::$uri, '.') != false) $this->_handle_dot_request();
		else $this->_handle_404_page();
	}

	private function _handle_dot_request() {
		if(preg_match('/gif|jpg|jpeg|png|bmp/', Request::$uri)) $this->_die_with_no_image();
		else Response::die_with_html('');
	}

	private function _die_with_no_image() {
		$no_image_path = ROOT . '/images/no_image.png';
		$no_image_pointer = fopen($no_image_path, 'rb');

		header("Content-Type: image/png");
		header("Content-Length: " . filesize($no_image_path));

		//Log::w('$no_image_path: ' . $no_image_path);
		fpassthru($no_image_pointer);
		Response::die_with_html('');
	}

	private function _handle_404_page() {
		Log::write('Failed to find the following uri: ' . conf('url.full') . ' | $is_page_view: ' . bool_s(Request::$is_page_view));
	}
}
