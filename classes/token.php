<?php
class Token {
	private static
		$token;

	public static function generate($user_id) {
		new self($user_id);
		return self::$token;
	}

	private function __construct($user_id) {
		$private_key = str_shuffle(conf('login_salt') . $user_id);
		$private_key = hash($algo = 'sha256', $private_key);
		$this->_generate_token($private_key);
	}

	private function _generate_token($private_key) {
		$length = 255 - strlen($private_key);
		self::$token = str_shuffle($this->_generate_random_string($length) . $private_key);
	}

	private function _generate_random_string($length) {
		$output = '';
		$token_characters_string = conf('token_characters');
		for($index = 0; $index < $length; $index++) {
			$output .= $token_characters_string[rand(0, strlen(conf('token_characters')) - 1)];
		}
		return $output;
	}
}
