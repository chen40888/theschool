<?php

class User_Page {
	public static $allowed_roles = array('owner', 'manager');

	public function __construct() {
	$id = Request::get('arg1');
	$user = Users_Table::bring_user_to_update($id); //את כל השאילתות לdb אתה יכול למצוא בתיקית tables.
	$user['name'] = ucwords($user['name']);
	$user['image'] = conf('url.users') . $user['image'];


		Template::set('user',Template::get_partial('one_user',$user));// שולח למשתנה בשם user את ה"חלק" של הuser אחרי שכל הנתונים בתוכו. המשתנה יגיע לuser.page בשתיקית view. 
	}
}
