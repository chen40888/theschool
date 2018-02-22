<?php
class Edit_User_Command {

	public static $allowed_roles = array('owner', 'manager','sales');

	public function __construct() {
		if(Request::get('edit_user')) $this->_do_upload();
	}

	private function _do_upload() {
//		Log::w('Upload::$is_upload_success' . Upload::$is_upload_success);
		if($_FILES) new Upload;
		Log::w('Upload::$is_upload_success' . Upload::$is_upload_success);
		if(Upload::$is_upload_success) $this->_on_upload_success();
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
		log::w(Request::all());

		Edit_User_Table::update_user($name, $phone, $id_card, $password, $email, $role, $file ,$id);
//		Request::$command_name = str_replace('Command', 'Page', Request::$command_name);
		new Page_Controller;
	}
}
