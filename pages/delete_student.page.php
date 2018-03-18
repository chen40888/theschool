<?php
class Delete_Student_Page {
	public static $allowed_roles = array('owner', 'manager','sales');// מורשי כניסה

	public function __construct() {
		$id = Request::get('arg1');
		Students_Table::delete_from_students_and_student_courses($id);// מוחק את כל הקשרים - הקורסים שרשום אליהם הסטודנט ואחרכך מוחק את הסטודנט
		Response::die_with_redirect('school', 'deleted a student');
	}
}
