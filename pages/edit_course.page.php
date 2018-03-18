<?php
class Edit_Course_Page {
	public static $allowed_roles = array('owner', 'manager');

	public function __construct() {
		if(!Request::get('arg1')) Response::die_with_redirect('school', 'missing student id');// אם מגיע ללא id שולח אותי חזרה לדף הראשי

		$id = Request::get('arg1');
		$course = Courses_Table::_bring_course($id);
		if(!$course) Response::die_with_redirect('school', 'not found course');//אם לא מוצא כלום ב db שולח אותי לדף הראשי

		$course['image'] = conf('url.courses') . $course['image'];

		$course_inside_form = Template::get_partial('edit_course', $course);
		Template::set('content', $course_inside_form); // שולח את המשתנה לview

	}
}
