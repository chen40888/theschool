<?php
class Add_Student_Command {
	public static $allowed_roles = array('owner', 'manager','sales');

	public function __construct() {
		//Log::w(Request::all());
		Validation::validate(Request::all());
		$this->_do_upload();
		$this->_on_upload_success();
		$this->_set_page_response();
	}

	public function _do_upload() {
		new Upload;
	}

	private function _on_upload_success() {
		$name = Request::get('student_name');
		$phone = Request::get('phone');
		$id_card = Request::get('id_card');
		$email = Request::get('email');
		$courses = Request::get('courses');
		$file_name = Files::get('name');


		Students_Table::insert_student($name, $phone, $id_card, $email, $file_name);
		$student_id = $this->_bring_student_id($id_card);
		$this->_enroll_student_to_courses($student_id, $courses);
	}

	private function _bring_student_id($id_card) {
		return Students_Table::get_this_student_id($id_card);
	}

	private function _enroll_student_to_courses($student_id, $courses) {
		foreach($courses as $course_id){
			Students_Courses_Table::insert_into_courses($student_id, $course_id);
		}
	}

	private function _set_page_response() {
		Template::set(array(
			'message' => '<div class="success_message">הסטודנט נרשם בהצלחה</div>'
		));
	}
}
