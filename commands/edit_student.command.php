<?php
class Edit_Student_Command {
	public static $allowed_roles = array('owner', 'manager','sales');

	public function __construct() {
		if(Request::get('edit_student')) $this->_do_upload();
	}

	private function _do_upload() {
		if($_FILES) new Upload;
//		log::w(Upload::$is_upload_success);
		if(Upload::$is_upload_success) $this->_on_upload_success();
	}

	private function _on_upload_success() {
		$name = Request::get('student_name');
		$phone = Request::get('phone');
		$id_card = Request::get('id_card');
		$email = Request::get('email');
		$id = Request::get('id');
		$file = Files::get('name');
		$courses_from_checkbox = Request::get('courses');

//		Log::w(Request::all());

		$student_inside_courses = Edit_Student_Table::_bring_student_courses($id);

		foreach($courses_from_checkbox as $course_id) {
			Edit_Student_Table::_update_or_insert($id,$course_id);
		}

//		Log::w($student_courses_array . '$student_courses_array');

//		foreach($courses_from_checkbox as $this_course) {
//
//			foreach($student_inside_courses as $student_inside_course){
//				if($this_course != $student_inside_course) {
//// do insert
//				}
//			}
//
//		}



		Edit_Student_Table::update_student($name, $phone, $id_card, $email, $file, $id);
		new Page_Controller;

	}
}
