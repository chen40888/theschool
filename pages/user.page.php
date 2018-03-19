<?php

class User_Page {
	public static $allowed_roles = array('owner', 'manager');

	public function __construct() {
	$id = Request::get('arg1');
	$user = Users_Table::bring_user_to_update($id);
	Template::set('user',Template::get_partial('one_user',$user));
	}
}
