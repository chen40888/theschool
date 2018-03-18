<?php
/*
 *	Represents the token DB Table.
 *	Token Types = login | password_reset
 */
class Token_Table {
	public static function set_status_as($token, $status) {
		$sql = "UPDATE token SET status = '{$status}' WHERE token = '{$token}'";
		DB::execute('UPDATE', $sql);
	}

	public static function insert_row($member_id, $token, $status = 'valid', $type = 'login') {
		if(empty($member_id)) throw new Custom_Exception(Token_Table_Exception::$invalid_user_id);

		$date_created = date(conf('date.full'));
		$sql = "INSERT INTO token SET member_id = '{$member_id}', token = '{$token}', date_created = '{$date_created}', type = '{$type}', status = '{$status}'";
		DB::execute('INSERT', $sql);
	}
}
