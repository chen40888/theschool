<?php
class Delete_Student_Table {

	public static function delete_from_students_and_student_courses($id) {
		$query = "DELETE FROM students_courses WHERE student_id=$id";
		DB::execute('DELETE', $query);
		$query = "DELETE FROM students WHERE id= $id LIMIT 1";
		DB::execute('DELETE', $query);
	}
}
