<?php

class Add_User_Table {

	public static function insert_user($name, $phone, $id_card, $password, $email, $role, $file) {
		$query = "INSERT INTO users SET name = '$name', phone = '$phone' ,id_card = '$id_card', email = '$email',image = '$file',
 					password = '$password', role = '$role' ";
		DB::execute('INSERT', $query);
	}
}
