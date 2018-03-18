<?php
// אפשר לקרוא לדף הזה גם course_details
class Students_Inside_Course_Page {
	public static $allowed_roles = array('owner', 'manager','sales');

	public function __construct() {
		$id = Request::get('arg1');
		$one_course = Courses_Table::_bring_course($id); // מביא קורס אחד

		$one_course['image'] = conf('url.courses') . $one_course['image'];
		$course = 	Template::get_partial('course', $one_course);

		$students = Students_Courses_Table::get_students_in_courses($id);// כל הסטודנטים שרשומים לקורס הזה

		$all_students = '';
		foreach($students as $student) {
			$student['image'] = conf('url.students') . $student['image'];
			$student['page_name'] = Request::get('arg0');// הוספתי משתנה משום שיש templets חופפים שמשמשים למטרות שונות ולכן אני צריך לדעת איפה אני נמצא בשביל לדעת איך להדפיס את זה
			$all_students .= 	Template::get_partial('students', $student);
		}

		Template::set(array(
			'course' => $course,
			'students' => $all_students,
			'course_id' => $id,
			'user_role' => User::$role,
			'count' => count($students)
		));
	}
}
