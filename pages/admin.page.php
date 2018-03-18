<?php
class Admin_Page {
	private $count;
	public static $allowed_roles = array('owner', 'manager');

	public function __construct() {
		$all_users = $this->bring_all_users();
		Template::set(array(
			'users' => $all_users,
			'count_manager'=> $this->count
		));
	}

	public function bring_all_users() {
		$users_array = (User::$role == 'owner' ? Users_Table::get_all_users() : Users_Table::get_manager_and_sales());
		$this->count = count($users_array);

		$body = '';
		foreach($users_array as $user) {
			$user['image'] = conf('url.users') . $user['image'];
			$body .= Template::get_partial('user', $user);
		}

		return $body;
	}
}
