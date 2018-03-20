<?php
// זה דף טעינת הנתונים מהDB של הקורסים והסטודנטים, הנתונים שבאים מהDB מורכבים בתוך הטמפלט ולבסוף נשלחים לVIEW בתוך משתנים
class School_Page {
	public static $allowed_roles = array('owner', 'manager','sales');

	public function __construct() {
		$all_courses = $this->_bring_all_courses();
		$all_students = $this->_bring_all_students();

		Template::set(array(
			'all_courses' => $all_courses,
			'all_students' => $all_students,
			'user_role' => User::$role
		));
	}

	function _bring_all_courses() {
		$courses_list = Courses_Table::get_all();

		$body= '';
		foreach($courses_list as $course) {
			$course['image'] = conf('url.courses') . $course['image']; // דורס את הערך שמגיע מה DB ומחליף אותו עם מיקוד מדיוק לכתובת של התמונה. כנל לגבי טעינת הסטודנטים
			$course['name'] = ucwords($course['name']);
			$body .= Template::get_partial('inside' ,$course);
		}
		return $body;
	}

	function _bring_all_students() {
		$students_list = Students_Table::get_all();

		$body= '';
		foreach($students_list as $student) {
			$student['image'] = conf('url.students') . $student['image'];
			$student['name'] = ucwords($student['name']);

			$body .= Template::get_partial('students' ,$student);
		}
		return $body;
	}
}
