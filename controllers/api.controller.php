<?php
class API_Controller {

	public function __construct() {
		if(!isset(Request::$command_name)) {
			throw new Custom_Exception(Api_Controller_Exception::$undefined_command_name);
		}

		$this->_authorize_request();

		$string_class_to_init = Request::$command_name;
		//Log::w('$string_class_to_init: ' . $string_class_to_init . ' | $arg1: ' . Request::get('arg1') . ' | $arg2: ' . Request::get('arg2'));

		/*$allowed_roles = $string_class_to_init::$allowed_roles;
		if(!in_array(Request::$)$allowed) thro...*/

		new $string_class_to_init;
	}

	private function _authorize_request() {
		if(!Authorization_Controller::authorize(User::$role, Request::$command_name, 'command')) throw new Custom_Exception(Api_Controller_Exception::$not_authorized_to_run_command);
	}
}
