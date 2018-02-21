<?php

class Admin_Page{

	private
		$count;

	public static $allowed_roles = array('owner', 'manager');

	public function __construct() {
	$all_users = $this->bring_all_users();
	Template::set('users',$all_users);
	Template::set('count_manager', $this->count);
	}

	public function bring_all_users() {
		if(User::$role == 'owner') {
		$users_array = Admin_Table::get_all_users();
		} else {
			$users_array = Admin_Table::get_manager_and_sales();
		}
		$this->count = count($users_array);
		$body = '';
		foreach($users_array as $user) {
		$body .= Template::get_partial('user', $user);
		}
		return $body;
	}
}
