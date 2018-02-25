<?php
class Edit_Course_Command {

	public static $allowed_roles = array('owner', 'manager','sales');

	public function __construct() {
		$this->_do_upload();
		$this->_on_upload_success();
		$this->_set_page_response();
	}

	private function _do_upload() {
		new Upload;
	}

	public function _on_upload_success() {
		$id = Request::get('id');
		$name = Request::get('course_name');
		$description = Request::get('description');
		$file = Files::get('name');
//		log::w(Request::all());

		Courses_Table::_update_course($name, $description, $file ,$id);
	}
	private function _set_page_response() {
		new Page_Controller(true, array(
			'message' => '<div class="success_message">הקורס עודכן בהצלחה</div>'
		));
	}
}
