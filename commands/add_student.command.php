<?php
class Add_Student_Command {

	public static $allowed_roles = array('owner', 'manager','sales');

	public function __construct() {
		if(Request::get('add_student')){
			$this->_do_upload();
		}
	}

	private function _do_upload() {
		include ROOT . 'classes/upload.php';
		$name = Request::get('student_name');
		$phone = Request::get('phone');
		$id_card = Request::get('id_card');
		$email = Request::get('email');
		$courses = Request::get('courses');
		$file_name = $_FILES["file"]["name"];

		Add_Student_Table::insert_student($name, $phone, $id_card, $email, $file_name);
		$student_id = $this->bring_student_id($id_card);
		$this->insert_to_students_courses($student_id,$courses);
	}

	function bring_student_id($id_card) {
		return Add_Student_Table::get_this_student_id($id_card);
	}

	function insert_to_students_courses($student_id,$courses) {
		foreach ($courses as $course_id){
			Add_Student_Table::insert_into_courses($student_id,$course_id);
		}
	}
}
