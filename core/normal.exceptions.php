<?php
class Login_Command_Exception extends Base_Exception {
  public static
	  $invalid_login_with_credentials = array('id' => 1, 'severity' => 'warning');
}

class Upload_Excel_Command_Exception extends Base_Exception  {
	public static
		$invalid_file_size_too_big = array('id' => 1),
		$invalid_excel_file = array('id' => 2),
		$failed_to_open_output_stream = array('id' => 3),
		$error_accessing_temp_file = array('id' => 4),
		$a_php_extension_stopped_the_file_upload = array('id' => 5),
		$invalid_excel_structure = array('id' => 6),
		$no_file_was_uploaded = array('id' => 7);
}

class Assign_Exam_To_Class_Command_Exception extends Base_Exception {
	public static
		$invalid_exam_id = array('id' => 2),
		$invalid_class_id = array('id' => 3);
}

class Signup_Command_Exception extends Base_Exception {
	public static
		$missing_id_card = array('id' => 1),
		$incorrect_id_card = array('id' => 2),
		$missing_password = array('id' => 3),
		$cannot_use_id_card_as_password = array('id' => 4);
}

class Authentication_Controller_Exception extends Base_Exception {
	public static
		$missing_mandatory_token = array('id' => 1, 'redirect' => 'login'),
		$invalid_token = array('id' => 2, 'redirect' => 'login'),
		$token_expired = array('id' => 3, 'redirect' => 'login');
}

class Token_Table_Exception extends Base_Exception {
	public static
		$invalid_user_id = array('id' => 1);
}

class Term_Association_Page_Exception extends Base_Exception {
	public static
		$missing_test_id = array('id' => 1);
}
