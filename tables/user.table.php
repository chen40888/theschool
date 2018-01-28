<?php
class User_Table {
	public static function get_full_name($id) {
		$sql = "SELECT u.full_name FROM user AS u WHERE u.id = '{$id}' LIMIT 1";
		return DB::fetch_value($sql);
	}

	public static function select_login_details($user_card_or_mail, $column_name) {
		$sql = "SELECT u.id, u.id_card, u.hash_password, u.role FROM user u
		WHERE u.{$column_name} = '{$user_card_or_mail}'
		ORDER BY u.id DESC LIMIT 1";
		return DB::fetch_row($sql);
	}

	public static function get_user_params_by_token($token) {
		if(!$token) return false;

		$sql = "SELECT u.*, t.date_created FROM user u 
		INNER JOIN token AS t ON t.token = '{$token}' 
		WHERE t.member_id = u.id AND t.status = 'valid'
		ORDER BY t.id DESC LIMIT 1";
		return DB::fetch_row($sql);
	}

	public static function get_user_id_by_card($id_card) {
		$sql = "SELECT u.id FROM user AS u WHERE u.id_card = '{$id_card}' LIMIT 1";
		return DB::fetch_value($sql);
	}

	public static function get_user($user_id) {
		$sql = "SELECT * FROM user AS u WHERE u.id = '{$user_id}' LIMIT 1";
		return DB::fetch_row($sql);
	}

	public static function get_user_by_card($id_card) {
		$sql = "SELECT * FROM user AS u WHERE u.id_card = '{$id_card}' LIMIT 1";
		return DB::fetch_row($sql);
	}

	public static function insert_new_user($role, $full_name, $gender, $id_card, $birth_date, $email) {
		$sql = "INSERT INTO user SET role = ?, full_name = ?, gender = ?, id_card = ?, birth_date = ?, email = ?";
		DB::execute('INSERT', $sql, array($role, $full_name, $gender, $id_card, $birth_date, $email));
	}

	public static function update_user($role, $full_name, $gender, $id_card, $birth_date, $email) {
		$sql = 	"UPDATE `user` u SET u.role = ?, u.full_name = ?, u.gender = ?, u.id_card = ?, u.birth_date = ?, u.email = ? WHERE id_card = ? LIMIT 1";
		DB::execute('UPDATE', $sql, array($role, $full_name, $gender, $id_card, $birth_date, $email, $id_card));
	}

	public static function get_signup_user_by_id_card($id_card) {
		$sql = "SELECT u.id, u.full_name, u.birth_date, u.email FROM user AS u WHERE u.id_card = '{$id_card}' LIMIT 1";
		return DB::fetch_row($sql);
	}

	public static function get_first_user_id() {
		$sql = "SELECT a.id FROM user a ORDER BY a.id LIMIT 1";
		return DB::fetch_value($sql);
	}

	public static function get_last_user_id() {
		$sql = "SELECT a.id FROM user a ORDER BY a.id DESC LIMIT 1";
		return DB::fetch_value($sql);
	}

	public static function get_total() {
		$sql = "SELECT count(a.id) AS total FROM user AS a";
		return (int) DB::fetch_value($sql);
	}

	public static function is_id_card_exists($id_card) {
		$sql = "SELECT EXISTS(SELECT 1 FROM user WHERE id_card = '{$id_card}' LIMIT 1)";
		return !!(DB::fetch_value($sql));
	}

	public static function get_role_enum_values() {
		return self::_get_enum_values('user', 'role');
	}

	public static function update_signup_user($full_name, $hash_pass, $gender, $birth_date, $email, $id_card) {
		$sql = 	"UPDATE `user` AS u SET u.full_name = ?, u.hash_password = ?, u.gender = ?, u.birth_date = ?, u.email = ? WHERE u.id_card = ? LIMIT 1";
		DB::execute('UPDATE', $sql, array($full_name, $hash_pass, $gender, $birth_date, $email, $id_card));
	}

	public static function get_by_role_or_all($role = NULL) {
		if($role) $role = "WHERE u.role = '{$role}'";

		$sql = "SELECT u.*, c.name AS class_name 
		FROM user u
		INNER JOIN user_to_class AS uc ON uc.user_id = u.id
		INNER JOIN class AS c ON c.id = uc.class_id
		{$role}
		ORDER BY u.id";

		return DB::fetch_all($sql);
	}

	public static function get_by_role($role) {
		$sql = "SELECT u.* 
		FROM user u
		WHERE u.role = '{$role}'
		ORDER BY u.id";

		return DB::fetch_all($sql);
	}

	public static function get_by_filter($filter) {
		$sql = "SELECT u.*, c.id AS class_id, c.name AS class_name 
		FROM user u
		INNER JOIN user_to_class AS uc ON uc.user_id = u.id
		INNER JOIN class AS c ON c.id = uc.class_id
		WHERE {$filter}
		ORDER BY u.id";
		return DB::fetch_all($sql);
	}

	private static function _get_enum_values( $table, $field ) {
		$sql = "SHOW COLUMNS FROM {$table} LIKE '{$field}'";
		$row = DB::fetch_all($sql);
		preg_match("/^enum\(\'(.*)\'\)$/", $row[0]["Type"], $matches);
		$enum = explode("','", $matches[1]);
		return array('default' => $row[0]["Default"], 'enum_values' => $enum);
	}

	public static function delete_user($user_id) {
		$sql = "DELETE FROM user WHERE id = '{$user_id}'";
		DB::execute('DELETE', $sql);
	}
}
