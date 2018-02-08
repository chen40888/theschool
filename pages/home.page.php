<?php

class Home_Page {

	public
		$age = array("page_name"=>"35", "content"=>"37");

	public static $allowed_roles = array('anonymous');

	public function __construct() {
//		if(!User::$id) Response::die_with_redirect('login', 'home_page_was_called');
		Template::set($this->age);

	}
}
