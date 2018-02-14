<?php

class Student_Details_Page {

	public static $allowed_roles = array('anonymous');

	public function __construct() {
		$uri = $_SERVER['REQUEST_URI'];
		$uri = explode('/',$uri);
		$id = $uri['2'];

		$one_student = Student_Details_Table::one_student($id);
		$student = Template::get_partial('students',$one_student);

		$student_courses = Student_Details_Table::get_courses_id($id);

		$all_courses = '';
		foreach($student_courses as $course_id) {
			$id = $course_id['cours_id'];
			$course = Student_Details_Table::get_student_in_courses($id);
			$all_courses .= Template::get_partial('course',$course);
		}

		$body = $student . $all_courses;


		Template::set('content',$body);

	}
}
