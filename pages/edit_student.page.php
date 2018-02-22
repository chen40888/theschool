<?php
class Edit_Student_Page {
	public static $allowed_roles = array('owner', 'manager','sales');

	public function __construct() {
		$id = Request::get('arg1');
		$student = Edit_Student_Table::bring_student_to_update($id);
		$student['image'] = conf('url.students') . $student['image'];

		$update_form = Template::get_partial('edit_student', $student);
		Template::set('content', $update_form);
	}
}
