<?php
class Edit_User_Page {
	public static $allowed_roles = array('owner', 'manager');

	public function __construct() {
		if(Request::get('arg1')) $this->_bring_user();
		else Response::die_with_redirect('home', 'missing user id');

	}

	private function _bring_user() {
		$user = Users_Table::bring_user_to_update(Request::get('arg1'));
		if(!$user) Response::die_with_redirect('home', 'not found user');

		$user['image'] = conf('url.users') . $user['image'];
		$update_form = Template::get_partial('edit_user', $user);
		Template::set('content', $update_form);
	}

}
