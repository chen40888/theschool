<?php
class Edit_Course_Command {

	public static $allowed_roles = array('owner', 'manager');//מורשי עריכת קורס

	public function __construct() {
		Validation::validate(Request::all());//ולידציה לכל האינפוטים. Request::all() מביא לי את כל מה שנשלח בpost/get

		if(!Files::get('name')){//בודק עם נשלח file.
			$this->_update_course_use_same_image();
		} else {
			$this->_do_upload();
			$this->_on_upload_success();
		}

		$this->_set_page_response();
	}

	private function _update_course_use_same_image() {
		$id = Request::get('id');
		$name = Request::get('course_name');
		$description = Request::get('description');

		Courses_Table::_update_course_same_image($name, $description ,$id);
	}

	private function _do_upload() {
		new Upload;
	}

	public function _on_upload_success() {
		$id = Request::get('id');
		$name = Request::get('course_name');
		$description = Request::get('description');
		$file = Files::get('name');

		Courses_Table::_update_course($name, $description, $file ,$id);
	}
	private function _set_page_response() {
		Template::set(array(
			'message' => '<div class="success_message">הקורס עודכן בהצלחה</div>'
		));
	}
}
