<?php if(!defined('ROOT')) define('ROOT', realpath(dirname(dirname(__FILE__))) . '/');
include ROOT . 'core/bootstrap.php';

new Routing_Controller;
class Routing_Controller {
	public function __construct() {
		try {
			$this->_init();
		} catch(Exception $e) {
			new Custom_Exception($e);
		}
	}

	private function _init() {
		//Log::w('$static_domain: ' . conf('static_domain') . ' | $uri: ' . Request::$uri);
		if(Request::$is_page_view && serv('HTTP_HOST') != conf('static_domain')) {
			Response::die_with_redirect('home', 'redirect invalid sub-domains');
		}

		if(strpos(Request::$uri, '.') != false) new Failed_Resource_Handler;
		if(serv('REQUEST_METHOD') == 'POST') new Request::$command_name;
		new Page_Controller;
	}
}
