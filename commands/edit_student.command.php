<?php
class Edit_Student_Command {
	public static $allowed_roles = array('owner', 'manager','sales');

	public function __construct() {
		$this->_do_upload();
		$this->_on_upload_success();
		$this->_set_page_response();
	}

	public function _do_upload() {
		new Upload;
	}

	private function _on_upload_success() {
		$student_id = Request::get('id');
		$name = Request::get('student_name');
		$phone = Request::get('phone');
		$id_card = Request::get('id_card');
		$email = Request::get('email');
		$courses = Request::get('courses');
		$file_name = Files::get('name');

		Edit_Student_Table::update_student($name, $phone, $id_card, $email, $file_name, $student_id);
		$this->_update_student_courses($student_id, $courses);
	}

	private function _update_student_courses($student_id, $courses_array) {
		Students_Courses_Table::remove_student_from_courses($student_id);

		foreach($courses_array as $course_id){
			Students_Table::insert_into_courses($student_id, $course_id);
		}
	}

	private function _set_page_response() {
		new Page_Controller(true, array(
			'message' => '<div class="success_message">הסטודנט עודכן בהצלחה</div>'
		));
	}
}
