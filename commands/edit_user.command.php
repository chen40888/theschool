<?php
class Edit_User_Command {
	public static $allowed_roles = array('owner', 'manager','sales');

	public function __construct() {
		Validation::validate(Request::all());

		if(empty($_FILES['file']['name'])){
			$this->_update_user_use_same_image();
		} else {
			$this->_do_upload();
			$this->_on_upload_success();
		}

		$this->_set_message();
	}

	private function _update_user_use_same_image() {
		$id = Request::get('id');
		$role = Request::get('role');
		$email = Request::get('email');
		$phone = Request::get('phone');
		$name = Request::get('user_name');
		$id_card = Request::get('id_card');
		$password = Request::get('password');
		Users_Table::update_user_same_image($name, $phone, $id_card, $password, $email, $role ,$id);
	}

	private function _do_upload() {
		new Upload;
	}

	public function _on_upload_success() {
		$id = Request::get('id');
		$file = Files::get('name');
		$role = Request::get('role');
		$phone = Request::get('phone');
		$email = Request::get('email');
		$name = Request::get('user_name');
		$id_card = Request::get('id_card');
		$password = Request::get('password');

		Users_Table::update_user($name, $phone, $id_card, $password, $email, $role, $file ,$id);
	}

	private function _set_message() {
		Template::set(array(
			'message' => '<div class="success_message">המשתמש עודכן בהצלחה</div>'
		));
	}
}
