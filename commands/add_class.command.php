<?php
class Add_Class_Command {
	public static $allowed_roles = array('teacher', 'principle', 'admin');

	public function __construct() {
		$teacher_id = Request::get('current_user_id');

		Response::die_with_response(array(
			//'new_class_id' => $new_class_id,
			'class_row_html' => User_Classes_Controller::get_class_row_html($new_class_id, $teacher_id, Class_Table::get_total_classes_of_teacher($teacher_id))
		));
	}
}
