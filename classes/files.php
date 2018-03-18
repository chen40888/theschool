<?php
class Files {
	public static function get($key, $default = NULL) {
		return (!empty($_FILES['file'][$key]) ? $_FILES['file'][$key] : $default);
	}

	public static function set($key, $value) {
		$_FILES['file'][$key] = $value;
	}
}
