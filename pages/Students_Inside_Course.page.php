<?php
class Students_Inside_Course_Page {
	public static $allowed_roles = array('owner', 'teacher');

	public function __construct() {
		$id = Request::get('arg1');
		$one_course = Students_Inside_Course_Table::one_course($id);
		$course = 	Template::get_partial('course',$one_course);

		$all_students_id = Students_Inside_Course_Table::get_students_id_in_courses($id);

		$all_students = '';
		foreach($all_students_id as $student_id) {
			$id = $student_id['student_id'];
			$student = Students_Inside_Course_Table::get_students_in_courses($id);
			$all_students .= 	Template::get_partial('students',$student);
		}

		$body = $course . $all_students;

		Template::set('content',$body);
	}
}
