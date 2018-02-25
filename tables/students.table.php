<?php
class Students_Table {
	public static function insert_student($name,$phone, $id_card, $email, $image_name) {
		$query = "INSERT INTO students SET name = '$name', phone = '$phone' ,id_card = '$id_card', email = '$email',image = '$image_name'";
		DB::execute('INSERT', $query);
	}

	public static function insert_into_courses($student_id,$course_id) {
		$query = "INSERT INTO students_courses SET student_id = '$student_id', cours_id = '$course_id'";
		DB::execute('INSERT', $query);
	}

	public static function get_all_with_table_name($table_name) {
		$query = "SELECT * FROM $table_name";
		return DB::fetch_all($query);
	}

	public static function get_this_student_id($id_card) {
		$query = "SELECT id FROM students WHERE id_card = '$id_card' LIMIT 1";
		return DB::fetch_value($query);
	}
}
