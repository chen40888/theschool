<?php
class Students_Courses_Table {
	public static function remove_student_from_courses($student_id) {
		$sql = "DELETE FROM students_courses WHERE student_id = $student_id";
		DB::execute('DELETE', $sql);
	}

	public static function one_course($id) {
		$query = "SELECT * FROM courses WHERE id = '{$id}'";

		return DB::fetch_row($query);
	}

	public static function get_students_in_courses($id) {
		$query = "SELECT *
		FROM students_courses AS c
		RIGHT JOIN students  AS s ON c.student_id = s.id
		WHERE c.cours_id ='{$id}'";

		return DB::fetch_all($query);
	}
}
