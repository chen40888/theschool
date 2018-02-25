<?php
class Edit_Course_Command {

	public static $allowed_roles = array('owner', 'manager','sales');

	public function __construct() {
		if(Request::get('edit_course')) $this->_do_upload();
	}

	private function _do_upload() {
//		Log::w('Upload::$is_upload_success' . Upload::$is_upload_success);
		if($_FILES) new Upload;
		Log::w('Upload::$is_upload_success' . Upload::$is_upload_success);
		if(Upload::$is_upload_success) $this->_on_upload_success();
	}

	public function _on_upload_success() {
		$id = Request::get('id');
		$name = Request::get('course_name');
		$description = Request::get('description');
		$file = Files::get('name');
		log::w(Request::all());

		Edit_Course_Table::_update_course($name, $description, $file ,$id);
		new Page_Controller;
	}
}
