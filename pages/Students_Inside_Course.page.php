<?php
class Students_Inside_Course_Page {
	public static $allowed_roles = array('owner', 'manager','sales');

	public function __construct() {
		$id = Request::get('arg1');
		$one_course = Courses_Table::_bring_course($id);

		$one_course['image'] = conf('url.courses') . $one_course['image'];
		$course = 	Template::get_partial('course', $one_course);

		$students = Students_Courses_Table::get_students_in_courses($id);

		$all_students = '';
		foreach($students as $student) {
			$student['image'] = conf('url.students') . $student['image'];
			$all_students .= 	Template::get_partial('students', $student);
		}


		$body = $course . $all_students;

		Template::set('content',$body);
	}
}
