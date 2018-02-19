<?php

class Students_Inside_Course_Table {

	public static function one_course($id) {
		$query = "SELECT * FROM courses WHERE id = '{$id}'";
		$result = DB::fetch_row($query);
		return $result;
	}

	public static function get_students_in_courses($id) {
		$query = "SELECT *
		FROM students_courses AS c
		RIGHT JOIN students  AS s ON c.student_id = s.id
		WHERE c.cours_id ='{$id}'";
		$result = DB::fetch_all($query);
		return $result;
	}
}
