<?php
class Exception_Overloader {
	public function __construct() {
		$base_exceptions_array = $this->get_sub_classes_of('Base_Exception');
		foreach($base_exceptions_array as $class_name) {
			$params = get_class_vars($class_name);
			foreach($params as $desc => $param_array) {
				$class_name::set($desc, array('class_name' => $class_name, 'desc' => $desc));
				if(!$class_name::exists($desc, 'severity')) $class_name::set($desc, array('severity' => 'fatal'));
			}
			//L o g::w(get_class_vars($class_name));
		}
	}

	function get_sub_classes_of($sub_class) {
		$result = array();
		foreach(get_declared_classes() as $class) {
			if(is_subclass_of($class, $sub_class))
				$result[] = $class;
		}

		return $result;
	}
}

// http://stackoverflow.com/questions/1280492/extending-php-static-classes
abstract class Base_Exception {
	public static function exists($exception_desc, $key) {
		$exception_array = static::$$exception_desc;
		return !empty($exception_array[$key]);
	}

	public static function set($exception_desc, $exception_params) {
		static::$$exception_desc = array_merge(static::$$exception_desc, (array) $exception_params);
	}
}

class DB_Exception extends Base_Exception {
	public static
		$invalid_pdo_response = array('id' => 1),
		$failed_to_prepare_an_sql_statement = array('id' => 2),
		$invalid_sql_must_be_a_valid_string = array('id' => 3),
		$mysql_thrown_pdo_exception = array('id' => 4);
}

class Template_Exception extends Base_Exception {
	public static
		$invalid_template_path = array('id' => 1);
}

class Authorization_Controller_Exception extends Base_Exception {
	public static
		$missing_mandatory_allowed_roles = array('id' => 1);
}

class Api_Controller_Exception extends Base_Exception {
	public static
		$not_authorized_to_run_command = array('id' => 1),
		$undefined_command_name = array('id' => 2);
}
