<?php
class Edit_User_Page {
	public static $allowed_roles = array('owner', 'manager');

	public function __construct() {
		if(!empty(Request::get('arg1'))) $this->_bring_user();
	}

	private function _bring_user() {
		$user = Users_Table::bring_user_to_update(Request::get('arg1'));
		$user['image'] = conf('url.users') . $user['image'];
		$update_form = Template::get_partial('edit_user', $user);
		Template::set('content', $update_form);
	}

}
