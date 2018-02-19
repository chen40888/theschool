<?php
class Logout_Page {
	public static $allowed_roles = array('owner', 'teacher');

	public function __construct() {
//		Token_Table::delete_token_of_user(User::$id);//אפשר למחוק את הtoken      		אפשר לבדוק אם יש לממבר id token ואם כן לעשות update

		Token_Table::set_status_as(Cookie::get('token'), 'logged_out');
		Cookie::forget(array('token'));

		Response::die_with_redirect('login', 'logout was called');
	}
}
