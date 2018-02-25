<?php
class Delete_Course_Table {

	public static function delete_course($id) {
		$query = "DELETE FROM students_courses WHERE cours_id=$id";
		DB::execute('DELETE', $query);
		$query = "DELETE FROM courses WHERE id= $id LIMIT 1";
		DB::execute('DELETE', $query);
	}
}
