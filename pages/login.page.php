<?php
class Login_Page {
	public static $allowed_roles = array('anonymous');

	public function __construct() {
		Template::set(array(
			'additional_css_array' => array('files_to_insert' => array('jquery-confirm')),
			'additional_js_array' => array('files_to_insert' => array('jquery-confirm'))
		));
	}
}
