<?php
/**
 * Authentication_Controller:
 * Verify that the request is authentic by checking that the provided token cookie exists in the DB and is valid.
 * Allow the request to continue if valid, if invalid: throw invalid authentication exception
 *
	Token Status:
	on login: valid
	on logout: invalid
	if token creation is more than 5 hours: expired -> mark current token as expired, generate a new token as valid in cookie
	if token creation is more than 2 days: expired -> mark current token as expired, redirect user to login
 */
class Authentication_Controller {
	public function __construct() {
		if(!User::$id && !Cookie::get('token')) return;
		else if(!Cookie::get('token')) throw new Custom_Exception(Authentication_Controller_Exception::$missing_mandatory_token);
		else if(!User::$id) $this->_on_invalid_token();
		else if($this->_token_is_older_than(strtotime('-2 days'))) $this->_on_token_older_than_2_days();
		else if($this->_token_is_older_than(strtotime('-5 hours'))) $this->_on_5_hours_old_token();
	}

	private function _on_invalid_token() {
		Cookie::forget('token');
		throw new Custom_Exception(Authentication_Controller_Exception::$invalid_token);
	}

	private function _token_is_older_than($time_diff) {
		$is_older_than_given_date = (strtotime(User::$token_date_created) <= $time_diff);
		//Log::w('$is_old: ' . bool_s($is_older_than_given_date) . ' | $created: ' . User::$token_date_created . ' <= $time: ' . date(conf('date.full'), $time_diff));

		return $is_older_than_given_date;
	}

	private function _on_token_older_than_2_days() {
		Token_Table::set_status_as(Cookie::get('token'), 'expired');
		Cookie::forget('token');
		throw new Custom_Exception(Authentication_Controller_Exception::$token_expired);
	}

	private function _on_5_hours_old_token() {
		Token_Table::set_status_as(Cookie::get('token'), 'expired');
		Cookie::forget('token');

		$new_token = Token::generate(User::$id);
		Token_Table::insert_row(User::$id, $new_token, 'valid', 'login');
		Cookie::bake('token', $new_token);
	}
}
