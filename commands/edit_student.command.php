<?php
class Edit_Student_Command {

	public static $allowed_roles = array('owner', 'teacher');

	public function __construct() {
		if(Request::get('edit_student')){
			$this->_do_upload();
		}
	}

	private function _do_upload() {
		include ROOT . 'classes/upload.php';
		$name = Request::get('student_name');
		$phone = Request::get('phone');
		$id_card = Request::get('id_card');
		$email = Request::get('email');
		$id = Request::get('id');
		$file = Request::get('file');
//		Log::w('$file_name' . $file);

		Edit_Student_Table::update_student($name, $phone, $id_card, $email, $file, $id);

		Response::die_with_redirect('inside');
	}
}
