<?php
class Delete_User_Page {
	public static $allowed_roles = array('owner', 'manager');//מורשי כניסה

	public function __construct() {
		$id = Request::get('arg1');
		Users_Table::delete_user($id);
		Response::die_with_redirect('admin', 'after deleted a user');
	}
}
