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
		if(Request::$is_page_view && !Request::$is_cron_or_cli && !serv('HTTP_HOST') || serv('HTTP_HOST') != conf('static_domain')) {
			Response::die_with_redirect('home', 'redirect invalid sub-domains');
		}

//		if(Request::$is_page_view)
			new Page_Controller;
//		else new API_Controller;
	}
}
