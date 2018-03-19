<?php
class Courses_Table {
	public static function insert_course($name,$description,$image_name) {
		$description = str_replace("'", "\'", $description);
		$name = str_replace("'", "\'", $name);
		$query = "INSERT INTO courses SET name = '$name', description = '$description' ,image = '$image_name'";
		DB::execute('INSERT', $query);
	}

	public static function _bring_course($id) {
		$query = "SELECT * FROM courses WHERE id = $id";
		return DB::fetch_row($query);
	}

	public static function _update_course($name, $description, $file ,$id) {
		$description = str_replace("'", "\'", $description);
		$name = str_replace("'", "\'", $name);
		$query = "UPDATE courses c SET c.name = '$name', c.description = '$description',c.image = '$file' WHERE c.id = '{$id}'";
		DB::execute('UPDATE', $query);
	}
	public static function _update_course_same_image($name, $description ,$id) {
		$description = str_replace("'", "\'", $description);
		$name = str_replace("'", "\'", $name);
		$query = "UPDATE courses AS c SET c.name = '$name', c.description = '$description' WHERE c.id = '{$id}'";
		DB::execute('UPDATE', $query);
	}
	public static function delete_course_with_students_inside($id) {
		$query = "DELETE FROM students_courses WHERE course_id = {$id}";
		DB::execute('DELETE', $query);

		$query = "DELETE FROM courses WHERE id = {$id} LIMIT 1";
		DB::execute('DELETE', $query);
	}
	public static function get_all() {
		$query = "SELECT * FROM courses";
		return DB::fetch_all($query);
	}
}
