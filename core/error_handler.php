<?php
class Error_Handler {
	private function __construct($file, $line, $message, $type, $cause) {
		$error_array = array(
			'error' => true,
			'error_code' => 1, // PHP Error
			'file' => $file,
			'line' => $line,
			'message' => 'Server Error: ' . $message,
			'error_type' => $this->_return_error_type($type),
			'cause' => $cause
		);

		$is_warn_or_notice = ($type == E_NOTICE || $type == E_WARNING);

		if($is_warn_or_notice) $this->_handle_warn_or_notice($error_array);
		else $this->_handle_normal_errors($error_array);
	}

	private function _handle_warn_or_notice($error_array) {
		if(conf('is_log_warnings')) Log::write($error_array);
	}

	private function _handle_normal_errors($error_array) {
		Log::write($error_array);
		Response::die_with_error($error_array);
	}

	public static function run_on_custom_exception($error_code, $error_description, $class_name = 'Custom Exception') {
		Request::$command_name = str_replace('Command', 'Page', Request::$command_name);
		new Page_Controller(array(
			'error_message' => '<div class="error_message">' . $class_name . '::' . $error_description . '</div>'
		));
	}

	public static function run_on_shutdown() {
		$last_error_array = error_get_last();
		if(!$last_error_array) return;

		new self($last_error_array['file'], $last_error_array['line'], $last_error_array['message'], $last_error_array['type'], 'shutdown');
	}

	public static function run_on_php_error($error_number, $error_string, $error_file_path, $error_line) {
		if(strstr($error_string, 'recursion detected') && strstr($error_file_path, 'log.php')) return;

		new self($error_file_path, $error_line, $error_string, $error_number, 'php_error');
	}

	public static function run_on_unhandled_exception($exception) {
		new self($exception->getFile(), $exception->getLine(), $exception->getMessage(), $exception->getCode(), 'unhandled_exception');
	}

	private function _return_error_type($type) {
		switch($type) {
			case E_ERROR: return 'E_ERROR "Fatal error: Execution halted"'; // 1
			case E_WARNING: return 'E_WARNING "Warning: Execution continues"'; // 2
			case E_PARSE: return 'E_PARSE "Compile-time parse error"'; // 4
			case E_NOTICE: return 'E_NOTICE "Could indicate an error"'; // 8
			case E_CORE_ERROR: return 'E_CORE_ERROR "Fatal error: Execution halted (PHP Core)"'; // 16
			case E_CORE_WARNING: return 'E_CORE_WARNING "Warning: execution continues"'; // 32
			case E_USER_ERROR: return 'E_USER_ERROR "trigger_error() was called"'; // 256
			case E_USER_WARNING: return 'E_USER_WARNING "trigger_error() was called"'; // 512
			case E_USER_NOTICE: return 'E_USER_NOTICE "trigger_error() was called"'; // 1024
			case E_STRICT: return 'E_STRICT "PHP suggests a code change"'; // 2048
			case E_RECOVERABLE_ERROR: return 'E_RECOVERABLE_ERROR "Catchable fatal error, can be caught"'; // 4096
			case E_DEPRECATED: return 'E_DEPRECATED "This code will not work in future versions"'; // 8192
			case E_USER_DEPRECATED: return 'E_USER_DEPRECATED "trigger_error() was called"'; // 16384
		}
		return 'Unknown Error Type';
	}
}

set_error_handler('Error_Handler::run_on_php_error');
set_exception_handler('Error_Handler::run_on_unhandled_exception');
register_shutdown_function('Error_Handler::run_on_shutdown');
