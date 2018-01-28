<?php
class Login_Controller {
	public function __construct($user_id, $password, $token_type) {
		if(Cookie::get('token')) Cookie::forget('token');
		$token = Token::generate($user_id);
		Token_Table::insert_row($user_id, $token);
		Cookie::bake('token', $token);
	}
}
