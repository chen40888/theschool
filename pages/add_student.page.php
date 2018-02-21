<?php
class Add_Student_Page {
	public static $allowed_roles = array('owner', 'manager','sales');

	public function __construct() {
		$all_courses = $this->_bring_all_courses();

		Template::set('courses',$all_courses);
	}
	function _bring_all_courses() {
		$courses_list = Add_Student_Table::get_all_with_table_name('courses');

		$body= '';
		foreach($courses_list as $cours) {
			$body .= Template::get_partial('course_chekbox' ,$cours);
		}
		return $body;
	}

}
