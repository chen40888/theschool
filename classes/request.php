<?php
class Request {
	public static
		$uri,
		$is_ssl,
		$is_test,
		$is_local,
		$args_array,
		$command_name,
		$is_page_view,
		$is_production,
		$location_href,
		$is_cron_or_cli;

	public function __construct() {
		self::$is_ssl = (serv('SERVER_PORT') == '443');
		self::$is_local = (conf('environment') == 'local');

		self::$location_href = Request::get('location_href', false);
		self::$is_production = (conf('environment') == 'production');
		self::$is_cron_or_cli = (!!preg_match('/CLI|CRON/', serv('REQUEST_METHOD')));
		self::$uri = preg_replace('/^\/|index\.php|\?.*$/', '$1', serv('REQUEST_URI', ''));

		$this->_set_is_page_view();
		$this->_set_post_on_json_request();
		$this->_set_args_array();
		$this->_add_args_to_post();
		$this->_set_command_name();
		$this->_set_is_test();

		//if(Log::is_allowed_to_log()) Log::details();
	}

	private function _set_command_name() {
		$command_name = Request::get('arg0', 'login');
		if(!empty($command_name)) $this->_set_full_formatted_command_name($command_name);
		//Log::w('$command_name: ' . self::$command_name);
	}

	private function _set_full_formatted_command_name($command_name) {
		if(is_numeric($command_name)) $command_name = 'page';
		$command_name .= $this->_get_command_name_suffix();
		$command_name = true_uppercase($command_name);
		$command_name = preg_replace($remove_start_underscore_pattern = '/^_/', '', $command_name);
		//Log::w('$command_name: ' . $command_name);
		self::$command_name = $command_name;
	}

	private function _get_command_name_suffix() {
		if(self::$is_cron_or_cli) return '_Cli';
		else if(Request::$is_page_view) return '_Page';
		else return '_Command';
	}

	private function _set_post_on_json_request() {
		//L o g::w('REQUEST_METHOD: ' . serv('REQUEST_METHOD') . ' | CONTENT_TYPE: ' . serv('CONTENT_TYPE'));
		if(serv('REQUEST_METHOD') != 'POST' || !stristr(serv('CONTENT_TYPE'), 'json')) return;
		$_POST = json_decode(file_get_contents('php://input'), true);
		if(!$_POST) $_POST = array();
	}

	private function _set_args_array() {
		self::$args_array = array();
		if(self::$is_cron_or_cli) $this->_set_args_from_command_line_arguments();
		else $this->_set_args_from_uri();
		//Log::w(self::$args_array, '$args_array');
	}

	private function _set_is_test() {
		self::$is_test = (Request::get('arg0') == 'is_test' || Request::get('arg1') == 'is_test');
		//L o g::w('$is_test: ' . bool_s(self::$is_test) . ' | $arg0: ' . Request::get('arg0')  . ' | $is_cron_or_cli: ' . bool_s(self::$is_cron_or_cli));
	}

	private function _set_args_from_command_line_arguments() {
		global $argv;
		foreach($argv as $value) {
			if(empty($value) || preg_match('/cli_runner|cron_router/i', $value)) continue;
			self::$args_array[] = $value;
		}
		//L o g::w(self::$args_array, '$args_array');
	}

	private function _set_args_from_uri() {
		$raw_array = explode('/', conf('uri'));
		self::$args_array = array();
		foreach($raw_array as $value) {
			if(empty($value) || strstr($value, '?') || preg_match('/api|routing_controller/i', $value)) continue;

			$value = trim($value);
			self::$args_array[] = $value;
		}
		//L o g::w(self::$args_array, '$uri: ' . conf('uri') . ' $args_array');
	}

	/**
	 * Allow a simpler and smarter use of getting clean url arguments: Request::get('arg0')
	 * Returns a component of the current path OR in CLI (or Cron), a command line argument.
	 *
	 * When viewing a page at the path "admin/structure/types", for example, get('arg0') returns "admin", get('arg1') returns "structure", and get('arg2') returns "types".
	 * https://api.drupal.org/api/drupal/includes!bootstrap.inc/function/arg/7
	 */
	private function _add_args_to_post() {
		foreach(self::$args_array as $key => $arg) {
			if($arg == 'api') continue;
			$_POST['arg' . $key] = $arg;
		}
	}

	/**
	 * Get the posted string variable value stored in the global $_POST array
	 * The $_POST array is overloaded with url arguments. See: '_add_args_to_post()'
	 * Supports converting string booleans "true" and "false" to real booleans
	 *
	 * @param string $key
	 * @param null $default
	 * @return null|string|array
	 */
	public static function get($key, $default = NULL) {
		if(empty($_POST[$key])) return $default;
		if(is_string($_POST[$key]) && strtolower($_POST[$key]) === 'false') $_POST[$key] = false;
		else if(is_string($_POST[$key]) && strtolower($_POST[$key]) === 'true') $_POST[$key] = true;
		return $_POST[$key];
	}

	/**
	 * Get the query string variable value stored in the global $_GET array
	 *
	 * @param $key
	 * @param null $default
	 * @return null|string - The requested named query variable
	 */
	public static function get_query_var($key, $default = NULL) {
		if(empty($_GET[$key])) return $default;
		else return $_GET[$key];
	}

	public static function exists($key) {
		if(isset($_POST[$key])) return true;
		else return false;
	}

	public static function is_empty_string($key) {
		if(isset($_POST[$key]) && $_POST[$key] === '') return true;
		else return false;
	}

	// Add the new param at the top of the array: http://stackoverflow.com/questions/7059721/array-merge-versus
	public static function put($key, $value = NULL) {
		if(is_array($key)) self::_put_by_array($key);
		else $_POST = array($key => $value) + $_POST;
	}

	public static function all() {
		$output = array();
		foreach($_POST as $key => $value) {
			$output[$key] = $value;
		}
		return (!empty($output) ? $output : NULL);
	}

	public static function delete($key) {
		if(is_array($key)) self::_delete_by_array($key);
		else if(isset($_POST[$key])) unset($_POST[$key]);
	}

	public static function _delete_by_array($delete_array) {
		foreach($delete_array as $key) {
			self::delete($key);
		}
	}

	private function _set_is_page_view() {
		self::$is_page_view = (serv('REQUEST_METHOD') != 'POST');
		//Log::w('$command_name: ' . Request::$command_name . ' | $is_page_view: ' . bool_s(self::$is_page_view) . ' | $request_method: ' . serv('REQUEST_METHOD'));
	}

	private static function _put_by_array($put_array) {
		foreach($put_array as $key => $value) {
			$_POST[$key] = $value;
		}
	}
}
