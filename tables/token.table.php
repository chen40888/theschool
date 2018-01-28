<?php
/*
 *	Represents the token DB Table.
 *	Token Types = login | password_reset
 */
class Token_Table {
	public static function select_token_row($token) {
		$sql = 'SELECT * FROM token t WHERE t.token = ?';
		return DB::fetch_row($sql, array($token));
	}

	public static function select_token($token) {
		$sql = 'SELECT token FROM token t WHERE t.token = ?';
		return DB::fetch_value($sql, array($token));
	}

	public static function get_member_id($token) {
		$sql = 'SELECT member_id FROM token t WHERE t.token = ?';
		return DB::fetch_value($sql, array($token));
	}

	public static function set_status_as($token, $status) {
		$sql = "UPDATE token SET status = '{$status}' WHERE token = '{$token}'";
		DB::execute('UPDATE', $sql);
	}

	public static function invalidate_all_valid_login_tokens($member_id) {
		$sql = "UPDATE token t SET t.status = 'invalid', t.comment = 'user_changed_password' WHERE t.member_id = '{$member_id}' AND t.type = '{login}' AND t.status = 'valid'";
		DB::execute('UPDATE', $sql);
	}

	public static function insert_row($member_id, $token, $status = 'valid', $type = 'login') {
		if(empty($member_id)) throw new Custom_Exception(Token_Table_Exception::$invalid_user_id);

		$date_created = date(conf('date.full'));
		$sql = 	"INSERT INTO token SET member_id = '{$member_id}', token = '{$token}', date_created = '{$date_created}', type = '{$type}', status = '{$status}'";
		DB::execute('INSERT', $sql);
	}

	public static function delete_token_of_user($user_id) {
		$sql = "DELETE FROM token WHERE member_id='{$user_id}'; ";
		DB::execute('DELETE', $sql);

	}
}
