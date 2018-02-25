<?php
class Student_Details_Page {
	public static $allowed_roles = array('owner', 'manager','sales');

	public function __construct() {
		$id = Request::get('arg1');

		$one_student = Student_Details_Table::one_student($id);
		$one_student['image'] = conf('url.students') . $one_student['image'];

		$student = Template::get_partial('students', $one_student);
		$courses = Student_Details_Table::get_student_courses($id);

		$all_courses = '';
		foreach($courses as $course) {
			$course['image'] = '/img/courses/' . $course['image'];
			$all_courses .= Template::get_partial('course', $course);
		}

		$content = $student . $all_courses;
		Template::set('content', $content);

	}
}
