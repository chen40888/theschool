<?php

class Students_Inside_Course_Table {

	public function __construct() {

	}

	public static function one_course($id) {
		$query = "SELECT * FROM courses WHERE id = '{$id}'";
		$result = DB::fetch_all($query);
		return $result;
	}

	public static function get_students_in_courses($id) {
		$query = "SELECT * FROM students_courses WHERE cours_id = '{$id}'";
		$result = DB::fetch_all($query);
		return $result;
	}
}
