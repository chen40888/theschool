<?php
class Student_Details_Page {
	public static $allowed_roles = array('owner', 'teacher');

	public function __construct() {
		$id = Request::get('arg1');

		$one_student = Student_Details_Table::one_student($id);
		$student = Template::get_partial('students',$one_student);


		$courses = Student_Details_Table::get_student_courses($id);

		$all_courses = '';
		foreach($courses as $course) {
			$all_courses .= Template::get_partial('course',$course);
		}


		$body = $student . $all_courses;

		Template::set('content',$body);

	}
}
