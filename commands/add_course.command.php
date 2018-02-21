<?php
class Add_Course_Command {

	public static $allowed_roles = array('owner', 'manager','sales');

	public function __construct() {
		if(Request::get('course_name')){
		$this->_do_upload();
		}


	}

	private function _do_upload() {
		include ROOT . 'classes/upload.php';
		$name = Request::get('course_name');
		$description = Request::get('description');
		$file_name = $_FILES["file"]["name"];
		Add_Course_table::insert_course($name,$description, $file_name);
		Response::die_with_redirect('inside');
	}
}
