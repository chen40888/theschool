<?php

class Student_Details_Table {

	public static function one_student($id) {
		$query = "SELECT * FROM students WHERE id = '{$id}'";
		$result = DB::fetch_row($query);

		return $result;
	}

	public static function get_student_courses($id) {
		$query = "SELECT *
		FROM students_courses AS s
		RIGHT JOIN courses  AS c ON s.cours_id = c.id
		WHERE s.student_id ='{$id}'";

		$result = DB::fetch_all($query);
		return $result;
	}
}
