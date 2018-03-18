<?php
class Edit_User_Page {
	//יש פה 2 הגנות כמו בשאר הדפים. אם הגעת לדף ללא id או שלא נמצא משתמש הוא זורק אותך בחזרה לדף הראשי
	public static $allowed_roles = array('owner', 'manager');

	public function __construct() {
		if(Request::get('arg1')) $this->_bring_user();
		else Response::die_with_redirect('school', 'missing user id');
	}

	private function _bring_user() {
		$selected = 'selected="selected"';

		$user = Users_Table::bring_user_to_update(Request::get('arg1'));
		if(!$user) Response::die_with_redirect('school', 'not found user');
		$user['image'] = conf('url.users') . $user['image'];

//		Log::w('$role: ' . User::$role);
		$user['hide_class'] = (User::$id == $user['id'] ? 'hide' : '');
		$user['hide_owner_class'] = (User::$role != 'owner' ? ' class="hide"' : '');

		$user['selected_manager'] = ($user['role'] == 'manager' ? $selected : '');
		$user['selected_owner'] = ($user['role'] == 'owner' ? $selected : '');
		$user['selected_sales'] = ($user['role'] == 'sales' ? $selected : '');


		$update_form = Template::get_partial('edit_user', $user);
		Template::set('content', $update_form);
	}
}
