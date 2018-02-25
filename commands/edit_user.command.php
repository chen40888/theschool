<?php
class Edit_User_Command {
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
		$name = Request::get('user_name');
		$phone = Request::get('phone');
		$id_card = Request::get('id_card');
		$password = Request::get('password');
		$email = Request::get('email');
		$role = Request::get('role');
		$file = Files::get('name');

		Edit_User_Table::update_user($name, $phone, $id_card, $password, $email, $role, $file ,$id);
	}
	private function _set_page_response() {
		new Page_Controller(true, array(
			'message' => '<div class="success_message">המשתמש עודכן בהצלחה</div>'
		));
	}
}
