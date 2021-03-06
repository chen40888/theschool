<?php
class Student_Details_Page {
	public static $allowed_roles = array('owner', 'manager','sales');

	public function __construct() {
		$id = Request::get('arg1');

		$one_student = Students_Table::one_student($id);
		$one_student['image'] = conf('url.students') . $one_student['image'];

		$student = Template::get_partial('student_details', $one_student);
		$courses = Students_Courses_Table::get_student_courses($id);

		$all_courses = '';
		foreach($courses as $course) {
			$course['image'] = conf('url.courses') . $course['image'];
			$course['page_name'] = Request::get('arg0');

			$all_courses .= Template::get_partial('course', $course);
		}

		Template::set(array(
			'student' => $student,
			'courses' => $all_courses,
			'student_id' => $id,
			'count' => count($courses)
		));
	}
}
