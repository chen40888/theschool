<?php
class Login_Command_Exception extends Base_Exception {
  public static
	  $invalid_login_with_credentials = array('id' => 1, 'severity' => 'warning');
}

class Upload_Exception extends Base_Exception  {
	public static
		$file_is_not_an_image = array('id' => 1),
		$file_already_exists = array('id' => 2),
		$file_too_large = array('id' => 3),
		$bad_file_type_only_allow_jpg_jpeg_png_gif = array('id' => 4),
		$general_upload_error = array('id' => 5),
		$apache__invalid_file_size_too_big = array('id' => 6),
		$apache__no_file_was_uploaded = array('id' => 7),
		$apache__error_accessing_temp_file = array('id' => 8),
		$apache__failed_to_open_output_stream = array('id' => 9),
		$apache__a_php_extension_stopped_the_file_upload = array('id' => 10);
}

class Validation_Exception extends Base_Exception  {
	public static
		$empty_input = array('id' => 1);
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
