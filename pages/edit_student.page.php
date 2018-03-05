<?php
class Edit_Student_Page {
	public static $allowed_roles = array('owner', 'manager','sales');

	public function __construct() {
		if(!Request::get('arg1')) Response::die_with_redirect('home', 'missing student id');;
		$id = Request::get('arg1');
		$content =$this->_get_student_content($id);
		$courses = $this->_bring_all_courses();

		Template::set('content', $content);
		Template::set('courses', $courses);
	}

	function _get_student_content($id) {
		$student = Students_Table::bring_student_to_update($id);
		if(!$student) Response::die_with_redirect('home', 'not found user');;

		$student['image'] = conf('url.students') . $student['image'];

		$update_form = Template::get_partial('edit_student', $student);
		return $update_form;
	}

	function _bring_all_courses() {
		$courses_list = Courses_Table::get_all();

		$all_student_courses = Students_Courses_Table::get_student_courses(Request::get('arg1'));



		$body= '';
		foreach($courses_list as $course) {
			$course['image'] = conf('url.courses') . $course['image'];

			$course['is_checked'] = FALSE;
			foreach($all_student_courses as $is_checked) {
				if($course['id'] == $is_checked['cours_id']) {
					$course['is_checked'] = TRUE;
				}
			}
			$body .= Template::get_partial('course_chekbox' ,$course);
		}
		return $body;
	}
}
