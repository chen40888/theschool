<?php
class Courses_Table {
	public static function insert_course($name,$description,$image_name){
		$sql = "INSERT INTO courses SET name = ?, description = ? ,image = ?";

		DB::execute('INSERT', $sql, array($name,$description,$image_name));
	}
	public static function _bring_course($id) {
		$query = "SELECT * FROM courses WHERE id = $id";
		return DB::fetch_row($query);
	}

	public static function _update_course($name, $description, $file ,$id){
		$sql = "UPDATE courses AS c SET c.name = ?, c.description = ? , c.image = ? WHERE c.id = ?";

		DB::execute('UPDATE', $sql, array($name, $description, $file ,$id));
	}
	public static function _update_course_same_image($name, $description ,$id){
		$sql = "UPDATE courses AS c SET c.name = ?, c.description = ? WHERE c.id = ?";

		DB::execute('UPDATE', $sql, array($name, $description, $id));
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
