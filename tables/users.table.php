<?php
class Users_Table {
	public static function select_login_details($user_card_or_mail, $password) {
		$sql = "SELECT u.id, u.id_card, u.role, u.email 
		FROM users AS u
		WHERE u.password = '{$password}'
		AND (u.email = '{$user_card_or_mail}' OR u.id_card = '{$user_card_or_mail}') 
		LIMIT 1";
		return DB::fetch_row($sql);
	}

	public static function get_user_params_by_token($token) {
		if(!$token) return false;

		$sql = "SELECT u.*, t.date_created 
		FROM users AS u 
		INNER JOIN token AS t ON t.token = '{$token}' 
		WHERE t.member_id = u.id AND t.status = 'valid'
		ORDER BY t.id DESC LIMIT 1";

		return DB::fetch_row($sql);
	}

	public static function insert_user($name, $phone, $id_card, $password, $email, $role, $file) {
		$query = "INSERT INTO users SET name = '$name', phone = '$phone' ,id_card = '$id_card', email = '$email',image = '$file',
 					password = '$password', role = '$role' ";
		DB::execute('INSERT', $query);
	}


}
