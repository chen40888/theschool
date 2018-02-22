<?php
class Add_Course_Command {
	public static $allowed_roles = array('owner', 'manager','sales');

	public function __construct() {
		if(Request::get('course_name')){
			$this->_do_upload();
		}
	}

	private function _do_upload() {
		if($_FILES) new Upload;
		if(Upload::$is_upload_success) $this->_on_upload_success();
	}

		public function _on_upload_success() {
		$name = Request::get('course_name');
		$description = Request::get('description');
		$file_name = Files::get('name');
			Log::w('file name' . $file_name);
		Add_Course_table::insert_course($name,$description, $file_name);
	}
}
