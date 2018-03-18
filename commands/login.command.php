<?php
class Login_Command {
	private $user;
	public static $allowed_roles = array('anonymous');

	public function __construct() {
		$this->_set_user();

		if(!$this->user) Template::set(array('problem' => 'Incorrect mail, id or password'));
		else $this->_on_regular_login();
	}

	private function _set_user() {
		if(Request::get('mail_or_id')) $this->user = Users_Table::select_login_details(Request::get('mail_or_id'), Request::get('password'));
	}

	private function _on_regular_login() {
		User::$id = $this->user['id'];
		User::$role = $this->user['role'];

		$this->create_user_token();
		Response::die_with_redirect('school', 'regular login');
	}

	public static function create_user_token() {
		if(Cookie::get('token')) Cookie::forget('token');
		$token = Token::generate(User::$id);
		Token_Table::insert_row(User::$id, $token);
		Cookie::bake('token', $token);
	}
}
