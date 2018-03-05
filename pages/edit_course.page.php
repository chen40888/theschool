<?php

class Edit_Course_Page {

	public static $allowed_roles = array('owner', 'manager','sales');

	public function __construct() {
		if(!Request::get('arg1')) Response::die_with_redirect('home', 'missing student id');;

		$id = Request::get('arg1');
		$course = Courses_Table::_bring_course($id);
		if(!$course) Response::die_with_redirect('home', 'not found course');;

		$course['image'] = conf('url.courses') . $course['image'];

		$course_inside_form = Template::get_partial('edit_course',$course);
		Template::set('content',$course_inside_form);

	}
}
