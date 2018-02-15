<?php
class Action_Table {

	public static function insert_course($name,$description,$image_name) {
		$query = "INSERT INTO courses SET name = '$name', description = '$description' ,image = '$image_name'";
		DB::execute('INSERT', $query);
	}

	public static function login_valid($mail_or_id, $pass) {
		$query = "SELECT * FROM users AS u WHERE u.password = '$pass' AND (u.email = '$mail_or_id' OR u.id = '$mail_or_id')";

		return DB::fetch_row($query);
	}

}
