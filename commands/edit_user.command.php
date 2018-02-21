<?php
class Edit_User_Command {

	public static $allowed_roles = array('owner', 'manager','sales');

	public function __construct() {
		if(Request::get('edit_user')){
			$this->_do_upload();
		}
	}

	private function _do_upload() {
		include ROOT . 'classes/upload.php';
		$id = Request::get('id');
		$name = Request::get('user_name');
		$phone = Request::get('phone');
		$id_card = Request::get('id_card');
		$password = Request::get('password');
		$email = Request::get('email');
		$role = Request::get('role');
		$file = Request::get('file');
//		echo $id_card;die();

		Edit_User_Table::update_user($name, $phone, $id_card, $password, $email, $role, $file ,$id);

		Response::die_with_redirect('inside');
	}
}
