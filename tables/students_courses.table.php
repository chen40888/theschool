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
		WHERE c.course_id ='{$id}'";

		return DB::fetch_all($query);
	}

	public static function insert_into_courses($student_id,$course_id) {
		$query = "INSERT INTO students_courses SET student_id = '$student_id', course_id = '$course_id'";
		DB::execute('INSERT', $query);
	}

	public static function get_student_courses($id) {
		$query = "SELECT *
		FROM students_courses AS s
		RIGHT JOIN courses  AS c ON s.course_id = c.id
		WHERE s.student_id ='{$id}'";

		return DB::fetch_all($query);
	}
}
