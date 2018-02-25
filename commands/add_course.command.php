<?php
class Add_Course_Command {
	public static $allowed_roles = array('owner', 'manager','sales');

	public function __construct() {
		$this->_do_upload();
		$this->_on_upload_success();
		$this->_set_page_response();
	}

	private function _do_upload() {
		new Upload;
	}


private function _on_upload_success() {
	$name = Request::get('course_name');
	$description = Request::get('description');
	$file_name = Files::get('name');

//		Log::w('file name' . $file_name);
	Courses_Table::insert_course($name,$description, $file_name);
	}

	private function _set_page_response() {
		new Page_Controller(true, array(
			'message' => '<div class="success_message">הקורס הוסף בהצלחה</div>'
		));
	}
}

