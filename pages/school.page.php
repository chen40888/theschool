<?php
class School_Page {
	public static $allowed_roles = array('owner', 'manager','sales');

	public function __construct() {
		$all_courses = $this->_bring_all_courses();
		$all_students = $this->_bring_all_students();
//		$all_data = $all_courses . $all_students;

		Template::set('all_courses' ,$all_courses);
		Template::set('all_students' ,$all_students);
	}

	function _bring_all_courses() {
		$courses_list = School_Table::get_all_with_table_name('courses');

		$body= '';
		foreach($courses_list as $course) {
			$course['image'] = '/img/courses/' . $course['image'];
			$body .= Template::get_partial('inside' ,$course);
		}
		return $body;
	}

	function _bring_all_students() {
		$students_list = School_Table::get_all_with_table_name('students');

		$body= '';
		foreach($students_list as $student) {
			$body .= Template::get_partial('students' ,$student);
		}
		return $body;
	}
}
