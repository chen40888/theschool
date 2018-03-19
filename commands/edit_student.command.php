<?php
class Edit_Student_Command {
	public static $allowed_roles = array('owner', 'manager','sales');

	public function __construct() {

		Validation::validate(Request::all());

		if(!Files::get('name')){ // בדיקה עם יש file או לא
			$this->_update_student_use_same_image();
		}else {
			$this->_do_upload();
			$this->_on_upload_success();
		}
		$this->_set_page_response();// חיווי שאכן המשתמש הוסף.
	}

	private function _update_student_use_same_image() {
		$this->_update_student(true);//בוליאן אם איו file משנה לtrue וככה אני שולח אותו לפונקציה שונה. המטרה - ליעל את הקוד בשביל לא לחזור על עצמי.
		$this->_update_student_courses(Request::get('id'), Request::get('courses'));
	}

	public function _do_upload() {
		new Upload;
	}

	private function _on_upload_success() {
		$this->_update_student();
		$this->_update_student_courses(Request::get('id'), Request::get('courses'));
	}
// פנקציה שמעלה לdb אם אין תמונה  הוא משנה את הערך של $is_no_image ל true ושולח אותו במידת הצורך לפונקציה שמעלה ללא הimage וההפך
	private function _update_student($is_no_image = false) {
		$name = Request::get('student_name');
		$phone = Request::get('phone');
		$id_card = Request::get('id_card');
		$email = Request::get('email');
		$student_id = Request::get('id');
		$file_name = Files::get('name');

		if($is_no_image) Students_Table::update_student_same_image($name, $phone, $id_card, $email, $student_id);
		else Students_Table::update_student($name, $phone, $id_card, $email, $file_name, $student_id);
	}

	private function _update_student_courses($student_id, $courses_array) {
		Students_Courses_Table::remove_student_from_courses($student_id);

		foreach($courses_array as $course_id){
//			Log::w($course_id);
			Students_Courses_Table::insert_into_courses($student_id, $course_id);
		}
	}

	private function _set_page_response() {
		Template::set(array(
			'message' => '<div class="success_message">הסטודנט עודכן בהצלחה</div>'// מחזיר לאותו עמוד שהסטודנט עודכן בהצלחה
		));
	}
}
