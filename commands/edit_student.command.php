<?php
class Edit_Student_Command {
	public static $allowed_roles = array('owner', 'manager','sales');

	public function __construct() {
		if(Request::get('edit_student')) $this->_do_upload();
	}

	private function _do_upload() {
		if($_FILES) new Upload;
		if(Upload::$is_upload_success) $this->_on_upload_success();
	}

	private function _on_upload_success() {
		$name = Request::get('student_name');
		$phone = Request::get('phone');
		$id_card = Request::get('id_card');
		$email = Request::get('email');
		$id = Request::get('id');
		$file = Files::get('name');

		Edit_Student_Table::update_student($name, $phone, $id_card, $email, $file, $id);
	}
}
