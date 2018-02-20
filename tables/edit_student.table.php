<?php
class Edit_Student_Table {
	public static function bring_student_to_update($id) {
		$query = "SELECT * FROM students WHERE id = $id";
		return DB::fetch_row($query);
	}
	public static function update_student($name, $phone, $id_card, $email, $file_name, $id) {
		$query = 	"UPDATE students SET  name = '$name', phone = '$phone', id_card = '$id_card', email = '$email', image = '$file_name'
 		WHERE id = $id";
		DB::execute('UPDATE', $query);
	}

}
