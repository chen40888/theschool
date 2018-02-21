<?php
class Delete_Student_Page {
	public static $allowed_roles = array('owner', 'manager','sales');

	public function __construct() {
		$id = Request::get('arg1');

		Delete_Student_Table::delete_from_students_and_student_courses($id);
		Response::die_with_redirect('school');


	}
}
