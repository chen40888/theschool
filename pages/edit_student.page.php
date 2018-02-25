<?php
class Edit_Student_Page {
	public static $allowed_roles = array('owner', 'manager','sales');

	public function __construct() {
		$id = Request::get('arg1');
		$content =$this->_get_student_content($id);
		$courses = $this->_bring_all_courses();

		Template::set('content', $content);
		Template::set('courses', $courses);
	}

	function _get_student_content($id) {
		$student = Edit_Student_Table::bring_student_to_update($id);
		$student['image'] = conf('url.students') . $student['image'];

		$update_form = Template::get_partial('edit_student', $student);
		return $update_form;
	}

	function _bring_all_courses() {
		$courses_list = Students_Table::get_all_with_table_name('courses');

		$body= '';
		foreach($courses_list as $course) {
			$body .= Template::get_partial('course_chekbox' ,$course);
		}
		return $body;
	}
}
