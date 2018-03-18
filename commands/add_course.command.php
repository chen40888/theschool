<?php
class Add_Course_Command {
	public static $allowed_roles = array('owner', 'manager');

	public function __construct() {
		//Log::w(Request::all());
		Validation::validate(Request::all()); //בודק שאין input ריק
		$this->_do_upload();//עושה uplode
		$this->_on_upload_success();// אם מצליח לעשות עושה העלה לdb
		$this->_set_page_response();// שולח הודעת הצלחה במידה והכל עבד כמו שצריך, אם יש בעיה זה נשלח בexcaption
	}

	private function _do_upload() {
		new Upload;
	}

	private function _on_upload_success() {
		$name = Request::get('course_name');
		$description = Request::get('description');
		$file_name = Files::get('name');

		Courses_Table::insert_course($name, $description, $file_name);
	}

	private function _set_page_response() {
		Template::set(array(
			'message' => '<div class="success_message">הקורס הוסף בהצלחה</div>'
		));
	}
}

