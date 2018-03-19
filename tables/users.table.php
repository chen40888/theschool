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
		$password = str_replace("'", "\'", $password);
		$name = str_replace("'", "\'", $name);
		$query = "INSERT INTO users SET name = '$name', phone = '$phone' ,id_card = '$id_card', email = '$email',image = '$file',
 					password = '$password', role = '$role' ";
		DB::execute('INSERT', $query);
	}

	public static function bring_user_to_update($id) {
		$query = "SELECT * FROM users WHERE id = $id";
		return DB::fetch_row($query);
	}

	public static function update_user($name, $phone, $id_card, $password, $email, $role, $file, $id) {
		$password = str_replace("'", "\'", $password);
		$name = str_replace("'", "\'", $name);
		$query = "UPDATE users SET  name = '$name', phone = '$phone', id_card = '$id_card', email = '$email',
 		image = '$file', password = '$password', role = '$role'
 		WHERE id = $id";
		DB::execute('UPDATE', $query);
	}

	public static function update_user_same_image($name, $phone, $id_card, $password, $email, $role, $id) {
		$password = str_replace("'", "\'", $password);
		$name = str_replace("'", "\'", $name);
		$query = "UPDATE users SET  name = '$name', phone = '$phone', id_card = '$id_card', email = '$email',
 		password = '$password', role = '$role'
 		WHERE id = $id";
		DB::execute('UPDATE', $query);
	}

	public static function get_all_users() {
		$query = "SELECT * FROM users";
		return DB::fetch_all($query);
	}

	public static function get_manager_and_sales() {
		$query = "SELECT * FROM users WHERE role = 'manager' OR role = 'sales'";
		return DB::fetch_all($query);
	}
	public static function delete_user($id) {
		$query = "DELETE FROM users WHERE id = {$id} LIMIT 1";
		DB::execute('DELETE', $query);
	}
}
