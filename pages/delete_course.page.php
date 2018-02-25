<?php
class Delete_Course_Page {
	public static $allowed_roles = array('owner', 'manager','sales');

	public function __construct() {
		$id = Request::get('arg1');
		Courses_Table::delete_course_with_students_inside($id);
		Response::die_with_redirect('school', 'deleted a student');
	}
}
