<?php

class Students_Inside_Course_Page {

	public static $allowed_roles = array('anonymous');

	public function __construct() {
		$uri = $_SERVER['REQUEST_URI'];
		$uri = explode('/',$uri);
//		var_dump($uri);
		$id = $uri['2'];

		$one_course = Students_Inside_Course_Table::one_course($id);
		var_dump($one_course);

		$all_students = Students_Inside_Course_Table::get_students_in_courses($id);
		var_dump($all_students);



	}
}
