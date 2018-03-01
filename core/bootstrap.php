<?php
if(!defined('ROOT')) define('ROOT', realpath(dirname(dirname(__FILE__))) . '/'); // Only this works 100% from CLI
include ROOT . 'core/environment.php'; // Autoload environment specific configurations. | Ignored by GIT.
include ROOT . 'core/error_handler.php';
include ROOT . 'core/log.php'; // Log must come before helpers.
include ROOT . 'core/helpers.php'; // Load global generic helper functions.
include ROOT . 'core/conf.global.php'; // Main configuration parameters.
include ROOT . 'core/core.exceptions.php'; // Load mandatory Core Exception Classes.
include ROOT . 'core/normal.exceptions.php'; // Load mandatory Normal (commands/controllers) Exception Classes.
include ROOT . 'classes/custom_exception.php'; // Load mandatory Custom_Exception Class.
include ROOT . 'classes/validation.php'; // Load mandatory Custom_Exception Class.
include ROOT . 'classes/autoloader.php'; // Used by spl_autoload_register() to automatically include class files on request

new Bootstrap;
class Bootstrap {

	public function __construct() {
		$this->_run_bootstrap();
		$this->_init_base_classes();
		Response::die_on_an_options_request();
		$this->_capture_log_js();
	}

	private function _run_bootstrap() {
		spl_autoload_register(array('Autoloader', 'load'));
		date_default_timezone_set('Asia/Jerusalem');
	}

	private function _init_base_classes() {
		new Exception_Overloader;
		new Request;
		new Response;
		new User;
		//new Authentication_Controller;

		//Log::w($_POST, 'post');
		Profiler::mark();
	}

	private function _capture_log_js() {
		$url = urldecode(conf('url.full'));
		if(strstr($url, 'log_js')) {
			throw new Custom_Exception($called_without_api = 200,
				"<br>\n" . Request::get('error_to_log') . "<br>\n" . '$href: ' . Request::get('href') . "<br>\n");
		}
	}
}
