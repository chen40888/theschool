<?php
class HTML {
	private static
		$is_js,
		$ready_tags_html,
		$tag_names_array;

	public static function get_js_or_css_tags($tag_names_array, $is_js = true) {
		self::$tag_names_array = $tag_names_array;
		self::$is_js = $is_js;
		new self;

		return self::$ready_tags_html;
	}

	public function __construct() {
		self::$ready_tags_html = '';
		foreach(self::$tag_names_array as $tag_name) {
			self::$ready_tags_html .= (self::$is_js ? $this->_get_js_tag($tag_name) : $this->_get_css_tag($tag_name));
		}
	}

	private function _get_css_tag($src) {
		$src = conf('url.css') . $src;
		if(!$this->_ends_with($src, '.css') && !$this->_ends_with($src, '.php')) $src .= '.css';
		$version = '?v' . conf('version');
		return "<link href='{$src}{$version}' rel='stylesheet' type='text/css' />\n";
	}

	private function _get_js_tag($src) {
		$src = conf('url.js') . $src;
		if(!$this->_ends_with($src, '.js') && !$this->_ends_with($src, '.php')) $src .= '.js';
		$version = '?v' . conf('version');
		return "<script src='{$src}{$version}' type='text/javascript' charset='utf-8'></script>\n";
	}

	private function _ends_with($haystack, $needle) {
		// search forward starting from end minus needle length characters
		return $needle === '' || (($temp = strlen($haystack) - strlen($needle)) >= 0 && strpos($haystack, $needle, $temp) !== FALSE);
	}
}
