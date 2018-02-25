<?php
class Delete_Course_Page {
	public static $allowed_roles = array('owner', 'manager','sales');

	public function __construct() {
		$id = Request::get('arg1');
		Delete_Course_Table::delete_course($id);
		Response::die_with_redirect('school', 'deleted a student');
	}
}
