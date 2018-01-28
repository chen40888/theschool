<?php
class User_Page {
	public static $allowed_roles = array('anonymous');

	public function __construct() {
		Template::set('content', 'עמוד המשתמש יויו');
	}
}
