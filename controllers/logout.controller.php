<?php
class Logout_Controller {
	public function __construct() {
		Token_Table::set_status_as(Cookie::get('token'), 'logged_out');
		Cookie::forget(array('token'));

		Response::die_with_redirect('home', 'logout was called');
	}
}
