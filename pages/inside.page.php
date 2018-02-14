<?php

class Inside_Page {

	public static $allowed_roles = array('anonymous');

	public function __construct() {
		$all_courses = $this->_bring_all_courses();
		$all_students = $this->_bring_all_students();
		$all_data = $all_courses . $all_students;

		echo $all_data;

		Template::set('content' ,$all_data);
	}

	function _bring_all_courses() {
		$courses_list = Inside_Table::get_all_with_table_name('courses');

		$body= '';
		foreach($courses_list as $cours) {
			$body .= Template::get_partial('inside' ,$cours);
		}
		return $body;
	}

	function _bring_all_students() {
		$students_list = Inside_Table::get_all_with_table_name('students');

		$body= '';
		foreach($students_list as $student) {
			$body .= Template::get_partial('students' ,$student);
		}
		return $body;
	}
}
