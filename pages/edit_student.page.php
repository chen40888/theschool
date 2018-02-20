<?php
class Edit_Student_Page {
	public static $allowed_roles = array('owner', 'teacher');

	public function __construct() {
		$id = Request::get('arg1');
		$student = Edit_Student_Table::bring_student_to_update($id);
		$update_form = Template::get_partial('edit_student',$student);
		Template::set('content',$update_form);
	}
}
