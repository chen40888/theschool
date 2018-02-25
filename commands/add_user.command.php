<?php
class Add_User_Command {
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
		$file = Files::get('name');
		$role = Request::get('role');
		$phone = Request::get('phone');
		$email = Request::get('email');
		$name = Request::get('user_name');
		$id_card = Request::get('id_card');
		$password = Request::get('password');
//		Log::w(Request::all());

		Users_Table::insert_user($name, $phone, $id_card, $password, $email, $role, $file);
	}

	private function _set_page_response() {
		new Page_Controller(true, array(
			'message' => '<div class="success_message">המשתמש הוסף בהצלחה</div>'
		));
	}
}
