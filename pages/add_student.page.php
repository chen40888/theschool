<?php
class Add_Student_Page {
	public static $allowed_roles = array('owner', 'manager','sales');

	public function __construct() {
		$all_courses = $this->_bring_all_courses();

		Template::set('courses', $all_courses);
	}

	function _bring_all_courses() {
		$courses_list = Courses_Table::get_all();

		$body = '';
		foreach($courses_list as $course) {
			$body .= Template::get_partial('course_chekbox' ,$course);
		}

		return $body;
	}

}
