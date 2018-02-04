<?php
class Home_Page {
	public static $allowed_roles = array('anonymous', 'student', 'teacher', 'principle', 'admin');

	public function __construct() {
		if(!User::$id) Response::die_with_redirect('login', 'home_page_was_called');
	}
}
