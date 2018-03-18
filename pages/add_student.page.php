<?php
class Add_Student_Page {
	public static $allowed_roles = array('owner', 'manager','sales');

	public function __construct() {
		Template::set('courses', $this->_bring_all_courses()); // מביא את כל הקורסים ושולח אותם לview  לתת אפשרות לבחור איזה קורסים שרוצים להירשם אליהם
	}

	function _bring_all_courses() {
		$courses_list = Courses_Table::get_all();

		$body = '';
		foreach($courses_list as $course) {
			$course['image'] = conf('url.courses') . $course['image'];
			$body .= Template::get_partial('course_checkbox', $course);
		}

		return $body;
	}
}
