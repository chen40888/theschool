<?php // These are the most basic functions that are loaded and used by Bootstrap and in multiple places across the project.

/**
 * Configuration getter with dot notion support for nested values
 *
 * @param string $path
 * @return mixed
 */
function conf($path) {
	$config = $GLOBALS['config'];

	if(strstr($path, '.')) {
		$config = array_get($config, $path);
		if(!$config) Log::caller('path: ' . $path);
	}
	else if(!isset($config[$path])) {
		Log::caller('Cannot find configuration parameter | path: ' . $path);
		//die('Cannot find configuration parameter | $path: ' . $path);
		return '';
	}
	else $config = $config[$path];

	return $config;
}

/**
 * Get an item from an array using "dot" notation
 *
 * @param  array $array
 * @param  string $key
 * @param  string $default
 * @return array
 */
function array_get($array, $key, $default = NULL) {
	if(is_null($key)) return $array;

	//L o g::w('key: ' . $key);
	foreach(explode('.', $key) as $segment) {
		//L o g::w('segment: ' . $segment);
		if(!is_array($array) || !array_key_exists($segment, $array)) {
			return $default;
		}

		$array = $array[$segment];
	}

	return $array;
}

/**
 * Configuration setter
 *
 * @param  mixed $conf_array
 * @param  string $value
 * @return void
 */
function set_conf($conf_array, $value = NULL) {
	if(is_array($conf_array)) $GLOBALS['config'] = array_merge($GLOBALS['config'], $conf_array);
	else $GLOBALS['config'][$conf_array] = $value;
}

/**
 * $_SERVER param getter
 *
 * @param string $value
 * @param string $default_value
 * @return string
 */
function serv($value, $default_value = NULL) {
	if(!isset($_SERVER[$value])) return $default_value;
	return $_SERVER[$value];
}

/**
 * Convert a boolean to a string representing a boolean, used to make logging booleans read better
 *
 * @param bool $boolean
 * @return string
 */
function bool_s($boolean) {
	return ($boolean ? 'true' : 'false');
}

/**
 * Upper case all words in the given string, converting underscores to spaces and back
 *
 * @param string $string
 * @return string
 */
function true_uppercase($string) {
	return str_replace(' ', '_', ucwords(str_replace('_', ' ', strtolower($string))));
}

/**
 * Check if a class exists by using 'file_exists' instead of the built-in PHP 'class_exists()' function, to avoid Autoloader exception
 *
 * @param string $string
 * @return string
 */
function is_class_exists($class_name, $class_type) {
	$file_path = ROOT . $class_type . 's/' . $class_name . '.' . $class_type . '.php';
	if(!file_exists($file_path)) return false;

	include_once $file_path;
	return class_exists(true_uppercase($class_name . '_' . $class_type), false);
}
