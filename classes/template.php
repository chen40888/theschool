<?php
class Template {
	static public $template_options;

	public static function get_page($page_name, $params_array = array(), $is_optional = false) {
		$page_template_path = conf('path.page') . $page_name . '.page.php';
		return self::_parse_params_array_return_ready_html($page_template_path, $params_array, $is_optional);
	}

	public static function get_partial($partial_name, $params_array = array(), $is_optional = false) {
		$partial_template_path = conf('path.partial') . $partial_name . '.partial.php';
		return self::_parse_params_array_return_ready_html($partial_template_path, $params_array, $is_optional);
	}

	private static function _parse_params_array_return_ready_html($template_path, $params_array, $is_optional) {
		//Log::w('$template_path: ' . $template_path);
		if(!file_exists($template_path)) {
			if($is_optional) return '';

			Log::write('$invalid_template_path - $command_name: ' . Request::$command_name);
			throw new Custom_Exception(Template_Exception::$invalid_template_path, $template_path);
		}

		if(!self::$template_options) self::$template_options = array();
		$params_array = self::$template_options = array_merge(self::$template_options, $params_array);
		extract($params_array); // http://php.net/extract: Import variables into the current symbol table from an array
		unset($params_array);

		ob_start();
		include $template_path;
		return ob_get_clean();
	}

	public static function set($key, $value = NULL) {
		if(!self::$template_options) self::$template_options = array();

		if(is_array($key)) self::$template_options = array_merge(self::$template_options, $key);
		else if(is_string($key) && !empty($key)) self::$template_options[$key] = $value;
	}
}
