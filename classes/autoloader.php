<?php

/**
 * Autoloader: find and include the file that holds the requested class
 */
class Autoloader {
	private static
		$class,
		$full_path,
		$class_type;

	public static function load($class) {
		self::$class = strtolower($class);
		self::_set_class_type();
		self::_set_full_path();

		if(file_exists(self::$full_path)) include self::$full_path;
		else Log::details('Failed to find and auto load a file for class: ' . self::$class . ' | $full_path: "' . self::$full_path . '"');
	}

	private static function _set_class_type() {
		self::$class_type = preg_replace('/.*(controller|command|table|page|cron).*/', '$1', self::$class);
		if(preg_match('/conditional_get|jshrink|minifier|mobile_detect/', self::$class)) self::$class_type = 'library';
	}

	private static function _set_full_path() {
		self::$full_path = ROOT . self::_get_base_folder() . '/' . str_replace('_' . self::$class_type, '.' . self::$class_type, self::$class) . '.php';
		//Log::w('$full_path: ' . self::$full_path);
	}

	private static function _get_base_folder() {
		switch(self::$class_type) {
			case 'controller': return 'controllers';
			case 'command': return 'commands';
			case 'table': return 'tables';
			case 'page': return 'pages';
			case 'cron': return 'crons';
			case 'library': return 'libraries';
			default: return 'classes';
		}
	}
}
