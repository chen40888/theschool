<?php
class Edit_Student_Table {
	public static function bring_student_to_update($id) {
		$query = "SELECT * FROM students WHERE id = $id";
		return DB::fetch_row($query);
	}
	public static function update_student($name, $phone, $id_card, $email, $file_name, $id) {
		$query = 	"UPDATE students SET  name = '$name', phone = '$phone', id_card = '$id_card', email = '$email', image = '$file_name'
 		WHERE id = $id";
		DB::execute('UPDATE', $query);
	}

	public static function _bring_student_courses($id) {
		$query = "SELECT * FROM students_courses WHERE student_id = $id";
		return DB::fetch_all($query);
	}

	public static function _update_or_insert($student_id,$course_id) {
		$query = "IF EXISTS (SELECT * FROM students_courses WHERE student_id = $student_id)
	    UPDATE students_courses SET (cours_id = $course_id) WHERE student_id= $student_id
		 ELSE
	    INSERT INTO students_courses VALUES (student_id = $student_id, cours_id = $course_id)";

		DB::execute('INSERT',$query);
	}


}
