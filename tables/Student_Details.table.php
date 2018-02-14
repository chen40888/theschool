<?php

class Student_Details_Table {

	public function __construct() {

	}

	public static function one_student($id) {
		$query = "SELECT * FROM students WHERE id = '{$id}'";
		$result = DB::fetch_row($query);
		return $result;
	}

	public static function get_courses_id($id) {
		$query = "SELECT cours_id FROM students_courses WHERE student_id = '{$id}'";
		$result = DB::fetch_all($query);
		return $result;
	}

	public static function get_student_in_courses($id) {
		$query = "SELECT * FROM courses WHERE id = '{$id}'";
		$result = DB::fetch_row($query);
		return $result;
	}
}
