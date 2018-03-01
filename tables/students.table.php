<?php
class Students_Table {
	public static function insert_student($name,$phone, $id_card, $email, $image_name) {
		$query = "INSERT INTO students SET name = '$name', phone = '$phone' ,id_card = '$id_card', email = '$email',image = '$image_name'";
		DB::execute('INSERT', $query);
	}

	public static function get_all() {
		$query = "SELECT * FROM students";
		return DB::fetch_all($query);
	}

	public static function get_this_student_id($id_card) {
		$query = "SELECT id FROM students WHERE id_card = '$id_card' LIMIT 1";
		return DB::fetch_value($query);
	}
	public static function bring_student_to_update($id) {
		$query = "SELECT * FROM students WHERE id = $id";
		return DB::fetch_row($query);
	}

	public static function update_student_same_image($name, $phone, $id_card, $email, $id) {
		$query = "UPDATE students SET name = '$name', phone = '$phone', id_card = '$id_card', email = '$email'
 		WHERE id = $id";
		DB::execute('UPDATE', $query);
	}
	public static function update_student($name, $phone, $id_card, $email, $file_name, $id) {
		$query = "UPDATE students SET name = '$name', phone = '$phone', id_card = '$id_card', email = '$email', image = '$file_name'
 		WHERE id = $id";
		DB::execute('UPDATE', $query);
	}
	public static function delete_from_students_and_student_courses($id) {
		$query = "DELETE FROM students_courses WHERE student_id=$id";
		DB::execute('DELETE', $query);
		$query = "DELETE FROM students WHERE id= $id LIMIT 1";
		DB::execute('DELETE', $query);
	}

	public static function one_student($id) {
		$query = "SELECT * FROM students WHERE id = '{$id}'";
		return DB::fetch_row($query);
	}
}
