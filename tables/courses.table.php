<?php

class Courses_Table {

	public static function insert_course($name,$description,$image_name) {
		$query = "INSERT INTO courses SET name = '$name', description = '$description' ,image = '$image_name'";
		DB::execute('INSERT', $query);
	}
}
