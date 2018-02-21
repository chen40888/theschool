<?php
class Edit_User_Table {
	public static function bring_user_to_update($id) {
		$query = "SELECT * FROM users WHERE id = $id";
		return DB::fetch_row($query);
	}
	public static function update_user($name, $phone, $id_card, $password, $email, $role, $file ,$id) {
		$query = 	"UPDATE users SET  name = '$name', phone = '$phone', id_card = '$id_card', email = '$email',
 		image = '$file', password = '$password', role = '$role'
 		WHERE id = $id";
		DB::execute('UPDATE', $query);
	}

}
